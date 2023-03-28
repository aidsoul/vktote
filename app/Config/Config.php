<?php

namespace Vktote\Config;

use Vktote\Message\Message;

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
   * @var array
   * @return void
   */
  public static function set(string $сonfigPath): void
  {
    self::$config = parse_ini_file($сonfigPath, true);    
  }

  /**
   * Get function
   *
   * @return static
   */
  public static function get(): static
  {
    return new static;
  }

  /**
   * Get config property
   *
   * @param string $property
   * @return void
   */
  public function __get(string $property)
  {
    try {
      $className = (new \ReflectionClass($this))->getShortName();
      if (!empty($property)) {
        if (
        array_key_exists($className, self::$config) &&
        property_exists($this, $property) &&
        array_key_exists(
        $property,
        self::$config[$className]
        )
        ) {
          $item = self::$config[$className][$property];
          if (!empty($item) || $item != 'pass') {
            $this->$property = $item;
            if (
            !method_exists($this, $property) or
            method_exists($this, $property) &&
            $this->$property() === true
            ) {
              $this->$property = $item;
              return $this->$property;
            }
          }
          else {
            Message::find()->show('Config', 'propertyNullItem', "[{$className}->[{$property}=>'...']");
          }
        }
        else {
          Message::find()->show('Config', 'property', "[{$className}]->{$property}=>'?'");
        }
      }
      else {
        Message::find()->show('Config', 'propertyNull', "[{$className}->[{$property}=>'...']");
      }
    }
    catch (\Exception $e) {
      throw new \Exception($e);
    }
  }
}
