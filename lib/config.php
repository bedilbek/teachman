<?php
/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/4/17
 * Time: 2:02 AM
 */

    abstract class Config {

        const SITENAME = "localhost/project";
        const SECRET = "";
        const ADDRESS = "http://localhost/project";
        const ADM_NAME =  "Bedilbek Khamidov";
        const ADM_EMAIL = "bedilbek@gmail.com";


        const DB_HOST = "localhost";
        const DB_USER = "root";
        const DB_PASSWORD = "mayboqcha5_25";
        const DB_NAME = "iproject";
        const DB_SYM_QUERY = "?";
        const DB_PREFIX = "";

        const DIR_IMG = "/images/";
        const DIR_IMG_AVATAR = "/project/images/avatar/";
        const DIR_TEMPLATES = "/var/www/html/project/templates";
        const DIR_EMAILS = "/var/www/html/project/templates/emails";

        const FILE_MESSAGES = "/var/www/html/project/text/messages.ini";

        const COUNT_ARTICLES_ON_PAGE = 3;
        const COUNT_SHOW_PAGES = 10;

        const MIN_SEARCH_LEN = 3;
        const LEN_SEARCH_RES = 255;

        const DEFAULT_AVATAR = "default.png";
        const MAX_SIZE_AVATAR = 2048000;

        const FORMAT_DATE = "%Y-%m-%d";
    }
?>