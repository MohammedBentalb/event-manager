<?php 

namespace Model;

use Attributes\Preserve;
use Attributes\Required;
use Attributes\Table;

#[Table("matches")]
class Matches{
    #[Preserve]
    private ?int $id = null;
    #[Preserve]
    #[Required]
    private int $score_a;
    #[Preserve]
    #[Required]
    private int $score_b;
    #[Preserve]
    #[Required]
    private int $tournamentId;
    #[Preserve]
    #[Required]
    private string $team_a;
    #[Preserve]
    #[Required]
    private string $team_b;
    #[Preserve]
    #[Required]
    private int $winnerId;
    private string $createdAt;
    
    public function __construct(){}

    public function setId($value){
        if(is_numeric($value)){
            return $this->id = abs($value);
        }
    }

    public function setScoreA($value){
        $this->score_a = $value;
    }

    public function setScoreB($value){
        $this->score_b = $value;
    }

    public function setTournamentId($value){
        $this->tournamentId = $value;
    }

    public function setTeamA($value){
        $this->team_a = $value;
    }

    public function setTeamB($value){
        $this->team_b = $value;
    }

    public function setWinnerId($value){
        $this->winnerId = $value;
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

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt($value){
        return $this->createdAt = $value;
    }

}