<?php

namespace Vktote\Telegram\Html;

/**
 * Link class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Link extends Html
{

    /**
     * Ahref function
     *
     * @param string $link
     * @param string $linkName
     * 
     * @return string
     */
    public static function a(string $link, string $linkName = ''): string
    {
        $aStart = '<a href="';
        $aEnd = '">' . $linkName . '</a>';
        
        return $aStart.$link.$aEnd;
    }
}
