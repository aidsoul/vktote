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
    public function __get(string $property = ''): string
    { 
        try{
            $className = (new \ReflectionClass($this))->getShortName();
            if(!empty( $property )){
                if (array_key_exists($className, parent::$config) and 
                property_exists($this, $property) and
                array_key_exists($property, parent::$config[$className]
                )
                ) {
                    $item = parent::$config[$className][$property];
                    if(!empty($item)){
                        $tag = "/[<\/][a-zA-Z]{1,7}[>]+/";
                        if (preg_match($tag, $item) || preg_match($tag, $className)) {
                            Message::find()->show(false, __TRAIT__, 'tag', "{$className}");
                        }
                        $this->$property = $item;
                        if (!method_exists($this, $property) or
                            method_exists($this, $property) and
                            $this->$property() === true
                        ) {
                            $this->$property = $item;
                            return $this->$property;
                        }
                    }else{
                        Message::find()->show(false, __TRAIT__, 'propertyNullItem', "[{$className}->[{$property}=>'...']");
                    }
                } else {
                    Message::find()->show(false, __TRAIT__, 'property', "[{$className}]->{$property}=>'?'");
                }
            }else{
                Message::find()->show(false, __TRAIT__, 'propertyNull', "[{$className}->[{$property}=>'...']");
            }
        }
        catch(\Exception $e){
            throw new \Exception($e);
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
