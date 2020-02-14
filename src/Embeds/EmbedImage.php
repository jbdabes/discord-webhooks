<?php

namespace DiscordWebhooks\Embeds;

use DiscordWebhooks\Exceptions\InvalidEmbedException;
use DiscordWebhooks\Traits\CanHaveUrlProperty;

class EmbedImage
{
    use CanHaveUrlProperty;

    public function getImage(): array
    {
        $data = [];

        if (! empty($this->getUrl())) {
            $data["url"] = $this->getUrl();
        }

        return $data;
    }
}