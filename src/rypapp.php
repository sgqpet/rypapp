<?php
namespace Sgqpet\Rypapp;
use Illuminate\Config\Repository;
use Config,Session;
class Rypapp{
	
	/**
     * @var Session
     */
    protected $session;
    /**
     * @var Repository
     */
    protected $config;
    /**
     * rypapp constructor.
     * @param SessionManager $session
     * @param Repository $config
     */
    public function __construct( $session, Repository $config)
    {
        $this->session = $session;
        $this->config = $config;
    }
    /**
     * @param string $msg
     * @return string
     */
    public function testing($msg = ''){
        $config_arr = Config::get('rypapp');
        Session::put("sess","I am Session");
        dump($config_arr );
        return $msg.' from your custom develop package!-'.Session::get('sess');
    }
}