<?php

namespace Scarce\AdminMenu\Provider;

use pocketmine\plugin\Plugin;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use Scarce\AdminMenu\Provider\bans\BanProvider;
use Scarce\AdminMenu\Provider\Player\PlayerProvider;

class ProviderManager{

    public static $database;
    public static $instance;
    private static $dbs = [];
    private static $providers = [];

    public function __construct(Plugin $plugin)
    {
        self::$instance = $this;
        self::$database = libasynql::create($plugin, $plugin->getConfig()->get("AdminMenu"), [
            "sqlite" => "AdminMenu.ql"
        ]);
        self::$providers["PlayerProvider"] = new PlayerProvider($plugin);
        self::$providers["BanProvider"] = new BanProvider($plugin);
    }

    public static function getDataBase():DataConnector{
        return self::$database;
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


    public static function getInstance(){
        return self::$instance;
    }


    public static function registerProvider(DataConnector $db){
        self::$dbs[] = $db;
    }

}
