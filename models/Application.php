<?php
class Application extends DataBaseModel{
    protected $courseName;
    protected $username;
    protected $date;
    protected $isAccepted;

    public function __construct($courseName="",$username="")
    {
        $this->courseName = $courseName;
        $this->username = $username;
        $this->date = (new DateTime())->format('Y-m-d H:i:s');
        $this->isAccepted = 0;
    }

    public function validcourseName(){
        return null;
    }

    public function validUsername(){
        return null;
    }

    public function validDate(){
        return null;
    }

    public function validIsAccepted(){
        return null;
    }

    public static function UserIsInCourse($username,$courseName){

        $applications = DataBase::getRowsByParameter(get_class(),["username" => $username]);

        foreach($applications as $app){
            if ($app->username==$username) {
                return true;
            }
        }

        return false;
    }

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
}

?>