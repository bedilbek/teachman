<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 9:59 AM
 */
class ObjectDB extends AbstractObjectDB {

    public function __construct($table_name)
    {
        parent::__construct($table_name, Config::FORMAT_DATE);

    }

    public function preEdit($field, $value) {
        return true;
    }

    public function postEdit($field, $value) {
        return true;
    }

}