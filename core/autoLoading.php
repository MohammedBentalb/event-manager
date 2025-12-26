<?php 

namespace core;

use ErrorException;

class AutoLoading{
    public function autoLoad(){
        spl_autoload_register(function($class){
            $file = str_replace('\\', "/", $class) . ".php";
            if(!is_file($file)){
                throw new ErrorException("$class could not be found");
            }
            require_once($file);
        });
    }
}