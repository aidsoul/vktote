<?php

namespace Vktote\Vk\Wall\Attachment;

/**
 * Link class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Link implements LinkInterface
{

    public function __construct(private array $link)
    {
    }

    /**
     * Get function
     *
     * @return array
     */
    public function get(): array
    {
        return [
            'url' => $this->link['url'],
            'title' => $this->link['title'],
            'description' => $this->link['description']
        ];
    }
}
