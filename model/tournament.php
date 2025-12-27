<?php 

namespace Model;

use Attributes\OneToMany;
use Attributes\Preserve;
use Attributes\Required;
use Attributes\Table;

#[Table("tournaments")]
class Tournament {
    #[Preserve]
    private ?int $id = null;
    #[Preserve]
    #[Required]
    private $title;
    #[Preserve]
    #[Required]
    private $cashPrize;
    #[Preserve]
    #[Required]
    private $format;
    #[Preserve]
    #[Required]
    private $date;
    private $createdAt;

    #[OneToMany("tournamentId", Matches::class)]
    private array $matches = [];
    
    public function __construct(){}

    public function setId($value){
        if(is_numeric($value)){
            return $this->id = abs($value);
        }
    }

    public function setMatches($value){
        return $this->matches= [...$this->matches, $value];
    }

    public function setTitle($value){
        return $this->title = $value;
    }

    public function setCashPrize($value){
        return $this->cashPrize = $value;
    }

    public function setFormat($value){
        return $this->format = $value;
    }

    public function setdate($value){
        return $this->date = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getCashPrize(){
        return $this->cashPrize;
    }

    public function getFormat(){
        return $this->format;
    }

    public function getdate(){
        return $this->date;
    }

    public function setCreatedAt($value){
        return $this->createdAt = $value;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
}