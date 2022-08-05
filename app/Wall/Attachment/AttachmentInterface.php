<?php

namespace Vktote\Wall\Attachment;

interface AttachmentInterface
{

    /**
     * Initializing an array of attachments
     *
     * @param array $attachment
     */
    public function set(array $attachment);

    /**
     * @return array
     */
    public function get(): array;

}