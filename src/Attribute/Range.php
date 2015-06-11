<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.2015
 * Time: 16:30
 */

namespace TG\Attribute;


class Range extends Generic
{
    protected $minValue;
    protected $maxValue;

    /**
     * @return mixed
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * @param mixed $minValue
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;
    }

    /**
     * @return mixed
     */
    public function getMaxValue()
    {
        return $this->maxValue;
    }

    /**
     * @param mixed $maxValue
     */
    public function setMaxValue($maxValue)
    {
        $this->maxValue = $maxValue;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValueValid($value)
    {
        return ($value >= $this->minValue) && ($value <= $this->maxValue);
    }

    /**
     * @param $value
     * @throws \Exception
     */
    protected function throwInvalidValueException($value)
    {
        throw new \Exception(sprintf('Attribute value (%f) should be between [%f; %f]', $value, $this->minValue, $this->maxValue));
    }

}