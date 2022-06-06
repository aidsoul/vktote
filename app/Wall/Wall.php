<?php

namespace Vktote\Wall;

use Generator;
use Vktote\Config\Vk as V;
use Vktote\Telegram\Telegram;
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
     * @var object
     */
    private object $item;

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
    private int $author;
    

    /**
     * Get Wall function
     *
     * @return void
     */
    private function getWall():Generator
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
    private function copyHistory(array $copyHistoryData):void
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
    private function middleBodyWall(array $attach):void
    {
        if (isset($attach['signer_id'])) {
            $this->author = $attach['signer_id'];
        } else {
            $this->author = 0;
        }
        $this->item = new Attachment($this->id, $this->text, $this->author);
        if (isset($attach['attachments'])) {
            foreach ($attach['attachments'] as $valueAttach) {
                $this->item->set($valueAttach);
            }
        }

            (new Telegram)->send($this->item->get());
    }

    /**
     * Collect and push function
     *
     * @return void
     */
    public function collectAndPush():void
    {
        foreach ($this->getWall() as $wallV) {
            $this->id = $wallV['id'];
            $this->text = $wallV['text']."\r\n";
            if (isset($wallV['copy_history'])) {
                $this->copyHistory($wallV['copy_history']);
            } else {
                $this->middleBodyWall($wallV);
            }
        }
    }
}
