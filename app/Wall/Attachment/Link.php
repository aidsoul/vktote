<?php

namespace Vktote\Wall\Attachment;

/**
 * Link class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Link extends Attachment implements LinkInterface
{

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $description;

    /**
     * __construct function
     *
     * @param array $link
     */
    public function __construct(private array $link)
    {
        $this->url = $this->link['url'];
        $this->title = $this->link['title'];
        $this->description = $this->link['description'];
    }

    /**
     * Get function
     *
     * @return array
     */
    public function get(): array
    {
        return [
            'url' => $this->url,
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
