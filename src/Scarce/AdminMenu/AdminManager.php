<?php

namespace Scarce\AdminMenu;

use pocketmine\plugin\Plugin;
use Scarce\AdminMenu\Provider\ProviderManager;

class AdminManager{

    public static $provider;

    public static function load(Plugin $plugin){
        self::$provider = new ProviderManager($plugin);
    }

    public function __construct(Plugin $plugin)
    {

    }

}
