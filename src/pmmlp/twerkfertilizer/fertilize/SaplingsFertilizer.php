<?php

declare(strict_types=1);

namespace pmmlp\twerkfertilizer\fertilize;

use Exception;
use pmmlp\twerkfertilizer\util\TwerkFertilizerConfig;
use pocketmine\block\Block;
use pocketmine\block\Sapling;
use pocketmine\player\Player;
use pocketmine\world\particle\HappyVillagerParticle;
use ReflectionMethod;

class SaplingsFertilizer extends Fertilizer {
    public function canBeAppliedTo(Block $block): bool{
        return $block instanceof Sapling;
    }

    /**
     * @param Sapling $block
     * @throws Exception
     */
    public function fertilize(Block $block, ?Player $player = null): void{
        $position = $block->getPosition();
        $world = $position->getWorld();
        $world->addParticle($position->add((random_int(0, 10) / 10), (random_int(3, 6) / 10), (random_int(0, 10) / 10)), new HappyVillagerParticle());
        if(random_int(0, max(0, (100 - TwerkFertilizerConfig::$saplingsChance))) === 0) {
            $method = new ReflectionMethod($block, "grow");
            $method->setAccessible(true);
            $method->invoke($block, $player);
        }
    }
}