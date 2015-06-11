<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.2015
 * Time: 16:29
 */

namespace TG\Attribute;

use TG\AttributeSet;

class Generic
{
    protected $name;
    protected $value;
    protected $attributeSet;
    protected $dependencies;
    protected $callback;

    protected $validationEnabled = true;

    /**
     * @param $name
     * @param $value
     * @return static
     */
    public static function create($name, $value = null)
    {
        $attribute = new static;
        $attribute->setName($name);

        if (!is_null($value)) {
            $attribute->setValue($value);
        }

        return $attribute;
    }

    /**
     * @return bool
     */
    public function isInitialized()
    {
        return !is_null($this->value);
    }

    /**
     * @return bool
     */
    public function haveDependencies()
    {
        return !empty($this->getDependencies());
    }

    /**
     * @param ...$dependencies
     * @return $this
     */
    public function on(...$dependencies)
    {
        $this->setDependencies($dependencies);

        return $this;
    }

    /**
     * @param $callback
     * @return $this
     */
    public function trigger($callback)
    {
        $this->setCallback($callback);

        return $this;
    }

    public function dependenciesChanged(...$dependencies)
    {
        $validationStatus = $this->validationEnabled;
        $this->validationEnabled = false;

        call_user_func_array($this->getCallback(), $dependencies[0]);

        $this->validationEnabled = $validationStatus;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param mixed $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback->bindTo($this);
    }

    /**
     * @return mixed
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param mixed $dependencies
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * @param AttributeSet $attributeSet
     */
    public function setAttributeSet(AttributeSet $attributeSet)
    {
        $this->attributeSet = $attributeSet;
    }

    /**
     * @return AttributeSet
     */
    public function getAttributeSet()
    {
        return $this->attributeSet;
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
        if ($this->validationEnabled && !$this->isValueValid($value)) {
            $this->throwInvalidValueException($value);
        }

        $this->value = $value;

        if ($this->isInitialized() && $this->getAttributeSet()) {
            $this->getAttributeSet()->attributeChanged($this);
        }
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