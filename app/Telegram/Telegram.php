<?php

namespace Vktote\Telegram;

use Vktote\Config\Vk as VkConf;
use Vktote\Telegram\Api\Api;
use Vktote\Telegram\Functions\FunctionFactory;
use Vktote\Vk\Wall\Wall;

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
    public function send(Wall $wall, Api $api = new Api()): void
    {
        $functions = new FunctionFactory();
        foreach ($wall->get() as $v) {
            if (Check::existPost($v['id'], VkConf::get()->idGroup) === false) continue;
                $text = $functions->text()->change($v['text']);
                if(isset($v['link'])) $text   = $functions->link()->change($v['link'], $text);
                if(isset($v['video'])) $text .= $functions->video()->edit($v['video']);
                if($v['author'] !== 0) $text .= $functions->author()->change($v['author']);
                if(isset($v['media'])) {
                    $api->sendMediaGroup($text, $v['media']);
                    $text = '';
                }
                if (!empty($text)) $api->sendMessage($text);
        }
    }
}
