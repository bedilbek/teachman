<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/11/17
 * Time: 9:48 PM
 */
class ValidateNumber extends Validator
{
    protected function validate()
    {
        $data = $this->data;
        if (strlen($data)<1) $this->setErrors(self::CODE_UNKNOWN);
    }}