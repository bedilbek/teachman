<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/5/17
 * Time: 8:40 PM
 */
class URL
{
    public static function get($action, $controller="", $data  = array(), $amp = true, $address = ""){
        if ($amp) $amp = "&amp;";
        else $amp = "&";
        if ($controller) $uri = "/$controller/$action";
        else $uri = "/$action";

        if (count($data) != 0) {
            $uri .="?";
            foreach ($data as $key => $value) {
                $uri .= "$key=$value".$amp;
            }
            $uri = substr($uri, 0, -strlen($amp));
        }
        return self::getAbsolute($address, $uri);
    }

    public static function getAbsolute($address, $uri) {
        return $address.$uri;
    }

    public static function current($address = "", $amp = false) {
        $url = self::getAbsolute($address, $_SERVER["REQUEST_URI"]);
        if ($amp) $url =str_replace("&", "&amp;", $url);
        return $url;
    }

    public static function getControllerAndAction() {
        $uri = $_SERVER["REQUEST_URI"];
        list($url_part, $qs_part) = array_pad(explode("?",$uri), 2, "");
        parse_str($qs_part,$qs_vars);
        $controller_name = "Main";
        $action_name = "index";
        if (($pos = strpos($uri, "?")) !== false) $uri = substr($uri, 0, strpos($uri,"?"));
        $routes = explode("/",$uri);
        if (!empty($routes[2])) {
            if (!empty($routes[1])) $controller_name = $routes[1];
            $action_name = $routes[2];
        }
        elseif (!empty($routes[1])) $action_name = $routes[1];
        return array($controller_name, $action_name);
    }

    public static function deletePage($url, $amp = true) {
        return self::deleteGET($url, "page", $amp);
    }

    public static function addTemplatePage($url, $amp =true){
        return self::addGET($url, "page", "", $amp);
    }

    public static function addGET($url, $name, $value, $amp=true) {
        if (strpos($url, "?") === false) $url = $url."?".$name."=".$value;
        else {
            if ($amp) $amp = "&amp;";
            else $amp = "&";
            $url = $url.$amp.$name."=".$value;
        }
        return $url;
    }

    public static function delegeGET($url,$name, $amp=true) {
        $url = str_replace("&amp;", "&", $url);
        list($url_part, $qs_part) = array_pad(explode("?",$url), 2, "");
        parse_str($qs_part, $qs_vars);
        unset($qs_vars[$name]);
        if (count($qs_vars) != 0) {
            $url = $url_part."?".http_build_query($qs_vars);
            if ($amp) $url = str_replace("&", "&amp;", $url);
        }
        else $url = $url_part;
        return $url;
    }

    public static function addID($url, $id) {
        return $url."#".$id;
    }


}
?>