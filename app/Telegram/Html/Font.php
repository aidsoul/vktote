<?php

namespace Vktote\Telegram\Html;

/**
 * Font class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Font extends Html
{

    /**
     * B teg function
     *
     * @param string $text
     * @return string
     */
    public static function b(string $text): string
    {
        return "<b>{$text}</b>";
    }
}
