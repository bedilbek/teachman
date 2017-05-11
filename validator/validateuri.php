<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 1:03 PM
 */
class ValidateURI extends Validator
{
    const MAX_LEN = 255;
    protected function validate()
    {
        $data = $this->data;
        if (strlen($data)>self::MAX_LEN) $this->setErrors(self::CODE_UNKNOWN);
        else {
            $pattern = "~^(?:/[a-z0-9.,_@%&?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i";
            if (!preg_match($pattern, $data)) $this->setErrors(self::CODE_UNKNOWN);
        }
        //if (!session_id()) session_start();
        //$_SESSION["uri"]="1";
    }

}