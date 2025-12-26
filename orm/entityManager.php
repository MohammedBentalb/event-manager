<?php 

namespace ORM;

use Database\Database;
use \PDO;
use Service\GetRelations;
use Validation\EntityResolver;



abstract class EntityManager  {
    protected static string $entityTable;
    protected static string $entityClass;
    private PDO $conn;
    
    public function __construct(private EntityResolver $resolver, private GetRelations $getRelations){
        $this->conn = Database::getConnection();
    }
    
    public function create($entity){
        $data = $this->resolver->resolve($entity);
        $stm = $this->conn->prepare("INSERT INTO " . static::$entityTable . " (". $data->getFields() .") VALUES (". $data->getPlaceholders() .")");
        $res = $stm->execute($data->getValues());
        return $res;
    } 

    public function update($entity){
        $data = (new EntityResolver())->resolve($entity); 
        $stm = $this->conn->prepare("UPDATE " . static::$entityTable . " SET ". $data->getPlaceholders(true) ." where id = :id");
        $res = $stm->execute($data->getValues());
        return $res;
    }

    public function findAll(){
        // ["joinKey" => $joinKey, "joinTable" => $joinTbale] = $this->getRelations->getRelation(static::$entityClass);
        $relations = $this->getRelations->getRelation(static::$entityClass);
        $joins = [];
        
        foreach($relations as $relation){
            $joins[] = "JOIN {$relation['joinTable']} ON {$relation['joinTable']}.{$relation['joinKey']} = " . static::$entityTable . ".id";
        }
        
        $stm = $this->conn->prepare("SELECT * FROM " . static::$entityTable . " " . implode(", ", $joins) ." ORDER BY " .  static::$entityTable. ".created_at");
        $stm->execute();
        $res = $stm->fetchAll();
        return $res ? $res : null;
    }

    public function findById(int $id){
        $stm = $this->conn->prepare("SELECT * FROM ". static::$entityTable ." WHERE id = :id");
        $stm->execute(["id" => $id]);
        $res = $stm->fetch();
        return $res ? $res : null;
    }

    public function delete(int $id){
        $stm = $this->conn->prepare("DELETE FROM " . static::$entityTable . " WHERE id = :id");
        $res = $stm->execute(["id" => $id]);
        return $res ? $res : null;
    }   
}