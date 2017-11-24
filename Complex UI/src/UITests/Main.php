<?php

declare(strict_types=1);

namespace UITests;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as T;

class Main extends PluginBase {

  public $ui = [];
  public $id = [];

  public function onEnable() : void {
    $this->createWorldUI();
    $this->getServer()->getPluginManager()->registerEvents(new \UITests\UI\ListenerUI($this), $this);
    $this->getServer()->getCommandMap()->register('complexui', new \UITests\Command\complexuiCommand($this));
    $this->getLogger()->info(T::GREEN ."Everything has Loaded!");
 }
 
  public function createWorldUI() : void {
    $id = $this->getRandId();
    $ui = new \UITests\UI\CustomUI($id);
    $this->ui['world-tp'] = $ui;
  }

  public function onDisable() : void {
    $this->getLogger()->info(T::RED ."unloading plugin...");
  if(isset($this->config)){
    $this->config->save();
  }
    $this->getLogger()->info(T::RED ."has Unloaded, Goodbye!");
  }
}
