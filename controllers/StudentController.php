<?php

/**
 * Controlador de la página de entrada al portal desde la que se pueden hacer las funciones que te permita tu rol
 */
require_once CONTROLLERS_FOLDER.'UserController.php';
require_once MODELS_FOLDER . 'Student.php';
class StudentController extends UserController{


   public function index()
   {
      $parameters = [
         "tituloventana" => "Bienvenid@, ".$this->user->getName()."!",
         "courses" => []
      ];

      $parameters["courses"] = Application::getAllCoursesEnrolled($this->user->getUsername());
      $this->show("index", $parameters);
   }

   
  

}