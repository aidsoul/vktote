<?php

namespace Vktote\Telegram\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Vktote\Config\Telegram as T;

/**
 * Telegram Api class
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class Api implements ApiInterface
{
    /**
     * @var string
     */
    private string $link = '';

    /**
     * @param ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client = new Client()
    )
    {
        $this->link = 'https://api.telegram.org/bot' . T::get()->botApiKey;
    }

    /**
     * @param string $text
     * @param SendMessageInterface $message
     * 
     * @return void
     */
    public function sendMessage(
        string $text,
        SendMessageInterface $message = new SendMessage()
    ): void
    {
        $this->client->get(
            $this->link . '/sendMessage',
            [
                'query' => $message->send($text)
            ]
        );
    }

    /**
     * @param string $text
     * @param array $media
     * 
     * @return void
     */
    public function sendMediaGroup(
        string $text,
        array $media,
        SendMediaGroupInterface $mediaGroup = new SendMediaGroup()
    ): void
    {
        $this->client->get(
            $this->link . '/sendMediaGroup',
            [
                'query' => $mediaGroup->send($text, $media)
            ]
        );
    }
}