<?php 

namespace Model;

use Attributes\Preserve;
use Attributes\Required;
use Attributes\Table;

#[Table("matchs")]
class Matchs{
    #[Preserve]
    private $id;
    #[Preserve]
    #[Required]
    private $score_a;
    #[Preserve]
    #[Required]
    private $score_b;
    #[Preserve]
    #[Required]
    private $tournamentId;
    #[Preserve]
    #[Required]
    private $team_a;
    #[Preserve]
    #[Required]
    private $team_b;
    #[Preserve]
    #[Required]
    private $winnerId;
    private $createdAt;
    
    public function __construct(){}

    public function setId($value){
        if(is_numeric($value)){
            return $this->id = abs($value);
        }
    }

    public function setScoreA($value){
        return $this->score_a = $value;
    }

    public function setScoreB($value){
        return $this->score_b = $value;
    }

    public function setTournamentId($value){
        return $this->tournamentId = $value;
    }

    public function setTeamA($value){
        return $this->team_a = $value;
    }

    public function setTeamB($value){
        return $this->team_b = $value;
    }

    public function setWinnerId($value){
        return $this->winnerId = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getScoreA(){
        return $this->score_a;
    }

    public function getScoreB(){
        return $this->score_b;
    }

    public function getTournamentId(){
        return $this->tournamentId;
    }

    public function getTeamA(){
        return $this->team_a;
    }

    public function getTeamB(){
        return $this->team_b;
    }

    public function getWinnerId(){
        return $this->winnerId;
    }

    public function getCreationDate(){
        return $this->createdAt;
    }

}