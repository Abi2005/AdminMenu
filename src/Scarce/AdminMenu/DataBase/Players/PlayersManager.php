<?php

namespace Scarce\AdminMenu\DataBase\Players;

use pocketmine\level\biome\UnknownBiome;
use pocketmine\plugin\Plugin;
use Scarce\AdminMenu\Provider\Player\PlayerProvider;

class PlayersManager{

    public const DEFAULT_TYPES = [0, 0];

    private static $players;

    public function __construct(Plugin $plugin)
    {
        PlayerProvider::load([], function (array $rows){
            foreach ($rows as $row){
                self::$players[strtolower($row["player_name"])] = new Player($row["player_name"], json_decode($row["ban_types"]), $row["ban_count"],$row["ipban_count"], $row["warnings"], $row["reports"], $row["mutes"], $row["kicks"], $row["address"]);
            }
        });
    }

    public static function PlayerExists($name){
        $name = strtolower($name);
        foreach (self::$players as $name1 => $player){
            if ($name === $name1){
                return true;
            }
        }
        return false;
    }

    public static function getPlayer(string $name):Player{
        $name = strtolower($name);
        if (self::PlayerExists($name)){
            return self::$players[$name];
        }
        return null;
    }

    public static function createPlayer(string $name, string $address){
        if (self::getPlayer($name) !== null){
            return self::getPlayer($name);
        }
        PlayerProvider::create([
            "player_name" => $name,
            "ban_types" => json_encode(self::DEFAULT_TYPES),
            "ban_count" => 0,
            "ipban_count" => 0,
            "warnings" => 0,
            "reports" => 0,
            "mutes" => 0,
            "kicks" => 0,
            "address" => $address
        ]);
        self::$players[strtolower($name)] = new Player($name, self::DEFAULT_TYPES, 0, 0, 0 ,0, 0, 0, $address);
        return self::$players[strtolower($name)];
    }

}