<?php

namespace Vktote\Config;

use Vktote\Message\Message;

/**
 * Vk class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Vk extends Config
{
    use ActionConfig;

    /**
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    private string $idGroup;

    /**
     * @var integer
     */
    private int $count;

    /**
     * Count function
     *
     * @return boolean
     */
    private function count(): bool
    {
        if (isset($this->count) and $this->count > 100) {
            Message::find()->show(false, __CLASS__, 'count');
        } else {
            return true;
        }
    }
}
