<?php

namespace Vktote\Telegram;

use Vktote\Config\Vk as V;
use Vktote\Telegram\Api\Api;
use Vktote\Telegram\Functions\Author;
use Vktote\Telegram\Functions\Link as FLink;
use Vktote\Telegram\Functions\Text;
use Vktote\Wall\WallInterface;

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
     * @param \Vktote\Wall\WallInterface $wall
     * @return void
     */
    public function send(WallInterface $wall): void
    {
        foreach ($wall->get() as $v) {
            if (Check::checkIfExistPost($v['id'], V::get()->idGroup)) {
                $text = Text::change($v['text']);
                $api  = new Api();
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
