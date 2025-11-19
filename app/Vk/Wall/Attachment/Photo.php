<?php

namespace Vktote\Vk\Wall\Attachment;

/**
 * Photo class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Photo extends AttachmentItem
{
    /**
     * Get Best Size Image function
     *
     * Getting the best image quality
     *
     * @return string
     */
    private function getBestSizeImage(): string
    {
        return array_pop($this->itemArr['sizes'])['url'];
    }

    /**
     * Get function
     *
     * @return array
     */
    public function get(): array
    {
        return [
            'type' => 'photo',
            'caption' => $this->itemArr['text'],
            'media' => $this->getBestSizeImage(),
            'parse_mode' => 'html'
        ];
    }
}
