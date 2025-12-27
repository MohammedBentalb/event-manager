<?php 

namespace ORM;

use Database\Database;
use \PDO;
use Service\AliasProperties;
use Service\Filler;
use Service\GetRelations;
use Validation\EntityResolver;



abstract class EntityManager {
    protected static string $entityTable;
    protected static string $entityClass;
    private PDO $conn;
    
    public function __construct(private EntityResolver $resolver, private GetRelations $getRelations, private AliasProperties $aliasModel, private Filler $entiityFiller){
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
        $relations = $this->getRelations->getRelation(static::$entityClass);
        // generating aliases from properties to avoid overwriting the colums eith thesame name like id and created at
        $baseAliases = $this->aliasModel->aliasAllProperties(static::$entityClass);

        $aliases[] = $baseAliases;
        $joins = [];
        // table first name to be used as an alias for the query
        $baseTAlias = str_split(static::$entityTable)[0];
        $baseTable = static::$entityTable;
        // final array that would be used in the query; it containes all aliases needed for create the query
        $basePAlias = [];
        foreach($relations as $relation){
            $relationTAlias = str_split($relation['joinTable'])[0];
            $joins[] = "LEFT JOIN {$relation['joinTable']} $relationTAlias ON $relationTAlias.{$relation['joinKey']} = " . $baseTAlias . ".id";
            $aliases[] = $this->aliasModel->aliasAllProperties($relation["targetModel"]);
        }
        if(!empty($joins)) $core = " " . static::$entityTable . ".id AS "; 

        foreach($aliases as $a){
            $basePAlias[] = implode(", ", $a);
        }

        $stm = $this->conn->prepare("SELECT ". implode(",", $basePAlias) . " FROM $baseTable $baseTAlias " . implode(" ", $joins) ." ORDER BY " . $baseTAlias . ".created_at");
        $stm->execute();
        $res = $stm->fetchAll();
        return $res ? $this->entiityFiller->fillEntity(static::$entityClass, $res) : null;
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