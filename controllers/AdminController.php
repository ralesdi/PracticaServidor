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
         "teachers" => []
      ];
      $this->show("CreateCourse", $parameters);
   }




   
  

}