<?php

namespace Scarce\AdminMenu\utils;

use pocketmine\utils\TextFormat;

class MessageUtils{

    public const PREFIX = TextFormat::BOLD . TextFormat::BOLD . "[AdminMenu]";
    public const COLOR = TextFormat::LIGHT_PURPLE;

    public const PLAYER_SELECT = self::COLOR . "Player Name";
    public const PLAYER_NOT_SELECTED = self::PREFIX . "Player Not Selected";
    public const PLAYER_NEVER_JOINED = self::COLOR . "Player has never join this server";

    public const REASON = TextFormat::RED . "Reason:";
    public const REASON_NOTGIVEN = self::PREFIX . " Reason not Given";

}