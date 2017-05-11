<?php
/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/11/17
 * Time: 9:05 PM
 */

mb_internal_encoding("UTF-8");

set_include_path(get_include_path().PATH_SEPARATOR."../core".PATH_SEPARATOR."../lib".PATH_SEPARATOR."../objects".PATH_SEPARATOR."../validator".PATH_SEPARATOR."../controllers");
spl_autoload_extensions(".php");
spl_autoload_register();

    AbstractObjectDB::setDB(DataBase::getDBO());
    $req = new Request();
    if (!session_id()) session_start();
    $_SESSION["hel"] = $req;
    $formProcessor = new FormProcessor($req);
    $message_error = new Message(Config::FILE_MESSAGES);

    if ($_POST["week_number"]) addLesson($formProcessor, $message_error);
    if ($_POST["course_id"]) deleteCourse($_POST["course_id"]);
    if ($_POST["category_id"]) deleteCategory($_POST["category_id"]);

    function addLesson($formProcessor, $message_error) {

        $fields = array("title", "content", "week_number", "lesson_n","syllabus_id");
        $lesson = new LessonDB();
        $lesson = $formProcessor->process("register", $lesson, $fields);
        if ($lesson instanceof LessonDB) {

        }
        else $message_error = $message_error->get($_SESSION["message"]["register"]);



}



?>