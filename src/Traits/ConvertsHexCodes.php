<?php

namespace DiscordWebhooks\Traits;

trait ConvertsHexCodes
{
    private function convertHexToDec($color)
    {
        // See if the user has left a hash at the start, if so remove it.
        if (substr($color, 0, 1) === "#") {
            $color = substr($color, 1);
        }

        // Check if we have a hex code, if so convert it to decimal.
        if (ctype_xdigit($color)) {
            $color = hexdec($color);
        }

        return $color;
    }
}