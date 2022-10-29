<?php

namespace Vktote\Message;

/**
 * Message
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Message
{
    /**
     * Message array
     *
     * @var array
     */
    private array $messageArr = [];

    /**
     * __construct function
     * 
     * @param string $fileName file name for work with php file
     */
    public function __construct(string $fileName)
    {
        $path = __DIR__ . '/Message' . $fileName . '.php';
        if (file_exists($path)) {
            $this->messageArr = include $path;
        } else {
            die('File with messages not found!' . $path);
        }
    }

    /**
     * Show messages
     * Error or Success
     *
     * @param bool $type
     * @param string $className
     * @param string $messageName
     * 
     * @return void
     */
    public function show(
        string $className,
        string $messageName,
        string $messageAddText = ''
    ): void
    {
        if (isset($this->messageArr[$className]) &&
            isset($this->messageArr[$className][$messageName])) {
            $message = $this->messageArr[$className][$messageName] .
                ' ' . $messageAddText;
            exit($message);
        }
    }

    /**
     * @param string $fileName
     * 
     * @return Message
     */
    public static function find(string $fileName = 'Errors'): Message
    {
        return new static ($fileName);
    }
}