<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 12:24 AM
 */
class View
{
    private $dir_tmpl;

    public function __construct($dir_tmpl)
    {
        $this->dir_tmpl = $dir_tmpl;
    }

    public function render($file, $params, $return = false){
        $template  = $this->dir_tmpl.".tpl";
        extract($params);
        ob_start();
        include($template);
        if ($return) return ob_get_clean();
        else echo ob_get_clean();
    }
}

?>