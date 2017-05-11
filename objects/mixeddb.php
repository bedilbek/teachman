<?php

require_once dirname(__FILE__)."/../start.php";
/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/9/17
 * Time: 6:58 PM
 */
class  MixedDB {
    public function __construct()
    {

    }
        public static function getMixedObjects($user_id){
            $user = new UserDB();
            $user->load($user_id);

            $fields =  array();
            $userType = $user->type;

            $teachers = UserDB::getAllOnTeacher("E");
            $numberOfTeachers = UserDB::getCountOnTeachers("E");

            $linkOfTeachers = UserDB::getLink($user->getID());
            if ($user->isAdmin()) $fields[] = (object) array("count"=>$numberOfTeachers, "link"=>$linkOfTeachers, "name"=>"Teachers", "img"=>"user", "color"=>"brown");

            $categories = CategoryDB::getAllOnUserID($user->getID());
            //print_r($categories);
            $numberOfCategories = CategoryDB::getCountOnUserID($user->getID());
            $linkOfCategories = CategoryDB::getLink($user->getID());
            $fields[] = (object) array("count"=>$numberOfCategories, "link"=>$linkOfCategories, "name"=>"Categories", "img"=>"list-alt", "color"=>"red");

            $courses = CourseDB::getAllOnUserID($user->getID());
            $linkOfCourses = CourseDB::getLink($user->getID());
            $numberOfCourses = CourseDB::getCountOnUserID($user->getID());
            $fields[] = (object) array("count"=>$numberOfCourses, "link"=>$linkOfCourses, "name"=>"Courses", "img" => "book", "color"=>"green");

            $syllabus = SyllabusDB::getAllOnUserID($user->getID());

            $numberOfSyllabus = SyllabusDB::getCountOnUserID($user->getID());
            $linkOfSyllabus = SyllabusDB::getLink($user->getID());
            $fields[] = (object) array("count"=>$numberOfSyllabus, "link"=>$linkOfSyllabus, "name"=>"Syllabus", "img"=>"th-list", "color"=>"blue");

            if (!$user->isAdmin())
                $fields[] = (object) array("count"=>$numberOfSyllabus, "link"=>"quizzes.php", "name"=>"Quizzes", "img"=>"edit", "color"=>"brown");
            return $fields;
        }

}

?>