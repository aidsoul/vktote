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
    /**
     * Application token
     * 
     * @var string
     */
    protected string $token;

    /**
     * Group identifier or name
     * 
     * @var string
     */
    protected string $idGroup;

    /**
     * Number of entries to be taken from the group wall
     * 
     * @var integer
     */
    protected int $count;

    /**
     * Count function
     *
     * @return boolean
     */
    protected function count(): bool
    {
        if (isset($this->count) and $this->count > 100) {
            Message::find()->show('Vk', 'count');
            return false;
        } else {
            return true;
        }
    }
}
