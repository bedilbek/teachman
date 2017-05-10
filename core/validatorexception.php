<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:20 AM
 */
class ValidatorException  extends Exception
{
    private $errors;

    public function __construct($errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    public function getErrors(){
        return $this->errors;
    }

}
?>