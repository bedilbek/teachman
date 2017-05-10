<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 11:30 AM
 */
class ValidateIMG extends Validator
{
    protected function validate()
    {
        $data = $this->data;
        if (!is_null($data) && !preg_match("/^[a-z0-9-_]+\.(jpg|jpeg|png|gif)$/i",$data)) $this->setErrors(self::CODE_UNKNOWN);
    }

}