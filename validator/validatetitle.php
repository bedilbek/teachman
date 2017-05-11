<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/7/17
 * Time: 11:58 PM
 */
class ValidateTitle extends Validator {

    const MAX_LEN = 100;
    const CODE_EMPTY = "ERROR_TITLE_EMPTY";
    const CODE_MAX_LEN = "ERROR_TITLE_MAX_LEN";

    protected function validate() {
        $data = $this->data;
        if (mb_strlen($data) == 0) $this->setErrors(self::CODE_EMPTY);
        elseif (mb_strlen($data) > self::MAX_LEN) $this->setErrors(self::CODE_MAX_LEN);
        //if (!session_id()) session_start();
        //$_SESSION["title"]="1";
    }

}

?>