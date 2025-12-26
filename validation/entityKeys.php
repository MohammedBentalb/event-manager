<?php

namespace Validation;

class EntityKeys{

    public function __construct(private array $fields, private array $placeholders, private array $values) {}

    public function getFields(){
        return implode(", ", $this->fields);
    }
    
    public function getPlaceholders(bool $update = false){
        if(!$update) return implode(", ", $this->placeholders);
        $group = [];
        foreach($this->values as $key => $value){
            $group[] =  "$key = :$key";
        }
        return $group;
    }

    public function getValues(){
        return $this->values;
    }
}