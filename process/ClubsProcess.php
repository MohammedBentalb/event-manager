<?php

namespace Process;

use Manager\ClubsManager;
use Service\Container;

class ClubsProcess{

    public function runProcess(){
        $clubsProcessEnd = false;
        while(!$clubsProcessEnd){
            echo PHP_EOL;
            echo "==== Clubs managing ====\n";
            echo "1. List Clubs\n";
            echo "2. create Clubs\n";
            echo "3. Update Clubs\n";
            echo "4. Delete Clubs\n";
            echo "0. exit Clubs\n";
            
            $userChoice = input("Choose action: ");
            
            switch($userChoice){
                case 1:
                    Container::getInstance(ClubsManager::class)->list();
                    break;
                case 2:
                    Container::getInstance(ClubsManager::class)->create();
                    break;
                case 3:
                    Container::getInstance(ClubsManager::class)->update();
                    break;
                case 4:
                    Container::getInstance(ClubsManager::class)->delete();
                    break;
                case 0:
                    $clubsProcessEnd = true;
                    break;
                default:
                    break;
            }
        }
    }
}