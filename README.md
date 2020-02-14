# Discord-Webhooks
_Use Discord's webhook feature with ease!_

## What are webhooks?
From Discord's documentation:

> Discord's built in Webhooks function as an easy way to get automated messages and data updates sent to a text channel
> in your server. Think of them as one of those fancy pneumatic tube things you used to love sending money into at a bank
> and watch disappear, but instead of never seeing your money again, you're actually sending messages into Discord from
> another platform.

## What does this library do?
Previously, in order to send some data to a Discord webhook, you would need to write the JSON code manually, or
structure the data yourself, fire it off with curl/some other method, and so on. The code to do so isn't developer
friendly and can be confusing to amateurs.

The aim of this library is to _simplify_ the usage of webhooks so that everyone can leverage their power.

Take the following as an example:
```php
$webhookURL = "https://discordapp.com/api/webhooks/my-webhook-url";

$jsonData = [
    "embeds" => [
        [
            "title" => "My Webhook Title",
            "description" => "My Webhook Description",
            "url" => "https://playersquared.com",
            "color" => 4433631,
            "timestamp" => date("Y-m-d\\TH:i:s.u\\Z"),
            "thumbnail" => [
                "url" => "https://cdn.discordapp.com/embed/avatars/0.png",
            ],
            "author" => [
                "name" => "JB",
                "url" => "https://playersquared.com/forums/members/jb/",
                "icon_url" => "https://cdn.discordapp.com/embed/avatars/4.png",
            ]
        ]
    ]
];

$ch = curl_init($webhookURL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonData));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
```

Now, the same code with Discord-Webhooks:
```php
$webhook = new \DiscordWebhooks\Webhook("https://discordapp.com/api/webhooks/my-webhook-url");
$embed   = new \DiscordWebhooks\Embeds\Embed();

$embed->setTitle("My Webhook Title")
    ->setDescription("My Webhook Description")
    ->setUrl("https://playersquared.com")
    ->setColor("#43a6df")
    ->setTimestamp($webhook->currentTimestamp());

$embed->thumbnail()->setUrl("https://cdn.discordapp.com/embed/avatars/0.png");
$embed->author()->setName("JB")
    ->setUrl("https://playersquared.com/forums/members/jb/")
    ->setIconUrl("https://cdn.discordapp.com/embed/avatars/4.png");

$webhook->embeds()->add($embed);
$webhook->send();
```

Working with Discord's webhooks has never been this simple.

## How can I use this library?
Discord-Webhooks can be installed to your PHP project by using composer:

`composer require jbdabes/discord-webhooks`

