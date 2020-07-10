<?php

namespace Scarce\AdminMenu\Forms\BanForms;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use Scarce\AdminMenu\AdminAPI;
use Scarce\AdminMenu\DataBase\Players\PlayersManager;
use Scarce\AdminMenu\Forms\BaseForm;
use Scarce\AdminMenu\utils\MessageUtils as M;

class BanForm extends BaseForm{

    public $name;
    public const TITLE = TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Ban";

    public function __construct(Player $player, string $name)
    {
        if (PlayersManager::getPlayer($name) !== null){
            $this->name = PlayersManager::getPlayer($name)->getName();
        }else{
            $this->name = null;
        }
        $this->player = $player;
        $callable = $this->Callable();
        $this->form = new CustomForm($callable);
    }

    public function Callable():callable
    {
        $callable = function (Player $player, ?array $data){
            if ($data === null){
                return;
            }
            if (isset($data[1]) && $data[1] !== ""){
                AdminAPI::getInstance()->banPlayer($this->name, $player->getName(), $data[1]);
                return;
            }
            $player->sendMessage(M::REASON_NOTGIVEN);
            return;
        };
    }

    public function addElements()
    {
        $this->form->setTitle(self::TITLE);
        if ($this->name === null){
            $this->form->addLabel(M::PLAYER_NEVER_JOINED);
        }else{
            $insight = AdminAPI::getInstance()->getPlayerMenuInformation($this->name, $this->player->getName());
            $insight = implode(" ", $insight);
            $this->form->addLabel($insight);
        }
        $this->form->addInput(M::REASON, "", "");
    }

}
