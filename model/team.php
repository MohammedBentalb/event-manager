<?php 

namespace Model;

use Attributes\OneToMany;
use Attributes\Preserve;
use Attributes\Required;
use Attributes\Table;

#[Table("teams")]
class Team{
    #[Preserve]
    private ?int $id = null;
    #[Preserve]
    #[Required]
    private int $clubId;
    #[Preserve]
    #[Required]
    private string $name;
    #[Preserve]
    #[Required]
    private string $game;
    private string $createdAt;

    #[OneToMany("teamId", Player::class)]
    private array $players = [];

    public function __construct(){}

    public function setId($value){
        if(is_numeric($value)){
            $this->id = abs($value);
        }
    }

    public function setClubId($value){
        $this->clubId = $value;
    }

    public function setName($value){
        $this->name = $value;
    }

    public function setGame($value){
        $this->game = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getClubId(){
        return $this->clubId;
    }

    public function getName(){
        return $this->name;
    }

    public function getGame(){
        return $this->game;
    }

    public function setCreatedAt($value){
        $this->createdAt = $value;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
}