<?php

namespace Vktote\Vk\Wall\Attachment;

use Vktote\Lang\Lang;

/**
 * Video class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Video extends AttachmentItem{

    /**
     * get function
     * 
     * @return array
     */
    public function get(): array
    {
        $title = $this->itemArr['title'] ?? '';
        if($title === "Video unavailable") {
            $title = Lang::get('videoNoName');
        }
        return [
            'caption' => $title,
            'url' => $this->itemArr['owner_id'] . 
            '_' . 
            $this->itemArr['id'],
        ];
    }
}