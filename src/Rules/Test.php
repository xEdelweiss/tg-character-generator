<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.2015
 * Time: 15:28
 */

namespace TG\Rules;


use TG\Attribute\Exact;
use TG\Attribute\Range;
use TG\AttributeSet;

class Test extends Generic
{
    public function getCharacterAttributeSet(){
        $set = new AttributeSet();

        (new Range('int', 1, 10))->setAttributeSet($set);

        $set->addAttribute(new Range('int', 1, 10));
        $set->addAttribute(new Range('ref', 1, 10));

        $set->addAttribute(new Auto('luck'))
            ->listen('int', 'ref')
            ->run(function($int, $ref) {
                $this->setValue($int + $ref);
            });
    }
}