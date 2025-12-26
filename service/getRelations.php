<?php 


namespace Service;

use Attributes\OneToMany;
use Exception;
use ReflectionClass;

class GetRelations{
    public function __construct(private tableResolver $tableResolver) {}
    public function getRelation(string $class){
        $relations = [];
        $ref = new ReflectionClass($class);
        if(!$ref->isUserDefined()) return throw new Exception("$class is not a valid class");

        foreach($ref->getProperties() as $property){
            foreach($property->getAttributes(OneToMany::class) as $hasRelation){
                    $OneToMany = $hasRelation->newInstance();
                    $JoinKey = $OneToMany->foreignKey;
                    $joinTable = $this->tableResolver->getTableName($OneToMany->tergetModel);
                    $relations[] = ["joinKey" => $JoinKey, "joinTable" => $joinTable];    
            }
        }
        return $relations;
    }
}