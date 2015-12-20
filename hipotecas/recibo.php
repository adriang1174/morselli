<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "recibo.php");
define('FPDF_FONTPATH',RelativePath.'/includes/font/');
include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");

//include(RelativePath.'/includes/Campos.inc.php');
include(RelativePath.'/includes/fpdf.php');
require "numerosALetras.class.php";
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

$error = false;

//
// Traemos los datos del request
//
$nrorecibo = $_REQUEST['nrorec'];
$autopuni = $_REQUEST['autopuni'];

$cuotas = $_REQUEST['cuotas'];
$contrato = $_REQUEST['idhipoteca'];
if (!empty($_REQUEST['otros']))
	$otros = $_REQUEST['otros'];
else
	$otros = 0;
$observaciones = $_REQUEST['observaciones'];

$fecha = date('d/m/Y');

//Verificar si las cuotas no han sido pagadas ya
//
$conn = new clsDBConnection1();
$sql = "EXEC sp_verifica_cuotas_pagadas_hipoteca '".$cuotas."'";
$conn->query($sql); 
$conn->next_record();
$pagada = $conn->f('resultado');

if($pagada > 0)
{
	header('Location: cuota_pagada.php');
	exit();
}

//////////////
//
// Averiguamos datos de deudor, prop, hipoteca, etc
//
$conn = new clsDBConnection1();
$sql = "select p.idpropiedad,p.direccion,p.localidad,h.idhipoteca,m.descripcion as moneda,m.simbolo,
f.nombre as nombre_deudor, tc.descripcion as tipo_iva, f.cuit,h.fechafin
from fichas f
inner join fichaspropiedades fp on fp.idficha = f.idficha
inner join propiedades p on p.idpropiedad = fp.idpropiedad
inner join hipotecas h on h.idpropiedad = fp.idpropiedad
inner join tipocontribuyente tc on tc.idtipocontribuyente = f.idtipocontribuyente
inner join monedas m on h.idmoneda = m.idmoneda
where
 h.idhipoteca = " . $contrato;
 $conn->query($sql);
 $conn->next_record();

$nombre_deudor = $conn->f('nombre_deudor');
$moneda = $conn->f('moneda');
$moneda_simbolo = $conn->f('simbolo');
$domicilio = $conn->f('direccion');
$localidad = $conn->f('localidad');

////////////////////////
//
// Creamos el pdf y tantas paginas como recibos vayamos a imprimir
//
$pdf=new PDF();
$pdf->AliasNbPages();
//echo "EXEC sp_pago_cuotas_hipoteca ".$nrorecibo.",".$contrato.",'".$cuotas."',".$otros;
//$conn->query("EXEC sp_pago_cuotas_hipoteca ".$nrorecibo.",".$autopuni.",".$contrato.",'".$cuotas."',".$otros); 
$conn->query("EXEC sp_pago_cuotas_hipoteca ".$nrorecibo.",".$contrato.",'".$cuotas."',".$otros); 
while($conn->next_record()){
   /// nueva_pagina_recibo aca van varias pagins 
   $nrocuota = $conn->f('nrocuota');
   $cuota = $conn->f('importe');
   //$fvenc = $conn->f('fechavencimiento');
   $fvenc = date("j/n/Y",strtotime(substr($conn->f('fechavencimiento'),0,10)));
   $adic = $conn->f('otros');
   //$total = number_format($cuota + $adic,2);
	$total = $cuota + $adic;
   //var_dump($total);
   $n = new numerosALetras ( $total ) ;
   $total_letras = $n->resultado;
   $total = number_format($total,2,',','.');
   $cuota = number_format($cuota,2,',','.');   	
   $adic  = number_format($adic,2,',','.');        
//   var_dump($total_letras);

   pdfPage($pdf);
}
$pdf->Output();


/*********************************************************************/

//Escribe PDF
//
function pdfPage($pdf)
{
	global $nrorecibo,$contrato,$fecha,$nombre_deudor,$moneda,$total_letras,$nrocuota,
	$domicilio,$localidad,$fvenc,$moneda_simbolo,$cuota,$total,$observaciones,$adic;

//Carga de datos

	if (!$error)
	{
	$pdf->AddPage();

	$pdf->Ln(18);
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
	$pdf->Cell(90,10,$domicilio);
	$pdf->Cell(35,10,'de la localidad de ');
	$pdf->Cell(50,10,$localidad);
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
	$pdf->Cell(60,10,'Punitorios.....');
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
	$pdf->Cell(170,10,'OBSERVACIONES: ' . $observaciones,'T');

	//$pdf->Output();
	}
	else
	{
	//$pdf=new PDF();
	//$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,12,'Error al generar un recibo',0,0,'L');
	}
}
?>