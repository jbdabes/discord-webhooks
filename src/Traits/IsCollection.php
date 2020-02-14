<?php

namespace DiscordWebhooks\Traits;

use DiscordWebhooks\Exceptions\InvalidKeyException;

trait IsCollection
{
    private $items = [];

    public function has($key): bool
    {
        return isset($this->items[$key]);
    }

    public function add($item, $key = null): bool
    {
        if ($key === null) {
            $this->items[] = $item;

            return true;
        }

        if ($this->has($key)) {
            throw new InvalidKeyException("The key specified is already in use.");
        }

        $this->items[$key] = $item;

        return true;
    }

    public function addAll($array)
    {
        if (empty($array)) {
            throw new \InvalidArgumentException("Data provided cannot be empty.");
        }

        foreach ($array as $key => $item) {
            $this->add($item, $key);
        }

        return true;
    }

    public function remove($key): bool
    {
        if (! $this->has($key)) {
            throw new InvalidKeyException("The key provided does not exist.");
        }

        unset($this->items[$key]);

        return true;
    }

    public function get($key = null)
    {
        if ($key === null) {
            return $this->all();
        }

        if (! $this->has($key)) {
            throw new InvalidKeyException("The key provided does not exist.");
        }

        return $this->items[$key];
    }

    public function all()
    {
        return $this->items;
    }
}