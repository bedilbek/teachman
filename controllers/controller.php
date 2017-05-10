<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/9/17
 * Time: 12:08 AM
 */
abstract class Controller extends AbstractController
{
    protected $title;
    protected $mail = null;
    protected $uri_active;
    protected $section_id = 0;

    public function __construct()
    {
        parent::__construct(new View(Config::DIR_TEMPLATES), new Message(Config::FILE_MESSAGES));
        $this->mail = new Mail;
        $this->url_active = URL::delegeGET(URL::current(Config::ADDRESS),"page");

    }

    public function action404(){
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        $this->title = "Page Not Found - 404";
        $this->meta_des = "Requested Page does not exist";
        $this->meta_key = "Page not Found, Page does not exist";

        $page = new PageMessage();
        $page->header = "Page not Found";
        $page->text = "This requested page does not exist, please check correctness of it";

        $this->render($page);
    }

    final protected function render($str){
        $params = array();
        $params["header"] =$this->getHeader();
        $params["auth"] = $this->getAuth();
        $params["menu"] = $this->getMenu();
        $params["dashboard"] = $this->getDashboard();
        $params["category_course"] = $this->getCategoryCourse();
        $this->view->render(Config::LAYOUT, $params);
    }

    protected function getHeader(){
        $header = new Header();
        $header->title = $this->title;
        $header->meta("Content-Type", "text/html; charset =utf-8", true);
        $header->meta("viewport","width=device-width, initial-scale=1",false);
        $header->meta(false,"IE=edge","X-UA-Compatible");
        $header->css = array("styles/custom.css", "styles/bootstrap/css/bootstrap.min.css", "styles/bootstrap/css/bootstrap-select.css",);
        $header->js = array("scripts/bootstrap/bootstrap.min.js", "scripts/bootstrap/jquery.js", "scripts/jquery.min.js", "scripts/jquery-1.10.2.js", "scripts/bootstrap/bootstrap.min.js", "scripts/custom.js");

    }

    protected function getAuth(){

    }

    protected function getMenu(){

    }

    protected function getDashboard(){

    }
    protected function getCategoryCourse(){

    }
}