<?php
namespace Vktote\Wall\Attachment;

/**
 * Photo class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Photo extends Attachment
{

    /**
     * __construct function
     *
     * @param array $photo
     */
    public function __construct(private array $photo)
    {
    }

    /**
     * Get Best Size Image function
     * 
     * Getting the best image quality
     * 
     * @return string
     */
    private function getBestSizeImage():string
    {
        return array_pop($this->photo['sizes'])['url'];
    }

    /**
     * Get function
     *
     * @return array
     */
    public function get():array
    {
        return [
                'type' => 'photo',
                'caption'=> $this->photo['text'],
                'media'=>$this->getBestSizeImage(),
                "parse_mode"=>"html"
        ];
    }
}
