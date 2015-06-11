<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.2015
 * Time: 15:27
 */

namespace TG\Generator;

use TG\Rules\Generic as GenericRules;

class Character extends Generic
{
    /**
     * @param GenericRules $rules
     * @return \TG\Character\Character
     */
    public function generate(GenericRules $rules)
    {
        $character = new \TG\Character\Character();

        return $character;
    }
}