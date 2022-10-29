<?php

namespace Vktote\Vk\Api;

use GuzzleHttp\Client;
use Vktote\Config\Vk;

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
   * Create request
   *
   * @return array
   */
  private function add(): array
  {
    $client = new Client();
    $response = $client->get(
      'https://api.vk.com/method/wall.get',
    [
      'query' => [
        'access_token' => Vk::get()->token,
        'v' => '5.131',
        'domain' => Vk::get()->idGroup,
        'count' => Vk::get()->count,
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
  public function get(): array
  {
    return $this->add();
  }
}