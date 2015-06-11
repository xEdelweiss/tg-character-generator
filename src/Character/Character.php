<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.2015
 * Time: 15:46
 */

namespace TG\Character;


class Character extends Generic
{
    protected $attributes = [];

    public function get($attribute)
    {
        if (!isset($this->attributes[$attribute])) {
            throw new \Exception(sprintf("Character doesn't have '%s' attribute", $attribute));
        }
    }
}