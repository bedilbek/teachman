<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:14 AM
 */
abstract class Validator
{
    const CODE_UNKNOWN = "UNKNOWN_ERROR";

    protected $data;
    private $errors = array();

    public function __construct($data)
    {
         $this->data = $data;
         $this->validate();
    }

    abstract protected function validate();

    public function getErrors(){
        return $this->errors;
    }

    public function isValid(){
        return count($this->errors) == 0;
    }
    protected function setErrors($code) {
        $this->errors[] = $code;
    }

    protected function isContainQuotes($string){
        $array = array("\"", "`", "''", "&quot;", "&apos;");
        foreach ($array as $key => $value) {
            if (strpos($string, $value) !== false) return true;
        }
        return false;
    }
}
?>