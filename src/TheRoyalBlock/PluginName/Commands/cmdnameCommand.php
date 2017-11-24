<?php 

namespace TheRoyalBlock\Pluginname\Commands;

use pocketmine\Player;

use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\command\defaults\VanillaCommand;

class cmdnameCommand extends VanillaCommand {
    
	private $plugin;
	const PREFIX = C::GOLD . "[" . C::BLUE . "PluginName" . C::GOLD . "] ". C::RESET . C::WHITE;
 
	public function __construct(\TheRoyalBlock\PluginName\Main $plugin){
		$this->plugin = $plugin;
		parent::__construct('cmdname', 'description', 'usage');
		$this->setPermission('plugins.command');
	}

	public function execute(CommandSender $sender, $alias, array $args){
		if($sender instanceof Player){
			if($sender->isOp() === true){
				// Command Data
			return true;
			} else {
				$sender->sendMessage(self::PREFIX . "You must be Op to run this Command!");
			return false;
			}
		} else {
			$sender->sendMessage(self::PREFIX . "Command must be run in-game!");
		return false;     
		}
	}
}
