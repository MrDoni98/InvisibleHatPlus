<?php

namespace InvisibleHatPlus;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as F;
use pocketmine\entity\Entity;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentEntry;

class Main extends PluginBase implements Listener{
  
  public function onEnable(){
	$this->getServer()->getPluginManager()->registerEvents($this,$this);
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
	
  public function Helmet(EntityArmorChangeEvent $event){
	$entity = $event->getEntity();
	$item = Item::get(298, 1);
        $item->setCustomName("Шапка-невидимка");
        $item->addEnchantment(Enchantment::getEnchantment(0)->setLevel(10));
	$nItem = $event->getNewItem();
	$oItem = $event->getOldItem();
	if($entity instanceof Player){
		$player = $entity->getPlayer();
		if($player->hasPermission("invisiblehat")){
		        if($nItem->getId() == 298){
			        if($nItem->getCustomName() == "Шапка-невидимка"){
					if($nItem->getEnchantment(0)){
					   foreach($this->getServer()->getOnlinePlayers() as $players){
					   	$players->hidePlayer($player);
					   }
				        }
				}
			}
			if($oItem->getId() == 298){
				if($oItem->getCustomName() == "Шапка-невидимка"){
					if($oItem->getEnchantment(0)){
					   foreach($this->getServer()->getOnlinePlayers() as $players){
					   	$players->showPlayer($player);
					   }
					}
				}
			}
		}   
	}
  }
}
