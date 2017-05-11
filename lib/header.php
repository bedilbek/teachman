<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/11/17
 * Time: 8:11 AM
 */
class Header
{
    private static $title;
    private static $favicon;
    public function __construct($title, $favicon = null)
    {
        self::$title = $title;
        self::$favicon = $favicon;
    }

    public static function getTitle(){
        return "<title>".self::$title."</title>";
    }
    public static function getFavicon(){
        if (self::$favicon){
            return "<link href=\"".self::$favicon."\" rel=\"shortcut icon\" type=\"image/x-icon\" />";
        }
    }

    public static function getMeta($name = null, $content = null, $http_equiv = null){
        if (!$content) return "<meta charset=\"$name\"/>";
        elseif ($http_equiv) {$ret1 ="http_equiv"; $ret2 = $http_equiv;}  else {$ret1 ="name"; $ret2 = $name;}
        return "<meta $ret1=\"$ret2\" content=\"$content\" />";
    }

    public static function getLink($href){
        return "<link type=\"text/css\" rel=\"stylesheet\" href=\"$href\" />";
    }

    public static function getScript($href){
        return "<script type=\"text/javascript\" src=\"$href\"></script>";
    }
}