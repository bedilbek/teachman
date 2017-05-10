<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 11:45 AM
 */
class ValidateIP extends Validator
{
    protected function validate()
    {
        $data = $this->data;
        if ($data == 0) return;
        if (!preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/",$data)) $this->setErrors(self::CODE_UNKNOWN);
    }

}