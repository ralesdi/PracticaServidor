<?php
require_once CONTROLLERS_FOLDER.'BaseController.php';
require_once MODELS_FOLDER . 'Course.php';
require_once MODELS_FOLDER . 'User.php';
require_once MODELS_FOLDER . 'Student.php';
require_once MODELS_FOLDER . 'Teacher.php';
require_once MODELS_FOLDER . 'Admin.php';
require_once MODELS_FOLDER . 'DirectMessage.php';
require_once MODELS_FOLDER . 'Application.php';
require_once MODELS_FOLDER . 'pdf.php';


class UserController extends BaseController{
    protected $user;
    
    /**
     * __construct
     *
     * @return void
     */
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
   
   /**
    * getUserType
    *
    * @return void
    */
   protected function getUserType(){
       $type = "student";
     if(Teacher::isTeacher($this->user)){
        $type = "teacher";
     }else if(Admin::isAdmin($this->user)){
        $type = "admin";
     }

     return $type;
   }
   
   /**
    * index
    *
    * @return void
    */
   public function index()
   {
        $this->redirect($this->getUserType(),"index");
   }
   
   /**
    * profile
    *
    * @return void
    */
   public function profile(){
    $parameters = [
        "user" => $this->user,
        "messages" => []
     ];
    
    $this->show("profile",$parameters);
    }
    
    /**
     * saveProfileChanges
     *
     * @return void
     */
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
    
    /**
     * courses
     *
     * @return void
     */
    public function courses(){
        $start = 0;
        $numRegisters= 2;
        
        if( isset($_POST['itemsPerPageActiveUsers'])){
            $numRegisters = $_POST['itemsPerPageActiveUsers'];
        }

        $numPage = 0;
        if( isset($_POST['numPage'])){
            $start = $_POST['numPage']*$numRegisters;
            $numPage =$_POST['numPage'];
        }

        $numPages = Course::pages($numRegisters);


        $parameters = 
        [
            "messages" => [],
            "numPagesActiveUsers" => $numPages,
            "itemPerPage" => $numRegisters,
            "numPage" => $numPage,
            "courses" => Course::listAllPages($start,$numRegisters),
            "applications" => Application::listByParameters(['username' => $this->user->getUsername()])
        ];
            

        $this->show("courses",$parameters);
    }
    
    /**
     * directMessages
     *
     * @return void
     */
    public function directMessages(){
        $parameters = [
            "messages" => [],
            "directMessages" => DirectMessage::listByParameters(["receiver" => $this->user->getUsername()])
        ];


        $this->show("directMessages",$parameters);
    }
    
    /**
     * sendMessage
     *
     * @return void
     */
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
    
    /**
     * listUsers
     *
     * @return void
     */
    public function listUsers(){

        $start = 0;
        $numRegisters= 2;
        
        if( isset($_POST['itemsPerPageActiveUsers'])){
            $numRegisters = $_POST['itemsPerPageActiveUsers'];
        }

        $numPage = 0;
        if( isset($_POST['numPage'])){
            $start = $_POST['numPage']*$numRegisters;
            $numPage = $_POST['numPage'];
        }

        $numPages = User::pagesActive($numRegisters);


        $parameters = 
        [
            "messages" => [],
            "users" => User::listAllActive($start,$numRegisters),
            "numPagesActiveUsers" => $numPages,
            "itemPerPage" => $numRegisters,
            "numPage" => $numPage
        ];

        if($this->getUserType()=='admin'){
            $startU = 0;
            $numRegistersU= 2;
            if(isset($_POST['itemsPerPageUnactiveUsers'])){
                $numRegistersU = $_POST['itemsPerPageUnactiveUsers'];
            }
            $numPageU = 0;
            if(isset($_POST['numPageU'])){
                $startU = $_POST['numPageU']*$numRegistersU;
                $numPageU = $_POST['numPageU'];
            }
            $numPagesU = User::pagesUnactive($numRegistersU);
            $parameters['numPagesUnactiveUsers'] = $numPagesU;
            $parameters["unactiveUsers"] = User::listAllUnactive($startU,$numRegistersU);
            $parameters['numPageU'] = $numPageU;
        }

        $this->show('listUsers',$parameters);
    }
    
    /**
     * teachers
     *
     * @return void
     */
    public function teachers(){
        $start = 0;
        $numRegisters= 2;
        
        if(isset($_POST['itemsPerPageActiveUsers'])){
            $numRegisters = $_POST['itemsPerPageActiveUsers'];
        }

        $numPage = 0;
        if(isset($_POST['numPage'])){
            $start = $_POST['numPage']*$numRegisters;
            $numPage = $_POST['numPage'];
        }

        $numPages = Teacher::pages($numRegisters);


        $parameters = 
        [
            "messages" => [],
            "teachers" => Teacher::listAllPages($start,$numRegisters),
            "numPagesActiveUsers" => $numPages,
            "itemPerPage" => $numRegisters,
            "numPage" => $numPage
        ];
  
        $this->show('teachers',$parameters);
     }
     
     /**
      * applicate
      *
      * @return void
      */
     public function applicate(){
        

        if( !Application::UserIsInCourse($this->user->getUsername(),$_POST['courseName'])){
            $application = new Application($_POST['courseName'],$this->user->getUsername());
            if( $message = $application->save()) $messages = $message;
        }else{
            $messages = [["message" => "You have already applied", "type" => "danger"]];
        }
        if(!$messages){
            $this->redirect($this->getUserType(),"courses");
        }else{
        
            $parameters = [
                "messages" => $messages,
                "courses" => Course::listAll()
            ];
            $this->redirect($this->getUserType(),'courses',$parameters);
            
        }
     }
     
     /**
      * ApplicationList
      *
      * @return void
      */
     public function ApplicationList(){
         
        $parameters = 
        [
            "messages" => [],
            "courseApp" => $_POST['courseName'],
            "applications" => Application::listByParameters(['courseName' => $_POST['courseName']]),
        ];

        $this->show('applicationList',$parameters);
    }
    
    /**
     * pdfUsers
     *
     * @return void
     */
    public function pdfUsers(){
        PDF::Print(User::listAll(),"List of users", $this->getUserType()=='admin');
    }
    
    /**
     * pdfCourses
     *
     * @return void
     */
    public function pdfCourses(){
        PDF::Print(Course::listAll(),"List of courses", $this->getUserType()=='admin');
    }
    
    /**
     * pdfTeachers
     *
     * @return void
     */
    public function pdfTeachers(){
        PDF::Print(Teacher::listAll(),"List of teachers", $this->getUserType()=='admin');
    }
    
    /**
     * pdfDirectMessages
     *
     * @return void
     */
    public function pdfDirectMessages(){
        PDF::Print(DirectMessage::listAll(),"List of messages", $this->getUserType()=='admin');
    }
    
    /**
     * pdfApplications
     *
     * @return void
     */
    public function pdfApplications(){
        PDF::Print(Application::listAll(),"List of applications", $this->getUserType()=='admin');
    }
   
   /**
    * logout
    *
    * @return void
    */
   public function logout()
   {
      session_start();
      session_unset();
      session_destroy();
      $this->redirect("index", "index");
   }
}

?>