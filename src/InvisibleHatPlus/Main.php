<?php

namespace InvisibleHatPlus;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat as F;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\scheduler\PluginTask;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentEntry;

class Main extends PluginBase implements Listener{
  
  public function onEnable(){
	$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new HedTask($this), 5);
  }
  
  public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){
    	if($cmd->getName() == "ihat"){
           $player = $this->getServer()->getPlayer($sender->getName());
           if($player->hasPermission("invisiblehat.cmd")){
	      $item = Item::get(298, 1, 1);
	      $item->setCustomName("Шапка-невидимка");
	      $item->addEnchantment(Enchantment::getEnchantment(0)->setLevel(10));
	      $sender->getInventory()->addItem($item);
	      $sender->sendMessage(F::YELLOW."Вы получили Шапку-невидимку");
	   }else{
              $sender->sendMessage(F::RED."У Вас нет прав на выполнение этой команды");
            }
	}
  }
	
  public function Helmet(){
	foreach($this->getServer()->getOnlinePlayers() as $player){
            if($player->hasPermission("invisiblehat")){
               $item = Item::get(298, 1);
               $item->setCustomName("Шапка-невидимка");
               $item->addEnchantment(Enchantment::getEnchantment(0)->setLevel(10));
	       $hed = $player->getInventory()->getHelmet();
               if($hed->getCustomName() == $item->getCustomName()){
		  if($hed->getEnchantment(0)){
		     if($hed->getId() == 298){
			$player->sendTip(F::BLUE."Вы невидимы");
		        $player->addEffect(Effect::getEffect(14)->setDuration(15)->setAmplifier(1)->setVisible(false));
		     }
		  }
               }
            }
       }
  }
}
