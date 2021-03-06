<?php

/**
 * Controlador de la página de entrada al portal desde la que se pueden hacer las funciones que te permita tu rol
 */
require_once CONTROLLERS_FOLDER.'UserController.php';
require_once MODELS_FOLDER . 'Admin.php';
require_once MODELS_FOLDER . 'Teacher.php';
class AdminController extends UserController{
   
   /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
      session_start();   // Todos los métodos de este controlador requieren autenticación
      if ( !isset($_SESSION['user']) OR !Admin::isAdmin($_SESSION['user']) )  // Si no existe la sesión…
      { 
         $this->redirect("index", "login");
      }else{
         $this->user = $_SESSION['user'];
      }
   }
   
   /**
    * index
    *
    * @return void
    */
   public function index()
   {
      $parameters = [
         "tituloventana" => "Bienvenid@, ADMIN!",
         "courses" => []
      ];

      $parameters["courses"] = Application::getAllCoursesEnrolled($this->user->getUsername());
      $this->show("index", $parameters);
   }
   
   /**
    * createCourse
    *
    * @return void
    */
   public function createCourse()
   {
      $parameters = [
         "messages" => [],
         "teachers" => Teacher::listAll()
      ];
      $this->show("CreateCourse", $parameters);
   }
   
   /**
    * validateCourse
    *
    * @return void
    */
   public function validateCourse(){
    $parameters = [
        "messages" => [],
        "teachers" => Teacher::listAll()
     ];
       if( isset($_POST['create'])){
            $variables = get_class_vars(get_class(new Course()));

            $allFieldsFilled = true;
            foreach ($variables as $key => $value) {
                if( !$_POST[$key] ){
                    $allFieldsFilled = false;
                }
            }

            if($allFieldsFilled){
                $course = new Course(ucwords($_POST['name']),$_POST['description'],$_POST['teacher'],
                                     $_POST['startDate'],$_POST['endDate'],$_POST['applicationDeadline'],
                                     $_POST['length'],$_POST['cost'],$_POST['maxStudents']);

                $messages = $course->save();

                if($messages){
                    $parameters['messages'] = $messages;

                    $this->show('CreateCourse',$parameters);
                }else{
                    $this->redirect('admin','createCourse');
                }
            }else{
                $this->redirect('admin','createCourse');
            }


       }else{
        $this->redirect('admin','createCourse');
       }
   }
   
   /**
    * deleteCourse
    *
    * @return void
    */
   public function deleteCourse(){
      if( isset($_POST['name']) ){
         $name = ucwords( filter_var($_POST['name'],FILTER_SANITIZE_STRING) );

         $course = Course::listByParameters(["name" => $name])[0];

         $parameters = 
        [
            "courses" => Course::listAll()
        ];

         if( $messages = $course->delete() ){
            $parameters['messages'] = $messages;
            $this->show('courses',$parameters);
         }else{
            $this->redirect('admin','courses');
         }
      }else{
         $this->redirect('admin','courses');
      }
   }
   
   /**
    * editCourse
    *
    * @return void
    */
   public function editCourse(){
      $name = ucwords( filter_var($_POST['name'],FILTER_SANITIZE_STRING) );

      $course = Course::listById($name);

      $parameters = [
         "course" => $course,
         "teachers" => Teacher::listAll(),
         "messages" => []
      ];

      $this->show('editCourse',$parameters);
   }
   
   /**
    * updateCourse
    *
    * @return void
    */
   public function updateCourse(){
      
      if( isset($_POST["edit"]) ){
         $name = ucwords(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
         $course = Course::listById( $name );
          $messages = [];
          $parameters = 
        [
            "messages" => [],
            "course" => $course
        ];
    
              $course->setDescription($_POST["description"]);
              $course->setTeacher($_POST["teacher"]);
              $course->setStartDate($_POST["startDate"]);
              $course->setEndDate($_POST["endDate"]);
              $course->setApplicationDeadline($_POST["applicationDeadline"]);
              $course->setLength($_POST["length"]);
              $course->setCost($_POST["cost"]);
              $course->setMaxStudents($_POST["maxStudents"]);
              if( $message = $course->update()) $messages = $message;

              if(!$messages){
                 
                  $this->redirect($this->getUserType(),"courses");
              }else{
                      $parameters["messages"] = $messages;
                      $this->show("editCourse",$parameters);
              }

      }else{
          $this->redirect($this->getUserType(),"courses");
      }
      
   }
   
   /**
    * activateUser
    *
    * @return void
    */
   public function activateUser(){
      if( isset($_POST['username']) ){
         $username = strtolower( filter_var($_POST['username'],FILTER_SANITIZE_STRING) );

         $user = User::listByParameters(["username" => $_POST['username']])[0];

         $user->setIsActive(true);


         $messages = $user->update() ;
            $this->redirect('admin','listUsers');
         
      }else{
         $this->redirect('admin','listUsers');
      }
   }
   
   /**
    * deleteUser
    *
    * @return void
    */
   public function deleteUser(){
      if( isset($_POST['username']) ){
         $username = strtolower( filter_var($_POST['username'],FILTER_SANITIZE_STRING) );

         $user = User::listByParameters(["username" => $_POST['username']])[0];

         if( $messages = $user->delete() ){
            $parameters['messages'] = $messages;
         }
            $this->redirect('admin','listUsers');
         
      }else{
         $this->redirect('admin','listUsers');
      }
   }
   
   /**
    * editUser
    *
    * @return void
    */
   public function editUser(){

      if( isset($_POST["save"]) ){
          $user = User::listById( strtoupper( filter_var($_POST["prevDni"],FILTER_SANITIZE_STRING) ));
          $message = null;
          $url = $user->getImage();
          $messages = null;
          if( $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ){   
              $messages = $this->uploadImage($_FILES['image'],$url);
          }
    
          if( !$messages ){
              $user->setUsername($_POST["username"]);
              $user->setName($_POST["name"]);
              $user->setSurname($_POST["surname"]);
              $user->setEmail($_POST["email"]);
              $user->setDni($_POST["dni"]);
              $user->setImage($url);
              if( $message = $user->update()) $messages = $message;

              if(!$messages){
                  $this->redirect($this->getUserType(),"listUsers");
              }else{
                      $parameters["messages"] = $messages;
                      $this->redirect("admin","listUsers",$parameters);
              }
          }else{
            $parameters["messages"] = $messages;
            $this->redirect("admin","listUsers",$parameters);
          }
      }else{
          $this->redirect($this->getUserType(),"listUsers");
      }
      
   }
   
   /**
    * addTeacher
    *
    * @return void
    */
   public function addTeacher(){
      $username = strtolower( filter_var( $_POST['username'], FILTER_SANITIZE_STRING) );
   
      $user = User::listByParameters(["username" => $username] )[0];


      if(!$user || $message = Teacher::addTeacher($user) ) $messages = $message;

      if(!$messages){
         $this->redirect($this->getUserType(),"teachers");
      }else{
               $parameters["messages"] = $messages;
               $this->show("teachers",$parameters);
      }
   }

      
   /**
    * adminTools
    *
    * @return void
    */
   public function adminTools(){
      $parameters = ["messages" => []];

      $this->show('adminTools',$parameters);
   }

   public function uploadStudentsFromExcel(){
      $url = "";
      $messages = [];
      if( $_FILES['excel'] ){
         
         if($message = $this->uploadExcel($_FILES['excel'],$url))$messages[]=$message;
       }

       ExcelReader::ExcelToStudents($url);

       $parameters = [
          "messages" => $messages
       ];

       echo $url;
       $this->show('adminTools',$parameters);
   }

   
  

}