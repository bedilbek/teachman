<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 11:54 AM
 */
class ValidateLogin extends Validator
{
    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_LOGIN_EMPTY";
    const CODE_INVALID = "ERROR_LOGIN_INVALID";
    const CODE_MAX_LEN = "ERROR_LOGIN_MAX_LEN";

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