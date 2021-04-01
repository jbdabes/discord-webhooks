<?php

namespace DiscordWebhooks\Traits;

trait ConvertsHexCodes
{

    /**
     * Convert a hex color code to decimal format.
     * @param $color
     *
     * @return int
     */
    private function convertHexToDec($color): int
    {
        // Check if we are processing a hex code.
        if (substr($color, 0, 1) === "#") {
            $color = hexdec(substr($color, 1));
        }

        return (int)$color;
    }
}