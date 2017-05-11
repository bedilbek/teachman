<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/7/17
 * Time: 11:59 PM
 */
class ValidateEmail extends Validator {

    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_EMAIL_EMPTY";
    const CODE_INVALID = "ERROR_EMAIL_INVALID";
    const CODE_MAX_LEN = "ERROR_EMAIL_MAX_LEN";

    protected function validate() {
        $data = $this->data;
        if (mb_strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
        else {
            if (mb_strlen($data) > self::MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);
            else {
                $pattern = "/^[a-z0-9_][a-z0-9\._-]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+$/i";
                if (!preg_match($pattern, $data)) $this->setErrors(self::CODE_INVALID);
            }
        }
        if (!session_id()) session_start();
        $_SESSION["EMAIL"]="1";
    }

}