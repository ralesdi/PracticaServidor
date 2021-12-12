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
         "tituloventana" => "Inicio de la aplicación autenticado"
      ];
      $this->show("index", $parameters);
   }

   
  

}