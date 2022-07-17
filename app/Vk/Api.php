<?php

namespace Vktote\Vk;

/**
 * Api
 *
 * Create and send a request to the api Vk
 *
 * @author AidSoul
 * @license MIT License
 */
class Api
{

  /**
   * @var string $token Token id
   */
  private static $token = 'You access token';

  /**
   * @var int $idGroup Id group for parser
   */
  private static $idGroup = 1345;

  /**
   * @var int $count Number of posts
   */
  private static $count = 2;

  /**
   * @param string $token
   * @param int $idGroup
   * @param int $count
   */
  public function __construct($token, $idGroup, $count)
  {
    self::$token = $token;
    self::$idGroup = $idGroup;
    self::$count = $count;
  }

  /**
   * Create request
   *
   * @return array
   */
  protected static function add(): array
  {
    $link = "https://api.vk.com/method/wall.get?access_token=";
    $send = $link . self::$token . "&v=5.131&domain=" . self::$idGroup . "&count=" . self::$count . "";
    $client = new \GuzzleHttp\Client();
    $response = $client->get($send);
    return json_decode($response->getBody(), true);
  }

  /**
   * Get request
   *
   * @return array
   */
  public static function get(): array
  {
    return self::add();
  }
}
