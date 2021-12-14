<?php
require LIBRARY_FOLDER . 'phpoffice/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
class ExcelReader{
    public static function ExcelToStudents($url){
        $excel = IOFactory::load($url);
        $sheetData = $excel->getActiveSheet()->toArray(null,true,true,true);

        echo count($sheetData);
        foreach($sheetData as $data){
            echo "$data<br>";
        }
    }
}

?>