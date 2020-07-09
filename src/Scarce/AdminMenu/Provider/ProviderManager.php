<?php

namespace Scarce\AdminMenu\Provider;

use pocketmine\plugin\Plugin;
use poggit\libasynql\DataConnector;
use Scarce\AdminMenu\Provider\Player\PlayerProvider;

class ProviderManager{

    public static $instance;
    private static $dbs = [];
    private static $providers = [];

    public function __construct(Plugin $plugin)
    {
        self::$instance = $this;
        self::$providers["PlayerProvider"] = new PlayerProvider($plugin);
    }


    public static function getProvider(string $name){
        if (isset(self::$providers[$name])){
            return self::$providers[$name];
        }
        return null;
    }


    public static function getProviders(){
        return self::$providers;
    }


    public static function getDataBases(){
        return self::$dbs;
    }


    public static function registerProvider(DataConnector $db){
        self::$dbs[] = $db;
    }

}
