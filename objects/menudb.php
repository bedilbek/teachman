<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/7/17
 * Time: 3:32 PM
 */
class MenuDB extends ObjectDB
{
    protected static $table = "menu";

    public function __construct()
    {
        parent::__construct(self::$table);
        $this->add("title","ValidateName");
        $this->add("type","ValidateUserType");
        $this->add("link","ValidateURL");
        $this->add("external","ValidateBoolean");
        $this->add("img", "ValidateIMG");
        $this->add("color","ValidateName");
        $this->add("parent","ValidateBoolean");
        $this->add("creation","ValidateName");
    }

   public static function getMenu(){
        return ObjectDB::getAllOnField(self::$table, __CLASS__,null, null,true);
   }

   public static function getAllOnType($type)
   {
       return parent::getAllOnField(self::$table, __CLASS__, "type", $type, true);
   }

    private static function getBaseSelect() {
        $select = new Select();
        $select->from(self::$table,"*");
        return $select;
    }

    public static function getAllOnTypesAndChildren($type, $parent) {
        $select = self::getBaseSelect();
        $select->where("`type` = ".self::$db->getSQ(), array($type))
            ->where("`parent` = ".self::$db->getSQ(), array($parent));
        $select->order("title",false);
        $data = self::$db->select($select);
        $menu = ObjectDB::buildMultiple(__CLASS__,$data);
        return $menu;
    }

}
?>