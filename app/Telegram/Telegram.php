<?php

namespace Vktote\Telegram;

use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram as TelegramBot;
use Vktote\Config\Telegram as T;
use Vktote\Config\Vk as V;
use Vktote\DataBase\Post;
use Vktote\DataBase\Vkgroup;
use Vktote\Telegram\Html\Font;
use Vktote\Telegram\Html\Link;

/**
 * Telegram class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Telegram
{
    /**
     * @var array
     */
    private array $link;

    /**
     * @var array
     */
    private array $media;

    /**
     * @var integer
     */
    private int $author;

    /**
     * @var integer
     */
    private int $chatId;

    /**
     * @var string
     */
    private string $text;

    /**
     * __construct function
     */
    public function __construct()
    {
        new TelegramBot(T::get()->botApiKey, T::get()->botName);
    }

    /**
     * Exist group function
     *
     * @return integer
     */
    private function checkIfExistGroup():int
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
    private function checkIfExistPost(int $postId):bool
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
     * Send function
     *
     * @param array $data
     * @return void
     */
    public function send(array $data):void
    {
        foreach ($data as $k => $v) {
            if ($this->checkIfExistPost($k)) {
                $this->chatId = T::get()->chatId;
                // $this->text = 'id = '.$k."\r\n";
                // $this->text = '#vk-'.V::get()->idGroup."\r\n";
                $this->text = $v['text'];
            /**
             * !Need to implement a separate class
             */
                $paternLink = '#(?:https?|http|ftp|ftps)://[^\s\,]+#i';
                if (preg_match($paternLink, $v['text'])) {
                    preg_match_all($paternLink, $v['text'], $linkArr);
                    foreach ($linkArr as $linkItm) {
                        foreach ($linkItm as $k => $link) {
                            $k++;
                            $this->text = preg_replace("~{$link}~", Link::a($link, '🔗'.parse_url($link)['host']), $this->text);
                        }
                    }
                }
            /**
             * !!!
             */

                if (isset($v['link'])) {
                    foreach ($v['link'] as $itmLink) {
                        $this->link = $itmLink;
                        $this->link();
                    }
                }

                if ($v['author'] !== 0) {
                    $this->author = $v['author'];
                    $this->author();
                }
                if (isset($v['media'])) {
                    $this->media = $v['media'];
                    $this->media();
                }
                if (!empty($v['text'])) {
                    $this->text();
                }
            } else {
            }
        }
    }

    /**
     * Text function
     *
     * @return void
     */
    private function text():void
    {
            Request::sendMessage([
            "chat_id" => $this->chatId,
            "text" => $this->text,
            "parse_mode"=>"html",
            "disable_web_page_preview" => true
            ]);
    }

    /**
     * Author function
     *
     * @return void
     */
    private function author():void
    {
        $link = 'https://vk.com/id';
        $this->text .= "\r\n".Link::a($link.$this->author, '👤'.parse_url($link)['host']);
    }

    /**
     * Link function
     *
     * @return void
     */
    private function link():void
    {
        $message = Font::b($this->text."\r\n");
        $message .= $this->link['title']."\r\n";
        if (!empty($this->link['description'])) {
            $symbol = '[…]';
            $nextStr = '[читать далее...]';
            if (strpos($this->link['description'], $symbol)) {
                $link = str_replace($symbol, Link::a($this->link['url'], $nextStr), $this->link['description']);
            } else {
                $link = $this->link['description']." ".Link::a($this->link['url'], $nextStr);
            }
        
            $message .= "{$link}\r\n";
        }
        // else {
        //     $message .= Link::a($this->link['url'], 'Ссылка на статью');
        // }
        $message .= '';
        $this->text = $message;
    }
    
    /**
     * Media function
     *
     * @return void
     */
    private function media():void
    {
        $this->media[0]["caption"] = $this->text;
        $this->text = '';
        Request::sendMediaGroup([
            "chat_id" => $this->chatId,
            "media" => $this->media
        ]);
    }
}
