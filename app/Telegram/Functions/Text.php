<?php

namespace Vktote\Telegram\Functions;

use Vktote\Telegram\Html\Link;

/**
 * Class Text
 * 
 * @author aidsoul work-aidsoul@outlook.com
 * @license MIT
 */
class Text
{
    /**
     * @param string $text
     * 
     * @return string
     */
    public function change(string $text): string
    {
        $paternLink = '#(?:https?|http|ftp|ftps)://[^\s\!$()*+:;%,<>[\]^{|}]+#i';
        if (preg_match_all($paternLink, $text, $linkArr)) {
            $linkAhref = [];
            foreach ($linkArr[0] as $item) {
                $linkAhref[] = Link::a($item, '🔗' . parse_url($item)['host']);
            }
            $text = str_replace($linkArr[0], $linkAhref, $text);
        }

        return $text;
    }
}