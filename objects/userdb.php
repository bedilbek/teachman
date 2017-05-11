<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 1:17 PM
 */
class UserDB extends ObjectDB
{
    protected static $table = "user";
    private $new_password;

    public function __construct()
    {
        parent::__construct(self::$table);
        $this->add("firstname","ValidateName");
        $this->add("lastname","ValidateName");
        $this->add("gender","ValidateBoolean");
        $this->add("type","ValidateUserType");
        $this->add("username","ValidateLogin");
        $this->add("password","ValidatePassword");
        $this->add("email","ValidateEmail");
        $this->add("img","ValidateIMG");
        $this->add("dob","ValidateDate");
        $this->add("phone","ValidatePhone");

    }

    protected function postInit()
    {
        if (is_null($this->img)) $this->img = Config::DEFAULT_AVATAR;
        $this->img = Config::DIR_IMG_AVATAR.$this->img;
        return true;
    }

    protected function preValidate() {
        if (is_null($this->type)) $this->type = "E";
        if ($this->img == Config::DIR_IMG_AVATAR.Config::DEFAULT_AVATAR) $this->img = null;
        if (!is_null($this->img)) $this->img = basename($this->img);
        if (!is_null($this->new_password)) $this->password = $this->new_password;
        return true;
    }

    protected function postValidate()
    {
       if (!is_null($this->new_password)) $this->password = md5($this->new_password);
       if (is_null($this->img)) $this->img = Config::DEFAULT_AVATAR;
       return true;
    }

    public function login(){
        // if ($this->activation != "") return false;
        if (!session_id()) session_start();
         $_SESSION["auth_login"] = $this->username;
         $_SESSION["auth_password"] = $this->password;
    }

    public function logout() {
        if (!session_id()) session_start();
        unset($_SESSION["auth_login"]);
        unset($_SESSION["auth_password"]);
        session_destroy();
    }

    public static function authUser($username = false, $password = false) {
        if ($username) $auth = true;
        else {
            if (!session_id()) session_start();
            if (!empty($_SESSION["auth_login"]) && !empty($_SESSION["auth_password"])) {
                $username = $_SESSION["auth_login"];
                $password = $_SESSION["auth_password"];
            }
            else return;
            $auth = false;
        }
        $user = new UserDB();
        if ($auth) $password = md5($password);
        $select = new Select();
        $select->from(self::$table,array("COUNT(id)"))
            ->where("`username` = ".self::$db->getSQ(), array($username))
            ->where("`password` = ".self::$db->getSQ(), array($password));
        $count = self::$db->selectCell($select);
        if ($count) {
            $user->loadOnLogin($username);
            if ($auth) $user->login();
            return $user;
        }
        if (!$auth) throw new Exception("ERROR_AUTH_USER");
    }

    public function setPassword($password) {
        $this->new_password = $password;
    }

    public function getPassword() {
        return $this->new_password;
    }

    private static function getBaseSelect() {
        $select = new Select();
        $select->from(self::$table,"*");
        return $select;
    }

    public function loadOnEmail($email){
        return $this->loadOnField("email",$email);
    }

    public function loadOnLogin($login){
        return $this->loadOnField("username",$login);
    }


    public function isAdmin(){
        if ($this->type == "A" || $this->type == "a") return true;
    }
    public static function getAllShow($count = false, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false);
        if ($count) $select->limit($count,$offset);
        $data = self::$db->select($select);
        $users = ObjectDB::buildMultiple(__CLASS__,$data);
        return $users;
    }

    public static function getLink($user_id) {
        $link = Config::DIR_MENU_LINKS;
        return URL::get($link."teachers.php","",array());
    }

    public static function getAllOnTeacher($type){
        $select = self::getBaseSelect();
        $select->where("`type` = ".self::$db->getSQ(), array($type));
        $row = self::$db->select($select);
        return self::buildMultiple(__CLASS__,$row);
    }

    public static function getCountOnTeachers($type)
    {
        $select = new Select();
        $select->from(self::$table, array("COUNT(id)"))
            ->where("`type` = ".self::$db->getSQ(), array($type));
        return self::$db->selectCell($select);
    }

    public static function getAllOnPage($count, $offset = false) {
        $select = self::getBaseSelect();
        $select->order("id",false)
            ->limit($count, $offset);
        $data = self::$db->select($select);
        $users = ObjectDB::buildMultiple(__CLASS__,$data);
        return $users;
    }



}

?>