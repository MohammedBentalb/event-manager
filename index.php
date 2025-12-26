<?php

use core\AutoLoading;
use Process\ClubsProcess;
use process\tournamentsProcess;
use Service\Container;

require_once('./core/autoLoading.php');

(new AutoLoading)->autoLoad();

function input($msg){
    echo "$msg : ";
    return trim(fgets(STDIN), "");
}

$mainProcessEnd = false;

while(!$mainProcessEnd){
    echo PHP_EOL;
    echo "==== USER CRUD CONSOLE ====\n";
    echo "1. Manage Tournaments\n";
    echo "3. Manage Clubs\n";
    echo "4. Manage Matchs\n";
    echo "5. Manage Notifications\n";
    echo "6. Manage Sponsors\n";
    echo "0. Exit\n";
    
    $container = new Container();
    $choice = input("choose");

    switch($choice){
        case 1:
            $container->getInstance(tournamentsProcess::class)->runProcess();
            break;
        case 2:
            $container->getInstance(ClubsProcess::class)->runProcess();
            break;
        case 3:
            echo $choice;
            break;
        case 4:
            echo $choice;
            break;
        case 0:
            echo "Ayayay";
            $mainProcessEnd = true;
            break;
        default: 
            return;
    }
}