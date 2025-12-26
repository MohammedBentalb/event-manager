<?php

namespace Service;

use Error;
use Exception;
use ReflectionClass;

class Resolver{

    public function __construct(private Container $container){}
    
    public function resolve($class){
        $args = [];
        $ref = new ReflectionClass($class);
        
        if(!$ref->isInstantiable()){
            throw new Exception("$class is not a class");
        }
        
        $constructor = $ref->getConstructor();
        if(!$constructor) return new $class();
        
        foreach($constructor->getParameters() as $parapeters){
            $type = $parapeters->getType();
            if($type && !$type->isBuiltin()){
                $args[] = $this->container::getInstance($type->getName());
                continue;
            }

            if($parapeters->isDefaultValueAvailable()){
                $args[] = $parapeters->getDefaultValue();
                continue;
            }
            throw new Exception("can't resolve params of $class");
        }
        return $ref->newInstanceArgs($args);
    }
}