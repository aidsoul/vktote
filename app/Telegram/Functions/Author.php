<?php

namespace Vktote\Telegram\Functions;

use Vktote\Telegram\Html\Link;

class Author
{
    /**
     * @param integer $author
     * 
     * @return string
     */
    public static function change(int $author): string
    {
        $link = 'https://vk.com/id';

        return "\r\n" . Link::a(
            $link . $author,
            '👤' . parse_url($link)['host']
        );
    }
}
