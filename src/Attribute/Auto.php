<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 11.06.2015
 * Time: 22:28
 */

namespace TG\Attribute;


class Auto extends Generic
{

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValueValid($value)
    {
        return false;
    }

    /**
     * @param $value
     * @throws \Exception
     */
    protected function throwInvalidValueException($value)
    {
        throw new \Exception(sprintf('Attribute value can be changed only by callback'));
    }

}