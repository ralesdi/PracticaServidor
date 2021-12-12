<?php

require_once MODELS_FOLDER . "DataBase.php";
require_once MODELS_FOLDER . "DataBaseModel.php";
class Course extends DataBaseModel
{
    protected $name;
    protected $description;
    protected $teacher;
    protected $startDate;
    protected $endDate;
    protected $applicationDeadline;
    protected $length;
    protected $cost;
    protected $maxStudents;
    
    public function __construct(
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

    public function validName(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }

    public function validDescription(){
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
