<?php

namespace Vktote\Config;

/**
 * Config class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
abstract class Config
{
    /**
     *
     * @var array
     */
    protected static array $config;

    /**
     * Installing the file to retrieve the configuration
     * 
     * @var array
     * @return void
     */
    public static function set(string $сonfigPath): void
    {
        self::$config = parse_ini_file($сonfigPath, true);
    }

    /**
     * Getting the right configuration
     *
     * @return static
     */
    public static function get(): static
    {
        return new static();
    }
}
