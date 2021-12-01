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
         "messages" => []
      ];
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
         $user = User::validateInDB($_POST["username"],$_POST["password"]);
         
         if($user){
            // Comienzo sesión y guardo los datos del usuario autenticado
            if( $user->isActive() ){
               session_start();
               $_SESSION['user'] = $user;
               
               if(Student::isStudent($user)){
                  $this->redirect("student","index");;
               }else if(Teacher::isTeacher($user)){
                  //controlador teacher
               }else if(Admin::isAdmin($user)){
                  //controlador admin
               }
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
       $id = User::totalUsuarios();
       $user = new User($id,$_POST["dni"],$_POST["username"],$_POST["name"],
                                              $_POST["surname"],$_POST["email"],$_POST["password"]);

      $messages = $user->save();

      $parametros = [ "messages" => $messages];
      if( count($messages) == 0 ){
         $this->redirect("index","login");
      }else{
         $this->show("register",$parametros);
      }
     


    }

  
}