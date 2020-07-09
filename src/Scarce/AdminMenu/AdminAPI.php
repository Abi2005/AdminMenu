<?php

namespace Scarce\AdminMenu;

use pocketmine\plugin\Plugin;
use pocketmine\Server;
use Scarce\AdminMenu\DataBase\Bans\Ban;
use Scarce\AdminMenu\DataBase\Bans\BansManager;
use Scarce\AdminMenu\DataBase\Players\PlayersManager;

class AdminAPI{

    public const PERMISSION_IMMUINE = "";

    public function __construct(Plugin $plugin)
    {
    }

    //Should be used to normally ban a player
    public function banPlayer(string $name, string $admin, string $reason){
        if (Server::getInstance()->getPlayer($admin) !== null){
            $aplayer = Server::getInstance()->getPlayer($name);
            if ($aplayer->hasPermission(self::PERMISSION_IMMUINE)){
                return false;
            }
        }
        if (Server::getInstance()->getOfflinePlayer($name) !== null){
            $oplayer = Server::getInstance()->getOfflinePlayer($name);
            if ($oplayer->hasPermission(self::PERMISSION_IMMUINE)){
                return false;
            }
        }
        if (PlayersManager::PlayerExists($name)){
            $player = PlayersManager::getPlayer($name);
            $player->ban();
        }
        if (!BansManager::BanExists($name)){
            BansManager::addBan($name, BansManager::BAN_NORMAL, $reason, $admin);
        }else{
            $ban = BansManager::getBan($name);
            $ban->updateBan($name, $reason, $admin, BansManager::BAN_NORMAL, 0);
        }
        return true;
    }

}
