<?php

namespace Vktote\Wall;

use Generator;
use Vktote\Config\Vk as V;
use Vktote\DataBase\Models\Post;
use Vktote\DataBase\Models\Vkgroup;
use Vktote\Vk\Api as VkApi;
use Vktote\Wall\Attachment\Attachment;

/**
 * Wall
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Wall
{
    /**
     * @var integer
     */
    private int $id;

    /**
     * @var string
     */
    private string $text = '';

    /**
     * @var integer
     */
    private int $author = 0;

    /**
     * @var array
     */
    private array $cleanWall = [];


    /**
     * Get Wall function
     *
     * @return Generator
     */
    private function getWall(): Generator
    {
        $wall = (new VkApi(
            V::get()->token,
            V::get()->idGroup,
            V::get()->count
        ))->get()['response']['items'];

        foreach ($wall as $currValue) {
            yield $currValue;
        }
    }

    /**
     * Copy history function
     *
     * @param array $copyHistoryData
     * @return void
     */
    private function copyHistory(array $copyHistoryData): void
    {
        foreach ($copyHistoryData as $copyV) {
            $this->text .= $copyV['text'];
            $this->middleBodyWall($copyV);
        }
    }

    /**
     * Midle body wall function
     *
     * @param array $attach
     * @return void
     */
    private function middleBodyWall(array $attach): void
    {
        $attachmetAction = new Attachment;
        if (isset($attach['attachments'])) {
            foreach ($attach['attachments'] as $valueAttach) {
                if ($valueAttach['type'] === 'video') {
                    $this->text = '';
                    continue;
                }
                $attachmetAction->set($valueAttach);
            }
        }

        if (isset($attach['signer_id'])) {
            $this->author = $attach['signer_id'];
        }else{
            $this->author = 0;
        }

        $this->cleanWall[$this->id] =
            [
                'text' => $this->text,
                'author' => $this->author
            ] +
            $attachmetAction->get();
    }


    /**
     * Exist group function
     *
     * @return integer
     */
    private function checkIfExistGroup(): int
    {
        $vkGroup = new Vkgroup;
        $groupName = V::get()->idGroup;
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
    private function checkIfExistPost(int $postId): bool
    {
        $status = false;
        $groupId = $this->checkIfExistGroup();
        $post = new Post;
        if (!$post->check($postId, $groupId)) {
            $post->create($postId, $groupId);
            $status = true;
        }

        return $status;
    }
    /**
     * Collect function
     *
     * @return void
     */
    private function collect(): void
    {
        foreach ($this->getWall() as $value) {
            if($this->checkIfExistPost($value['id'])){
            $this->id = $value['id'];
            $this->text = $value['text'] . "\r\n";
            if (isset($value['copy_history'])) {
                $this->copyHistory($value['copy_history']);
            } else {
                $this->middleBodyWall($value);
            }
            }
        }
    }

    /**
     * @return \Generator
     */
    public function get(): Generator
    {
        $this->collect();
        foreach($this->cleanWall as $v){
            yield $v;
        }
    }

}
