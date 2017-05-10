<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 11:14 AM
 */
class ValidateID extends Validator
{
    protected function validate()
    {
        $data = $this->data;
        if (!is_null($data) && ((!is_int($data)) || ($data < 0) )) $this->setErrors(self::CODE_UNKNOWN);
    }

}