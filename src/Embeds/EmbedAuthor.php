<?php

namespace DiscordWebhooks\Embeds;

use DiscordWebhooks\Exceptions\InvalidEmbedException;
use DiscordWebhooks\Traits\CanHaveIconUrlProperty;
use DiscordWebhooks\Traits\CanHaveNameProperty;
use DiscordWebhooks\Traits\CanHaveUrlProperty;

class EmbedAuthor
{
    use CanHaveNameProperty, CanHaveUrlProperty, CanHaveIconUrlProperty;

    public function getAuthor()
    {
        $data = [];

        if (! empty($this->getName())) {
            $data["name"] = $this->getName();
        }

        if (! empty($this->getUrl())) {
            $data["url"] = $this->getUrl();
        }

        if (! empty($this->getIconUrl())) {
            $data["icon_url"] = $this->getIconUrl();
        }

        return $data;
    }
}