<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 10:19 AM
 */
abstract class Module extends AbstractModule
{
    public function __construct()
    {
        parent::__construct(new View(Config::DIR_TEMPLATES));
    }
}