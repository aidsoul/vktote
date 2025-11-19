<?php

namespace Vktote\Vk\Api;

use GuzzleHttp\Client;
use Vktote\Config\Vk as VkConf;

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
    $client = new Client(['verify' => false ]);
    $response = $client->request('GET', 'https://api.vk.com/method/wall.get', [
        'query' => [
            'access_token' => VkConf::get()->token,
            'v' => VkConf::API_VERSION,
            'domain' => VkConf::get()->idGroup,
            'count' => VkConf::get()->count,
        ]
    ]);

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