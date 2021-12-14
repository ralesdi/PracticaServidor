<?php

/**
 * Controlador de la página de entrada al portal desde la que se pueden hacer las funciones que te permita tu rol
 */
require_once CONTROLLERS_FOLDER.'UserController.php';
require_once MODELS_FOLDER . 'Teacher.php';
class TeacherController extends UserController{
   
   /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
      session_start();   // Todos los métodos de este controlador requieren autenticación
      if ( !isset($_SESSION['user']) OR !Teacher::isTeacher($_SESSION['user']) )  // Si no existe la sesión…
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
         "tituloventana" => "Bienvenid@ ".$this->user->getName(),
         "courses" => Course::getCourses($this->user)
      ];
      $this->show("index", $parameters);
   }
   
   /**
    * acceptApplication
    *
    * @return void
    */
   public function acceptApplication(){
      $id = $_POST['id'];
      $application = Application::listByParameters(["id" => $id])[0];
      $messages = [];
      $message = null;
      $application->setIsAccepted(true);

      if( $message = $application->update() ) $messages = $message;

      $parameters = [
         "messages" => $messages,
         "applications" => Application::listByParameters(['courseName' => $application->getCourseName()])
      ];

      $this->show("applicationList",$parameters);
   }
   
   /**
    * rejectApplication
    *
    * @return void
    */
   public function rejectApplication(){
      $id = $_POST['id'];
      $application = Application::listByParameters(["id" => $id])[0];
      $messages = [];
      $message = null;

      if( $message = $application->delete() ) $messages = $message;

      $parameters = [
         "messages" => $messages,
         "applications" => Application::listByParameters(['courseName' => $application->getCourseName()])
      ];

      $this->show("applicationList",$parameters);
   }
   
  

}