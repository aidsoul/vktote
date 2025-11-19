<?php
namespace Vktote\Vk\Wall\Attachment;

/**
 * AttachmentItem abstract class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
abstract class AttachmentItem{

    public function __construct(protected array $itemArr){
    }

    /**
     * @return array
     */
    abstract public function get(): array;
}