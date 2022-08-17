<?php

namespace Vktote\Vk;

/**
 * VkApi interface
 * 
 * @license 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface ApiInterface
{
    /**
     * @param string $token
     * @param string|integer $idGroup
     * @param integer $count
     */ 
    public function __construct(string $token, string|int $idGroup, int $count);

    /**
     * @return array
     */
    public static function get(): array;
}
