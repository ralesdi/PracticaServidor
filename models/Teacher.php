<?php
require_once MODELS_FOLDER . 'User.php';
class Teacher extends User{
    
    /**
     * userToTeacher
     *
     * @param  mixed $user
     * @return void
     */
    public static function userToTeacher(User $user){
        $teacher = new Teacher($user->dni,$user->username,$user->name,$user->surname,
                                $user->email,$user->password,$user->image,$user->isActive);

        return $teacher;
    }

    
    /**
     * addTeacher
     *
     * @param  mixed $user
     * @return void
     */
    public static function addTeacher($user = null){
        $messages = [];
        if(!$user){
            $messages = $user->validateDataIntegrity();
        }
        if( !$messages )
            $messages = DataBase::insert(get_called_class(), ["dni" => $user->dni]);

        return $messages;
    }
    
    /**
     * isTeacher
     *
     * @param  mixed $user
     * @return void
     */
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

    

}


?>