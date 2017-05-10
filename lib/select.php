<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 9:54 AM
 */
class Select extends AbstractSelect
{
    public function __construct()
    {
        parent::__construct(DataBase::getDBO());
    }
}
