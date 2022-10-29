<?php

namespace Vktote\Telegram\Functions;

/**
 * Class Function Factory
 * 
 * @author aidsoul work-aidsoul@outlook.com
 * @license MIT
 */
class FunctionFactory
{
    /**
     * @return Video
     */
    public function video(): Video
    {
        return new Video();
    }

    /**
     * @return Link
     */
    public function link(): Link
    {
        return new link();
    }

    /**
     * @return Text
     */
    public function text(): Text
    {
        return new Text();
    }

    /**
     * @return Author
     */
    public function author(): Author
    {
        return new Author();
    }
}
