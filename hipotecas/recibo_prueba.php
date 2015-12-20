<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "recibo_prueba.php");
define('FPDF_FONTPATH',RelativePath.'/includes/font/');
include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");

//include(RelativePath.'/includes/Campos.inc.php');
include(RelativePath.'/includes/fpdf.php');
require "numerosALetras.class.php";

$error = false;

$fecha = '23/09/2008';
$nrorecibo = '6';
$nombre_deudor = 'MARTINO, JUAN MANUEL';
$contrato = '3409';
$moneda = 'DOLARES';
$moneda_simbolo = 'u$s';
$nrocuota = '6';
$domicilio = 'LUIS VIALE NRO 3108/10, PB 1';
$localidad = 'C.A.B.A.';
$fvenc = '23/09/2008';
$cuota = '170.00';
$adic = '0.00';
$total = number_format($cuota + $adic,2);
//var_dump($total);

$n = new numerosALetras ( $total ) ;
$total_letras = $n->resultado;

/*********************************************************************/

//Escribe PDF
//
class PDF extends FPDF
{
//Cabecera de p·gina
function Header()
{
    //Logo

    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //TÌtulo
    $this->Cell(30,10,'',0,'C');
    //Salto de lÌnea
    $this->Ln(17);
}

//Pie de p·gina
function Footer()
{
    //PosiciÛn: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Nmero de p·gina
#	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

//Carga de datos

if (!$error)
{
//CreaciÛn del objeto de la clase heredada
#function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Ln();
//$pdf->Ln();
//$pdf->Ln();

//Cabecera
//$pdf->Cell(180,30,'',1);

//$pdf->SetXY($pdf->GetX()-175,$pdf->GetY());
//$pdf->SetLeftMargin(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(22,10,'Nro de recibo ');
$pdf->Cell(15,10,$nrorecibo); 
$pdf->Cell(35,10,'Nro de carpeta ');
$pdf->Cell(15,10,$contrato); 
$pdf->Cell(30,10,$fecha,0,0,'R'); 
$pdf->Ln(8);
$pdf->Cell(100,10,'Por cuenta y orden de los acreedores recibi de los Sr(a)/s ');
$pdf->Ln(8);
$pdf->Cell(5,10,'');
$pdf->Cell(60,10,$nombre_deudor);
$pdf->Ln(20);
$pdf->Cell(35,10,'la cantidad de ');
$pdf->Cell(30,10,$moneda); 
$pdf->Ln(8);
$pdf->Cell(170,10,$total_letras.'---------------------'); 
$pdf->Ln(8);
$pdf->Cell(30,10,'Por la cuota nro ');
$pdf->Cell(15,10,$nrocuota); 
$pdf->Cell(100,10,'sobre la propiedad puesta en garantía ubicada en ');
$pdf->Ln(8);
$pdf->Cell(70,10,$domicilio);
$pdf->Cell(35,10,'de la localidad de ');
$pdf->Cell(70,10,$localidad);
$pdf->Ln(8);
$pdf->Cell(45,10,'con fecha de vencimiento ');
$pdf->Cell(30,10,$fvenc); 
$pdf->Ln(10);
$pdf->Cell(5,10,'');
$pdf->Cell(60,10,'Cuota............................................');
$pdf->Cell(15,10,$moneda_simbolo); 
$pdf->Cell(20,10,$cuota,0,0,'R'); 
$pdf->Ln(8);
$pdf->Cell(5,10,'');
$pdf->Cell(60,10,'Gestión cobranza + punitorios.....');
$pdf->Cell(15,10,$moneda_simbolo); 
$pdf->Cell(20,10,$adic,0,0,'R'); 
$pdf->Ln(8);
$pdf->Cell(5,10,'');
$pdf->Cell(60,10,'Total.............................................');
$pdf->Cell(15,10,$moneda_simbolo); 
$pdf->Cell(20,10,$total,0,0,'R');
$pdf->Ln(10);
$pdf->Cell(100,10,'');
$pdf->Cell(70,10,'p/ O. MORSELLI E HIJOS','T');
$pdf->Ln(10);
$pdf->Cell(170,10,'OBSERVACIONES: Los fondos recibidos serán entregados a los acreedores','T');

$pdf->Output();
}
else
{
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,12,'Error al generar una factura',0,0,'L');
}
?>