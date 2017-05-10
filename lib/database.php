<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 9:45 AM
 */


class DataBase extends AbstractDataBase
{
    private static $db;

    public static function getDBO(){
        if (self::$db == null) self::$db = new DataBase(Config::DB_HOST,
            Config::DB_USER, Config::DB_PASSWORD,Config::DB_NAME,
            Config::DB_SYM_QUERY, Config::DB_PREFIX);
        return self::$db;
    }
}