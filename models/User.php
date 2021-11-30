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
        $this->id = $id ;
        $this->dni = strtoupper($dni);
        $this->name=$name;
        $this->surname=$surname;
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
        $this->image=$image;
        $this->isActive=$isActive;
    }

    public function parametersToArray(){
        return get_object_vars($this);
    }

    public function idToArray(){
        return ["id" => $this->id];
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

    private function validate(){
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
        }
        

        return $messages;
    }

    public function save(){
        $messages = $this->validate();

        if(count($messages)==0)
            $messages = DataBase::insert(get_class($this), $this->parametersToArray());

        return $messages;
    }

    public function update(){
        $messages = $this->validate();

        if(count($messages)==0)
            $messages = DataBase::update(get_class($this), $this->parametersToArray(), $this->idToArray());

        return $messages;
    }

    public function delete(){
        $messages = $this->validate();

        if(count($messages)==0)
            $messages = DataBase::delete(get_class($this),$this->idToArray());

        return $messages;
    }

    public static function listAll(){

    }

    public static function listById($id){

    }

    public static function totalUsuarios(){
        return DataBase::getNumberOfRows(get_class());
    }
}

?>