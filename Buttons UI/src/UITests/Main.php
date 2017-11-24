<?php

namespace UITests;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\utils\TextFormat as T;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

class Main extends PluginBase implements Listener {

  public $countiu = 25530;
  public $ver = "v1.0.0-beta";

  public $bp = [];
  public $ptb = [];
  public $bid = 1;

  public function onEnable(){
    $this->getLogger()->info(T::YELLOW ."Loading...");
 try {
  $this->getServer()->getPluginManager()->registerEvents($this, $this);
  $this->getServer()->getCommandMap()->register('testui', new \UITests\UITest($this));

    //@mkdir($this->getDataFolder());
    //$config = new Config($this->getDataFolder() . "config.yml", Config::YAML);

    $this->getLogger()->info(T::YELLOW ."has Loaded successfully!");
  }
   catch(Exception $e){
    $this->getLogger()->info(T::RED ."Plugin has Failed to Load due to $e");
   }
  }

  public function onPacketReceived(\pocketmine\event\server\DataPacketReceiveEvent $e){
    $player = $e->getPlayer();
    $pk = $e->getPacket();
  if($pk instanceof ModalFormResponsePacket){
    $id = $pk->formId;
    $button = json_decode($pk->formData, true);
/* Explanation:
It takes the id (25530) from the command file (UITests.php). Then, function 
step2 interprets it,  and creates id 25531 in the first part. The second one is "ALTERNATE NUMBER ID LOL". These ids each redirect
to a function. How does it know where to go? The code below this tells it. Lets say they click on Transfer to HimbeerCraft
in id 25530. They'll be redirected to step 2, which will say "oh, clicked on button id 0? make a new UI 25531. They then 
click a button, which redirects them to banlist, which will interpret whether they pressed "ban" or "update" aka button id 0 or 1. 
Simple enough explanation. Much of the code is taken from a different plugin and will be confusing unless you read this. Have fun! */
    if($id === 25530){
    $this->step2($player, $button);

  }
  if($id === 25531){
    $this->banlist($player, $button);
  }
  if($id === 25532){
    $this->bancheck($player, $button);
    }
   }
  }

  public function step2($player, $buttonid){
  if($buttonid === 0){
    $ui = new \UITests\UI\SimpleUI(25531);
    $ui->addTitle(T::AQUA ."Transfer to HimbeerCraft");
    $ui->addContent(T::LIGHT_PURPLE ."Are you sure you want to \ndo this?");
    $onlineP = $this->getServer()->getOnlinePlayers();
    $ui->addButton("Ban: ", -1);
  foreach($onlineP as $p){
    $ui->addButton("Update", -1);
    $this->bp[$this->bid] = $p;
    $this->bid++;
  }
    $ui->send($player);
  }elseif($buttonid === 1){
    $ui = new \UITests\UI\SimpleUI(ALTERNATE NUMBER ID LOL);
    $ui->addTitle(T::AQUA ."INFO!");
    $ui->addContent(T::LIGHT_PURPLE ."Are you sure you want to \ndo this?");
    $ui->addButton("Okay ", -1);
  }
  }

  public function banlist($player, $buttonid){
  if($buttonid != 0){
  if(isset($this->bp[$buttonid])){
    $p = $this->bp[$buttonid];
  if($p->isOp() === false){
    $ui = new \UITests\UI\SimpleUI(25532);
    $ui->addTitle(T::AQUA ."UITest ". T::YELLOW . $this->ver);
    $ui->addContent(T::AQUA ."Are you sure you want to ban ". $p->getName() ."?\n\n");
    $ui->addButton("Yes", -1);
    $ui->addButton("No", -1);
    $this->ptb[$player->getName()] = $p;
    $ui->send($player);
  } else {
    $ui = new \UITests\UI\SimpleUI(25533);
    $ui->addTitle(T::AQUA ."UITest ". T::YELLOW . $this->ver);
    $ui->addContent(T::AQUA ."You can't ban other admins silly.\n\n");
    $ui->addButton("Ok.", -1);
    $ui->send($player);
     }
    }
   } elseif($buttonid === 0) {
    $this->UITest($player, 0);
   }
  }

  public function bancheck($player, $buttonid){
  if($buttonid === 0){
    $p = $this->ptb[$player->getName()];
    $p->setBanned(true);
    $ui = new \UITests\UI\SimpleUI(25534);
    $ui->addTitle(T::AQUA ."UITest ". T::YELLOW . $this->ver);
    $ui->addContent(T::RED ."You Banned ". $p->getName() ."!\n\n");
    $ui->addButton("Ok.", -1);
    $ui->send($player);
   }
  }
}
