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
    public function video()
    {
        return new Video();
    }

    public function link()
    {
        return new link();
    }

    public function text()
    {
        return new Text();
    }

    public function author()
    {
        return new Author();
    }
}
