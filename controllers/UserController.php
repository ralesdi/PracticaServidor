<?php
require_once CONTROLLERS_FOLDER.'BaseController.php';
require_once MODELS_FOLDER . 'Course.php';
require_once MODELS_FOLDER . 'User.php';
require_once MODELS_FOLDER . 'Student.php';
require_once MODELS_FOLDER . 'Teacher.php';
require_once MODELS_FOLDER . 'Admin.php';

class UserController extends BaseController{
    protected $user;
    public function __construct()
   {
      session_start();   // Todos los métodos de este controlador requieren autenticación
      if ( !isset($_SESSION['user']) )  // Si no existe la sesión…
      { 
         $this->redirect("index", "login");
      }else{
          $this->user = $_SESSION['user'];
      }
   }

   protected function getUserType(){
       $type = "";
    if(Student::isStudent($this->user)){
        $type = "student";
     }else if(Teacher::isTeacher($this->user)){
        $type = "teacher";
     }else if(Admin::isAdmin($this->user)){
        $type = "admin";
     }

     return $type;
   }

   public function index()
   {
        $this->redirect($this->getUserType(),"index");
   }

   public function profile(){
    $parameters = [
        "user" => $this->user,
        "messages" => []
     ];
    
    $this->show("profile",$parameters);
    }

    public function saveProfileChanges(){
        $parameters = [
            "user" => $this->user
        ];

        $user = $this->user ;

        if( isset($_POST["save"]) ){
            $messages = [];
            $message = null;
            
           if( $message = $user->setUsername($_POST["username"])) $messages[] = $message;
           if( $message = $user->setName($_POST["name"])) $messages[] = $message;
           if( $message = $user->setSurname($_POST["surname"])) $messages[] = $message;
           if( $message = $user->setEmail($_POST["email"])) $messages[] = $message;
           if( $message = $user->update()) $messages[] = $message;

           if(!$messages){
            $this->user = $user;
            $this->redirect($this->getUserType(),"profile");
            }else{
                $parameters = [
                    "user" => $this->user,
                    "messages" => $messages
                ];
                $this->show("profile",$parameters);
            }     
        }else{
            $this->redirect($this->getUserType(),"profile");
        }
        
     }

    public function courses(){
        $courses = Course::listAll();
        $parameters = [
            "messages" => [],
            "courses" => Course::listAll()
        ];

        if($courses){
            $parameters["courses"] = $courses;
        }

        $this->show("courses",$parameters);
    }


   public function logout()
   {
      session_start();
      session_unset();
      session_destroy();
      $this->redirect("index", "index");
   }
}

?>