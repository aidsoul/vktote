<?php

namespace Vktote\Telegram;

use Vktote\Config\Vk;
use Vktote\Telegram\Api\Api;
use Vktote\Telegram\Api\ApiInterface;
use Vktote\Telegram\Functions\Author;
use Vktote\Telegram\Functions\Link as FLink;
use Vktote\Telegram\Functions\Text;
use Vktote\Vk\Wall\WallInterface;

/**
 * Telegram class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Telegram
{
    /**
     * Send post to the Telegram channel
     *
     * @param \Vktote\Vk\Wall\WallInterface $wall
     * 
     * @return void
     */
    public function send(WallInterface $wall, ApiInterface $api = new Api()): void
    {
        foreach ($wall->get() as $v) {
            if (Check::checkIfExistPost($v['id'], Vk::get()->idGroup)) {
                $text = Text::change($v['text']);
                if (isset($v['link'])) {
                    foreach ($v['link'] as $itmLink) {
                        $text = FLink::change($itmLink, $text);
                    }
                }
                if ($v['author'] !== 0) $text .= Author::change($v['author']);
                if (isset($v['media'])) {
                    $api->sendMediaGroup($text, $v['media']);
                    $text = '';
                }
                if (!empty($text)) $api->sendMessage($text);
            }
        }
    }
}
