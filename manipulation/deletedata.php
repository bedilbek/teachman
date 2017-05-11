<?php
/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/11/17
 * Time: 4:49 PM
 */
mb_internal_encoding("UTF-8");

set_include_path(get_include_path().PATH_SEPARATOR."../core".PATH_SEPARATOR."../lib".PATH_SEPARATOR."../objects".PATH_SEPARATOR."../validator".PATH_SEPARATOR."../controllers");
spl_autoload_extensions(".php");
spl_autoload_register();
AbstractObjectDB::setDB(DataBase::getDBO());


if ($_POST["user_id"]) deleteUser($_POST["user_id"]);
if ($_POST["course_id"]) deleteCourse($_POST["course_id"]);
if ($_POST["category_id"]) deleteCategory($_POST["category_id"]);


function deleteUser($user_id){

    if (!session_id()) session_start();
    $user = new UserDB();
    $user->load($user_id);
    $messages = MessageDB::getAllOnUserID($user_id);
    if (!is_null($messages))
        foreach ($messages as $message)
            $message->delete();

    if ($user->delete()) {
        if (!session_id()) session_start();
        $_SESSION["user_deleted"] = "user_not_deleted".$user_id;
    }
    else {
        if (!session_id()) session_start();
        $_SESSION["user_not_deleted"] = "user_delted".$user_id;
    }
}
function deleteCategory($category_id){
    if (!session_id()) session_start();
    $_SESSION["cat"] = "cat";
    $category = new CategoryDB();
    $category->load($category_id);
    $courses = CourseDB::getAllOnCategoryID($category_id);
    foreach ($courses as $course) {
        $syllabus = new SyllabusDB();
        $syllabus->loadOnCourseID($course->getID());
        $lessons = LessonDB::getAllOnSyllabusID($syllabus->getID());
        if (!is_null($lessons))
            foreach ($lessons as $lesson)
                $lesson->delete();

        if ($syllabus instanceof SyllabusDB)
            $syllabus->delete();

        if ($course instanceof CourseDB)
            $course->delete();
    }
        if ($category->delete()) $_SESSION["category_deleted"] = "category_deleted".$category_id;
        else $_SESSION["category_not_deleted"] = "Something went wrong-category_not_deleted".$category_id;



}
function deleteCourse($course_id){
    if (!session_id()) session_start();
    $course = new CourseDB();
    $course->load($course_id);
    $syllabus = new SyllabusDB();
    $syllabus->loadOnCourseID($course_id);
    $lessons = LessonDB::getAllOnSyllabusID($syllabus->getID());
    if (!is_null($lessons)){
        foreach ($lessons as $lesson){
            $lesson->delete();
        }
    }
    if ($syllabus instanceof SyllabusDB){
        $syllabus->delete();
    }
    if ($course instanceof CourseDB){
        $course->delete();
        if (!session_id()) session_start();
        $_SESSION["course_deleted"] = "course_deleted".$course_id;
    }
    else{
        if (!session_id()) session_start();
        $_SESSION["course_not_deleted"] = "Something went wrong-course_not_deleted".$course_id;
    }

}



?>