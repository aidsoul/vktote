<?php

namespace Vktote\Wall\Attachment;

use Vktote\Wall\Item;

/**
 * Attachment class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Attachment extends Item
{

    /**
     * @var array
     */
    private array $media;

    /**
     * @var array
     */
    private array $attachment;

    /**
     * __construct function
     *
     * @param integer $id
     * @param string $text
     * @param integer $author
     */
    public function __construct(int $id, string $text, int $author)
    {
        $this->id = $id;
        $this->text = $text;
        $this->author = $author;
        $this->cleanAttach[$id] = ['text' => $text];
        $this->cleanAttach[$id]['author'] =  $author;
    }

    /**
     * Set function
     *
     * @param array $attachment
     * @return void
     */
    public function set(array $attachment): void
    {
        $this->attachment = $attachment;
        $type = $attachment['type'];

        //delete post if exist type = 'video'
        if ($type === 'video') {
            unset($this->cleanAttach[$this->id]);
        }
        if (method_exists($this, $type)) {
            $this->$type();
        }
    }

    /**
     * Photo function
     *
     * @return void
     */
    private function photo(): void
    {
        $this->cleanAttach[$this->id]['media'][] = (new Photo($this->attachment[__FUNCTION__]))->get();
    }

    /**
     * Video function
     *
     * Turn on if it is ready
     *
     * @return void
     */
    // private function video():void
    // {
    // }

    /**
     * Link function
     *
     * @return void
     */
    private function link(): void
    {
        $this->cleanAttach[$this->id]['link'][] = (new Link($this->attachment[__FUNCTION__]))->get();
    }

    /**
     * Get media function
     *
     * @return array
     */
    public function getMedia(): array
    {
        return $this->media;
    }
}
