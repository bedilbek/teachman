<?php
/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/8/17
 * Time: 10:06 PM
 */
    mb_internal_encoding("UTF-8");

    set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."lib".PATH_SEPARATOR."objects".PATH_SEPARATOR."modules".PATH_SEPARATOR."validator".PATH_SEPARATOR."controllers");
    spl_autoload_extensions(".php");
    spl_autoload_register();

    AbstractObjectDB::setDB(DataBase::getDBO());

?>