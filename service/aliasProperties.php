<?php

namespace Service;

use Attributes\Table;
use Exception;
use ReflectionClass;

class AliasProperties {
    public function __construct(private Strings $strings) {}
    public function aliasAllProperties(string $classModel){
        $ref = new ReflectionClass($classModel);
        if(!$ref->isUserDefined()) throw new Exception("$classModel is not a valid class");
        $tableClass = $ref->getAttributes(Table::class)[0] ?? null;
        if(!$tableClass) throw new Exception("$classModel does not have db table");
        
        $table = $tableClass->newInstance()->tableName;
        $aliases = [];

        foreach($ref->getProperties() as $property){
            $name = $property->getName();
            if(in_array($name, ["matches", "clubs", "tournaments", "teams", "sponsors", "players"])) continue ;
            
            if(in_array($name, ["createdAt", "updatedAt"])) $name = $this->strings->toSnakeCase($name);
            $baseAliase = str_split($table)[0];
            $aliases[] = "$baseAliase.$name AS $table" ."_" . "$name";
        }
        return $aliases;
    }

}