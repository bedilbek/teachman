<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/10/17
 * Time: 11:24 PM
 */
class ValidatePhone extends Validator
{
    protected function validate()
{
    $data = $this->data;
    if (strlen($data)<9 || strlen($data)>13) $this->setErrors(self::CODE_UNKNOWN);
}

}

?>