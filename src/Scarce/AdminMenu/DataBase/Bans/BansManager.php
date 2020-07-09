<?php

namespace Scarce\AdminMenu\DataBase\Bans;

use pocketmine\plugin\Plugin;
use Scarce\AdminMenu\Provider\bans\BanProvider;

class BansManager{

    public const NOT_BANNED = 0;
    public const BAN_NORMAL = 1;
    public const TEMP_BANNED = 2;

    private static $bans;
    public static $instance;

    public function __construct(Plugin $plugin)
    {
        self::$instance = $this;
        BanProvider::load([], function (array $rows){
            foreach ($rows as $row){
                self::$bans[strtolower($row["player_name"])] = new Ban($row["player_name"], $row["reason"], $row["admin"], $row["ban_type"], $row["duration"]);
            }
        });
    }
    public static function getInstance(){
        return self::$instance;
    }


    public static function BanExists(string $name){
        $name = strtolower($name);
        foreach (self::$bans as $banname => $ban){
            if ($banname === $name){
                return true;
            }
        }
        return false;
    }

    //Add A Ban
    public static function addBan(string $name, int $type, string $reason, string $admin, int $duration = 0){
        switch ($type){
            case self::BAN_NORMAL:
                $ban = self::getInstance()->addNormalBan($name, $reason, $admin);
                return $ban;
                break;
            case self::TEMP_BANNED:
                $ban = self::getInstance()->addTempBan($name, $reason, $admin, $duration);
                return $ban;
                break;
        }
    }

    public static function getBan(string $name):Ban{
        $name = strtolower($name);
        if (self::BanExists($name)){
            return self::$bans[$name];
        }
        return null;
    }



    private function addNormalBan(string $name, string $reason, string $admin){
        if (self::BanExists($name)){
            return null;
        }
        BanProvider::create([
            "player_name" => $name,
            "reason" => $reason,
            "admin" => $admin,
            "ban_type" => self::BAN_NORMAL,
            "duration" => 0
        ]);
        self::$bans[strtolower($name)] = new Ban($name, $reason, $admin, self::BAN_NORMAL, 0);
        return self::$bans[strtolower($name)];
    }

    private function addTempBan($name, $reason, $admin, $duration){
        if (self::BanExists($name)){
            return null;
        }
        BanProvider::create([
            "player_name" => $name,
            "reason" => $reason,
            "admin" => $admin,
            "ban_type" => self::TEMP_BANNED,
            "duration" => $duration + time()
        ]);
        self::$bans[strtolower($name)] = new Ban($name, $reason, $admin, self::TEMP_BANNED, $duration);
        return self::$bans[strtolower($name)];
    }

}
