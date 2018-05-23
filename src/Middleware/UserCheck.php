<?php

namespace App\Http\Middleware;

use Closure;
use Rypapp;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //make
        //$key_string = self::make_key_string( $_REQUEST ,'#adf#12','hash');
        //dump($_REQUEST,$key_string);

dd( Rypapp::ryp_init() );
        //veriry
        $re = self::make_key_string( $_REQUEST ,'','hash',1 );
        if( !$re ){
            $back['message'] = 'incorect!';
            return json_encode($back);
        }
        return $next($request);
    }

    static public function make_key_string( $params , $secret='' ,$type='hash' , $auth = false ){
        $key = '';
        if( !$params ){ return false; }
        if( isset( $params['key'] ) ){ $key = $params['key'];  unset( $params['key'] ); }
        
        sort($params);

        $merge_str = implode('',$params).$secret;

        if( $auth ){
            if( $type == 'hash'){
                return password_verify( $merge_str, $key );
            } else {
                return (MD5($merge_str) == $key);
            }
        }

        if( $type == 'hash'){
            return password_hash( $merge_str ,PASSWORD_BCRYPT );
        } else {
            return MD5($merge_str);
        }
        
    }

    

}
