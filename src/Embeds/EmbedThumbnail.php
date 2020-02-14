<?php

namespace DiscordWebhooks\Embeds;

use DiscordWebhooks\Exceptions\InvalidEmbedException;
use DiscordWebhooks\Traits\CanHaveUrlProperty;

class EmbedThumbnail
{
    use CanHaveUrlProperty;

    public function getThumbnail(): array
    {
        $data = [];

        if (! empty($this->getUrl())) {
            $data["url"] = $this->getUrl();
        }

        return $data;
    }
}