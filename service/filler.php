<?php

namespace Service;

use Attributes\OneToMany;
use Attributes\Table;
use Exception;
use ReflectionClass;

class Filler{
    public function __construct(private Strings $strings){}
    
    public function fillEntity(string $modalClass, array $data){
        if(!$data) throw new Exception("the needed data is not set: $data is recieved");
        if(!$modalClass) throw new Exception("the needed class modal is not set: $modalClass is recieved");

        $ref = new ReflectionClass($modalClass);
        $entity = $ref->newInstance();
        $entity->setId(12);
        var_dump($entity);
        $tableAttribute = $ref->getAttributes(Table::class)[0];
        $joinTable = "";
        foreach($ref->getProperties() as $property){
            if($property->getAttributes(OneToMany::class)){
                $joinTable = $property->getName();
            }
        }

        $tableName = $tableAttribute->newInstance()->tableName;
        $items = [];


        foreach($data as $datum){
            foreach($datum as $key => $value){
                if(str_contains($key, $tableName. "_")){
                    $bareKey = ucfirst(str_replace($tableName . "_", "", $key));                    
                    if(in_array($bareKey, ["Created_at", "Update_at"])) $bareKey = $this->strings->toCamelCase($bareKey, true);
                    if($ref->hasMethod("set" . $bareKey)){
                        $method = $ref->getMethod("set$bareKey");
                        $method->invoke($entity, $value);
                    };   
                }

                $method = "set" . ucfirst($key);
                $field = $ref->hasProperty($method);
            }
            break;
        }
        return $items;
    }
}