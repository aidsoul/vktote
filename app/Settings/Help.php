<?php

namespace Vktote\Settings;

/**
 * Help class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class Help
{
    /**
     * getShortName function
     *
     * @param object $obj
     * @return void
     */
    public static function getShortName(object $obj):string
    {
        return (new \ReflectionClass($obj))->getShortName();
    }
    
    /**
     * addHeader function
     *
     * @param string $header
     * @return void
     */
    public static function addHeader(string $header):string
    {
        return "[{$header}]\n";
    }
}
