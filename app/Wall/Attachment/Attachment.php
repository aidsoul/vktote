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
    private array $cleanAttach = [];

    /**
     * Set function
     *
     * @param array $attachment
     * @return void
     */
    public function set(array $attachment): void
    {
        $type = $attachment['type'];
        if (method_exists($this, $type)) {
            $sendArray = $attachment[$type];
            match ($type){
                'photo' => $this->photo(new Photo($sendArray)),
                'link' => $this->link(new Link($sendArray))
            };
        }
    }

    /**
     * Photo function
     *
     * @return void
     */
    private function photo(PhotoInterface $photo): void
    {
        $this->cleanAttach['media'][] = $photo->get();
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
    private function link(LinkInterface $link): void
    {
        $this->cleanAttach['link'][] = $link->get();
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
