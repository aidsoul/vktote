<?php

namespace Vktote\Telegram\Functions;

use Vktote\Telegram\Html\Font;
use Vktote\Telegram\Html\Link as HtmlLink;

/**
 * Function for work with links
 * 
 * @license 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class Link
{
    /**
     * @param array $link
     * @param string $text
     * 
     * @return string
     */
    public static function change(array $link, string $text): string
    {
        $message = Font::b($text . "\r\n");
        $message .= $link['title'] . "\r\n";
        if (!empty($link['description'])) {
            $symbol = '[…]';
            $nextStr = '[читать далее...]';
            if (strpos($link['description'], '[…]')) {
                $link = str_replace(
                    $symbol,
                    HtmlLink::a(
                        $link['url'],
                        $nextStr
                    ),
                    $link['description']
                );
            } else {
                $link = $link['description'] . " " .
                HtmlLink::a($link['url'], $nextStr);
            }
            $message .= "{$link}\r\n";
        }
        $message .= '';

        return $message;
    }
}
