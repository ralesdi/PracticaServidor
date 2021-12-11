<?php

/**
 * Controlador de la página de entrada al portal desde la que se pueden hacer las funciones que te permita tu rol
 */
require_once CONTROLLERS_FOLDER.'UserController.php';
require_once MODELS_FOLDER . 'Admin.php';
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




   
  

}