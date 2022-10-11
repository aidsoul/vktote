<?php

namespace Vktote\Vk\Wall\Attachment;

interface AttachmentInterface
{

    /**
     * Initializing an array of attachments
     *
     * @param array $attachment
     * 
     * @return void
     */
    public function set(array $attachment): void;

    /**
     * @return array
     */
    public function get(): array;

}