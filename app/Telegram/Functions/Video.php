<?php

namespace Vktote\Telegram\Functions;

use Vktote\Telegram\Html\Link;

/**
 * Class Video
 * 
 * @author aidsoul work-aidsoul@outlook.com
 * @license MIT
 */
class Video
{
    /**
     * @param array $video
     * 
     * @return string
     */
    public function edit(array $video): string
    {
        $text = "\r\n" . '🎞Видеоматериалы🎞' . "\r\n";
        foreach($video as $k=>$value)
        {
            $text .= "\r\n" . '(' . ++$k . ') ' .
            Link::a('https://vk.com/video'.$value['url'], 
            'vk.com/video('. $value['caption']. ')');
        }

        return $text. "\n";
    }
}
