<?php

declare(strict_types=1);

namespace pmmlp\twerkfertilizer\fertilize;

use pmmlp\twerkfertilizer\util\TwerkFertilizerConfig;
use pocketmine\block\Block;
use pocketmine\player\Player;

class FertilizeManager {
    /** @var Fertilizer[]  */
    private static array $fertilizer = [];

    public function __construct(){
        if(TwerkFertilizerConfig::$saplings) {
            self::registerFertilizer(new SaplingsFertilizer());
        }
        if(TwerkFertilizerConfig::$crops) {
            self::registerFertilizer(new CropsFertilizer());
        }
    }

    public static function getFertilizer(): array{
        return self::$fertilizer;
    }

    public static function registerFertilizer(Fertilizer $fertilizer): void {
        self::$fertilizer[$fertilizer::class] = $fertilizer;
    }

    public static function fertilizeBlock(Block $block, ?Player $player = null): void {
        foreach(self::getFertilizer() as $fertilizer) {
            if($fertilizer->canBeAppliedTo($block)) {
                $fertilizer->fertilize($block, $player);
            }
        }
    }
}