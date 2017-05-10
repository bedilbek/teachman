<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 1:09 PM
 */
class ValidateURL extends Validator
{
    const MAX_LEN = 255;
    protected function validate()
    {
        $data = $this->data;
        if (strlen($data)>self::MAX_LEN) $this->setErrors(self::CODE_UNKNOWN);
        else {
            $pattern_1 = "~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
                "(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
                "org|mil|edu|arpa|gov|biz|info|uz|ru|aero|inc|name|local|[a-z]{2})|(?!0)(?:(?".
                "!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
                "?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i";
            $pattern_2 = "~^(?:/[a-z0-9.,_@%&?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i";

            if (!preg_match($pattern_1, $data) && !preg_match($pattern_2, $data)) $this->setErrors(self::CODE_UNKNOWN);
        }
    }
}