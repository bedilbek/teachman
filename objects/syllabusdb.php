<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/7/17
 * Time: 6:31 AM
 */
class SyllabusDB extends ObjectDB
{
    protected static $table = "syllabus";

    public function __construct()
    {
        parent::__construct(self::$table);
        $this->add("course_id","ValidateID");
        $this->add("course_objectives","ValidateText");
        $this->add("textbooks","ValidateText");
        $this->add("class_structure","ValidateText");
    }

    protected function postInit()
    {
        $this->link = URL::get("project/syllabus.php","",array("id"=>$this->getID()));
        $course = new CourseDB();
        $course->load($this->course_id);
        $this->course = $course;
        return true;
    }

    private static function getBaseSelect() {
        $select = new Select();
        $select->from(self::$table,"*");
        return $select;
    }

    public static function getAllOnUserID($user_id)
    {
        $syllabuses = self::getAllShow();
        $user = new UserDB();
        $user->load($user_id);
        $syllabusesOfUser = array();
        foreach ($syllabuses as $syllabus) {
            if ($syllabus->course->category->user_id == $user_id) {
                $syllabusesOfUser[] = $syllabus;
            }
        }
        if ($user->type == "A" || $user->type == "a") return $syllabuses;
        else {
            if (!empty($syllabusesOfUser)) return $syllabusesOfUser;
            else return null;
        }
    }

    public static function getLink($user_id) {
        return URL::get("project/syllabus.php","",array("user_id"=>$user_id));
    }

    public static function getCountOnUserID($user_id)
    {
        $user = new UserDB();
        $user->load($user_id);
        $numberOfSyllabusOfUser = 0;
        $syllabuses = self::getAllShow();
        foreach ($syllabuses as $syllabus) {
            if ($syllabus->course->category->user_id == $user_id) {
                $numberOfSyllabusOfUser++;
            }
        }
        if ($user->type == "A" || $user->type == "a") return SyllabusDB::getCount();
        else return $numberOfSyllabusOfUser;
    }

    public static function getAllShow($count = false, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false);
        if ($count) $select->limit($count,$offset);
        $data = self::$db->select($select);
        $syllabus = ObjectDB::buildMultiple(__CLASS__,$data);
        return $syllabus;
    }


    public static function getAllOnPage($count, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false)
            ->limit($count, $offset);
        $data = self::$db->select($select);
        $syllabus = ObjectDB::buildMultiple(__CLASS__,$data);
        return $syllabus;
    }
}
?>