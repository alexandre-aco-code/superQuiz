<?php
    $text1 = "Je vois que l'on se porte bien, bienvenue";
    $text2 = "Je vois qu'on pousse à la salle, bienvenue";
    $text3 = "Très belle dégaine, bienvenue";
    $text4 = "Quel regard, bienvenue";
    $text5 = "Votre mine est radieuse, bienvenue";
    $variable = rand(1, 5);
    switch ($variable) {
        case 1:
            $text = $text1;
            break;
        case 2:
            $text = $text2;
            break;
        case 3:
            $text = $text3;
            break;
        case 4:
            $text = $text4;
            break;
        case 5:
            $text = $text5;
            break;
    }
?>