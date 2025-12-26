<?php

namespace Manager;

use Repo\TournamentRepository;

class TournamentsManager{
    public function __construct(private TournamentRepository $tournamentRepo) {}
    
    public function list(){
        $res = $this->tournamentRepo->findAll();
        // (new Filler())->fillEntity(new club, ["id" => 1, "title" => "testing here", "yiy" => "yisi"]);
    }

    public function create(){
        $id = (int) input("Inset tournament id: ");
        $title = input("inset the title: ");
        $cashPrize = (int) input("inset the cashPrize: ");
        $format = input("inset the formmat (ex: 1v1): ");
        $date = input("inset the date: ");
        
    }
    
    public function update(){
        $title = input("inset the title: ");
        $cashPrize = (int) input("inset the cashPrize: ");
        $format = input("inset the formmat (ex: 1v1): ");
        $date = input("inset the date: ");
    }
    
    public function delete(){
        $id = (int) input("Inset tournament id: ");
    }
}