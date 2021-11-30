<?php
class InitializationController{
   static function main(){
      //Requiere archivos con configuraciones.
      foreach (glob('config/*.php') as $filename) {
         require_once "$filename";
      }

      //Formamos el nombre del Controlador o el controlador por defecto
      if (!empty($_GET['controller'])) {
         $controller = ucwords($_GET['controller']);
      } else {
         $controller = DEFAULT_CONTROLLER;
      }

      //Lo mismo sucede con las acciones, si no hay accion tomamos index como accion
      if (!empty($_GET['action'])) {
         $action = $_GET['action'];
      } else {
         $action = DEFAULT_ACTION;
      }

      $controller .= "Controller";
      $controller_path = CONTROLLERS_FOLDER . $controller . '.php';

      //Incluimos el fichero que contiene nuestra clase controladora solicitada
      if (!is_file($controller_path)) {
         throw new \Exception('El controlador no existe ' . $controller_path . ' - 404 not found');
      }
      require $controller_path;

      if (!method_exists($controller, $action)){
         throw new \Exception($controller . '->' . $action . ' no existe');
      }

      //Si todo esta bien, creamos una instancia del controlador
      //  y llamamos a la accion
      $controller = new $controller();
      $controller->$action();
    }
}

?>