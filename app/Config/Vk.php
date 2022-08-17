<?php

namespace Vktote\Config;

use Vktote\Config\ConfigInterface;
use Vktote\Message\Message;

/**
 * Vk class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Vk extends Config implements ConfigInterface
{
    /**
     * @var string
     */
    protected string $token;

    /**
     * @var string
     */
    protected string $idGroup;

    /**
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
                Message::find()->show(false, __CLASS__, 'count');
            } else {
                return true;
            }
    }
}
