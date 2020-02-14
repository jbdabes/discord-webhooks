<?php

namespace DiscordWebhooks\Embeds\Fields;

use DiscordWebhooks\Traits\CanHaveNameProperty;

class Field
{
    use CanHaveNameProperty;

    protected $value;
    protected $inline = false;

    public function setInline(bool $inline): Field
    {
        $this->inline = $inline;

        return $this;
    }

    public function getInline(): bool
    {
        return $this->inline;
    }

    public function setValue($value): Field
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getField()
    {
        $data = [];

        // Set the name property
        if (! empty($this->getName())) {
            $data["name"] = $this->getName();
        }

        // Set the value property
        if (! empty($this->getValue())) {
            $data["value"] = $this->getValue();
        }

        // Set the inline property - this will always have a value, so we don't need to worry about checking if it is
        // present/empty or not.
        $data["inline"] = $this->getInline();

        return $data;
    }
}