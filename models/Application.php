<?php
class Application extends DataBaseModel{
    protected $courseName;
    protected $username;
    protected $date;
    protected $isAccepted;
    
    /**
     * __construct
     *
     * @param  mixed $courseName
     * @param  mixed $username
     * @param  mixed $date
     * @param  mixed $isAccepted
     * @return void
     */
    public function __construct($courseName="",$username="",$date=null,$isAccepted=0)
    {
        $this->courseName = $courseName;
        $this->username = $username;
        $this->date = $date?:(new DateTime())->format('Y-m-d H:i:s');
        $this->isAccepted = $isAccepted;
    }
    
    /**
     * validcourseName
     *
     * @return void
     */
    public function validcourseName(){
        return null;
    }
    
    /**
     * validUsername
     *
     * @return void
     */
    public function validUsername(){
        return null;
    }
    
    /**
     * validDate
     *
     * @return void
     */
    public function validDate(){
        return null;
    }
    
    /**
     * validIsAccepted
     *
     * @return void
     */
    public function validIsAccepted(){
        return null;
    }
    
    /**
     * UserIsInCourse
     *
     * @param  mixed $username
     * @param  mixed $courseName
     * @return void
     */
    public static function UserIsInCourse($username,$courseName){

        $applications = DataBase::getRowsByParameter(get_class(),["username" => $username]);

        foreach($applications as $app){
            if ($app->username==$username) {
                return true;
            }
        }

        return false;
    }
    
    /**
     * getAllCoursesEnrolled
     *
     * @param  mixed $username
     * @return void
     */
    public static function getAllCoursesEnrolled($username){

        $applications = Application::listByParameters(["username" => $username]);

        $courses = [];
        if($applications)
        foreach ($applications as $app ) {
            if($app->isAccepted)
            $courses[] = Course::listById($app->courseName);
        }

        return $courses;
    }

    /**
     * Get the value of courseName
     */ 
    public function getCourseName()
    {
        return $this->courseName;
    }

    /**
     * Set the value of courseName
     *
     * @return  self
     */ 
    public function setCourseName($courseName)
    {
        $this->courseName = $courseName;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of isAccepted
     */ 
    public function getIsAccepted()
    {
        return $this->isAccepted;
    }

    /**
     * Set the value of isAccepted
     *
     * @return  self
     */ 
    public function setIsAccepted($isAccepted)
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }
}

?>