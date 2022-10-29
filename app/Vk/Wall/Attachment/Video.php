<?php

namespace Vktote\Vk\Wall\Attachment;

use Vktote\Lang\Lang;

/**
 * Video class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Video implements VideoInterface
{
    /**
     * Summary of __construct
     * @param array $video
     */
    public function __construct(private array $video)
    {

    }

    /**
     * get function
     * 
     * @return array
     */
    public function get(): array
    {
        $title = $this->video['title'] ?? '';
        if($title == "Video unavailable") {
            $title = Lang::get('videoNoName');
        }
        return [
            'caption' => $title,
            'url' => $this->video['owner_id'] . 
            '_' . 
            $this->video['id'],
        ];
    }
}