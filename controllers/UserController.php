<?php
require_once CONTROLLERS_FOLDER.'BaseController.php';
require_once MODELS_FOLDER . 'Course.php';
require_once MODELS_FOLDER . 'User.php';
require_once MODELS_FOLDER . 'Student.php';
require_once MODELS_FOLDER . 'Teacher.php';
require_once MODELS_FOLDER . 'Admin.php';
require_once MODELS_FOLDER . 'DirectMessage.php';
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
       $type = "student";
     if(Teacher::isTeacher($this->user)){
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
        
        $user = clone ($this->user) ;

        if( isset($_POST["save"]) ){
            $message = null;
            $url = "";
            $messages = [];
            if( $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ){
                
                $messages = $this->uploadImage($_FILES['image'],$url);
            }
      
            if( !$messages ){
                $user->setUsername($_POST["username"]);
                $user->setName($_POST["name"]);
                $user->setSurname($_POST["surname"]);
                $user->setEmail($_POST["email"]);
                $user->setImage($url);
                if( $message = $user->update()) $messages = $message;
                if(!$messages){
                    $_SESSION['user'] = $user;
                    $this->redirect($this->getUserType(),"profile");
                }else{
                        $parameters = [
                            "user" => $this->user,
                            "messages" => $messages
                        ];
                        $this->show("profile",$parameters);
                }
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
        $parameters = [
            "messages" => [],
            "courses" => Course::listAll()
        ];

        $this->show("courses",$parameters);
    }

    public function directMessages(){
        $parameters = [
            "messages" => [],
            "directMessages" => DirectMessage::listByParameters(["receiver" => $this->user->getUsername()])
        ];


        $this->show("directMessages",$parameters);
    }

    public function sendMessage(){

        if( isset($_POST['send']) ){
            $directMessage = new DirectMessage($this->user->getUsername(), $_POST['receiver'],$_POST['content'],(new DateTime())->format('Y-m-d H:i:s'));

            if( $messages = $directMessage->save() ){
                $parameters = [
                    "messages" => $messages
                ];

                $this->show('DirectMessages',$parameters);
            }else{
                $parameters = [
                    "messages" => [
                        ["message" => "Message sent succesfully", "type" => "success"]
                    ]
                ];
                $this->show('DirectMessages',$parameters);
            }
        }else{
            $this->redirect($this->getUserType(),'DirectMessages');
        }
    }

    public function listUsers(){
        $parameters = 
        [
            "messages" => [],
            "users" => User::listAllActive()
        ];

        if($this->getUserType()=='admin'){
            $parameters["unactiveUsers"] = User::listAllUnactive();
        }

        $this->show('listUsers',$parameters);
    }

    public function teachers(){
        $parameters = [
           "teachers" => Teacher::listAll(),
           "messages" => []
        ];
  
        $this->show('teachers',$parameters);
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