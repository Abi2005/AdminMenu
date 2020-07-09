<?php

namespace Scarce\AdminMenu\Provider\bans;

use Scarce\AdminMenu\Provider\IProvider;

interface IBanProvider extends IProvider{

    public const BANS_INIT = "AdminMenu.bans.init";
    public const BANS_CREATE = "AdminMenu.bans.create";
    public const BANS_LOAD = "AdminMenu.bans.load";
    public const BANS_UPDATE = "AdminMenu.bans.update";
    public const BANS_DELETE = "AdminMenu.bans.delete";

    public static function delete($args);
}
