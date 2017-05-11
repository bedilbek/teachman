<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/8/17
 * Time: 12:00 AM
 */
class ValidateUserType extends Validator {

    const MAX_LEN = 1;
    const CODE_EMPTY = "ERROR_TYPE_EMPTY";
    const CODE_INVALID = "ERROR_TYPE_INVALID";
    const CODE_MAX_LEN = "ERROR_TYPE_MAX_LEN";

    protected function validate() {
        $data = $this->data;
        if (strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
        else {
            if (strlen($data) > self::MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);
            else {
                $pattern = "/^[ae]$/i";
                if (!preg_match($pattern, $data)) $this->setErrors(self::CODE_INVALID);
            }
        }
    }

}