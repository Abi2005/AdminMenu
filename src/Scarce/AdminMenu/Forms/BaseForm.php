<?php

namespace Scarce\AdminMenu\Forms;

use pocketmine\Player;

class BaseForm{

    public $form;
    public $player;


    public function sendTo(Player $player){
        $player->sendForm($this->form);
    }

    public function addElements(){}

    public function Callable(){
    }

}