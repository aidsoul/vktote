<?php

namespace Vktote\Telegram;

use Vktote\DataBase\Models\PostModel;
use Vktote\DataBase\Models\VkgroupModel;

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
        $vkGroup = new VkgroupModel();
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
    public static function checkIfExistPost(int $postId, string $groupId): bool
    {
        $status = false;
        $group = self::checkIfExistGroup($groupId);
        $post = new PostModel();
        if (!$post->check($postId, $group)) {
            $post->create($postId, $group);
            $status = true;
        }

        return $status;
    }
}