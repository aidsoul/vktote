<?php

namespace Vktote\Vk\Wall\Attachment;

/**
 * Link class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Link extends AttachmentItem
{
    /**
     * Get function
     *
     * @return array
     */
    public function get(): array
    {
        return [
            'url' => $this->itemArr['url'],
            'title' => $this->itemArr['title'],
            'description' => $this->itemArr['description']
        ];
    }
}
