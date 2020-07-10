<?php

namespace Scarce\AdminMenu;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\plugin\Plugin;
use Scarce\AdminMenu\DataBase\Bans\BansManager;

class EventListener implements Listener{

    public function __construct(Plugin $plugin)
    {

    }


    public function onPreLogin(PlayerPreLoginEvent $event){

    }

    public function normalBan(PlayerPreLoginEvent $event){
        $player = $event->getPlayer();
        if (BansManager::BanExists($player->getName())){
            $ban = BansManager::getBan($player->getName());
            if ($ban->getType() === BansManager::BAN_NORMAL){
                $reason = $ban->getReason();
                $player->kick($reason, false);
            }
        }
    }

}
