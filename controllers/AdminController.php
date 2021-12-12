<?php

/**
 * Controlador de la página de entrada al portal desde la que se pueden hacer las funciones que te permita tu rol
 */
require_once CONTROLLERS_FOLDER.'UserController.php';
require_once MODELS_FOLDER . 'Admin.php';
require_once MODELS_FOLDER . 'Teacher.php';
class AdminController extends UserController{

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

   public function index()
   {
      $parameters = [
         "tituloventana" => "Inicio de la aplicación autenticado ADMIN"
      ];
      $this->show("index", $parameters);
   }

   public function createCourse()
   {
      $parameters = [
         "messages" => [],
         "teachers" => Teacher::listAll()
      ];
      $this->show("CreateCourse", $parameters);
   }

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
                $course = new Course($_POST['name'],$_POST['description'],$_POST['teacher'],
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

   public function activateUser(){
      if( isset($_POST['username']) ){
         $username = strtolower( filter_var($_POST['username'],FILTER_SANITIZE_STRING) );

         $user = User::listByParameters(["username" => $_POST['username']])[0];

         $user->setIsActive(true);

         $parameters = 
        [
            "users" => User::listAllActive(),
            "unactiveUsers" => User::listAllUnactive()
        ];

         if( $messages = $user->update() ){
            $parameters['messages'] = $messages;
            $this->show('listUsers',$parameters);
         }else{
            $this->redirect('admin','listUsers');
         }
      }else{
         $this->redirect('admin','listUsers');
      }
   }

   public function deleteUser(){
      if( isset($_POST['username']) ){
         $username = strtolower( filter_var($_POST['username'],FILTER_SANITIZE_STRING) );

         $user = User::listByParameters(["username" => $_POST['username']])[0];

         $parameters = 
        [
            "users" => User::listAllActive(),
            "unactiveUsers" => User::listAllUnactive()
        ];

         if( $messages = $user->delete() ){
            $parameters['messages'] = $messages;
            $this->show('listUsers',$parameters);
         }else{
            $this->redirect('admin','listUsers');
         }
      }else{
         $this->redirect('admin','listUsers');
      }
   }

   public function editUser(){
      $parameters = 
        [
            "messages" => [],
            "users" => User::listAllActive()
        ];

        if($this->getUserType()=='admin'){
            $parameters["unactiveUsers"] = User::listAllUnactive();
        }

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
                      $this->show("listUsers",$parameters);
              }
          }else{
            $parameters["messages"] = $messages;
            $this->show("listUsers",$parameters);
          }
      }else{
          $this->redirect($this->getUserType(),"listUsers");
      }
      
   }

   public function teachers(){
      $parameters = [
         "teachers" => Teacher::listAll(),
         "messages" => []
      ];

      $this->show('teachers',$parameters);
   }

   public function addTeacher(){
      $username = strtolower( filter_var( $_POST['username'], FILTER_SANITIZE_STRING) );
   
      $user = User::listByParameters(["username" => $username] )[0];


      if( $message = Teacher::addTeacher($user)) $messages = $message;

      if(!$messages){
         $this->redirect($this->getUserType(),"teachers");
      }else{
               $parameters["messages"] = $messages;
               $this->show("teachers",$parameters);
      }
   }


   
  

}