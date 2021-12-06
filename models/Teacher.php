<?php
require_once MODELS_FOLDER . 'User.php';
class Teacher extends User{

    function __construct($id=0,$dni="",$username = "",$name = "",$surname = "",$email = "",$password = "",$image="",$isActive = 0){
        parent::__construct($id,$dni,$username,$name,$surname,$email,$password,$image,$isActive);
    }

    public static function isTeacher($user){
        return DataBase::getNumberOfRowsByParameters(get_class(),["dni" => $user->dni]) > 0;
    }
}


?>