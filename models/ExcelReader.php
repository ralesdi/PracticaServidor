<?php
require_once LIBRARY_FOLDER . 'phpExcell/PHPExcel/IOFactory.php';
class ExcelReader{
    public static function ExcelToStudents($url){
        $excel = PHPExcel_IOFactory::load($url);
        $sheetData = $excel->getActiveSheet()->toArray(null,true,true,true);

        echo count($sheetData);
        foreach($sheetData as $data){
            echo "$data<br>";
        }
    }
}

?>