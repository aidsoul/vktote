<?php

namespace Vktote\Telegram\Html;

/**
 * Html abstract class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
abstract class Html
{

    /**
     * Get function
     *
     * @return static
     */
    public static function get(): static
    {
        return new static;
    }
}
