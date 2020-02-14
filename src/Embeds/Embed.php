<?php

namespace DiscordWebhooks\Embeds;

use DiscordWebhooks\Traits\ConvertsHexCodes;

class Embed
{
    use ConvertsHexCodes;

    protected $title;
    protected $description;
    protected $url;
    protected $color;
    protected $timestamp;

    protected $footer;
    protected $thumbnail;
    protected $image;
    protected $author;
    protected $fields;

    public function __construct()
    {
        $this->footer    = new EmbedFooter();
        $this->thumbnail = new EmbedThumbnail();
        $this->image     = new EmbedImage();
        $this->author    = new EmbedAuthor();
        $this->fields    = new EmbedFields();
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setColor($color)
    {
        $color = $this->convertHexToDec($color);

        $this->color = $color;

        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function currentTimestamp()
    {
        // ISO-8601 Timestamp
         return \Carbon\Carbon::now()->format("Y-m-d\\TH:i:s.u\\Z");
    }

    public function footer()
    {
        return $this->footer;
    }

    public function thumbnail()
    {
        return $this->thumbnail;
    }

    public function image()
    {
        return $this->image;
    }

    public function author()
    {
        return $this->author;
    }

    public function fields()
    {
        return $this->fields;
    }

    public function getEmbed(): array
    {
        // Set up a blank array that we can populate as we go along.
        $data = [];

        // Set the title
        if (! empty($this->getTitle())) {
            $data["title"] = $this->getTitle();
        }

        // Set the description
        if (! empty($this->getDescription())) {
            $data["description"] = $this->getDescription();
        }

        // Set the URL
        if (! empty($this->getUrl())) {
            $data["url"] = $this->getUrl();
        }

        // Set the color
        if (! empty($this->getColor())) {
            $data["color"] = $this->getColor();
        }

        // Set the timestamp
        if (! empty($this->getTimestamp())) {
            $data["timestamp"] = $this->getTimestamp();
        }

        // Set the footer
        if (! empty($this->footer()->getFooter())) {
            $data["footer"] = $this->footer()->getFooter();
        }

        // Set the thumbnail
        if (! empty($this->thumbnail()->getThumbnail())) {
            $data["thumbnail"] = $this->thumbnail()->getThumbnail();
        }

        // Set the image
        if (! empty($this->image()->getImage())) {
            $data["image"] = $this->image()->getImage();
        }

        // Set the author
        if (! empty($this->author()->getAuthor())) {
            $data["author"] = $this->author()->getAuthor();
        }

        // Set any fields
        if (! empty($this->fields()->all())) {
            $data["fields"] = [];

            foreach ($this->fields()->all() as $field) {
                $data["fields"][] = $field->getField();
            }
        }

        return $data;
    }
}