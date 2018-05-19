<?php
namespace Sgqpet\Rypapp\Facades;
use Illuminate\Support\Facades\Facade;
class Rypapp extends Facade
{
    protected static function getFacadeAccessor()
    {
    	// src/rypapp.php
        return 'rypapp';
    }
}

?>