<?php
/**
 * Inclusión de los archivos que contienen las clases de core
 * Cuando PHP usa una clase que no encuentra va a llamar a la función anónima definida en el callback
 * que requiere (incluye) la clase
 * @return void
 */
require_once "./controllers/InitializationController.php";
try {
   //Lo iniciamos con su método estático main.
   InitializationController::main();
} catch (\Exception $e) { // Tratamiento último de errors
   echo "Error general en la app: " . $e->getMessage();
}

?>