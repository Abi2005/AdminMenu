<?php

namespace Scarce\AdminMenu\DataBase\Bans;

use Scarce\AdminMenu\Provider\bans\BanProvider;

class Ban{

    private $name;
    private $reason;
    private $admin;
    private $ban_type;
    private $duration;

    public function __construct(string $name, string $reason, string $admin, int $ban_type, int $duration)
    {
        $this->name = $name;
        $this->reason = $reason;
        $this->admin = $admin;
        $this->ban_type = $ban_type;
        $this->duration = $duration;
    }
    //getters
    public function getName():string {
        return $this->name;
    }

    public function getReason():string {
        return $this->reason;
    }

    public function getAdmin():string {
        return $this->admin;
    }

    public function getType():int {
        return $this->ban_type;
    }

    public function getDuration():int {
        return $this->duration;
    }

    //setters
    public function setName(string $name):void{
        $this->name = $name;
        $this->update();
    }

    public function setReason(string $reason):void {
        $this->reason = $reason;
        $this->update();
    }

    public function setAdmin(string $admin):void {
        $this->admin = $admin;
        $this->update();
    }

    public function setType(int $type):void{
        $this->ban_type = $type;
        $this->update();
    }

    public function setDuration(int $duration):void {
        $this->duration = $duration = time();
        $this->update();
    }

    public function updateBan(string $name, string $reason, string $admin, int $ban_type, int $duration){
        $this->name = $name;
        $this->reason = $reason;
        $this->admin = $admin;
        $this->ban_type = $ban_type;
        $this->duration = $duration;
        $this->update();
    }


    public function update(){
        BanProvider::update([
            "player_name" => $this->name,
            "reason" => $this->reason,
            "admin" => $this->admin,
            "ban_type" => $this->ban_type,
            "duration" => $this->duration
        ]);
    }

}
