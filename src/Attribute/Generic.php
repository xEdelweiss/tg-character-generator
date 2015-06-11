<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.2015
 * Time: 16:29
 */

namespace TG\Attribute;


class Generic
{
    protected $name;
    protected $value;

    /**
     * Generic constructor.
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @throws \Exception
     */
    public function setValue($value)
    {
        if (!$this->isValueValid($value)) {
            $this->throwInvalidValueException($value);
        }

        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValueValid($value)
    {
        return true;
    }

    /**
     * @param $value
     * @throws \Exception
     */
    protected function throwInvalidValueException($value)
    {
        throw new \Exception(sprintf('Attribute value (%f) is invalid', $value));
    }

}