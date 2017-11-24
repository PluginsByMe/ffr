<?php 

declare(strict_types=1);

namespace UITests\Command;

use pocketmine\Player;

use pocketmine\utils\TextFormat as T;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\defaults\VanillaCommand;

class wtpuiCommand extends VanillaCommand {
    
  private $plugin;

  public function __construct(\Zero\WorldTpUI\Main $plugin){
    $this->plugin = $plugin;
    parent::__construct('complexui', 'allows admins to tp to any world', '/complexui');
    $this->setPermission('plugins.command');
  }

  public function execute(CommandSender $sender, $alias, array $args){
  if($sender instanceof Player){
    $ui = $this->plugin->ui['test'];
    $ui->data = ['type' => 'custom_form', 'title' => 'test ui', 
      'content' => [   
        ['type' => 'toggle', 'text' => 'toggle'],
        ['type' => 'slider', 'text' => 'slider', 'min' => 0 , 'max' => 10],
        ['type' => 'step_slider', 'text' => 'step slider', 'steps' => array('1', '2', '3', '4', '5')],
        ['type' => 'input', 'text' => 'imput', 'placeholder' => 'placeholder text', 'default' => null],
        ["type" => 'dropdown', 'text' => 'dropdown', 'options' => array('1', '2', '3'), 'default' => null]
      ]];
    $ui->send($sender);
    return true;
  } else {
    $sender->sendMessage(T::RED."Command must be run in-game!");
    return false;     
   }
}
