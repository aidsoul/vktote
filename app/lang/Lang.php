<?php

namespace Vktote\Lang;

use Vktote\Config\Bot;
use Vktote\Message\Message;

/**
 * Enum Lang
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Lang
{
    /**
     * langArr
     * 
     * @var array
     */
    private static array $langArr;

    /**
     * Set language file
     * 
     * @return void
     */
    public static function set(): void
    {
        $langPath = __DIR__ . '/' . Bot::get()->lang . '.php';
        if (file_exists($langPath)) {
            self::$langArr = include $langPath;
        } else {
            Message::find()->show('Lang', 'noLanguageFound');
        }
    }

    /**
     * 
     * @param string $propertyName
     * 
     * @return string
     */
    public static function get(string $propertyName): string
    {
        if (!array_key_exists($propertyName, self::$langArr)) {
            Message::find()->show('Lang', 'property');
        }

        return self::$langArr[$propertyName];
    }
}