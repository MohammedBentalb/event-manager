<?php 

namespace Repo;

use Model\Tournament;
use ORM\EntityManager;

class TournamentRepository extends EntityManager{
    protected static string $entityTable = "tournaments";
    protected static string $entityClass = Tournament::class;
}