<?php

declare(strict_types=1);

namespace pmmlp\twerkfertilizer;

use pmmlp\twerkfertilizer\fertilize\FertilizeManager;
use pmmlp\twerkfertilizer\util\TwerkFertilizerConfig;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class TwerkFertilizer extends PluginBase {
    public function onEnable(): void{
        new TwerkFertilizerConfig($this);
        new FertilizeManager();

        Server::getInstance()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}