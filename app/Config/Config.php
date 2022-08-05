<?php

namespace Vktote\Config;

/**
 * Config class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Config
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
}
