<?php

namespace DiscordWebhooks;

use DiscordWebhooks\Embeds\Embed;
use DiscordWebhooks\Exceptions\InvalidWebhookException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use \InvalidArgumentException;

class Webhook
{
    protected $username;
    protected $content;
    protected $avatarUrl;

    protected $urls;
    protected $embeds;
    protected $tts = false;

    /**
     * Webhook constructor.
     *
     * @param string|array $webhookURLs
     *
     * @throws InvalidArgumentException
     * @throws Exceptions\InvalidKeyException
     */
    public function __construct($webhookURLs)
    {
        $this->urls   = new WebhookUrls();
        $this->embeds = new WebhookEmbeds();

        if (is_array($webhookURLs)) {
            $this->urls()->addAll($webhookURLs);
        } else if (is_string($webhookURLs)) {
            $this->urls()->add($webhookURLs);
        } else {
            throw new InvalidArgumentException("Argument passed to Webhook should be string or array.");
        }
    }

    /**
     * Set the message sent to the webhook.
     *
     * @param $content
     *
     * @return Webhook
     */
    public function setContent($content): Webhook
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setUsername($username): Webhook
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    public function setTts(bool $tts): Webhook
    {
        $this->tts = $tts;

        return $this;
    }

    public function getTts(): bool
    {
        return $this->tts;
    }

    public function getWebhook(): array
    {
        $data = [];

        if (! empty($this->getUsername())) {
            $data["username"] = $this->getUsername();
        }

        if (! empty($this->getContent())) {
            // Sets the message that is sent
            $data['content'] = $this->getContent();
        }

        if (! empty($this->getAvatarUrl())) {
            $data["avatar_url"] = $this->getAvatarUrl();
        }

        if ($this->getTts() === true) {
            $data["tts"] = $this->getTts();
        }

        if (! empty($this->embeds()->all())) {
            // Set up embeds as an array
            $data['embeds'] = [];

            // Loop through all of the embeds and add them to the post data.
            foreach ($this->embeds()->all() as $embed) {
                // Add it to the output data
                $data['embeds'][] = $embed->getEmbed();
            }
        }

        return $data;
    }

    public function getWebhookAsJson()
    {
        return json_encode($this->getWebhook());
    }

    public function embeds()
    {
        return $this->embeds;
    }

    public function urls()
    {
        return $this->urls;
    }

    /**
     * @return bool
     * @throws InvalidWebhookException
     */
    public function send(): bool
    {
        // Loop through all applicable webhooks
        foreach ($this->urls()->all() as $webhookURL) {
            // Use a try/catch so we can fire our own exception(s)
            try {
                $client = (new Client())->request(
                    'POST',
                    $webhookURL,
                    [
                        "json" => $this->getWebhook(),
                    ]
                );
            } catch (ClientException $e) {
                throw new InvalidWebhookException($e->getMessage());
            }
        }

        return true;
    }
}