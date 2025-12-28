<?php

namespace Service;

class AliasesEntity {
    public function __construct( public string $baseTable, public string $baseAlias, public array $joins, public array $selectAliases){}
}
