<?php

declare(strict_types=1);

namespace pmmlp\twerkfertilizer\util;

use pmmlp\config\Config;

class TwerkFertilizerConfig extends Config {
    public static bool $crops = true;
    public static int $cropsChance = 85;

    public static bool $saplings = true;
    public static int $saplingsChance = 40;

    public static float $radius = 2;
}