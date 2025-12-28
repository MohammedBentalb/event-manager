<?php 
namespace Model;

use Attributes\Preserve;
use Attributes\Required;
use Attributes\Table;

#[Table("players")]
class Player {
    #[Preserve]
    private ?int $id = null;
    #[Preserve]
    #[Required]
    private string $teamId;
    #[Required]
    #[Preserve]
    private string $pseudo;
    #[Required]
    #[Preserve]
    private string $role;
    #[Required]
    #[Preserve]
    private int $salary;
    private string $createdAt;
    
    public function __construct(){}

    public function setId($value){
        if(is_numeric($value)){
            $this->id = abs($value);
        }
    }
    
    public function setTeamId($value){
        $this->teamId = $value;
    }

    public function setSalary($value){
        $this->salary = $value;
    }
    
    public function setPseudo($value){
        $this->pseudo = $value;
    }
    
    public function setRole($value){
        $this->role = $value;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getTeamId(){
        return $this->teamId;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function getSalary(){
        return $this->salary;
    }
    
    public function getRole(){
        return $this->role;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt($value){
        $this->createdAt = $value;
    }
}