<?php 
namespace Model;
use Attributes\Preserve;
use Attributes\Required;
use Attributes\OneToMany;
use Attributes\Table;
use Model\Team;


#[Table("clubs")]
class club {
    #[Preserve]
    private ?int $id = null;
    #[Preserve]
    #[Required]
    private string $name;
    #[Preserve]
    #[Required]
    private string $city;
    private string $createdAt;

    #[OneToMany("clubId", Team::class)]
    private array $teams = [];
    
    public function __construct(){}

    public function setId($value){
        if(is_numeric($value)){
            $this->id = abs($value);
        }
    }

    public function setTeams($value){
        $this->teams = [...$this->teams, $value];
    }
 
    public function setCity($value){
        $this->city = $value;
    }

    public function setName($value){
        $this->name = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getCity(){
        return $this->city;
    }

    public function getName(){
        return $this->name;
    }

    public function setCreatedAt($value){
        return $this->createdAt = $value;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
}