<?php

require_once MODELS_FOLDER . "DataBase.php";
require_once MODELS_FOLDER . "DataBaseModel.php";
require_once MODELS_FOLDER . "User.php";
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
        
    /**
     * __construct
     *
     * @return void
     */
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
    
    /**
     * validName
     *
     * @return void
     */
    public function validName(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validDescription
     *
     * @return void
     */
    public function validDescription(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validTeacher
     *
     * @return void
     */
    public function validTeacher(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validStartDate
     *
     * @return void
     */
    public function validStartDate(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validEndDate
     *
     * @return void
     */
    public function validEndDate(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validApplicationDeadline
     *
     * @return void
     */
    public function validApplicationDeadline(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validLength
     *
     * @return void
     */
    public function validLength(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validCost
     *
     * @return void
     */
    public function validCost(){
        $message = null;

        if( false ){
            $message = ["message" => "error", "type" => "danger"];
        }

        return $message;
    }
    
    /**
     * validMaxStudents
     *
     * @return void
     */
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

    public function getTeacherObject(){
        return User::listById($this->teacher);
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

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the value of teacher
     *
     * @return  self
     */ 
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Set the value of applicationDeadline
     *
     * @return  self
     */ 
    public function setApplicationDeadline($applicationDeadline)
    {
        $this->applicationDeadline = $applicationDeadline;

        return $this;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */ 
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Set the value of cost
     *
     * @return  self
     */ 
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Set the value of maxStudents
     *
     * @return  self
     */ 
    public function setMaxStudents($maxStudents)
    {
        $this->maxStudents = $maxStudents;

        return $this;
    }
    
    /**
     * getCourses
     *
     * @param  mixed $teacher
     * @return void
     */
    public static function getCourses($teacher){
        return Course::listByParameters(["teacher" => $teacher->getDni()]);
    }
    
    /**
     * getWidths
     *
     * @return void
     */
    public static function getWidths(){
        $widths = [
             "name" => 20,
      "description" => 30,
      "teacher" => 15,
      "startDate" => 30,
       "endDate" => 30,
       "applicationDeadline" => 30,
       "length" => 10,
       "cost" => 10,
       "maxStudents " => 15
        ];

        return $widths;
    }
}
