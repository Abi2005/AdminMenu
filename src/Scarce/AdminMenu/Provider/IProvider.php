<?php

namespace Scarce\AdminMenu\Provider;

interface IProvider{

    public static function create($args);

    public static function load($args, $callable);

    public static function update($args);

}