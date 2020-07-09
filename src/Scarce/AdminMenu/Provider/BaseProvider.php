<?php

namespace Scarce\AdminMenu\Provider;

use poggit\libasynql\DataConnector;

abstract class BaseProvider{

    public static $db;


    public function close(){
        if (self::$db instanceof DataConnector){
            if (self::$db->close() !== null){
                self::$db->waitAll();
                self::$db->close();
            }
        }
    }

    public static function getProvider():DataConnector{
        return self::$db;
    }



}
