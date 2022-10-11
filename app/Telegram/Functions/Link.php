<?php

namespace Vktote\Telegram\Functions;

use Vktote\Telegram\Html\Link as HtmlLink;

/**
 * Class function for work with links
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
    public function change(array $link, string $text): string
    {
        foreach ($link as $itmLink) {
            if (!empty($itmLink['description'])) {
                $message = $text . "\r\n";
                $symbol = '[…]';
                $nextStr = '[читать далее...]';
                if (strpos($itmLink['description'], $symbol)) {
                    $linkEdit = str_replace(
                        $symbol,
                        HtmlLink::a(
                        $itmLink['url'],
                        $nextStr
                    ),
                        $itmLink['description']
                    );
                }
                else {
                    $linkEdit = $itmLink['description'] . " " .
                        HtmlLink::a($itmLink['url'], $nextStr);
                }
                $message .= "{$linkEdit}\r\n";
            }else
            {
                $message = $text;
            }
        }
        $message .= '';

        return $message;
    }
}
