<?php 

namespace Service;

use Attributes\Table;
use Exception;
use ReflectionClass;

class tableResolver {
    public function getTableName($modalClass){
        $ref = new ReflectionClass($modalClass);
        if(!$ref->isUserDefined()) throw new Exception("$modalClass is not a valid modal class");
        
        $attribute = $ref->getAttributes(Table::class)[0];
        if(!$attribute) throw new Exception("the attribute could not be found, $attribute recived instead");
        return $attribute->newInstance()->tableName;
    }
}