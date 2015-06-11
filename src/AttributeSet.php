<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 11.06.2015
 * Time: 21:03
 */

namespace TG;


use TG\Attribute\Generic as GenericAttribute;

class AttributeSet {

    /**
     * @var GenericAttribute[]
     */
    protected $attributes;
    protected $listenersByDependencies = [];

    public function addAttribute(GenericAttribute $attribute)
    {
        $attribute->setAttributeSet($this);

        $listenerName = $attribute->getName();
        $this->attributes[$listenerName] = $attribute;

        if ($attribute->haveDependencies()) {
            foreach ($attribute->getDependencies() as $dependencyName) {
                $this->registerListener($listenerName, $dependencyName);
            }
        }
    }

    public function attributeChanged(GenericAttribute $attribute)
    {
        $dependencyName = $attribute->getName();

        $this->fireListeners($dependencyName);
    }

    public function dumpAttributes()
    {
        $result = [];

        foreach ($this->attributes as $name => $attribute) {
            $result[$name] = $attribute->getValue();
        }

        return $result;
    }

    protected function fireListeners($dependencyName)
    {
        foreach ($this->getListeners($dependencyName) as $listener) {
            /** @var GenericAttribute $listener */
            $dependenciesValues = $this->getDependenciesValues($listener->getDependencies());
            $listener->dependenciesChanged($dependenciesValues);
        }
    }

    protected function getDependenciesValues($dependencies)
    {
        $result = [];

        foreach ($dependencies as $dependencyName) {
            $result[] = $this->getAttribute($dependencyName)->getValue();
        }

        return $result;
    }

    /**
     * @param $attributeName
     * @return GenericAttribute
     */
    public function getAttribute($attributeName)
    {
        return $this->attributes[$attributeName];
    }

    /**
     * @param $dependencyName
     * @return \Generator
     */
    protected function getListeners($dependencyName)
    {
        $this->ensureDependencyRegistered($dependencyName);

        foreach ($this->listenersByDependencies[$dependencyName] as $listenerName) {
            yield $this->attributes[$listenerName];
        }
    }

    protected function registerListener($listenerName, $dependencyName)
    {
        $this->ensureDependencyRegistered($dependencyName);

        if (!$this->isListenerRegistered($listenerName, $dependencyName)) {
            $this->listenersByDependencies[$dependencyName][] = $listenerName;
        }
    }

    protected function ensureDependencyRegistered($dependencyName)
    {
        if (!isset($this->listenersByDependencies[$dependencyName])) {
            $this->listenersByDependencies[$dependencyName] = [];
        }
    }

    protected function isListenerRegistered($listenerName, $dependencyName)
    {
        return in_array($listenerName, $this->listenersByDependencies[$dependencyName]);
    }
}