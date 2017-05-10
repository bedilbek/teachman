<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/7/17
 * Time: 6:14 AM
 */
class CategoryDB extends ObjectDB
{
    protected static $table = "category";

    public function __construct()
    {
        parent::__construct(self::$table);
        $this->add("user_id","ValidateID");
        $this->add("category_name","ValidateName");
        $this->add("category_short_name","ValidateName");
        $this->add("category_description","ValidateText");
    }

    protected function postInit()
    {
        $this->link = URL::get("project/categories.php","",array("id"=>$this->getID()));
        $user = new UserDB();
        $user->load($this->user_id);
        $this->user = $user;
        return true;
    }

    private static function getBaseSelect() {
        $select = new Select(self::$db);
        $select->from(self::$table,"*");
        return $select;
    }

    public static function getAllShow($count = false, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false);
        if ($count) $select->limit($count,$offset);
        $data = self::$db->select($select);
        $categories = ObjectDB::buildMultiple(__CLASS__,$data);
        return $categories;
    }

    public static function getAllOnUserID($user_id)
    {
        $user = new UserDB();
        $user->load($user_id);
        $select = self::getBaseSelect();
        $select->where("`user_id` = ".self::$db->getSQ(), array($user_id));
        $row = self::$db->select($select);
        if ($user->isAdmin()) return CategoryDB::getAllShow();
        else return self::buildMultiple(__CLASS__,$row);
    }

    public static function getLink($user_id) {
        return URL::get("project/categories.php","",array("user_id"=>$user_id));
    }
    public static function getCountOnUserID($user_id)
    {
        $user = new UserDB();
        $user->load($user_id);
        $select = new Select();
        $select->from(self::$table, array("COUNT(id)"))
            ->where("`user_id` = ".self::$db->getSQ(), array($user_id));
        if ($user->type == "A" || $user->type == "a") return CategoryDB::getCount();
        else return self::$db->selectCell($select);
    }

    public static function getAllOnPage($count, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false)
            ->limit($count, $offset);
        $data = self::$db->select($select);
        $categories = ObjectDB::buildMultiple(__CLASS__,$data);
        return $categories;
    }

}
?>