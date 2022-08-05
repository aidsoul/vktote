<?php

namespace Vktote\Wall\Attachment;

/**
 * Attachment interface
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
interface LinkInterface extends AttachmentItemInterface
{
    /**
     * @param array $link
     */
    public function __construct(array $link);
}
