<?php

namespace Scarce\AdminMenu;

use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use Scarce\AdminMenu\DataBase\DataBaseManager;
use Scarce\AdminMenu\Provider\ProviderManager;
use jojoe77777\FormAPI\Form;

class AdminManager{

    public $plugin;

    public const VIRIONS = ["libFormApi" => Form::class];

    public static $provider;
    public $databasemanager;

    public static function load(Plugin $plugin){
        self::$provider = new ProviderManager($plugin);
    }

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
        $this->checkVirions();
        $this->databasemanager = new DataBaseManager($plugin);
    }

    public function checkVirions(){
        foreach (self::VIRIONS  as $name => $class){
            if (!class_exists($class)){
                $this->plugin->getLogger()->info(TextFormat::RED . "$name Virion missing");
                $this->plugin->getServer()->getPluginManager()->disablePlugin($this->plugin);
            }
        }
    }

}
