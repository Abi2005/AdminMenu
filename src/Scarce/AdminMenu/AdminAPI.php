<?php

namespace Scarce\AdminMenu;

use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use Scarce\AdminMenu\DataBase\Bans\Ban;
use Scarce\AdminMenu\DataBase\Bans\BansManager;
use Scarce\AdminMenu\DataBase\Players\PlayersManager;

class AdminAPI{

    public static $instance;

    public const PERMISSION_IMMUINE = "";
    public const PERMISSION_ADDRESS_SEE = "";

    public function __construct(Plugin $plugin)
    {
        self::$instance = $this;
    }

    public static function getInstance(){
        return self::$instance;
    }



    public function getPlayerMenuInformation(string $name, string $admin){
        if (PlayersManager::PlayerExists($name)){
            $player = PlayersManager::getPlayer($name);
            $n = $player->getName();
            $ban = BansManager::getBan($name);
            $pname = TextFormat::LIGHT_PURPLE . "$name>\n";
            $w = $player->getWarnings();
            $m = $player->getMutes();
            $k = $player->getKicks();
            $r = $player->getReports();
            $ad = $player->getAddress();
            $warnings = TextFormat::GOLD . "Warnings: $w";
            $mutes = TextFormat::GOLD . "Mutes: $m";
            $kicks = TextFormat::GOLD . "Kicks: $k";
            $reports = TextFormat::GOLD . "Reports: $r";
            $address = TextFormat::GOLD . "Address: $ad";
            $banned = "";
            $reason = "";
            $badmin = "";
            $duration = "";
            if ($ban !== null){
                if ($ban->getType() === BansManager::BAN_NORMAL){
                    $banned = TextFormat::GOLD . "Banned: True\n";
                }else{
                    $banned = TextFormat::GOLD . "TempBanned: \n";
                    $du = $ban->getDuration();
                    $durati = new \DateTime("@$du");
                    $format = $durati->format("Y-m-d H:i:s\n");
                    $duration = TextFormat::GOLD . $format;
                }
                $r = $ban->getReason();
                $a = $ban->getAdmin();
                $reason = TextFormat::GOLD . "Reason: $r\n";
                $badmin = TextFormat::GOLD . "Admin: $a\n";
            }
            $addresversion = [];
            array_push($addresversion, $pname, $warnings, $banned, $reason, $badmin, $duration, $mutes, $kicks, $reports, $address);
            $nonaddressversion = [];
            array_push($nonaddressversion, $pname, $warnings, $banned, $reason, $badmin, $duration, $mutes, $kicks, $reports);
            if (Server::getInstance()->getPlayer($admin) !== null){
                $pl = Server::getInstance()->getPlayer($admin);
                if ($pl->hasPermission(self::PERMISSION_ADDRESS_SEE)){
                    return $addresversion;
                }else{
                    return $nonaddressversion;
                }
            }
            if (Server::getInstance()->getOfflinePlayer($admin) !== null){
                $thing = Server::getInstance()->getOfflinePlayer($admin);
                if ($thing->hasPermission(self::PERMISSION_ADDRESS_SEE)){
                    return $addresversion;
                }else{
                    return $nonaddressversion;
                }
            }
            if ($admin === "CONSOLE"){
                return $addresversion;
            }
            return $nonaddressversion;
        }else{
            return null;
        }
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
