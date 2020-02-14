<?php

namespace DiscordWebhooks\Traits;

use DiscordWebhooks\Exceptions\InvalidKeyException;

trait IsCollection
{
    private $items = [];

    /**
     * Checks if the collection has an item via its' key.
     * @param $key
     *
     * @return bool
     */
    public function has($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * Add an item to the collection, with a given key if provided.
     * @param      $item
     * @param null $key
     *
     * @return bool
     * @throws InvalidKeyException
     */
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

    /**
     * Iterate an array and add all elements with their given keys, if provided.
     * @param $array
     *
     * @return bool
     * @throws InvalidKeyException
     */
    public function addAll(array $array): bool
    {
        if (empty($array)) {
            throw new \InvalidArgumentException("Data provided cannot be empty.");
        }

        foreach ($array as $key => $item) {
            $this->add($item, $key);
        }

        return true;
    }

    /**
     * Remove an item from the collection via its' key.
     * @param $key
     *
     * @return bool
     * @throws InvalidKeyException
     */
    public function remove($key): bool
    {
        if (! $this->has($key)) {
            throw new InvalidKeyException("The key provided does not exist.");
        }

        unset($this->items[$key]);

        return true;
    }

    /**
     * Retrieve an item or all items from the collection.
     * @param null $key
     *
     * @return mixed
     * @throws InvalidKeyException
     */
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

    /**
     * Retrieve all items.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Count all items.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->all());
    }
}