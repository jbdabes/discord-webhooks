<?php

namespace DiscordWebhooks\Traits;

use DiscordWebhooks\Embeds\EmbedThumbnail;
use DiscordWebhooks\Exceptions\InvalidEmbedException;

trait CanHaveUrlProperty
{
    protected $url = "";

    /**
     * @param string $url
     *
     * @return mixed
     * @throws InvalidEmbedException
     */
    public function setUrl(string $url)
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidEmbedException("Embed Thumbnail URL should be a valid URL.");
        }

        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}