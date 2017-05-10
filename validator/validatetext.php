<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:50 PM
 */
class ValidateText extends Validator
{
    const MAX_LEN = 5000;
    const CODE_EMPTY = "ERROR_TEXT_EMPTY";
    const CODE_MAX_LEN = "ERROR_TEXT_MAX_LEN ";

    protected function validate()
    {
        $data = $this->data;
        if (strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
        elseif (strlen($data) > self::MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);
    }

}