<?php

require_once MODELS_FOLDER."DataBase.php";
require_once MODELS_FOLDER."DataBaseModel.php";
class User extends DataBaseModel{
    protected $dni;
    protected $username;
    protected $name;
    protected $surname;
    protected $email;
    protected $password;
    protected $image;
    protected $isActive;
    public const MIN_CHAR_USERNAME = 3;
    public const MAX_CHAR_USERNAME = 15;
    public const MIN_CHAR_NAME = 3;
    public const MAX_CHAR_NAME = 20;
    public const MIN_CHAR_SURNAME = 3;
    public const MAX_CHAR_SURNAME = 35;
    public const MIN_CHAR_EMAIL = 3;
    public const MAX_CHAR_EMAIL = 20;
    public const MIN_CHAR_PASSWORD = 5;
    public const MAX_CHAR_PASSWORD = 30;
    

    function __construct($dni="",$username = "",$name = "",$surname = "",$email = "",$password = "",$image="",$isActive = 0){
        $this->dni = strtoupper(filter_var($dni,FILTER_SANITIZE_STRING));
        $this->name= ucwords(filter_var($name,FILTER_SANITIZE_STRING));
        $this->surname=ucwords(filter_var($surname,FILTER_SANITIZE_STRING));
        $this->username= strtolower(filter_var($username,FILTER_SANITIZE_STRING));
        $this->email=strtolower(filter_var($email,FILTER_SANITIZE_EMAIL));
        $this->password=filter_var($password,FILTER_SANITIZE_STRING);;
        $this->image=filter_var($image,FILTER_SANITIZE_STRING);;
        $this->isActive=filter_var($isActive,FILTER_SANITIZE_NUMBER_INT);;
    }

    public function getImage(){
        return $this->image;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        
            $this->username = $username;
        
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
            $this->name = $name;
       
        
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname){
            $this->surname = $surname;

    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
            $this->email = $email;

    }

    public function isActive(){
        return $this->isActive>0;
    }

    public function setIsActive($isActive){
        $this->isActive = $isActive;
    }

    public function parametersToArray(){
        return get_object_vars($this); 
    }

    public function idToArray(){
        return ["dni" => $this->dni];
    }

    

    public static function validateInDB($dni,$password){
        $dni = filter_var($dni,FILTER_SANITIZE_STRING);
        $password = filter_var($password,FILTER_SANITIZE_STRING);

        $user = User::listById($dni);

        if($user->password!=$password){
            $user = null;
        }

        return $user;
    }

    private function validDni(){
        
        $validationTable = "TRWAGMYFPDXBNJZSQVHLCKE";
        $valid = false;

        if( preg_match("/^\d{8}[A-Z]$/",$this->dni) ){
            $number = (int)substr($this->dni,0,-1);
            $char = "".$this->dni[8];
            $module = $number%23;
            if($validationTable[$module] == $char){
                $valid = true;
            }
        }

        $message = null;

        if(!$valid){
            $message = ["message" => "DNI incorrecto", "type" => "danger"];
        }

        return $message;
    }

    private function validUsername(){
        $message = null;
        if( !preg_match("/^[a-z0-9]{"
            .User::MIN_CHAR_USERNAME.",".User::MAX_CHAR_USERNAME.
            "}$/i", $this->username ) ){
            $message = ["message" => "Nombre de usuario incorrecto", "type" => "danger"];
        }

        return $message;
    }

    private function validName(){
        $message = null;
        if( !preg_match("/^[a-z ]{"
            .User::MIN_CHAR_NAME.",".User::MAX_CHAR_NAME.
            "}$/i", $this->name ) ){
            $message = ["message" => "Nombre incorrecto", "type" => "danger"];
        }

        return $message;
    }

    private function validSurname(){
        $message = null;
        if( !preg_match("/^[a-z ]{"
            .User::MIN_CHAR_SURNAME.",".User::MAX_CHAR_SURNAME.
            "}$/i", $this->surname ) ){
            $message = ["message" => "Apellido incorrecto", "type" => "danger"];        
        }           

        return $message;
    }

    private function validEmail(){
        $message = null;
        if( !preg_match("/^[a-z0-9]{"
            .User::MIN_CHAR_EMAIL.",".User::MAX_CHAR_EMAIL.
            "}[@][a-z0-9]{"
            .User::MIN_CHAR_EMAIL.",".User::MAX_CHAR_EMAIL.
            "}[.][a-z]{2,5}$/i",$this->email) ){
                $message = ["message" => "Email incorrecto", "type" => "danger"];        
        }         

        return $message;
    }

    private function validPassword(){
        $message = null;
        /*
        if( !preg_match("/^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)(?=.{"
            .User::MIN_CHAR_PASSWORD.",".User::MAX_CHAR_PASSWORD.
            "}).*)$/", $password ) ){
            $message = ["message" => "Contraseña incorrecta", "type" => "danger"];        
        }    */

        return $message;
    }

    public static function listAllActive(){
        return DataBase::getRowsByParameter(get_class(),["isActive" => 1]);
    }

    public static function listAllUnactive(){
        return DataBase::getRowsByParameter(get_class(),["isActive" => 0]);
    }


    
}

?>