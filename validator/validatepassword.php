<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:37 PM
 */
class ValidatePassword extends Validator
{
    const MIN_LEN = 6;
    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_PASSWORD_EMPTY";
    const CODE_CONTENT = "ERROR_PASSWORD_CONTENT";
    const CODE_MIN_LEN = "ERROR_PASSWORD_MIN_LEN";
    const CODE_MAX_LEN = "ERROR_PASSWORD_MAX_LEN ";

    protected function validate()
    {
       $data = $this->data;
       if (strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
       elseif (strlen($data) > self::MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);
       elseif (strlen($data) < self::MIN_LEN) $this->setErrors(self::CODE_MIN_LEN);
       elseif (!preg_match("/^[a-z0-9_]+$/i",$data)) $this->setErrors(self::CODE_CONTENT);
    }


}