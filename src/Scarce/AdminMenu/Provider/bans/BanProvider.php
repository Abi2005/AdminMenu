<?php

namespace Scarce\AdminMenu\Provider\bans;


use pocketmine\plugin\Plugin;
use poggit\libasynql\libasynql;
use Scarce\AdminMenu\Provider\BaseProvider;
use Scarce\AdminMenu\Provider\ProviderManager;

class BanProvider extends BaseProvider implements IBanProvider {

    public static $db;

    public function __construct(Plugin $plugin)
    {
        self::$db = ProviderManager::getDataBase();
        self::getProvider()->executeGeneric(self::BANS_INIT);
        ProviderManager::registerProvider(self::$db);
    }

    public static function create($args):void {
        self::getProvider()->executeInsert(self::BANS_CREATE, $args);
    }

    public static function load($args, $callable):void{
        self::getProvider()->executeSelect(self::BANS_LOAD, $args, $callable);
    }

    public static function update($args):void{
        self::getProvider()->executeChange(self::BANS_UPDATE, $args);
    }

    public static function delete($args)
    {
        self::getProvider()->executeGeneric(self::BANS_DELETE, $args);
    }
}
