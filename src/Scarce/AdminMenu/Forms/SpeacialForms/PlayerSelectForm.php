<?php

namespace Scarce\AdminMenu\Forms\SpeacialForms;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\Player;
use Scarce\AdminMenu\DataBase\Players\PlayersManager;
use Scarce\AdminMenu\Forms\BaseForm;
use Scarce\AdminMenu\utils\MessageUtils as M;

class PlayerSelectForm extends BaseForm{

    public $title;
    public $class;

    public function __construct(Player $player, string $title, string $class)
    {
        $this->title = $title;
        $this->class = $class;
        $callable = $this->Callable();
        $this->form = new CustomForm($callable);
        $this->addElements();
    }

    public function Callable():callable{
        return $callable = function (Player $player, ?array $data){
            if ($data === null){
                return;
            }
            if (isset($data[0]) && $data[0] !== ""){
                if (PlayersManager::PlayerExists($data[0])){
                    $aplayer = PlayersManager::getPlayer($data[0]);
                    $form = new $this->class($player, $aplayer->getName());
                    if ($form instanceof BaseForm){
                        $form->sendTo($player);
                        return;
                    }
                }
            }else{
                $player->sendMessage(M::PLAYER_NOT_SELECTED);
                return;
            }
        };
    }

    public function addElements()
    {
        $this->form->setTitle($this->title);
        $this->form->addInput(M::PLAYER_SELECT, "", "");
    }

}
