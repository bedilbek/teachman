<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:12 PM
 */
class ValidateMD extends Validator
{
    const MAX_LEN = 255;
    const CODE_EMPTY = "ERROR_MD_EMPTY";
    const CODE_MAX_LEN = "ERROR_MD_MAX_LEN";

    protected function validate()
    {
        $data = $this->data;
        if (strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
        if (strlen($data)>self::CODE_MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);
    }

}