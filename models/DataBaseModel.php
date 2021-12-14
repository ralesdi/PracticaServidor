<?php

abstract class DataBaseModel{
    
    /**
     * idToArray
     *
     * @return void
     */
    public function idToArray(){
        $values = get_object_vars($this);
        return [array_key_first($values) => $values[array_key_first($values)]];
    }
    
    /**
     * valid
     *
     * @param  mixed $regex
     * @param  mixed $attribute
     * @param  mixed $errorMessage
     * @return void
     */
    public static function valid($regex,$attribute,$errorMessage){
        $message = null;
        if( !preg_match($regex,$attribute) ){
                $message = ["message" => $errorMessage, "type" => "danger"];        
        }         

        return $message;
        
    }
    
    /**
     * validId
     *
     * @return void
     */
    protected function validId(){
        return null;
    }
    
    /**
     * validateDataIntegrity
     *
     * @return void
     */
    public function validateDataIntegrity(){
        $messages = null;
        $vars = get_object_vars($this);

        foreach ($vars as $name => $value) {
            $function = "valid$name";

            if( $message = $this->$function() ){
                $messages[] = $message;
            }
        }

        return $messages;
    }
        
    /**
     * save
     *
     * @return void
     */
    public function save(){
        $messages = $this->validateDataIntegrity();

        if( !$messages )
            if($message = DataBase::insert(get_class($this), get_object_vars($this)))$messages[] = $message;
        

        return $messages;
    }
    
    /**
     * update
     *
     * @return void
     */
    public function update(){
        
        $messages = $this->validateDataIntegrity();

        if( !$messages )
            $messages = DataBase::update(get_class($this), get_object_vars($this), $this->idToArray());

        return $messages;
    }
    
    /**
     * delete
     *
     * @return void
     */
    public function delete(){
        $messages = $this->validateDataIntegrity();

        if( !$messages )
            $messages = DataBase::delete(get_class($this),$this->idToArray());

        return $messages;
    }
    
    /**
     * listAll
     *
     * @return void
     */
    public static function listAll(){
        return DataBase::getAll(get_called_class());
    }
    
    /**
     * listById
     *
     * @param  mixed $id
     * @return void
     */
    public static function listById($id){
        return DataBase::getRowsByParameter(get_called_class(),[array_key_first(get_class_vars(get_called_class())) => $id])[0];
    }
    
    /**
     * listByParameters
     *
     * @param  mixed $parameters
     * @return void
     */
    public static function listByParameters($parameters){
        return DataBase::getRowsByParameter(get_called_class(),$parameters);
    }
    
    /**
     * totalNumber
     *
     * @return void
     */
    public static function totalNumber(){
        return DataBase::getNumberOfRows(get_called_class());
    }
    
    /**
     * listAllPages
     *
     * @param  mixed $start
     * @param  mixed $numRegisters
     * @return void
     */
    public static function listAllPages($start,$numRegisters){
        
        return DataBase::getAllPage(get_called_class(),$start,$numRegisters);
    }
    
    /**
     * pages
     *
     * @param  mixed $itemsPerPage
     * @return void
     */
    public static function pages($itemsPerPage){
        $num = count(DataBase::getAll(get_called_class()));
        $pages =  ceil($num/$itemsPerPage);
        return $pages;
    }
    
    /**
     * getVars
     *
     * @param  mixed $sensitiveInformation
     * @return void
     */
    public static function getVars($sensitiveInformation=false){
        return get_class_vars(get_called_class());
    }
    
    /**
     * getWidths
     *
     * @return void
     */
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