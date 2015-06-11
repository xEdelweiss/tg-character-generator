<?php

use TG;

$rules = new Rules\Fuzion(); // extends Rules\Generic

// �������

$setting = $rules->isGeneric() ? new Setting\Cyberpunk() : $rules->getSetting(); // extends Setting\Generic

// ����������� ����������

$restrictions = new Setting\Generic\Restrictions\Character(); // npc?
$restrictions
    ->maxHeight(300)
    ->gender('male')
    ->maxLimbCount(6);

// ��� ���

$restrictions = $setting->getRestrictions(); // Setting\Cyberpunk\Restrictions

// ���������� ���� ���������

$characterGenerator = new Generator\Character();
$character = $characterGenerator->generate($restrictions);

// ���������� ��������� ��������

$descriptionGenerator = new Generator\CharacterDescription();
$description = $descriptionGenerator->generate($setting);

/**
 * - ��������� �������� (�������) ������ ����� ��� ���� ��������� ���������������? ��� ��������� ������� � ���������
 */