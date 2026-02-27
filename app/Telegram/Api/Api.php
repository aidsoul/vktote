<?php

namespace Vktote\Telegram\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Vktote\Config\Telegram as Tconf;

/**
 * Telegram Api class
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class Api
{
    /**
     * @var string
     */
    private string $link = '';

    /**
     * @param ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client = new Client(['verify' => false ])
    )
    {
        $this->link = 'https://api.telegram.org/bot' . Tconf::get()->botApiKey;
    }

    /**
     * @param string $text
     * @param SendMessage $message
     * 
     * @return void
     */
    public function sendMessage(string $text): void
    {
        $this->client->get(
            $this->link . '/sendMessage',
            [
                'query' => [
                    'chat_id' => Tconf::get()->chatId,
                    'text' => $text,
                    'parse_mode' => 'html',
                    'disable_web_page_preview' => true
                ]
            ]
        );
    }

    /**
     * @param string $text
     * @param array $media
     * 
     * @return void
     */
    public function sendMediaGroup(string $text, array $media): void
    {
        $media[0]['caption'] = $text;
        $this->client->get(
            $this->link . '/sendMediaGroup',
            [
                'query' => [
                    'chat_id' => Tconf::get()->chatId,
                    'media' => json_encode($media),
                    'disable_web_page_preview' => true
                ]
            ]
        );
    }
}