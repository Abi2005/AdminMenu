<?php

namespace Scarce\AdminMenu\Provider\Player;

use Scarce\AdminMenu\Provider\IProvider;

interface IPlayerProvider extends IProvider {

    public const PLAYER_INIT = "AdminMenu.players.init";
    public const PLAYER_CREATE = "AdminMenu.players.create";
    public const PLAYER_LOAD = "AdminMenu.players.load";
    public const PLAYER_UPDATE = "AdminMenu.players.update";

}
