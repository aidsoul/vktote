<?php

namespace Vktote\Config;

use Vktote\Message\Message;

/**
 * ActionConfig
 *
 * Get config with name
 *
 * @author AidSoul
 * @license MIT License
 */
trait ActionConfig
{
    /**
     *
     * @param string $property
     * @return string
     */
    public function __get(string $property = ''):string
    { 
        try{
            $className = (new \ReflectionClass($this))->getShortName();
            if(!empty($property)){
                $item = parent::$config[$className][$property];
                if (array_key_exists($className, parent::$config) and property_exists($this, $property)) {
                    if (preg_match("/[<\/][a-zA-Z]{1,7}[>]+/", $item)) {
                        Message::find()->show(false, __TRAIT__, 'tag', "{$item}");
                    }
                    $this->$property = $item;
                    if (!method_exists($this, $property) or
                        method_exists($this, $property) and
                        $this->$property() === true
                    ) {
                        return $this->$property;
                    }
                } else {
                    Message::find()->show(false, __TRAIT__, 'property', "[{$className}->[{$property}=>'...']");
                }
            }else{
                Message::find()->show(false, __TRAIT__, 'propertyNull', "[{$className}->[{$property}=>'...']");
            }
        }
        catch(\Exception $e){
        }

    }

    /**
     * Get function
     *
     * @return static
     */
    public static function get():static
    {
        return new static();
    }
}
