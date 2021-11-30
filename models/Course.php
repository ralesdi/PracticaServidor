<?php

require_once MODELS_FOLDER."DataBase.php";
require_once MODELS_FOLDER."DataBaseModel.php";
class Course implements DataBaseModel{
    private $name;
    private $code;

    public function __construct($name = "DEFAULT COURSE",$code=null)
    {
        $this->name = $name;

        if(is_null($code)){
            $words = explode(" ",$name);
            $this->code = "";
            foreach ($words as $word) {

                if($word !== "de" && $word !=="en" && $word !== "para")
                    $this->code.=$word[0];
            }
            $this->code .= "-".rand(1000,9999);
        }else{
            $this->code = $code;
        }
    }

    public function parametersToArray(){
        return get_object_vars($this);
    }

    public function idToArray(){
        return ["code" => $this->code];
    }
    
    public function save(){
        DataBase::insert("Course",["name"=>$this->name,
                                   "code" => $this->code]);
    }

    public function update(){
        DataBase::update("Course",["name" => $this->name, "code" => $this->code],["code" => $this->code]);
    }

    public function delete(){
        DataBase::delete("Course",["code" => $this->code]);
    }

    public static function listAll(){

    }

    public static function listById($id){

    }


}


?>