<?php

namespace Repo;

use Model\club;
use ORM\EntityManager;


class ClubRepository extends EntityManager{
    protected static string $entityTable = "clubs"; 
    protected static string $entityClass = club::class; 
}