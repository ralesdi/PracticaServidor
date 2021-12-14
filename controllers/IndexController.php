<?php
/**
 * Controlador de la página abierta de inicio del sitio, desde la que se puede hacer el login y el registro
 * y otros métodos que no requieran estar autenticado
 */

 /**
 * Incluimos todos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'User.php';
require_once MODELS_FOLDER . 'Student.php';
require_once MODELS_FOLDER . 'Teacher.php';
require_once MODELS_FOLDER . 'Admin.php';
require_once MODELS_FOLDER . 'Course.php';
require_once CONTROLLERS_FOLDER.'BaseController.php';
class IndexController extends BaseController
{

   public function __construct()
   {

   }

   /**
    * Muestra la página del sitio no autenticada
    *
    * @return void
    */
   public function index()
   {
      $this->show("IndexGuest");
   }

   /**
    * Muestra la vista de login
    *
    * @return void
    */
   public function login()
   {
      $parametros = [
         "messages" => [],
         "dni" => "",
         "password" => "",
         "rememberme" => ""
      ];

      if( isset($_COOKIE["dni"]) ){
         $parametros["dni"] = $_COOKIE["dni"];
      }

      if( isset($_COOKIE["password"]) ){
         $parametros["password"] = $_COOKIE["password"] ;
      }

      if( isset($_COOKIE["rememberme"]) ){
         $parametros["rememberme"] =  $_COOKIE["rememberme"] ;
      }
      $this->show("Login", $parametros);
   }

   public function notActive()
   {
      $parametros = [
         "messages" => []
      ];
      $this->show("notactive", $parametros);
   }

   

   /**
    * Maneja la solicitud de petición de login
    * Recibo de POST los datos de login y usuario
    *
    * @return void
    */
    public function autenticate()
    {
      if(isset($_POST['submit'])){
         // Pulso el botón Entrar del login. El login es el nombre
         $user = User::validateInDB($_POST["dni"],sha1($_POST["password"]));
         
         if($user){
            // Comienzo sesión y guardo los datos del usuario autenticado
            if( $user->isActive() ){
               session_start();
               $_SESSION['user'] = $user;

               if( isset($_POST['rememberme']) AND $_POST['rememberme']=='on'){
                  setcookie ('dni' ,$_POST['dni'] ,time() + (15 * 24 * 60 * 60)); 
                  setcookie ('password',$_POST['password'],time() + (15 * 24 * 60 * 60));
                  setcookie ('rememberme',$_POST['rememberme'],time() + (15 * 24 * 60 * 60));
               } else {  //Si no está seleccionado el checkbox..
                  // Eliminamos las cookies
                  if(isset($_COOKIE['usuario'])) { 
                     setcookie ('dni',""); } 
                  if(isset($_COOKIE['password'])) { 
                     setcookie ('password',""); } 
                  if(isset($_COOKIE['recuerdo'])) { 
                     setcookie ('rememberme',""); }    
               }
               
               $this->redirect("user","index");
            //$this->redirect("home","index");
            }else{
               $this->redirect("index","notActive");
            }
            
            
         }else { // Autenticación no correcta
            $parametros = [
               "messages" => [[
                              "type" => "danger",
                              "message" => "¡El usuario o la contraseña no son correctos!"]
                           ]
            ];
            $this->show("Login", $parametros);
         }
      }else{
         // Caso raro de que entre con la url ?controller=index&action=autenticate
         $this->redirect("index","login");
      } 
    }

   /**
    * Muestra la vista de registro
    *
    * @return void
    */
   public function register()
   {
      $parametros = [
         "messages" => []
      ];
      $this->show("Register", $parametros);
   }

   /**
    * Procesar la vista de registro
    *
    * @return void
    */
    public function completeRegister()
    {
       $url = null;
       $messages = [];
       $message = null;

      if(!$_POST['g-recaptcha-response']){
         $messages = [ ["message" => "Error con el captcha", "type" => "danger"] ];
      }
      if( $_FILES['image'] && !$messages ){
        if($message = $this->uploadImage($_FILES['image'],$url))$messages[]=$message;
      }
      
      if( !$messages ){
       $user = new User($_POST["dni"],$_POST["username"],$_POST["name"],
                                              $_POST["surname"],$_POST["email"],sha1($_POST["password"]),$url);

      $messages = $user->save();

   
      }
      $parametros = [ "messages" => $messages];
      if( !$messages ){
         $this->redirect("index","login");
      }else{
         
         $this->show("register",$parametros);
      }
     


    }

  
}