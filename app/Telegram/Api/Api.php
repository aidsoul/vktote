<?php

namespace Vktote\Telegram\Api;

use GuzzleHttp\Client;
use Vktote\Config\Telegram as T;

class Api implements ApiInterface
{
    /**
     * @var string
     */
    private static string $link = '';

    /**
     * @var \GuzzleHttp\Client
     */
    private Client $client;

    public function __construct()
    {
        self::$link = 'https://api.telegram.org/bot' . T::get()->botApiKey;
        $this->client = new Client();
    }

    /**
     * @param string $text
     * @return void
     */
    public function sendMessage(string $text): void
    {
        $message = new SendMessage();
        $this->client->get(
            self::$link . '/sendMessage',
            [
                'query' => $message->send($text)
            ]
        );
    }

    /**
     * @param string $text
     * @param array $media
     * @return void
     */
    public function sendMediaGroup(string $text, array $media): void
    {
        $mediaGroup = new SendMediaGroup();
        $this->client->get(
            self::$link . '/sendMediaGroup',
            [
                'query' => $mediaGroup->send($text, $media)
            ]
        );
    }
}
