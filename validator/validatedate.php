<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 10:49 AM
 */
class ValidateDate extends Validator
{
    protected function validate()
    {
        $data = $this->data;
        if (!is_null($data) && strtotime($data) === false) $this->setErrors(self::CODE_UNKNOWN);
    }

}