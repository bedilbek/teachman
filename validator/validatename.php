<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:31 PM
 */
class ValidateName extends Validator
{
    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_NAME_EMPTY";
    const CODE_INVALID = "ERROR_NAME_INVALID";
    const CODE_MAX_LEN = "ERROR_NAME_MAX_LEN";

    protected function validate()
    {
        $data = $this->data;

        if (strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
        else {
            if (strlen($data)> self::MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);
            elseif ($this->isContainQuotes($data)) $this->setErrors(self::CODE_INVALID);
        }

    }

}