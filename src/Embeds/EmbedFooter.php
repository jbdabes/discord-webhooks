<?php

namespace DiscordWebhooks\Embeds;

use DiscordWebhooks\Traits\CanHaveIconUrlProperty;

class EmbedFooter
{
    use CanHaveIconUrlProperty;

    protected $text = "";

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getFooter()
    {
        $data = [];

        if (! empty($this->getText())) {
            $data["text"] = $this->getText();
        }

        if (! empty($this->getIconUrl())) {
            $data["icon_url"] = $this->getIconUrl();
        }

        if (empty($data)) {
            return false;
        }

        return $data;
    }
}