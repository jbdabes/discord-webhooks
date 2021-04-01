<?php

namespace DiscordWebhooks\Traits;

use DiscordWebhooks\Exceptions\InvalidEmbedException;

trait CanHaveIconUrlProperty
{
    /**
     * @var string
     */
    protected $iconUrl;

    /**
     * @param $url
     *
     * @return $this
     * @throws InvalidEmbedException
     */
    public function setIconUrl($url)
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidEmbedException("Icon URL should be a valid URL.");
        }

        $this->iconUrl = $url;

        return $this;
    }

    public function getIconUrl()
    {
        return $this->iconUrl;
    }
}