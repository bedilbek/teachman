<?php

/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 5/6/17
 * Time: 7:37 AM
 */
class File
{
    public static function uploadIMG($file, $max_size, $dir, $root=false, $source_name= false){
        $blacklist = array(".php", ".phtml", ".php3", ".php4", "html", ".htm", ".exe");
        foreach ($blacklist as $item)
            if (preg_match("/$item\$/i",$file["name"])) throw new Exception("ERROR_AVATAR_TYPE");
            $type = $file["type"];
            $size = $file["size"];
            if (($type != "image/jpg") && ($type != "image/jpeg") && ($type != "image/gif") && ($type != "image/png"))
                throw new Exception("ERROR_AVATAR_TYPE");
            if ($size > $max_size) throw new Exception("ERROR_AVATAR_SIZE");
            if ($source_name) $avatar_name = $file["name"];
            else $avatar_name = self::getName().".".substr($type,strlen("image/"));
            $upload_file = $dir.$avatar_name;
            if (!$root) $upload_file = $_SERVER["DOCUMENT_ROOT"].$upload_file;
            if(!move_uploaded_file($file["tmp_name"], $upload_file)) throw new Exception("UKNOWN_ERROR");
            return $avatar_name;
    }

    public static function uploadDocument($file, $max_size, $dir, $root=false, $source_name= false){
        $blacklist = array(".php", ".phtml", ".php3", ".php4", "html", ".htm", ".exe");
        foreach ($blacklist as $item)
            if (preg_match("/$item\$/i",$file["name"])) throw new Exception("ERROR_DOCUMENT_TYPE");
        $type = $file["type"];
        $size = $file["size"];
        if (($type != "application/vnd.ms-powerpoint") &&
            ($type != "application/msword") &&
            ($type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") &&
            ($type != "application/vnd.ms-excel") &&
            ($type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") &&
            ($type != "application/vnd.openxmlformats-officedocument.presentationml.presentation") &&
            ($type != "application/pdf") &&
            ($type != "application/x-pdf"))
            throw new Exception("ERROR_DOCUMENT_TYPE");
        if ($size > $max_size) throw new Exception("ERROR_DOCUMENT_SIZE");
        if ($source_name) $doc_name = $file["name"];
        else $doc_name = self::getName().".".substr($type,strlen("application/"));
        $upload_file = $dir.$doc_name;
        if (!$root) $upload_file = $_SERVER["DOCUMENT_ROOT"].$upload_file;
        if(!move_uploaded_file($file["tmp_name"], $upload_file)) throw new Exception("UKNOWN_ERROR");
        return $doc_name;
    }

    public static function getName() {
        return uniqid();
    }

    public static function delete($file, $root=false) {
        if (!$root) $file =  $_SERVER["DOCUMENT_ROOT"].$file;
        if (file_exists($file)) unlink($file);
    }

    public static function isExists($file, $root = false) {
        if (!$root) $file =  $_SERVER["DOCUMENT_ROOT"].$file;
        return file_exists($file);
    }

}
?>