<?php

namespace Vktote\Vk\Wall\Attachment;


/**
 * Attachment class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Attachment
{
    /**
     * @var array<string>
     */
    private array $cleanAttach = [];

    /**
     * Set function
     *
     * @param array $attachment
     * 
     * @return void
     */
    public function set(array &$attachment): void
    {
        $type = &$attachment['type'];
        if (method_exists($this, $type)) {
            match ($type){
                'photo' => $this->photo(new Photo($attachment[$type])),
                'link' => $this->link(new Link($attachment[$type])),
                'video' => $this->video(new Video($attachment[$type]))
            };
        }
    }

    /**
     * Photo function
     *
     * @return void
     */
    private function photo(Photo $photo): void
    {
        $this->cleanAttach['media'][] = $photo->get();
    }

    /**
     * Video function
     *
     * @return void
     */
    private function video(Video $video): void
    {
        $this->cleanAttach['video'][] = $video->get();
    }

    /**
     * Link function
     *
     * @return void
     */
    private function link(Link $link): void
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
