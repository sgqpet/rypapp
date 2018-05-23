# rypapp
Ryp APP1.0.3
Ryp project private code.

1 provider
Sgqpet\Rypapp\RypappServiceProvider::class,

2 aliases
'Rypapp' => Sgqpet\Rypapp\Facades\Rypapp::class,

use Rypapp

	$data = array(  
            'ret'  => 'abc',  
            'code' => 200,  
            'data' => array(1, 2,['a'=>'aa','c'=>'cc']),  
            'msg'  => "success",  
	); 
	//encode 
	Rypapp::rsa_encode( $data );

	//decode data to object request
	Rypapp::rsa_decode( $request->pk , 1 ,$request);

	//make a signature return string
	Rypapp::rsa_sign( $_REQUEST );

	//verify sign return boole
	Rypapp::rsa_verify( $_REQUEST,$request->pk);
