<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/8/17
 * Time: 1:03 AM
 */
class MessageDB extends ObjectDB
{
    protected static $table = "message";

    public function __construct()
    {
        parent::__construct(self::$table);
        $this->add("user_id","ValidateID");
        $this->add("content","ValidateText");
        $this->add("timestamp","ValidateDate");
    }

    protected function postInit()
    {
        $user = new UserDB();
        $user->load("user_id");
        $this->user = $user;
        return true;
    }


    private static function getBaseSelect() {
        $select = new Select();
        $select->from(self::$table,"*");
        return $select;
    }

    public static function getAllShow($count = false, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("timestamp",false);
        if ($count) $select->limit($count,$offset);
        $data = self::$db->select($select);
        $messages = ObjectDB::buildMultiple(__CLASS__,$data);
        return $messages;
    }

}

?>