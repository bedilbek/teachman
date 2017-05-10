<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/7/17
 * Time: 6:23 AM
 */
class CourseDB extends ObjectDB
{
    protected static $table = "course";

    public function __construct()
    {
        parent::__construct(self::$table);
        $this->add("category_id","ValidateID");
        $this->add("course_name","ValidateName");
        $this->add("course_shortname","ValidateName");
        $this->add("course_description","ValidateText");
    }

    protected function postInit()
    {
        $this->link = URL::get("project/courses.php","",array("id"=>$this->getID()));
        $category = new CategoryDB();
        $category->load($this->category_id);
        $this->category = $category;
        return true;
    }

    private static function getBaseSelect() {
        $select = new Select();
        $select->from(self::$table,"*");
        return $select;
    }
    public static function getLink($user_id) {
        return URL::get("project/courses.php","",array("user_id"=>$user_id));
    }
    public static function getAllOnCategoryID($category_id)
    {
        return self::getAllOnWhere(self::$table,__CLASS__,"category_id",$category_id);
    }

    public static function getCountOnCategoryID($category_id)
    {
        $select = new Select();
        $select->from(self::$table, array("COUNT(id)"))
            ->where("`category_id` = ".self::$db->getSQ(), array($category_id));
        return self::$db->selectCell($select);
    }

    public static function getAllOnUserID($user_id)
    {
        $courses = self::getAllShow();
        $user = new UserDB();
        $user->load($user_id);
        $coursesOfUser = array();
        foreach ($courses as $course) {
            if ($course->category->user_id == $user_id) {
                $coursesOfUser[] = $course;
            }
        }
        if ($user->type == "A" || $user->type == "a") return $courses;
        else {
            if (!empty($coursesOfUser)) return $coursesOfUser;
            else return null;
        }
    }

    public static function getCountOnUserID($user_id)
    {
        $user = new UserDB();
        $user->load($user_id);
        $numberOfCoursesOfUser = 0;
        $courses = self::getAllShow();
        foreach ($courses as $course) {
            if ($course->category->user_id == $user_id) {
                $numberOfCoursesOfUser++;
            }
        }
        if ($user->type == "A" || $user->type == "a") return self::getCount();
        else return $numberOfCoursesOfUser;
    }

    public static function getAllShow($count = false, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false);
        if ($count) $select->limit($count,$offset);
        $data = self::$db->select($select);
        $courses = ObjectDB::buildMultiple(__CLASS__,$data);
        return $courses;
    }

    public static function getAllOnPage($count, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false)
            ->limit($count, $offset);
        $data = self::$db->select($select);
        $courses = ObjectDB::buildMultiple(__CLASS__,$data);
        return $courses;
    }
}

?>