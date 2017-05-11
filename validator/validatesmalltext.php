<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:55 PM
 */
class ValidateSmallText extends Validator
{
    const MAX_LEN = 500;
    const CODE_EMPTY = "ERROR_TEXT_SMALL_EMPTY";
    const CODE_MAX_LEN = "ERROR_TEXT_SMALL_MAX_LEN ";

    protected function validate()
    {
        $data = $this->data;
        if (strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
        elseif (strlen($data) > self::MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);

    }
}