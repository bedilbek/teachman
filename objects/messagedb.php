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
        $user->load($this->user_id);
        $this->user = $user;
        $current = time();
        $newtime = (int)$current - (int)strtotime($this->timestamp);
        $newtime = self::seconds_to_time($newtime);
        if ((int)$newtime->minutes == 0) $lastseen = $newtime->seconds.self::getSecond($newtime->seconds)." ago";
        elseif ((int)$newtime->hours == 0) $lastseen = $newtime->minutes.self::getMinute($newtime->minutes)." ago";
        elseif ( (int) $newtime->days == 0) $lastseen = $newtime->hours.self::getHour($newtime->hours)." ago";
        else $lastseen = $this->timestamp;
        $this->lastseen = $lastseen;
        return true;
    }
        protected function preValidate(){
            $now = new DateTime();
            $this->timestamp = $now->format('Y-m-d H:i:s');
            return true;
        }
    public static function getHour($time){
        if ($time>1) return " hours";
        else return " hour";
    }
    public static function getMinute($time){
        if ($time>1) return " minutes";
        else return " minute";
    }
    public static function getSecond($time){
        if ($time>1) return " seconds";
        else return " second";
    }
    private static function getBaseSelect() {
        $select = new Select();
        $select->from(self::$table,"*");
        return $select;
    }

    public static function getAllShow($count = false, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",true);
        if ($count) $select->limit($count,$offset);
        $data = self::$db->select($select);
        $messages = ObjectDB::buildMultiple(__CLASS__,$data);
        return $messages;
    }
    public static function seconds_to_time($secs)
    {
        $dt = new DateTime('@' . $secs, new DateTimeZone('UTC'));
        return (object) array('days'    => $dt->format('z'),
            'hours'   => $dt->format('G'),
            'minutes' => $dt->format('i'),
            'seconds' => $dt->format('s'));
    }

}

?>