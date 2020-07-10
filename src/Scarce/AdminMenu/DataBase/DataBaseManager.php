<?php

namespace Scarce\AdminMenu\DataBase;

use pocketmine\plugin\Plugin;
use Scarce\AdminMenu\DataBase\Bans\BansManager;
use Scarce\AdminMenu\DataBase\Players\PlayersManager;

class DataBaseManager{

    public static $instance;

    private $bansmanager;
    private $playersmanager;

    public function __construct(Plugin $plugin)
    {
        self::$instance = $this;
        $this->bansmanager = new BansManager($plugin);
        $this->playersmanager = new PlayersManager($plugin);
    }

    public static function getInstance(){
        return self::$instance;
    }

}
