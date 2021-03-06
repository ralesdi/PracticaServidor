<?php
require_once MODELS_FOLDER . 'User.php';
class Student extends User{
        
    /**
     * __construct
     *
     * @param  mixed $id
     * @param  mixed $dni
     * @param  mixed $username
     * @param  mixed $name
     * @param  mixed $surname
     * @param  mixed $email
     * @param  mixed $password
     * @param  mixed $image
     * @param  mixed $isActive
     * @return void
     */
    function __construct($id=0,$dni="",$username = "",$name = "",$surname = "",$email = "",$password = "",$image="",$isActive = 0){
        parent::__construct($id,$dni,$username,$name,$surname,$email,$password,$image,$isActive);
    }
    
    /**
     * isStudent
     *
     * @param  mixed $user
     * @return void
     */
    public static function isStudent($user){
        return DataBase::getNumberOfRowsByParameters(get_class(),["dni" => $user->dni]) > 0;
    }
}

?>