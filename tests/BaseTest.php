<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    protected function setUp(): void
    {
        // load sensitive stuff from .env - only used in testing
        // see .env.example for example file
        (\Dotenv\Dotenv::createImmutable(__DIR__ . '/../'))->load();
    }
}