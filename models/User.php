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
    
        
    /**
     * __construct
     *
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
    function __construct($dni="",$username = "",$name = "",$surname = "",$email = "",$password = "",$image=PHOTOS_FOLDER."default.jpg",$isActive = 0){
        $this->dni = strtoupper(filter_var($dni,FILTER_SANITIZE_STRING));
        $this->name= ucwords(filter_var($name,FILTER_SANITIZE_STRING));
        $this->surname=ucwords(filter_var($surname,FILTER_SANITIZE_STRING));
        $this->username= strtolower(filter_var($username,FILTER_SANITIZE_STRING));
        $this->email=strtolower(filter_var($email,FILTER_SANITIZE_EMAIL));
        $this->password=filter_var($password,FILTER_SANITIZE_STRING);;
        $this->image=filter_var($image,FILTER_SANITIZE_STRING);;
        $this->isActive=filter_var($isActive,FILTER_SANITIZE_NUMBER_INT);;
        
    }

        
    /**
     * getImage
     *
     * @return void
     */
    public function getImage(){
        return $this->image;
    }
    
    /**
     * setImage
     *
     * @param  mixed $url
     * @return void
     */
    public function setImage($url){
        $this->image = $url;
    }
    
    /**
     * setDni
     *
     * @param  mixed $dni
     * @return void
     */
    public function setDni($dni){
        $this->dni = $dni;
    }
    
    /**
     * getDni
     *
     * @return void
     */
    public function getDni(){
        return $this->dni;
    }
    
    /**
     * getUsername
     *
     * @return void
     */
    public function getUsername(){
        return $this->username;
    }
    
    /**
     * setUsername
     *
     * @param  mixed $username
     * @return void
     */
    public function setUsername($username){
            $this->username = $username;
        
    }
    
    /**
     * getName
     *
     * @return void
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * setName
     *
     * @param  mixed $name
     * @return void
     */
    public function setName($name){
            $this->name = $name;
    }
    
    /**
     * getSurname
     *
     * @return void
     */
    public function getSurname(){
        return $this->surname;
    }
    
    /**
     * setSurname
     *
     * @param  mixed $surname
     * @return void
     */
    public function setSurname($surname){
            $this->surname = $surname;

    }
    
    /**
     * getEmail
     *
     * @return void
     */
    public function getEmail(){
        return $this->email;
    }
    
    /**
     * setEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function setEmail($email){
            $this->email = $email;

    }
    
    /**
     * isActive
     *
     * @return void
     */
    public function isActive(){
        return $this->isActive>0;
    }
    
    /**
     * getIsActive
     *
     * @return void
     */
    public function getIsActive(){
        return $this->isActive>0;
    }
    
    /**
     * setIsActive
     *
     * @param  mixed $isActive
     * @return void
     */
    public function setIsActive($isActive){
        $this->isActive = $isActive;
    }
    
    /**
     * getId
     *
     * @return void
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * getPassword
     *
     * @return void
     */
    public function getPassword(){
        return "";
    }
    
    /**
     * validateInDB
     *
     * @param  mixed $dni
     * @param  mixed $password
     * @return void
     */
    public static function validateInDB($dni,$password){
        $dni = filter_var($dni,FILTER_SANITIZE_STRING);
        $password = filter_var($password,FILTER_SANITIZE_STRING);

        $user = User::listById($dni);

        if($user->password!=$password){
            $user = null;
        }

        return $user;
    }

        
    /**
     * validDni
     *
     * @return void
     */
    protected function validDni(){
        
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
    
    /**
     * validUsername
     *
     * @return void
     */
    protected function validUsername(){
        $message = null;
        if( !preg_match("/^[a-z0-9]{"
            .User::MIN_CHAR_USERNAME.",".User::MAX_CHAR_USERNAME.
            "}$/i", $this->username ) ){
            $message = ["message" => "Nombre de usuario incorrecto", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validName
     *
     * @return void
     */
    protected function validName(){
        $message = null;
        if( !preg_match("/^[a-z ]{"
            .User::MIN_CHAR_NAME.",".User::MAX_CHAR_NAME.
            "}$/i", $this->name ) ){
            $message = ["message" => "Nombre incorrecto", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validSurname
     *
     * @return void
     */
    protected function validSurname(){
        $message = null;
        if( !preg_match("/^[a-z ]{"
            .User::MIN_CHAR_SURNAME.",".User::MAX_CHAR_SURNAME.
            "}$/i", $this->surname ) ){
            $message = ["message" => "Apellido incorrecto", "type" => "danger"];        
        }           

        return $message;
    }
    
    /**
     * validEmail
     *
     * @return void
     */
    protected function validEmail(){
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
    
    /**
     * validPassword
     *
     * @return void
     */
    protected function validPassword(){
        $message = null;
        /*
        if( !preg_match("/^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)(?=.{"
            .User::MIN_CHAR_PASSWORD.",".User::MAX_CHAR_PASSWORD.
            "}).*)$/", $password ) ){
            $message = ["message" => "Contraseña incorrecta", "type" => "danger"];        
        }    */

        return $message;
    }
    
    /**
     * validImage
     *
     * @return void
     */
    protected function validImage(){
        return null;
    }
    
    /**
     * validIsActive
     *
     * @return void
     */
    protected function validIsActive(){
        return null;
    }
    
    /**
     * listAll
     *
     * @return void
     */
    public static function listAll(){
        return DataBase::getAll(get_class());
    }
    
    /**
     * listAllActive
     *
     * @param  mixed $start
     * @param  mixed $numRegisters
     * @return void
     */
    public static function listAllActive($start,$numRegisters){
        
        return DataBase::getRowsByParameterPage(get_called_class(),["isActive" => 1],$start,$numRegisters);
    }
    
    /**
     * pagesActive
     *
     * @param  mixed $itemsPerPage
     * @return void
     */
    public static function pagesActive($itemsPerPage){
        $num = DataBase::getNumberOfRowsByParameters(get_class(),["isActive" => 1]);
        $pages =  ceil($num/$itemsPerPage);
        return $pages;
    }
    
    /**
     * pagesUnactive
     *
     * @param  mixed $itemsPerPage
     * @return void
     */
    public static function pagesUnactive($itemsPerPage){
        $num = DataBase::getNumberOfRowsByParameters(get_class(),["isActive" => 0]);
        $pages =  ceil($num/$itemsPerPage);

        return $pages;
    }
    
    /**
     * listAllUnactive
     *
     * @param  mixed $start
     * @param  mixed $numRegisters
     * @return void
     */
    public static function listAllUnactive($start,$numRegisters){
        $numPages = DataBase::getNumberOfRowsByParameters(get_class(),["isActive" => 1]);
        return DataBase::getRowsByParameterPage(get_called_class(),["isActive" => 0],$start,$numRegisters);
    }
    
    /**
     * getWidths
     *
     * @return void
     */
    public static function getWidths(){
        $widths = [
               "dni" => 20,
               "username" => 15,
               "name" => 40,
               "surname" => 45, 
               "email" => 50,
               "isActive" => 20
        ];

        return $widths;
    }
    
    /**
     * getVars
     *
     * @param  mixed $sensitiveInformation
     * @return void
     */
    public static function getVars($sensitiveInformation=true){
        $vars = parent::getVars();

        unset($vars["password"]);
        unset($vars["image"]);

        if(!$sensitiveInformation){
            unset($vars["dni"]);
            unset($vars["email"]);
            unset($vars["isActive"]);
        }


        return $vars;
    }

    
}

?>