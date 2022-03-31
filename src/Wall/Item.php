<?php

namespace Vktote\Wall;

/**
 * Abstract item class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
abstract class Item
{

    /**
     * @var integer
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $text = '';

    /**
     * @var integer
     */
    protected int $author;
    
    /**
     * @var array
     */
    protected array $cleanAttach;

    /**
     * Get function
     *
     * @return array
     */
    public function get():array
    {
        return $this->cleanAttach;
    }

    /**
     * Get text function
     *
     * @return string
     */
    public function getText():string
    {
        return $this->text;
    }

    /**
     * Set text function
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text):void
    {
        $this->text = $text;
    }
}
