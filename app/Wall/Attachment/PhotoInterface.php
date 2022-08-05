<?php

namespace Vktote\Wall\Attachment;

/**
 * Attachment interface
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
interface PhotoInterface extends AttachmentItemInterface
{
    /**
     * @param array $photo
     */
    public function __construct(array $photo);
}
