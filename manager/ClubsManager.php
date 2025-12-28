<?php

namespace Manager;

use Repo\ClubRepository;

class ClubsManager{
    public function __construct(private ClubRepository $clubRepo) {}
    
    public function list(){
        $res = $this->clubRepo->findAll();
        var_dump($res);
    }

    public function listOne(){
        $id = input("give the tournament id: ");
        $res = $this->clubRepo->findById((int) $id);
        var_dump($res);
    }

    public function create(){
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
        $id = (int) input("Inset club id: ");
    }
}