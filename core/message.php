<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 8:36 AM
 */
class Message
{
    private $data;

    public function __construct($file)
    {
        $this->data = parse_ini_file($file);
    }

    public function get($name) {
        return $this->data[$name];
    }
}