<?php

namespace UITests;

use pocketmine\Player;

use pocketmine\utils\TextFormat as T;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\defaults\VanillaCommand;

class UITest extends VanillaCommand {

  private $plugin;

  public function __construct(\UITests\Main $plugin){
    $this->plugin = $plugin;
    parent::__construct('UITesting', 'TheRoyalBlocks UI Testing', '/testUI');
    $this->setPermission('plugins.command');
  }

  public function execute(CommandSender $sender, $alias, array $args){
  if($sender instanceof Player){
    $ui = new \UITests\UI\SimpleUI(1);//no words for ID, just numbers
    $ui->addTitle(T::AQUA ."UI Testing");
    $ui->addContent(T::LIGHT_PURPLE ."You've got options!");
    $ui->addButton("Go to HimbeerCraft", -1);
    $ui->addButton("Read Some Info", -1);
    $ui->addButton("See an image", 1, "https://server.wolvesfortress.de/MCPEGUIimages/hd/X.png");
    $ui->send($sender);
    return true;
  } else {
    $sender->sendMessage(T::RED."Command must be run in-game!");
    return false;
   }
  }
}
