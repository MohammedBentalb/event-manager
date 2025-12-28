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
            $this->id = abs($value);
        }
    }

    public function setMatches($value){
        $this->matches= [...$this->matches, $value];
    }

    public function setTitle($value){
        $this->title = $value;
    }

    public function setCashPrize($value){
        $this->cashPrize = $value;
    }

    public function setFormat($value){
        $this->format = $value;
    }

    public function setdate($value){
        $this->date = $value;
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
        $this->createdAt = $value;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
}