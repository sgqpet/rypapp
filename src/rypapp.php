<?php
namespace Sgqpet\Rypapp;
use Illuminate\Config\Repository;
use Config,Session;
use Sgqpet\Rypapp\Repository\RSA;
use Illuminate\Http\Request;
class Rypapp{
	
	/**
     * @var Session
     */
    protected $session;
    /**
     * @var Repository
     */
    protected $config;

    public const SECRET_KEY = 'secret_key';
    /**
     * rypapp constructor.
     * @param SessionManager $session
     * @param Repository $config
     */
    public function __construct( $session, Repository $config)
    {
        $this->session = $session;
        $this->config  = $config;
    }

    //init
    public function ryp_init(){
        return true;
    }

    //加密
    static public function rsa_encode( $data , $url = true ){
        $re = self::get_rsa_object()->encrypt( $data );
        if( $url ){
            return urlencode( $re );
        } else {
            return $re;
        }
    }

    //解密
    static public function rsa_decode( $data ,$arr = true ,$request){
        $re = self::get_rsa_object()->decrypt( $data ); 

        if( $arr ){

            $re = json_decode( $re );   
            self::data2Request( $re , $request);
            return $re;

        } else {
            return $re;
        }
    }

    //签名方法
    static public function rsa_sign( $data , $url = true ){
        $str  = self::arrtostring( $data );
        $re   = self::get_rsa_object()->sign( $str );
        if( $url ){
            return urlencode( $re );
        } else {
            return $re;
        }
    }

    //验证签名
    static public function rsa_verify( $data , $sign ){
        $str  = self::arrtostring( $data );
        $re   = self::get_rsa_object()->verify( $str  , $sign  );
        return $re;
    }

    //生成证书pem
    static public function make_key( $file_name_arr ){
        $rsa = self::get_rsa_object();
        return $rsa->make_key( $file_name_arr );
    }

    //获得rsa对象
    static public function get_rsa_object( $public_file = '' , $pivate_file = '' ){
        return new RSA( $public_file ,$pivate_file );
    }

    //生成签名字符串
    static public function arrtostring( $params ){
        $key    = '';
        $except = self::SECRET_KEY;

        if( isset( $params[$except] ) ){ unset( $params[$except] ); }
        
        sort($params);

        $merge_str = json_encode($params);
        return $merge_str;
    }

    //data back to obj request
    static public function data2Request( $data ,$request ){

        if( !$data ){ return; }
        foreach( $data as $k=>$v ){
            $request->$k = $v;
        }
    }

    //获得key名字
    static public function get_secret_key(){
        return self::SECRET_KEY;
    }
}