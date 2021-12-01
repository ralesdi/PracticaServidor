<?php

require_once MODELS_FOLDER."DataBase.php";
require_once MODELS_FOLDER."DataBaseModel.php";
class User implements DataBaseModel{
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
    protected $id;
    protected $dni;
    protected $username;
    protected $name;
    protected $surname;
    protected $email;
    protected $password;
    protected $image;
    protected $isActive;
    



    function __construct($id=0,$dni="",$username = "",$name = "",$surname = "",$email = "",$password = "",$image="",$isActive = 0){
        $this->id = filter_var($id,FILTER_SANITIZE_NUMBER_INT) ;
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

    public function isActive(){
        return $this->isActive>0;
    }

    public function parametersToArray(){
        return get_object_vars($this); 
    }

    public function idToArray(){
        return ["dni" => $this->dni];
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

        return $valid;
    }

    public static function validateInDB($dni,$password){
        $dni = filter_var($dni,FILTER_SANITIZE_STRING);
        $password = sha1(filter_var($password,FILTER_SANITIZE_STRING));

        $user = User::listById(["dni" => $dni]);

        if($user->password!=$password){
            $user = null;
        }

        return $user;
    }

    private function validateDataIntegrity(){
        $messages = [];
        
        if( !is_numeric($this->id) ){
            $messages[] = ["message" => "Error al procesar el ID", "type" => "danger"];        
        }
        
        if( !$this->validDni() ){
            $messages[] = ["message" => "DNI incorrecto", "type" => "danger"];        
        }
        
        if( !preg_match("/^[a-z0-9]{"
                        .User::MIN_CHAR_USERNAME.",".User::MAX_CHAR_USERNAME.
                        "}$/i", $this->username ) ){
            $messages[] = ["message" => "Nombre de usuario incorrecto", "type" => "danger"];
        }
        
        if( !preg_match("/^[a-z ]{"
                        .User::MIN_CHAR_NAME.",".User::MAX_CHAR_NAME.
                        "}$/i", $this->name ) ){
            $messages[] = ["message" => "Nombre incorrecto", "type" => "danger"];
        }
        
        if( !preg_match("/^[a-z ]{"
                        .User::MIN_CHAR_SURNAME.",".User::MAX_CHAR_SURNAME.
                        "}$/i", $this->surname ) ){
            $messages[] = ["message" => "Apellido incorrecto", "type" => "danger"];        
        }

        if( !preg_match("/^[a-z0-9]{"
                        .User::MIN_CHAR_EMAIL.",".User::MAX_CHAR_EMAIL.
                        "}[@][a-z0-9]{"
                        .User::MIN_CHAR_EMAIL.",".User::MAX_CHAR_EMAIL.
                        "}[.][a-z]{2,5}$/i",$this->email) ){
            $messages[] = ["message" => "Email incorrecto", "type" => "danger"];        
        }

        if( !preg_match("/^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)(?=.{"
                        .User::MIN_CHAR_PASSWORD.",".User::MAX_CHAR_PASSWORD.
                        "}).*)$/", $this->password ) ){
            $messages[] = ["message" => "Contraseña incorrecta", "type" => "danger"];        
        }else{
            $this->password = sha1($this->password);
        }
        

        return $messages;
    }

    public function save(){
        $messages = $this->validateDataIntegrity();

        if(count($messages)==0)
            $messages = DataBase::insert(get_class($this), $this->parametersToArray());

        return $messages;
    }

    public function update(){
        $messages = $this->validateDataIntegrity();

        if(count($messages)==0)
            $messages = DataBase::update(get_class($this), $this->parametersToArray(), $this->idToArray());

        return $messages;
    }

    public function delete(){
        $messages = $this->validateDataIntegrity();

        if(count($messages)==0)
            $messages = DataBase::delete(get_class($this),$this->idToArray());

        return $messages;
    }

    public static function listAll(){

    }

    public static function listById($id){
        return DataBase::getRowsByParameter(get_class(),$id);
    }

    public static function totalUsuarios(){
        return DataBase::getNumberOfRows(get_class());
    }

    
}

?>