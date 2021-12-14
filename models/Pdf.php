<?php
require_once LIBRARY_FOLDER . "fpdf/fpdf.php";
class PDF extends FPDF
{
    private $title;
    public function __construct($title="")
    {
        parent::__construct();
        $this->title = $title;
    }
    // Funcion encargado de realizar el encabezado
    public function Header()
    {
        // Logo
        //$this->Image('logo.jpg', 10, -1, 70);
        $this->SetFont('Arial', 'B', 13);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(95, 10, $this->title, 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }
    // Funcion pie de pagina
    public function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    public static function Print($objects,$title,$sensitiveInformation){
        $pdf = new PDF($title);
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', 'B', 8);
        $class = ( get_class($objects[0]));
        $vars = $class::getVars($sensitiveInformation);

        $width = $class::getWidths();
        
        //Declaramos el encabezado de la tabla
        foreach ($vars as $key => $value) {
            if(!isset($width[$key])){
                $width[$key] = 14;
            }
            $pdf->Cell($width[$key], 12, $key, 1);
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 7);

        foreach ($objects as $object) {
            foreach($vars as $key => $value){
                $getter = "get$key";
                $pdf->Cell($width[$key], 6, $object->$getter(), 1);
            }
            $pdf->Ln();
        }
        /*
        foreach ($result as $row) {
            $pdf->Cell($w[0], 6, $row['idp'], 1);
            $pdf->Cell($w[1], 6, $row['personal_nombre'], 1);
            $pdf->Cell($w[2], 6, $row['personal_edad'], 1);
            $pdf->Cell($w[3], 6, number_format($row['personal_salario']), 1);
            $pdf->Cell($w[3], 6, $row['fecha'], 1);
            $pdf->Ln();
        }*/
        $pdf->Output();
    }
}

?>