<?php
class DataBase {
    /*
    private static $dbHost = '192.168.64.2';
    private static $dbName = 'academia';
    private static $dbUser = 'administrador';
    private static $dbPass= '';
    */

    private static function parametersToList($parameters){
        $string[0] = "";
        $string[1] = "";
        foreach ($parameters as $key => $value) {
            
            $string[0] .= "$key,";
            $string[1] .= ":$key,";
        }
        $string[0] = substr($string[0],0,-1);
        $string[1] = substr($string[1],0,-1);

        return $string;
    }

    public static function connect(){
        try{
            //Se conecta a la base de datos
            $connection = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASS);
            $connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo '<div class="alert alert-success">' . "Conectado a la  Base de Datos de usuarios!! :)" . '</div>';
        }catch (PDOException $ex){
            //echo '<div class="alert alert-danger">' . "No se pudo conectar a la Base de Datos de usuarios!! :( <br/>" .$ex->getMessage(). '</div>';
        }
        return $connection;
    }

    public static function insert($table,$parameters){ // INSERRT INTO USER('')
        $connection = DataBase::connect();
        $message = [];
        try{  //Definimos la instrucción SQL parametrizada
            $string = DataBase::parametersToList($parameters);

            $sql = "INSERT INTO $table($string[0])
                           VALUES ($string[1])";
            // Preparamos la consulta...
            $query = $connection->prepare($sql); 
            // y la ejecutamos indicando los valores que tendría cada parámetro
            $query->execute ($parameters);
            
            
          }catch (PDOException $ex){
                $error = $ex->errorInfo[2];
                    $message = ["message" => $error, "type" => "danger"];
          }

          return $message;
    }

    public static function update($table,$parameters,$PrimaryKeys){
        $connection = DataBase::connect();
        $message = [];
        try{
            $updateString = "";

            //convetirmos los parametros en la forma "p1=:p1, p2=:p2, etc."
            foreach ($parameters as $key => $value) {
                $updateString.= "$key=:$key,";
            }
            $updateString = substr($updateString,0,-1);

            $pkString = "";
            foreach ($PrimaryKeys as $key => $value) {
                $pkString.= "$key=:$key AND";
            }
            $pkString = substr($pkString,0,-3);

            $sql = "UPDATE $table SET $updateString WHERE $pkString";
            $query = $connection->prepare($sql); 
            $query->execute($parameters);

            
        }catch(PDOException $ex){
            $error = $ex->errorInfo[2];
                    $message[] = ["message" => $error, "type" => "danger"];
        }

        return $message;
    }

    public static function delete($table,$PrimaryKeys){
        $connection = DataBase::connect();
        $parameters = $PrimaryKeys;
        $message = [];
        try{
            $pkString = "";
            foreach ($parameters as $key => $value) {
                $pkString.= "$key=:$key AND";
            }
            $pkString = substr($pkString,0,-3);

            $sql = "DELETE FROM $table WHERE $pkString";
            $query = $connection->prepare($sql); 
            $query->execute($parameters);

           
        }catch(PDOException $ex){
            $error = $ex->errorInfo[2];
                    $message[] = ["message" => $error, "type" => "danger"];
        }
        return $message;
    }

    public static function getNumberOfRows($table){
        $connection = DataBase::connect();
        $number = 0;

        try{
            $sql = "SELECT COUNT(*) FROM $table";
            $query = $connection->prepare($sql); 
            $query->execute();
            $number = $query->fetchColumn();
        }catch(PDOException $ex){

        }

        return $number;
    }

    public static function getNumberOfRowsByParameters($table,$parameters){
        $connection = DataBase::connect();
        $number = 0;

        try{
            $string = "";
            foreach ($parameters as $key => $value) {
                $string.= "$key=:$key AND";
            }
            $string = substr($string,0,-3);
            
            $sql = "SELECT COUNT(*) FROM $table WHERE $string";
            $query = $connection->prepare($sql); 
            $query->execute($parameters);
            $number = $query->fetchColumn();
        }catch(PDOException $ex){

        }

        return $number;

    }

    public static function getRowsByParameter($table,$parameters){
        $connection = DataBase::connect();
        $usuarios = null;
        try{
            $string = "";
            $selected = "";
            foreach ($parameters as $key => $value) {
                $string.= "$key=:$key AND";
            }
            $string = substr($string,0,-3);

            $sql = "SELECT * FROM $table WHERE $string";
            $query = $connection->prepare($sql); 
            $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $table);
            $query->execute($parameters);
            
            $usuarios = $query->fetchAll();
            
        }catch(PDOException $ex){

        }

        return $usuarios;
    }

    public static function getRowsByParameterPage($table,$parameters,$desde,$numRegistros){
        $connection = DataBase::connect();
        $usuarios = null;
        try{
            $string = "";
            $selected = "";
            foreach ($parameters as $key => $value) {
                $string.= "$key=:$key AND";
            }
            $string = substr($string,0,-3);

            $sql = "SELECT * FROM $table WHERE $string LIMIT $numRegistros OFFSET $desde";
            $query = $connection->prepare($sql); 
            $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $table);
            $query->execute($parameters);
            
            $usuarios = $query->fetchAll();
            
        }catch(PDOException $ex){

        }

        return $usuarios;
    }

    public static function getAll($table){
        $connection = DataBase::connect();
        $usuarios = null;
        try{

            $sql = "SELECT * FROM $table";
            $query = $connection->prepare($sql); 
            $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $table);
            $query->execute();
            
            $usuarios = $query->fetchAll();
            
        }catch(PDOException $ex){

        }

        return $usuarios;
    }

    public static function getAllTable($table,$start,$numRegisters){
        $connection = DataBase::connect();
        $usuarios = null;
        try{

            $sql = "SELECT * FROM $table LIMIT $numRegisters OFFSET $start";
            $query = $connection->prepare($sql); 
            $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $table);
            $query->execute();
            
            $usuarios = $query->fetchAll();
            
        }catch(PDOException $ex){

        }

        return $usuarios;
    }

    public static function getAllPage($table,$desde,$numRegistros){
        $connection = DataBase::connect();
        $usuarios = null;
        try{

            $sql = "SELECT * FROM $table LIMIT $numRegistros OFFSET $desde";
            $query = $connection->prepare($sql); 
            $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $table);
            $query->execute();
            
            $usuarios = $query->fetchAll();
            
        }catch(PDOException $ex){

        }

        return $usuarios;
    }

    
}

?>