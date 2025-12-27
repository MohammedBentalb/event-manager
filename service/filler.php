<?php
namespace Service;

use Attributes\OneToMany;
use Attributes\Table;
use Exception;
use ReflectionClass;

class Filler {
    public function __construct(private Strings $strings) {}

    public function fillEntity(string $modelClass, array $data): array {
        if (!$data) throw new Exception("No data received to hydrate entity.");
        if (!$modelClass) throw new Exception("Model class not provided.");

        $items = [];
        $ref = new ReflectionClass($modelClass);
        $tableAttr = $ref->getAttributes(Table::class)[0]->newInstance();
        $tableName = $tableAttr->tableName;

        $relations = [];
        foreach ($ref->getProperties() as $property) {
            $attributes = $property->getAttributes(OneToMany::class);
            if ($attributes) {
                $attr = $attributes[0]->newInstance();
                $relations[$property->getName()] = $attr->tergetModel;
            }
        }

        foreach ($data as $datum) {
            $itemKey = $datum[$tableName . '_id'] ?? null;
            if (!$itemKey) continue;

            if (!isset($items[$itemKey])) {
                $entity = $ref->newInstance();
                foreach ($datum as $key => $value) {
                    if (str_starts_with($key, $tableName . '_')) {
                        $bareKey = ucfirst(str_replace($tableName . '_', '', $key));
                        if (in_array($bareKey, ['Created_at', 'Update_at'])) {
                            $bareKey = $this->strings->toCamelCase($bareKey, true);
                        }
                        if ($ref->hasMethod("set$bareKey")) {
                            $method = $ref->getMethod("set$bareKey");
                            $method->invoke($entity, $value);
                        }
                    }
                }
                $items[$itemKey] = $entity;
            } else {
                $entity = $items[$itemKey];
            }

            foreach ($relations as $propName => $childClass) {
                $childRef = new ReflectionClass($childClass);
                $childEntity = $childRef->newInstance();
                
                foreach ($datum as $key => $value) {
                    if (str_starts_with($key, $propName . '_') && $value !== null) {
                        $bareKey = ucfirst(str_replace($propName . '_', '', $key));
                        if (in_array($bareKey, ['Created_at', 'Update_at'])) {
                            $bareKey = $this->strings->toCamelCase($bareKey, true);
                        }
                        if ($childRef->hasMethod("set$bareKey")) {
                            $method = $childRef->getMethod("set$bareKey");
                            $method->invoke($childEntity, $value);
                        }
                    }
                }

                $adder = "set" . ucfirst($propName);
                if ($ref->hasMethod("set" . ucfirst($propName)) && $childEntity->getId() !== null) {
                    $method = $ref->getMethod($adder);
                    $method->invoke($entity, $childEntity);
                }
            }
        }
        return $items;
    }
}