<?php
namespace Service;

class AliasExractor{
    public function __construct(private GetRelations $relations, private AliasProperties $aliasModel) {}

    public function extract(string $entityClass, string $entityTable) {
        $relations = $this->relations->getRelation($entityClass);
        $baseTable = $entityTable;
        $baseAlias = strtolower($baseTable[0]);
        $joins = [];
        $selectAliases = [];
        $selectAliases[] = implode(', ', $this->aliasModel->aliasAllProperties($entityClass));

        foreach ($relations as $relation) {
            $joinTable = $relation['joinTable'];
            $joinAlias = strtolower($joinTable[0]);
            $joins[] = "LEFT JOIN {$joinTable} {$joinAlias} ON {$joinAlias}.{$relation['joinKey']} = {$baseAlias}.id";
            $selectAliases[] = implode(', ', $this->aliasModel->aliasAllProperties($relation['targetModel']));
        }

        return new AliasesEntity ($baseTable, $baseAlias, $joins, $selectAliases);
    }
}