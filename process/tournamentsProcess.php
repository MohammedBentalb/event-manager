<?php

namespace Process;

use Manager\TournamentsManager;
use Service\Container;

$endOfFirstProcess = false;

class tournamentsProcess{

    public function runProcess(){
        $firstProcessEnd = false;
        while(!$firstProcessEnd){
            echo PHP_EOL;
            echo "==== Tournaments managing ====\n";
            echo "1. List Tournaments\n";
            echo "2. create Tournaments\n";
            echo "3. Update Tournament\n";
            echo "4. Delete Tournament\n";
            echo "0. exit Tournaments\n";
            
            $userChoice = input("Choose action: ");
            
            switch($userChoice){
                case 1:
                    Container::getInstance(TournamentsManager::class)->list();
                    break;
                case 2:
                    Container::getInstance(TournamentsManager::class)->create();
                    break;
                case 3:
                    Container::getInstance(TournamentsManager::class)->update();
                    break;
                case 4:
                    Container::getInstance(TournamentsManager::class)->delete();
                    break;
                case 0:
                    $firstProcessEnd = true;
                    break;
                default:
                    break;
            }
        }
    }
}