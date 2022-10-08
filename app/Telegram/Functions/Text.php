<?php

namespace Vktote\Telegram\Functions;

use Vktote\Telegram\Html\Link;

class Text
{
    /**
     * @param string $text
     * 
     * @return string
     */
    public static function change(string $text): string 
    {
        $paternLink = '#(?:https?|http|ftp|ftps)://[^\s\,]+#i';
        if (preg_match_all($paternLink, $text, $linkArr)) {
            foreach ($linkArr as $linkItm) {
                foreach ($linkItm as $k => $link) {
                    $text = preg_replace(
                        "~{$link}~",
                        Link::a($link, '🔗' . parse_url($link)['host']),
                        $text
                    );
                }
            }
        }
        
        return $text;
    }
}