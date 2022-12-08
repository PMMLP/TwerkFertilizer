<?php

declare(strict_types=1);

namespace pmmlp\twerkfertilizer;

use pmmlp\twerkfertilizer\fertilize\FertilizeManager;
use pmmlp\twerkfertilizer\util\TwerkFertilizerConfig;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\Position;

class EventListener implements Listener {
    public function onPlayerToggleSneak(PlayerToggleSneakEvent $event): void {
        if(!$event->isSneaking()) {
            $this->fertilizeBlocks($event->getPlayer()->getPosition(), $event->getPlayer());
        }
    }

    public function fertilizeBlocks(Position $center, ?Player $player = null): void {
        $world = $center->getWorld();
        $radius = TwerkFertilizerConfig::$radius;
        $maxDistanceSquared = $radius ** 2;
        for($x = -$radius; $x <= $radius; $x++) {
            for($y = -$radius; $y <= $radius; $y++) {
                for($z = -$radius; $z <= $radius; $z++) {
                    $position = new Vector3($center->getX() + $x, $center->getY() + $y, $center->getZ() + $z);
                    if($position->distanceSquared($center) > $maxDistanceSquared) {
                        continue;
                    }
                    FertilizeManager::fertilizeBlock($world->getBlock($position), $player);
                }
            }
        }
    }
}