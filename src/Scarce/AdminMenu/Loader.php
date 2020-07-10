<?php

namespace Scarce\AdminMenu;

use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

    public static $instance;
    public $manager;


    public function onEnable()
    {
        self::$instance = $this;
        $this->manager = new AdminManager($this);
    }


    public function onLoad()
    {
        AdminManager::load($this);
    }

    public static function getInstance(){
        return self::$instance;
    }

}
