<?php

namespace Validation;

use Attributes\DefaultValue;
use Attributes\Preserve;
use Attributes\Required;
use Exception;
use ReflectionClass;

class EntityResolver{
    public function resolve($entity){
        $fields = [];
        $placeHolders = [];
        $values = [];

        $ref = new ReflectionClass($entity);
       
        foreach($ref->getProperties() as $property){
            if(!$property->getAttributes(Preserve::class)){
                continue;
            }

            $value = $property->getValue($entity);
            $hasDefaults = $property->getAttributes(DefaultValue::class);
            if($value === null && $hasDefaults){
                $defaultValue = $hasDefaults[0]->newInstance()->value;
                $property->setValue($entity, $defaultValue);
            }

            if($value === null && $property->getAttributes(Required::class)){
                return throw new Exception("{$property->getName()} is required,  but re reciesved $value");
            }

            $name = $property->getName();
            $fields[] = $name; 
            $placeHolders[] = ":$name"; 
            $values[$name] = $value; 
        }
        return new EntityKeys($fields, $placeHolders, $values);
    }
}