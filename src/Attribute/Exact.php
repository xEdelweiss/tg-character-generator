<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.2015
 * Time: 17:33
 */

namespace TG\Attribute;


class Exact extends Generic
{
    protected $possibleValue;

    /**
     * @return mixed
     */
    public function getPossibleValue()
    {
        return $this->possibleValue;
    }

    /**
     * @param mixed $possibleValue
     */
    public function setPossibleValue($possibleValue)
    {
        $this->possibleValue = $possibleValue;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValueValid($value)
    {
        return ($value === $this->value);
    }

    /**
     * @param $value
     * @throws \Exception
     */
    protected function throwInvalidValueException($value)
    {
        throw new \Exception(sprintf('Attribute value (%f) cannot be changed', $value));
    }
}