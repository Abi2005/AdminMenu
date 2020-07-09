<?php

namespace Scarce\AdminMenu\DataBase\Players;

use Scarce\AdminMenu\DataBase\Bans\BansManager;
use Scarce\AdminMenu\Provider\Player\PlayerProvider;

class Player{

    private $name;
    private $ban_types;
    private $ban_count;
    private $ipban_count;
    private $warnings;
    private $reports;
    private $mutes;
    private $kicks;
    private $address;
    public function __construct(string $name, array $ban_types, int $ban_count, int $ipban_count, int $warnings, int $reports, int $mutes, int $kicks, string $address)
    {
        $this->name = $name;
        $this->ban_types = $ban_types;
        $this->ban_count = $ban_count;
        $this->ipban_count = $ipban_count;
        $this->warnings = $warnings;
        $this->reports = $reports;
        $this->mutes = $mutes;
        $this->kicks = $kicks;
        $this->address = $address;
    }

    //Getters
    public function getName():string {
        return $this->name;
    }

    public function getTypes():array {
        return $this->ban_types;
    }

    public function getBanCount():int{
        return $this->ban_count;
    }

    public function getIpBanCount():int{
        return $this->ipban_count;
    }

    public function getWarnings():int{
        return $this->warnings;
    }

    public function getReports(){
        return $this->reports;
    }

    public function getMutes():int{
        return $this->mutes;
    }

    public function getKicks():int{
        return $this->kicks;
    }

    public function getAddress():string {
        return $this->address;
    }
    //Setters
    public function setName($name):void{
        $this->name = $name;
        $this->update();
    }

    public function setBanType(int $type):void{
        $this->ban_types[0] = $type;
        $this->update();
    }

    public function setIpBanType(int $type):void{
        $this->ban_types[1] = $type;
        $this->update();
    }

    public function setBanCount(int $count):void {
        $this->ban_count = $count;
        $this->update();
    }

    public function setIpBanCount(int $count):void {
        $this->ipban_count = $count;
        $this->update();
    }

    public function setWarnings(int $count):void {
        $this->warnings = $count;
        $this->update();
    }

    public function setReports(int $count):void {
        $this->reports = $count;
        $this->update();
    }

    public function setMutes(int $count):void {
        $this->mutes = $count;
        $this->update();
    }

    public function setKicks(int $count):void {
        $this->kicks = $count;
        $this->update();
    }

    public function setAddress(int $count):void {
        $this->address = $count;
        $this->update();
    }
    //bans
    public function ban(){
        $this->setBanCount($this->getBanCount() + 1);
        $this->setBanType(BansManager::BAN_NORMAL);
    }

    public function unban(){
        $this->setBanType(BansManager::NOT_BANNED);
    }



    public function update(){
        PlayerProvider::update([
            "player_name" => $this->name,
            "ban_types" => json_encode($this->ban_types),
            "ban_count" => $this->ban_count,
            "ipban_count" => $this->ipban_count,
            "warnings" => $this->warnings,
            "reports" => $this->reports,
            "mutes" => $this->mutes,
            "kicks" => $this->kicks,
            "address" => $this->address
        ]);
    }
}
