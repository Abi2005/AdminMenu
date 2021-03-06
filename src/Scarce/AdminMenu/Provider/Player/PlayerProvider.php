<?php

namespace Scarce\AdminMenu\Provider\Player;


use pocketmine\plugin\Plugin;
use poggit\libasynql\libasynql;
use Scarce\AdminMenu\Provider\BaseProvider;
use Scarce\AdminMenu\Provider\ProviderManager;

class PlayerProvider extends BaseProvider implements IPlayerProvider {

    public static $db;

    public function __construct(Plugin $plugin)
    {
        self::$db = ProviderManager::getDataBase();
        self::getProvider()->executeGeneric(self::PLAYER_INIT);
        ProviderManager::registerProvider(self::$db);
    }

    public static function create($args):void {
        self::getProvider()->executeInsert(self::PLAYER_CREATE, $args);
    }

    public static function load($args, $callable):void{
        self::getProvider()->executeSelect(self::PLAYER_LOAD, $args, $callable);
    }

    public static function update($args):void{
        self::getProvider()->executeChange(self::PLAYER_UPDATE, $args);
    }
}
