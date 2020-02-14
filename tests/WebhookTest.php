<?php

namespace Tests;

use DiscordWebhooks\Exceptions\InvalidKeyException;
use DiscordWebhooks\Webhook;
use DiscordWebhooks\Embeds\Embed;
use DiscordWebhooks\Embeds\Fields\Field;
use DiscordWebhooks\Exceptions\InvalidEmbedException;
use DiscordWebhooks\Exceptions\InvalidWebhookException;

class WebhookTest extends BaseTest
{
    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidKeyException
     */
    public function canSendAMessageWithADifferentUsername()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $webhook->setUsername("Some Random Name");
        $webhook->setContent("This message should have a different name than the one it should have.");
        $response = $webhook->send();

        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidKeyException
     */
    public function canSendBasicMessage()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $webhook->setContent("Test: Can send a basic message");
        $response = $webhook->send();

        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidKeyException
     * @throws InvalidWebhookException
     */
    public function canSendAMessageWithADifferentAvatar()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $webhook->setContent("Test: Can send a message with a different avatar.");
        $webhook->setAvatarUrl("https://cdn.discordapp.com/embed/avatars/4.png");
        $response = $webhook->send();

        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidKeyException
     * @throws InvalidWebhookException
     */
    public function canSendATtsMessage()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $webhook->setContent("Test: Can send a TTS message.");
        $webhook->setTts(true);
        $response = $webhook->send();

        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidKeyException
     */
    public function canSendABasicRichEmbed()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $embed = new Embed();
        $embed->setTitle("Test: Embed with all fields present");
        $embed->setDescription("Test embed description.");
        $embed->setUrl("https://discordapp.com");
        $embed->setColor("#43a6df");
        $embed->setTimestamp("2020-02-11T22:24:10.818Z");
        $webhook->embeds()->add($embed);

        $response = $webhook->send();
        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidKeyException
     */
    public function canSendARichEmbedWithCurrentTimestamp()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $embed = new Embed();
        $embed->setTitle("Test: Embed with current timestamp");
        $embed->setTimestamp($embed->currentTimestamp());
        $webhook->embeds()->add($embed);

        $response = $webhook->send();
        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidEmbedException
     * @throws InvalidKeyException
     */
    public function canSendARichEmbedWithAFooter()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $embed = new Embed();
        $embed->setTitle("Test: Embed with a footer");
        $embed->setDescription("We should have a footer on this embed.");
        $embed->footer()->setIconUrl("https://cdn.discordapp.com/embed/avatars/0.png");
        $embed->footer()->setText("This is my footer text.");
        $webhook->embeds()->add($embed);

        $response = $webhook->send();
        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidEmbedException
     * @throws InvalidKeyException
     */
    public function canSendARichEmbedWithAThumbnail()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $embed = new Embed();
        $embed->setTitle("Test: Embed with a thumbnail");
        $embed->setDescription("We should have a thumbnail on this embed.");
        $embed->thumbnail()->setUrl("https://cdn.discordapp.com/embed/avatars/0.png");
        $webhook->embeds()->add($embed);

        $response = $webhook->send();
        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidEmbedException
     * @throws InvalidKeyException
     */
    public function canSendARichEmbedWithAnImage()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        $embed = new Embed();
        $embed->setTitle("Test: Embed with an image");
        $embed->setDescription("We should have an image on this embed.");
        $embed->image()->setUrl("https://cdn.discordapp.com/embed/avatars/0.png");
        $webhook->embeds()->add($embed);

        $response = $webhook->send();
        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidEmbedException
     * @throws InvalidKeyException
     */
    public function canSendARichEmbedWithAnAuthor()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        // Try with all fields
        $embed = new Embed();
        $embed->setTitle("Test: Embed with an author");
        $embed->setDescription("We should have an author on this embed.");
        $embed->author()->setName("Test Author");
        $embed->author()->setUrl("https://discordapp.com");
        $embed->author()->setIconUrl("https://cdn.discordapp.com/embed/avatars/0.png");
        $webhook->embeds()->add($embed);

        // Try with all fields except name
        $embed = new Embed();
        $embed->setTitle("Test: Embed with an author");
        $embed->setDescription("We should have an author without a name on this embed.");
        $embed->author()->setUrl("https://discordapp.com");
        $embed->author()->setIconUrl("https://cdn.discordapp.com/embed/avatars/0.png");
        $webhook->embeds()->add($embed);

        // Try with all fields except URL
        $embed = new Embed();
        $embed->setTitle("Test: Embed with an author");
        $embed->setDescription("We should have an author without a URL on this embed.");
        $embed->author()->setName("Test Author");
        $embed->author()->setIconUrl("https://cdn.discordapp.com/embed/avatars/0.png");
        $webhook->embeds()->add($embed);

        // Try with all fields except Icon URL
        $embed = new Embed();
        $embed->setTitle("Test: Embed with an author");
        $embed->setDescription("We should have an author without an icon URL on this embed.");
        $embed->author()->setName("Test Author");
        $embed->author()->setUrl("https://discordapp.com");
        $webhook->embeds()->add($embed);

        $response = $webhook->send();
        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidKeyException
     */
    public function canSendARichEmbedWithFields()
    {
        // Set up the webhook
        $webhook = new Webhook(getenv("WEBHOOK_URL"));

        // Set up the embed
        $embed = new Embed();
        $embed->setTitle("Test: Embed with fields");
        $embed->setDescription("We should have fields on this embed.");

        // Single row field
        $field = new Field();
        $field->setName("Single Field (full width)");
        $field->setValue("This field should have its own row.");
        $embed->fields()->add($field);

        // Inline row of two fields
        $field = new Field();
        $field->setName("Single Field (inline)");
        $field->setValue("This field should be inline.");
        $field->setInline(true);
        $embed->fields()->add($field);

        $field = new Field();
        $field->setName("Single Field (inline) - 2");
        $field->setValue("This field is also inline.");
        $field->setInline(true);
        $embed->fields()->add($field);

        $webhook->embeds()->add($embed);

        // Send the webhook
        $response = $webhook->send();

        $this->assertTrue($response);
    }

    /**
     * @test
     * @throws InvalidWebhookException
     * @throws InvalidKeyException
     */
    public function canSendAMessageToMultipleWebhooks()
    {
        // Set up the webhook
        $webhook = new Webhook([getenv("WEBHOOK_URL"), getenv("SECOND_WEBHOOK_URL")]);

        $webhook->setContent("Test: Send a message to multiple webhooks.");
        $response = $webhook->send();

        $this->assertTrue($response);
    }
}