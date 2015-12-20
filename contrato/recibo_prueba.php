<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/contrato/");
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

$firma = "O. MORSELLI E HIJOS";
$fecha = date("d/m/Y");
$nroliq = "3";
//$liquida = $_REQUEST['liquida'];
//$ficha = $_REQUEST['ficha'];
//$idalquiler = $_REQUEST['idalquiler'];

$total = 0;
$honorarios = 0;
$detalle = array();

		$linea = array('Año' => '1','Mes' => '1','Importe'=>'46.67');
		$total += $linea['Importe'];
		array_push($detalle,$linea);
		$linea = array('Año' => '1','Mes' => '2','Importe'=>'50');
		$total += $linea['Importe'];
		array_push($detalle,$linea);

$total_liq = $total - $honorarios;
$n = new numerosALetras ( $total_liq ) ;
$total_letras = $n->resultado;

$nombre = "BEATRIZ YOLANDA" ;
$direccion = "NEUQUEN N² 1894, 8² P UF N² 24";
$localidad = "C.A.B.A.";
$idalquiler = "4225";
$moneda = "DOLARES" ;
$simbolo_moneda = "uSs";
$observaciones = "OBSERVACIONES: Los fondos recibidos serán entregados a los acreedores";

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

function ImprovedTableCuotas($header,$data)
{
    //Anchuras de las columnas
    $w=array(20,20,30);
    //Cabeceras
    $this->Cell($w[0],10,$header[0],'TLB');
	$this->Cell($w[1],10,$header[1],'TB');
	$this->Cell($w[2],10,$header[2],'TRB');
    $this->Ln();
    //Datos
	foreach($data as $linea)
    {
        $this->Cell($w[0],8,$linea[$header[0]]);
        $this->Cell($w[1],8,$linea[$header[1]]);
        $this->Cell($w[2],8,$linea[$header[2]]);
		$this->Ln();
		//$this->Cell($w[3],8,$data[$header[3]]);
    }
    //LÌnea de cierre
#    $this->Cell(array_sum($w),0,'','T');
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
$pdf->Cell(180,30,'',1);

$pdf->SetXY($pdf->GetX()-175,$pdf->GetY());
$pdf->SetFont('Arial','',10);
$pdf->Cell(22,10,'Señor(es): ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,12,'FELDMAN, RICARDO ENRIQUE'); //$nombre
$pdf->Ln(8);
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,10,'');
$pdf->Cell(22,10,'Domicilio: ');
$pdf->Cell(70,10,'AV. NAZCA N² 830/32/34 U.F N²1'); //$domicilio_inquilino
$pdf->Cell(22,10,'Localidad: ');
$pdf->Cell(30,10,'CAPITAL FEDERAL'); //$domicilio
$pdf->Ln(8);
$pdf->Cell(5,10,'');
$pdf->Cell(22,10,'I.V.A.: ');
$pdf->Cell(30,10,'CONSUMIDOR FINAL'); //$tipo_iva
$pdf->Cell(30,10,'');
$pdf->Cell(22,10,'CUIT/CUIL: ');
$pdf->Cell(30,10,'30-71065584-3'); //$cuit

//Cuerpo
$pdf->SetXY($pdf->GetX()-139,$pdf->GetY()+14);
$pdf->Cell(180,110,'',1);
$pdf->SetXY($pdf->GetX()-175,$pdf->GetY());
$pdf->Cell(50,10,'Cobranzas por Terceros No: ');
$pdf->Cell(20,10,' 1 - 000003 - 15'); //$recibo
$pdf->Ln(5);
$pdf->Cell(5,10,'');
$pdf->Cell(40,10,'Por cuenta y orden de: ');
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(160,10,'VENTOSO, GASTON Y VENTOSO, AGUSTIN'); //$nombre , concatenar los nombres de los propietarios
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,10,'Recibí la cantidad de ');
$pdf->Cell(15,10,'PESOS'); //$moneda
$pdf->Cell(100,10,'dos mil seiscientos con 00/100'.'-------------'); //$total_letras
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->Cell(100,10,'por el alquiler de la propiedad ubicada en:');
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(115,10,'AV. NAZCA N² 830/32/34 U.F N²1'); //$domicilio_propiedad
$pdf->Cell(30,10,'CAPITAL FEDERAL'); //$localidad_propiedad
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,'Período: ');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,10,'01/09/2008 - 30/09/2008'); //$período
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,10,'(Vencimiento del contrato: ');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'30/06/2012'); //$vencimiento
$pdf->SetFont('Arial','',10);
$pdf->Cell(1,10,')'); 
$pdf->Ln(8);
$pdf->Cell(100,10,'');
$pdf->Cell(20,10,'[*]Detalle');
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->Cell(40,10,'Alquiler ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'2600,00',0,0,'R'); //$total
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,'');
$pdf->Cell(50,10,'Esta es la primer linea de detalle'); //$detalle_lin1
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->Cell(40,10,'Punitorios ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'2600,00',0,0,'R'); //$punitorios
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,'');
$pdf->Cell(50,10,'Esta es la segunda linea de detalle'); //$detalle_lin1
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->Cell(40,10,'Otros(*) ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'2600,00',0,0,'R'); //$otros
$pdf->SetFont('Arial','',10);
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->Cell(40,10,'TOTAL: ','B');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'2600,00','B',0,'R'); //$total_final
$pdf->Ln(8);
$pdf->Cell(5,10,'');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,'Total ABONADO: ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'2600,00',0,0,'R'); //$total_abonado
$pdf->SetFont('Arial','',10);
$pdf->Ln(6);
$pdf->Cell(5,12,'');
$pdf->Cell(40,10,'en efectivo: ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'2600,00',0,0,'R'); //$total_efectivo
$pdf->SetFont('Arial','',10);
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->Cell(40,10,'en cheques: ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'2600,00',0,0,'R'); //$total_cheques
$pdf->Ln(10);
$pdf->Cell(100,10,'');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(70,10,'p/ O. MORSELLI E HIJOS','T');
//Observaciones
$pdf->SetXY($pdf->GetX()-170,$pdf->GetY()+13);
$pdf->Cell(180,30,'',1);
$pdf->SetXY($pdf->GetX()-175,$pdf->GetY());
$pdf->SetFont('Arial','U',10);
$pdf->Cell(50,10,'OBSERVACIONES');
$pdf->Ln(6);
$pdf->Cell(5,10,'');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(160,10,' ACA VAN LAS OBSERVACIONES'); //$observaciones
$pdf->Ln(14);
$pdf->Cell(5,10,'');
$pdf->SetFont('Arial','U',10);
$pdf->Cell(50,10,'El locatario entregó los siguientes comprobantes:');
//Impuestos
$pdf->SetXY($pdf->GetX()-265,$pdf->GetY()+10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(22,10,'Expensas',1,0,'C'); //$impuesto1
$pdf->Cell(22,10,'Luz',1,0,'C'); //$impuesto2
$pdf->Cell(22,10,'Gas',1,0,'C'); //$impuesto3
$pdf->Cell(22,10,'Teléfono',1,0,'C'); //$impuesto4
$pdf->Cell(22,10,'A.B.L',1,0,'C'); //$impuesto5
$pdf->Cell(22,10,'A.A',1,0,'C'); //$impuesto6
$pdf->Cell(22,10,'Exp.Extr.',1,0,'C'); //$impuesto7
$pdf->Cell(26,10,'----',1,0,'C'); //$impuesto8
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(22,10,'xxxx',1,0,'L'); //$vimpuesto1
$pdf->Cell(22,10,'xxxx',1,0,'L'); //$vimpuesto2
$pdf->Cell(22,10,'xxxx',1,0,'L'); //$vimpuesto3
$pdf->Cell(22,10,'xxxxx',1,0,'L'); //vimpuesto4
$pdf->Cell(22,10,'xxxx',1,0,'L'); //$vimpuesto5
$pdf->Cell(22,10,'xxx',1,0,'L'); //$vimpuesto6
$pdf->Cell(22,10,'xxxx',1,0,'L'); //$vimpuesto7
$pdf->Cell(26,10,'----',1,0,'L'); //$vimpuesto8
//Linea vertical
$x1 = $pdf->GetX() -110;
$y1 = $pdf->GetY() -100;
$x2 = $x1;
$y2 = $y1 + 60;
$pdf->Line($x1,$y1,$x2,$y2);

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