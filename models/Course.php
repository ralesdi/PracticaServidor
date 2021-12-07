<?php

require_once MODELS_FOLDER . "DataBase.php";
require_once MODELS_FOLDER . "DataBaseModel.php";
class Course implements DataBaseModel
{
    private $id;
    private $name;
    private $description;
    private $teacher;
    private $startDate;
    private $endDate;
    private $applicationDeadline;
    private $length;
    private $cost;
    private $max_students;
    
    public function __construct(
        $id = 0,
        $name = "",
        $description = "",
        $teacher = 0,
        $startDate = 0,
        $endDate = 0,
        $applicationDeadline = 0,
        $length = 0,
        $cost = 0.0,
        $max_students = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->teacher = $teacher;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->applicationDeadline = $applicationDeadline;
        $this->length = $length;
        $this->description = $description;
        $this->cost = $cost;
        $this->max_students = $max_students;
    }

    private static function validId($id){
        $message = null;

        if( !is_int($id) ){
            $message = ["message" => "id no numerico", "type" => "danger"];
        }

        return $message;
    }

    public static function validName($id){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validDescription($id){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validTeacher(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validStartDate(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validEndDate(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validApplicationDeadline(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validLength(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validCost(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public static function validMaxStudents(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    private function validateDataIntegrity(){
        $messages = [];
        
        $vars = get_object_vars();

        foreach ($vars as $name => $value) {
            $function = "valid$name($value)";

            if( $message = Course::$function ){

            }
        }


        /*
        if( !preg_match("/^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)(?=.{"
                        .User::MIN_CHAR_PASSWORD.",".User::MAX_CHAR_PASSWORD.
                        "}).*)$/", $this->password ) ){
            $messages[] = ["message" => "Contraseña incorrecta", "type" => "danger"];        
        }
        */
        

        return $messages;
    }



    public function parametersToArray()
    {
        return get_object_vars($this);
    }

    public function idToArray()
    {
        return ["name" => $this->name];
    }

    public function save()
    {
        DataBase::insert(get_class(), $this->parametersToArray());
    }

    public function update()
    {
        DataBase::update(get_class(), $this->parametersToArray(), $this->idToArray());
    }

    public function delete()
    {
        DataBase::delete(get_class(), $this->idToArray());
    }

    public static function listAll()
    {
    }

    public static function listById($id)
    {
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of teacher
     */ 
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Get the value of applicationDeadline
     */ 
    public function getApplicationDeadline()
    {
        return $this->applicationDeadline;
    }

    /**
     * Get the value of length
     */ 
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of cost
     */ 
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Get the value of max_students
     */ 
    public function getMax_students()
    {
        return $this->max_students;
    }
}
