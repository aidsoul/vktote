<?php

namespace Vktote\Telegram;

use Vktote\DataBase\Models\Post;
use Vktote\DataBase\Models\Vkgroup;

/**
 * A class for checking the existence of data in a database
 * 
 * @license 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class Check
{
    /**
     * Exist group function
     *
     * @return integer
     */
    private static function checkIfExistGroup(string|int $groupName): int
    {
        $vkGroup = new Vkgroup;
        $getVkGroup = $vkGroup->check($groupName);
        if (!$getVkGroup) {
            $vkGroup->create($groupName);
            $getVkGroup = $vkGroup->check($groupName);
        }

        return $getVkGroup;
    }

    /**
     * Exist post function
     *
     * @return bool
     */
    public static function checkIfExistPost(int $postId, string $groupName): bool
    {
        $status = false;
        $groupId = self::checkIfExistGroup($groupName);
        $post = new Post;
        if (!$post->check($postId, $groupId)) {
            $post->create($postId, $groupId);
            $status = true;
        }

        return $status;
    }
}
