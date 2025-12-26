<?php

namespace Service;

class Container{
    private static $instances = [];
    
    static function getInstance($class){
        if(!isset(static::$instances[$class])){
            static::$instances[$class] = (new Resolver(new Container))->resolve($class);
        }
        return static::$instances[$class];
    }
}