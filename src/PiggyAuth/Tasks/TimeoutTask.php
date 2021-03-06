<?php
namespace PiggyAuth\Tasks;

use pocketmine\scheduler\PluginTask;

class TimeoutTask extends PluginTask {
    public function __construct($plugin) {
        parent::__construct($plugin);
        $this->plugin = $plugin;
    }

    public function onRun($currentTick) {
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {
            if(!$this->plugin->isAuthenticated($player)) {
                if(isset($this->plugin->timeouttick[strtolower($player->getName())])) {
                    $this->plugin->timeouttick[strtolower($player->getName())]++;
                    if($this->plugin->timeouttick[strtolower($player->getName())] == $this->plugin->getConfig()->get("timeout-time")) {
                        $player->kick($this->plugin->getMessage("timeout-message"));
                    }
                }
            }
        }
    }

}
