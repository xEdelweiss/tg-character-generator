<?php

use TG;

$rules = new Rules\Fuzion(); // extends Rules\Generic

// сеттинг

$setting = $rules->isGeneric() ? new Setting\Cyberpunk() : $rules->getSetting(); // extends Setting\Generic

// ограничения персонажей

$restrictions = new Setting\Generic\Restrictions\Character(); // npc?
$restrictions
    ->maxHeight(300)
    ->gender('male')
    ->maxLimbCount(6);

// или так

$restrictions = $setting->getRestrictions(); // Setting\Cyberpunk\Restrictions

// генерируем лист персонажа

$characterGenerator = new Generator\Character();
$character = $characterGenerator->generate($restrictions);

// генерируем текстовое описание

$descriptionGenerator = new Generator\CharacterDescription();
$description = $descriptionGenerator->generate($setting);

/**
 * - генератор описания (сеттинг) должен знать обо всех возможных характеристиках? это связывает сеттинг с правилами
 */