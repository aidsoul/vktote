<?php

namespace Vktote\Wall;

use Generator;
use Vktote\Config\Vk as V;
use Vktote\Vk\Api as VkApi;
use Vktote\Vk\ApiInterface;
use Vktote\Wall\Attachment\Attachment;
use Vktote\Wall\Attachment\AttachmentInterface;

/**
 * Wall
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Wall implements WallInterface
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
    private int $author;

    /**
     * @var array
     */
    private array $cleanWall = [];


    /**
     * Get Wall function
     *
     * @return Generator
     */
    private function getWall(ApiInterface $wall): Generator
    {
        foreach ($wall->get()['response']['items'] as $currValue) {
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
    private function middleBodyWall(
        array $attach,
        AttachmentInterface $attachmetAction = new Attachment()
    ): void {
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
        } else {
            $this->author = 0;
        }
        $this->cleanWall[] =
            [
                'id'   => $this->id,
                'text' => $this->text,
                'author' => $this->author
            ] +
            $attachmetAction->get();
    }
    
    /**
     * Collect function
     *
     * @return void
     */
    private function collect(): void
    {
        foreach ($this->getWall((new VkApi(
            V::get()->token,
            V::get()->idGroup,
            V::get()->count
        ))) as $value) {
                $this->id = $value['id'];
                $this->text = $value['text'] . "\r\n";
                if (isset($value['copy_history'])) {
                    $this->copyHistory($value['copy_history']);
                } else {
                    $this->middleBodyWall($value);
            }
        }
    }

    /**
     * @return \Generator
     */
    public function get(): Generator
    {
        $this->collect();
        foreach ($this->cleanWall as $v) {
            yield $v;
        }
    }
}
