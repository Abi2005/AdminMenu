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
        self::$db = libasynql::create($plugin, $plugin->getConfig()->get(""), [
            "sqlite" => "AdminMenu.ql"
        ]);
        self::getProvider()->executeGeneric(self::PLAYER_INIT);
        ProviderManager::registerProvider(self::$db);
    }

    public function create($args):void {
        self::getProvider()->executeInsert(self::PLAYER_CREATE, $args);
    }

    public function load($args, $callable):void{
        self::getProvider()->executeSelect(self::PLAYER_LOAD, $args, $callable);
    }

    public function update($args):void{
        self::getProvider()->executeChange(self::PLAYER_UPDATE, $args);
    }
}
