<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 10:38 AM
 */
class ValidateActivation extends Validator
{
    const MAX_LEN = 100;

    protected function validate()
    {
        $data = $this->data;
        if (strlen($data) > self::MAX_LEN)  $this->setErrors(self::CODE_UNKNOWN);
    }

}