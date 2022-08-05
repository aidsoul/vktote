<?php

namespace Vktote\Wall\Attachment;


/**
 * Attachment class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Attachment implements AttachmentInterface
{

    /**
     * @var array
     */
    private array $attachment;

    /**
     * @var array
     */
    private array $cleanAttach = [];

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
        $this->cleanAttach['media'][] = (new Photo($this->attachment[__FUNCTION__]))->get();
    }

    /**
     * Video function
     *
     * !! Add Late
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
        $this->cleanAttach['link'][] = (new Link($this->attachment[__FUNCTION__]))->get();
    }

    /**
     * Get function
     *
     * @return array
     */
    public function get(): array
    {
        return $this->cleanAttach;
    }

}
