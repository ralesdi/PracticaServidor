<?php

interface DataBaseModel{

    public function parametersToArray();

    public function idToArray();
    
    public function save();

    public function update();

    public function delete();

    public static function listAll();

    public static function listById($id);

    
}

?>