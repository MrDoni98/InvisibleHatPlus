<?php

namespace InvisibleHatPlus;

use pocketmine\scheduler\PluginTask;

class HedTask extends PluginTask{
	
  public function __construct(Main $plugin){
        $this->plugin = $plugin;
        parent::__construct($plugin);
    }
	//$this->me = $plugin;

  public function onRun($tick){
	$this->plugin->Helmet();
  }

}
