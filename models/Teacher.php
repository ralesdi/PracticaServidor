<?php
require_once MODELS_FOLDER . 'User.php';
class Teacher extends User{

    public static function userToTeacher(User $user){
        $teacher = new Teacher($user->dni,$user->username,$user->name,$user->surname,
                                $user->email,$user->password,$user->image,$user->isActive);

        return $teacher;
    }


    public static function addTeacher($user = null){
        $messages = [];
        if(!$user){
            $messages = $user->validateDataIntegrity();
        }
        if( !$messages )
            $messages = DataBase::insert(get_called_class(), ["dni" => $user->dni]);

        return $messages;
    }

    public static function isTeacher($user){
        return DataBase::getNumberOfRowsByParameters(get_class(),["dni" => $user->dni]) > 0;
    }

    public static function listAll(){
        $teachers = DataBase::getAll(get_class());
        $users = [];
        foreach ($teachers as $teacher) {
            $users[] = User::listById($teacher->dni);
        }

        return $users;
    }

    public static function listAllPages($start,$numRegisters){
        
        return DataBase::getAllPage(get_called_class(),$start,$numRegisters);
    }

    public static function pages($itemsPerPage){
        $num = count(DataBase::getAll(get_class()));
        $pages =  ceil($num/$itemsPerPage);
        return $pages;
    }

}


?>