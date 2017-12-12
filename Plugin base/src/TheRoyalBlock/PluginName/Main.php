<?php

namespace TheRoyalBlock\PluginName;
  
//Blocks
use pocketmine\block\Block;

//Command
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

//Entity
use pocketmine\entity\Entity;
use pocketmine\entity\Effect;

//Events
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\entity\EntityLevelChangeEvent; 

//Inventory
use pocketmine\inventory\ChestInventory;
use pocketmine\inventory\EnderChestInventory;

//Item
use pocketmine\item\Item;

//Lang

//Level
use pocketmine\level\Level;
use pocketmine\level\Position;

//Math
use pocketmine\math\Vector3;

//Metadata

//Nbt
use pocketmine\nbt\NBT;

//Network
use pocketmine\network\Network;

//Permission
use pocketmine\permission\Permission;

//Plugin
use pocketmine\plugin\PluginBase;

//Scheduler
use pocketmine\scheduler\PluginTask;

//Tile
use pocketmine\tile\Sign;
use pocketmine\tile\Chest;

//Utils
use pocketmine\utils\TextFormat as C;
use pocketmine\utils\Config;

//Other
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener{
    
	const PREFIX = C::GOLD . "[" . C::BLUE . "PluginName" . C::GOLD . "] ". C::RESET . C::WHITE;
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info(self::PREFIX . "Loading...");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->getServer()->getPluginManager()->registerEvents(new \TheRoyalBlock\PluginName\SubDir\ListenerDir($this), $this);
		$this->getServer()->getCommandMap()->register('cmdname', new \TheRoyalBlock\PluginName\Commands\cmdnameCommand($this));
		$this->getServer()->getLogger()->info(self::PREFIX . "Everything has loaded!");  
	}
      
	public function onDisable(){
		$this->getServer()->getLogger()->info(self::PREFIX . "Disabling plugin...");
			if(isset($this->config)){
				$this->config->save();
			}
		$this->getServer()->getLogger()->info(self::PREFIX . "Plugin Disabled!");
	}
}
