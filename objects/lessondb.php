<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/7/17
 * Time: 11:54 PM
 */
class LessonDB extends ObjectDB
{
    protected static $table = "lessons";

    public function __construct()
    {
        parent::__construct(self::$table);
        $this->add("syllabus_id","ValidateID");
        $this->add("title","ValidateTitle");
        $this->add("content","ValidateText");
        $this->add("file","ValidateURI");
    }

    protected function postInit()
    {
        $syllabus = new SyllabusDB();
        $syllabus->load("syllabus_id");
        $this->syllabus = $syllabus;
        return true;
    }

    public static function getAllOnSyllabusID($syllabus_id){
        $select = self::getBaseSelect();
        $select->where("`syllabus_id` = ".self::$db->getSQ(), array($syllabus_id));
            $row = self::$db->select($select);
            return self::buildMultiple(__CLASS__,$row);
    }

    public static function getCountOnSyllabusID($syllabus_id)
    {
        $select = new Select();
        $select->from(self::$table, array("COUNT(id)"))
            ->where("`syllabus_id` = ".self::$db->getSQ(), array($syllabus_id));
        return self::$db->selectCell($select);
    }

    public static function getAllOnUserID($user_id)
    {
        $user = new UserDB();
        $user->load($user_id);
        $lessonsOfUser = array();
        $lessons = self::getAllShow();
        foreach ($lessons as $lesson) {
            if ($lesson->syllabus->course->category->user_id == $user_id) {
                $lessonsOfUser[] = $lesson;
            }
        }
        if ($user->type == "A" || $user->type == "a") return $lessons;
        else {
            if (!empty($lessonsOfUser)) return $lessonsOfUser;
            else return null;
        }
    }
    public static function getCountOnUserID($user_id)
    {
        $user = new UserDB();
        $user->load($user_id);
        $numberOfLessonsOfUser = 0;
        $lessons = self::getAllShow();
        foreach ($lessons as $lesson)
            if ($lesson->syllabus->course->category->user_id == $user_id)
                $numberOfLessonsOfUser++;
        if ($user->type == "A" || $user->type == "a") return self::getCount();
        return $numberOfLessonsOfUser;
    }

    public static function getAllOnCourseID($course_id)
    {
        $lessonsInCourse = array();
        $lessons = self::getAllShow();
        foreach ($lessons as $lesson) {
            if ($lesson->syllabus->course->id == $course_id) {
                $lessonsInCourse[] = $lesson;
            }
        }
        if (!empty($lessonsInCourse)) return $lessonsInCourse;
        else return null;
    }

    public static function getCountOnCourseID($course_id)
    {
        $numberOfLessonsInCourse = 0;
        $lessons = self::getAllShow();
        foreach ($lessons as $lesson)
            if ($lesson->syllabus->course->id == $course_id)
                $numberOfLessonsInCourse++;
        return $numberOfLessonsInCourse;
    }

    private static function getBaseSelect() {
        $select = new Select();
        $select->from(self::$table,"*");
        return $select;
    }

    public static function getAllShow($count = false, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false);
        if ($count) $select->limit($count,$offset);
        $data = self::$db->select($select);
        $lessons = ObjectDB::buildMultiple(__CLASS__,$data);
        return $lessons;
    }


    public static function getAllOnPage($count, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false)
            ->limit($count, $offset);
        $data = self::$db->select($select);
        $lessons = ObjectDB::buildMultiple(__CLASS__,$data);
        return $lessons;
    }
}

?>