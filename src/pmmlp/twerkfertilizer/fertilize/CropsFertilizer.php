<?php

declare(strict_types=1);

namespace pmmlp\twerkfertilizer\fertilize;

use Exception;
use pmmlp\twerkfertilizer\util\TwerkFertilizerConfig;
use pocketmine\block\Block;
use pocketmine\block\Crops;
use pocketmine\player\Player;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\particle\HeartParticle;

class CropsFertilizer extends Fertilizer {
    public function canBeAppliedTo(Block $block): bool{
        return $block instanceof Crops;
    }

    /**
     * @param Crops $block
     * @throws Exception
     */
    public function fertilize(Block $block, ?Player $player = null): void{
        $position = $block->getPosition();
        $world = $position->getWorld();
        if($block->getAge() >= 7){
            return;
        }
        $world->addParticle($position->add((random_int(0, 10) / 10), (random_int(3, 6) / 10), (random_int(0, 10) / 10)), new HappyVillagerParticle());
        if(random_int(0, max(0, (100 - TwerkFertilizerConfig::$cropsChance))) === 0) {
            for($i = 0; $i <= 4; $i++) {
                $world->addParticle($position->add((random_int(0, 10) / 10), (random_int(3, 6) / 10), (random_int(0, 10) / 10)), new HeartParticle());
            }
            $world->setBlock($position, $block->setAge($block->getAge() + 1));
        }
    }
}