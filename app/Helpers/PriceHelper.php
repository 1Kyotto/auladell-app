<?php

namespace App\Helpers;

class PriceHelper
{
    public static function applyAttractiveRounding(int $price): int
    {
        $rounded = round($price, -1);

        if ($rounded % 100 < 50) {
            $rounded = floor($rounded / 100) * 100 + 500;
        } else {
            $rounded = ceil($rounded / 100) * 100 - 10;
        }

        return $rounded;
    }
}
