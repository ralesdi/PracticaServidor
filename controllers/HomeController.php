<?php

/**
 * Controlador de la página de entrada al portal desde la que se pueden hacer las funciones que te permita tu rol
 */
require_once CONTROLLERS_FOLDER.'BaseController.php';
class HomeController extends BaseController{
   public function __construct()
   {
      
      session_start();   // Todos los métodos de este controlador requieren autenticación
      if ((!isset($_SESSION['user'])))  // Si no existe la sesión…
      { 
         $this->redirect("index", "login");
      }
   }

   public function index()
   {
      $parametros = [
         "tituloventana" => "Inicio de la aplicación autenticado"
      ];
      $this->show("index", $parametros);
   }

   public function logout()
   {
      session_start();
      session_unset();
      session_destroy();
      $this->redirect("index", "index");
   }
}