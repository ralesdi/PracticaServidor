<?php
require_once MODELS_FOLDER . 'User.php';
class Admin extends User{
    
    function __construct($id=0,$dni="",$username = "",$name = "",$surname = "",$email = "",$password = "",$image="",$isActive = 0){
        parent::__construct($id,$dni,$username,$name,$surname,$email,$password,$image,$isActive);
    }

    public static function isAdmin($user){
        return DataBase::getNumberOfRowsByParameters(get_class(),["dni" => $user->getDni()]) > 0;
    }
}

?>