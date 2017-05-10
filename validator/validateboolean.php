<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 10:44 AM
 */
class ValidateBoolean extends Validator
{
    protected function validate()
    {
        $data = $this->data;
        if (($data != 0) && ($data != 1)) $this->setErrors(self::CODE_UNKNOWN);
    }



}