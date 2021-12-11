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
    private $maxStudents;
    
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
        $maxStudents = 0
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
        $this->maxStudents = $maxStudents;
    }

    private function validId($id){
        $message = null;

        if( !is_int($id) ){
            $message = ["message" => "id no numerico", "type" => "danger"];
        }

        return $message;
    }

    public function validName($id){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validDescription($id){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validTeacher(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validStartDate(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validEndDate(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validApplicationDeadline(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validLength(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validCost(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validMaxStudents(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    private function validateDataIntegrity(){
        $messages = [];
        
        $vars = get_object_vars($this);

        foreach ($vars as $name => $value) {
            $function = "valid$name()";

            if( $message = $this->$function ){
                $messages[] = $message;
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
        $messages = $this->validateDataIntegrity();

        if( !$messages )
            $messages = DataBase::insert(get_class($this), $this->parametersToArray());

        return $messages;
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

    public static function numberOfCourses(){
        return DataBase::getNumberOfRows(get_class());
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
     * Get the value of maxStudents
     */ 
    public function getMaxStudents()
    {
        return $this->maxStudents;
    }
}
