<?php

abstract class DataBaseModel{

    public function idToArray(){
        $id = get_object_vars($this);
        return [array_key_first($id) => $id[array_key_first($id)]];
    }

    public static function valid($regex,$attribute,$errorMessage){
        $message = null;
        if( !preg_match($regex,$attribute) ){
                $message = ["message" => $errorMessage, "type" => "danger"];        
        }         

        return $message;
        
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

    
}

?>