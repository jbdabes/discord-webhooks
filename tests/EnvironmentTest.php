<?php

namespace Tests;

class EnvironmentTest extends BaseTest
{
    /**
     * @test
     */
    public function isEnvironmentConfiguredCorrectly()
    {
        $this->assertNotEmpty(getenv('WEBHOOK_URL'));
    }
}