<?php
class BaseController{

   public function uploadImage($image,&$url){
      $message = [];
      try {
   
         // Undefined | Multiple Files | $_FILES Corruption Attack
         // If this request falls under any of them, treat it invalid.
         if (
             !isset($image['error']) ||
             is_array($image['error'])
         ) {
             throw new RuntimeException('Invalid parameters.');
         }
     
         // Check $_FILES['upfile']['error'] value.
         switch ($image['error']) {
             case UPLOAD_ERR_OK:
                 break;
             case UPLOAD_ERR_NO_FILE:
                 throw new RuntimeException('No file sent.');
             case UPLOAD_ERR_INI_SIZE:
             case UPLOAD_ERR_FORM_SIZE:
                 throw new RuntimeException('Exceeded filesize limit.');
             default:
                 throw new RuntimeException('Unknown errors.');
         }
     
         // You should also check filesize here.
         if ($image['size'] > 1000000) {
             throw new RuntimeException('Exceeded filesize limit.');
         }
     
         // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
         // Check MIME Type by yourself.
         $finfo = new finfo(FILEINFO_MIME_TYPE);
         if (false === $ext = array_search(
             $finfo->file($image['tmp_name']),
             array(
                 'jpg' => 'image/jpeg',
                 'png' => 'image/png',
                 'gif' => 'image/gif',
             ),
             true
         )) {
             throw new RuntimeException('Invalid file format.');
         }
     
         // You should name it uniquely.
         // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
         // On this example, obtain safe unique name from its binary data.
         $url = sprintf(PHOTOS_FOLDER.'%s.%s',
         sha1_file($image['tmp_name']),
         $ext);
         if (!move_uploaded_file(
             $image['tmp_name'],
             $url
         )) {
             throw new RuntimeException('Failed to move uploaded file.');
         }
     
         //echo 'File is uploaded successfully.';
     
     } catch (RuntimeException $e) {
     
         $message= ["message" => $e->getMessage(), "type" => "danger"];
     
     }

     return $message;
   }

   public function uploadExcel($image,&$url){
      $message = [];
      try {
   
         // Undefined | Multiple Files | $_FILES Corruption Attack
         // If this request falls under any of them, treat it invalid.
         if (
             !isset($image['error']) ||
             is_array($image['error'])
         ) {
             throw new RuntimeException('Invalid parameters.');
         }
     
         // Check $_FILES['upfile']['error'] value.
         switch ($image['error']) {
             case UPLOAD_ERR_OK:
                 break;
             case UPLOAD_ERR_NO_FILE:
                 throw new RuntimeException('No file sent.');
             case UPLOAD_ERR_INI_SIZE:
             case UPLOAD_ERR_FORM_SIZE:
                 throw new RuntimeException('Exceeded filesize limit.');
             default:
                 throw new RuntimeException('Unknown errors.');
         }
     
         // You should also check filesize here.
         if ($image['size'] > 1000000) {
             throw new RuntimeException('Exceeded filesize limit.');
         }
     
         // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
         // Check MIME Type by yourself.
         $finfo = new finfo(FILEINFO_MIME_TYPE);
         if (preg_match("/ [.]xlsx$/",$image['tmp_name'])) {
             throw new RuntimeException('Invalid file format.');
         }
     
         // You should name it uniquely.
         // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
         // On this example, obtain safe unique name from its binary data.
         $url = sprintf(FILES_FOLDER.'%s.%s',
         sha1_file($image['tmp_name']),
         "xlsx");
         if (!move_uploaded_file(
             $image['tmp_name'],
             $url
         )) {
             throw new RuntimeException('Failed to move uploaded file.');
         }
     
         //echo 'File is uploaded successfully.';
     
     } catch (RuntimeException $e) {
     
         $message= ["message" => $e->getMessage(), "type" => "danger"];
     
     }

     return $message;
   }
    
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