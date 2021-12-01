<?php
class BaseController{
    
    public static function show($name, $vars = array())
   {
      //Creamos la ruta real a la plantilla
      $path = VIEWS_FOLDER . ucwords($name). 'View.php';

      //Si no existe el fichero en cuestion, lanzamos una excepción
      if (file_exists($path) == false)
         throw new \Exception('La plantilla ' . $path . ' no existe');

      //Si hay variables para asignar, las pasamos una a una.
      if (is_array($vars)) {
         foreach ($vars as $key => $value) {
            $$key = $value;   // Es una variable variable, el valor de la variable hace de nombre de otra variable
         }
      }

      //Finalmente, incluimos el archivo plantilla o vista
      require_once($path);
   }

   public static function redirect($controlador = DEFAULT_CONTROLLER, $accion = DEFAULT_ACTION, $params = null)
   {
      if ($params != null) {
         $urlpar="";
         foreach ($params as $key => $valor) {
            $urlpar .= "&$key=$valor";
         }
         header("Location: ?controller=" . $controlador . "&action=" . $accion . $urlpar);
      } else {
         header("Location: ?controller=" . $controlador . "&action=" . $accion);
      }
   }
}



?>