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
    private string $name;
    #[Preserve]
    #[Required]
    private string $city;
    private string $createdAt;
    
    public function __construct(){}

    public function setId($value){
        if(is_numeric($value)){
            return $this->id = abs($value);
        }
    }
    
    public function setName($value){
        return $this->name = $value;
    }
    
    public function setCity($value){
        return $this->city = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getCity(){
        return $this->city;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt($value){
        return $this->createdAt = $value;
    }

}