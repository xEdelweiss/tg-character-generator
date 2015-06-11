<?php
use TG\Attribute\Auto;
use TG\Attribute\Generic;
use TG\AttributeSet;

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 11.06.2015
 * Time: 21:18
 */

class AttributeSetTest extends PHPUnit_Framework_TestCase {

    public function testEventManagement()
    {
        $set = new AttributeSet();

        $set->addAttribute(Generic::create('int'));
        $set->addAttribute(Generic::create('ref'));
        $set->addAttribute(Auto::create('luck')->on('int', 'ref')->trigger(function($int, $ref) {
            $this->setValue($int + $ref);
        }));

        $set->getAttribute('int')->setValue(5);
        $set->getAttribute('ref')->setValue(3);

        $this->assertEquals(8, $set->getAttribute('luck')->getValue());

        $set->getAttribute('ref')->setValue(2);

        $this->assertEquals(7, $set->getAttribute('luck')->getValue());
    }
}
