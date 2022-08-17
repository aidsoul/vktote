<?php

namespace Vktote\Message;

/**
 * Message interface
 * 
 * @license 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface MessageInterface
{
    public function __construct();

    /**
     * @param boolean $type
     * @param string $className
     * @param string $messageName
     * @param string $messageAdd
     * @return void
     */
    public function show(
        bool $type,
        string $className,
        string $messageName,
        string $messageAdd = ''
    ): void;

    public static function find(): Message;
}