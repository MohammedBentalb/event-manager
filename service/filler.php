<?php

namespace Service;

use Exception;
use ReflectionClass;

class Filler{

    public function entityFiller(object $entity, array $data){
        if(!$data) throw new Exception("the needed data is not set: $data is recieved");
        if(!$entity) throw new Exception("the needed entity is not set: $entity is recieved");

        $ref = new ReflectionClass($entity);
        foreach($data as $key => $value){
            $field = $ref->hasProperty($key);
        }
    }
}