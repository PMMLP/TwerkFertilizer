<?php

declare(strict_types=1);

namespace pmmlp\twerkfertilizer\fertilize;

use pocketmine\block\Block;
use pocketmine\player\Player;

abstract class Fertilizer {
    abstract public function canBeAppliedTo(Block $block): bool;

    abstract public function fertilize(Block $block, ?Player $player = null): void;
}