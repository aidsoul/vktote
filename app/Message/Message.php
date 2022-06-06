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
     * Path to ini file with messages
     *
     * @var const FILE_NAME
     */
    private const FILE_NAME = 'message.ini';

    /**
     * Undocumented variable
     *
     * @var array
     */
    private array $messageArr = [];

    /**
     * __construct function
     */
    public function __construct()
    {
        if (file_exists(__DIR__ . '/' . self::FILE_NAME)) {
            $this->messageArr = parse_ini_file(self::FILE_NAME, true);
        } else {
            die("[ini]File with messages not found!");
        }
    }

    /**
     * Show messages
     * Error or Success
     *
     * @param bool $type
     * @param string $className
     * @param string $messageName
     */
    public function show(
        bool $type,
        string $className,
        string $messageName,
        string $messageAdd = ''
    ):void 
    {
        if (class_exists($className) or trait_exists($className)) {
            $message = $this->messageArr[$className = 
            (new \ReflectionClass($className))
            ->getShortName()][$messageName] . ' ' . $messageAdd;
            if ($type === false) {
                exit($message);
            } elseif ($type === true) {
                echo  $message;
            }
        }
    }

    /**
     * link message function
     *
     * @return Message
     */
    public static function find():Message
    {
        return new static();
    }
}
