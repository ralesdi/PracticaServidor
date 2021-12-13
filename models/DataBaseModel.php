<?php

abstract class DataBaseModel{

    public function idToArray(){
        $values = get_object_vars($this);
        return [array_key_first($values) => $values[array_key_first($values)]];
    }

    public static function valid($regex,$attribute,$errorMessage){
        $message = null;
        if( !preg_match($regex,$attribute) ){
                $message = ["message" => $errorMessage, "type" => "danger"];        
        }         

        return $message;
        
    }

    protected function validId(){
        return null;
    }

    public function validateDataIntegrity(){
        $messages = [];
        $vars = get_object_vars($this);

        foreach ($vars as $name => $value) {
            $function = "valid$name";

            if( $message = $this->$function() ){
                $messages[] = $message;
            }
        }

        return $messages;
    }
    
    public function save(){
        $messages = $this->validateDataIntegrity();

        if( !$messages )
            $messages = DataBase::insert(get_class($this), get_object_vars($this));

        return $messages;
    }

    public function update(){
        
        $messages = $this->validateDataIntegrity();

        if( !$messages )
            $messages = DataBase::update(get_class($this), get_object_vars($this), $this->idToArray());

        return $messages;
    }

    public function delete(){
        $messages = $this->validateDataIntegrity();

        if( !$messages )
            $messages = DataBase::delete(get_class($this),$this->idToArray());

        return $messages;
    }

    public static function listAll(){
        return DataBase::getAll(get_called_class());
    }

    public static function listById($id){
        return DataBase::getRowsByParameter(get_called_class(),[array_key_first(get_class_vars(get_called_class())) => $id])[0];
    }

    public static function listByParameters($parameters){
        return DataBase::getRowsByParameter(get_called_class(),$parameters);
    }

    public static function totalNumber(){
        return DataBase::getNumberOfRows(get_called_class());
    }

    public static function listAllPages($start,$numRegisters){
        
        return DataBase::getAllPage(get_called_class(),$start,$numRegisters);
    }

    public static function pages($itemsPerPage){
        $num = count(DataBase::getAll(get_called_class()));
        $pages =  ceil($num/$itemsPerPage);
        return $pages;
    }

    public static function getVars($sensitiveInformation=false){
        return get_class_vars(get_called_class());
    }

    public static function getWidths(){
        $vars = get_class_vars(get_called_class());
        $widths = [];
        foreach ($vars as $key => $value) {
            $widths[$key] = 190/count($vars);
        }

        return $widths;
    }
    
}

?>