<?php

namespace Vktote\Vk;

use GuzzleHttp\Client;

/**
 * Api
 *
 * Create and send a request to the api Vk
 *
 * @author AidSoul
 * @license MIT License
 */
class Api implements ApiInterface
{

  /**
   * @var string $token Token id
   */
  private static string $token = "token";

  /**
   * @var string|int $idGroup Id group for parser
   */
  private static string|int $idGroup = 1345;

  /**
   * @var int $count Number of posts
   */
  private static int $count = 1;

  /**
   * @param string $token
   * @param string|integer $idGroup
   * @param integer $count
   */
  public function __construct(string $token, string|int $idGroup, int $count)
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
  private static function add(): array
  {
    $client = new Client();
    $response = $client->get(
      'https://api.vk.com/method/wall.get',
      [
        'query' => [
          'access_token' => self::$token,
          'v' => '5.131',
          'domain' => self::$idGroup,
          'count' => self::$count
        ]
      ]
    );

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
