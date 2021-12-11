<?php

require_once MODELS_FOLDER."DataBase.php";
require_once MODELS_FOLDER."DataBaseModel.php";
class User extends DataBaseModel{
    public const  MIN_CHAR_USERNAME = 3;
    public const MAX_CHAR_USERNAME = 15;
    public const MIN_CHAR_NAME = 3;
    public const MAX_CHAR_NAME = 20;
    public const MIN_CHAR_SURNAME = 3;
    public const MAX_CHAR_SURNAME = 35;
    public const MIN_CHAR_EMAIL = 3;
    public const MAX_CHAR_EMAIL = 20;
    public const MIN_CHAR_PASSWORD = 5;
    public const MAX_CHAR_PASSWORD = 30;
    protected $dni;
    protected $username;
    protected $name;
    protected $surname;
    protected $email;
    protected $password;
    protected $image;
    protected $isActive;

    function __construct($dni="",$username = "",$name = "",$surname = "",$email = "",$password = "",$image="",$isActive = 0){
        $this->dni = strtoupper(filter_var($dni,FILTER_SANITIZE_STRING));
        $this->name=filter_var($name,FILTER_SANITIZE_STRING);
        $this->surname=filter_var($surname,FILTER_SANITIZE_STRING);;
        $this->username=filter_var($username,FILTER_SANITIZE_STRING);;
        $this->email=filter_var($email,FILTER_SANITIZE_EMAIL);;
        $this->password=filter_var($password,FILTER_SANITIZE_STRING);;
        $this->image=filter_var($image,FILTER_SANITIZE_STRING);;
        $this->isActive=filter_var($isActive,FILTER_SANITIZE_NUMBER_INT);;
    }


    public function getDni(){
        return $this->dni;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        
        if(!$message = User::validUsername($username)){
            $this->username = $username;
        }

        return $message;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        if(!$message = User::validName($name)){
            $this->name = $name;
            
        }

        return $message;
        
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname){
        if(!$message = User::validSurname($surname)){
            $this->surname = $surname;
        }
        return $message;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        if(!$message = User::validEmail($email)){
            $this->email = $email;
        }
        return $message;
    }

    public function isActive(){
        return $this->isActive>0;
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

    private static function validId($id){
        $message = null;
        if( !is_numeric($id) ){
            $message = ["message" => "Error al procesar el ID", "type" => "danger"];        
        }

        return $message;
    }

    private static function validDni($dni){
        
        $validationTable = "TRWAGMYFPDXBNJZSQVHLCKE";
        $valid = false;

        if( preg_match("/^\d{8}[A-Z]$/",$dni) ){
            $number = (int)substr($dni,0,-1);
            $char = "".$dni[8];
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

    private static function validUsername($username){
        $message = null;
        if( !preg_match("/^[a-z0-9]{"
            .User::MIN_CHAR_USERNAME.",".User::MAX_CHAR_USERNAME.
            "}$/i", $username ) ){
            $message = ["message" => "Nombre de usuario incorrecto", "type" => "danger"];
        }

        return $message;
    }

    private static function validName($name){
        $message = null;
        if( !preg_match("/^[a-z ]{"
            .User::MIN_CHAR_NAME.",".User::MAX_CHAR_NAME.
            "}$/i", $name ) ){
            $message = ["message" => "Nombre incorrecto", "type" => "danger"];
        }

        return $message;
    }

    private static function validSurname($surname){
        $message = null;
        if( !preg_match("/^[a-z ]{"
            .User::MIN_CHAR_SURNAME.",".User::MAX_CHAR_SURNAME.
            "}$/i", $surname ) ){
            $message = ["message" => "Apellido incorrecto", "type" => "danger"];        
        }           

        return $message;
    }

    private static function validEmail($email){
        $message = null;
        if( !preg_match("/^[a-z0-9]{"
            .User::MIN_CHAR_EMAIL.",".User::MAX_CHAR_EMAIL.
            "}[@][a-z0-9]{"
            .User::MIN_CHAR_EMAIL.",".User::MAX_CHAR_EMAIL.
            "}[.][a-z]{2,5}$/i",$email) ){
                $message = ["message" => "Email incorrecto", "type" => "danger"];        
        }         

        return $message;
    }

    private static function validPassword($password){
        $message = null;
        /*
        if( !preg_match("/^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)(?=.{"
            .User::MIN_CHAR_PASSWORD.",".User::MAX_CHAR_PASSWORD.
            "}).*)$/", $password ) ){
            $message = ["message" => "Contraseña incorrecta", "type" => "danger"];        
        }    */

        return $message;
    }

    public static function listAll(){
        return DataBase::getRowsByParameter(get_class(),["isActive" => 1]);
    }


    
}

?>