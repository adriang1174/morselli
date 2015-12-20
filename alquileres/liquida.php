<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/liquidacion/");
define("FileName", "liquida_cuotas.php");
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
$nroliq = $_REQUEST['nroliq'];
$liquida = $_REQUEST['liquida'];
$ficha = $_REQUEST['ficha'];
$idalquiler = $_REQUEST['idalquiler'];

$conn = new clsDBConnection1();
$conn->query("EXEC sp_liquida_cuotas_alquiler ".$nroliq.",".$idalquiler.",'".$liquida."'"); //---proforma facturada
$total = 0;
$honorarios = 0;
$detalle = array();
while($conn->next_record()){
	if($conn->f('idtipocuota') != 3) //Comision
	{	
		$linea = array('Año' => $conn->f('ano'),'Mes' => $conn->f('mes'),'Importe'=>$conn->f('importe'));
		$total += $linea['Importe'];
		array_push($detalle,$linea);
	}
	else
		$honorarios += $conn->f('importe');
}
$total_liq = $total - $honorarios;
$n = new numerosALetras ( $total_liq ) ;
$total_letras = $n->resultado;

$sql = "select f.nombre,p.direccion,p.localidad,a.idalquiler,m.descripcion,m.simbolo
from fichas f
inner join fichaspropiedades fp on fp.idficha = f.idficha
inner join propiedades p on p.idpropiedad = fp.idpropiedad
inner join alquileres a on a.idpropiedad = p.idpropiedad
inner join monedas m on a.idmoneda = m.idmoneda
where
f.idficha = ".$ficha." and a.idalquiler = ". $idalquiler;
//var_dump($sql);
$conn->query($sql);
$conn->next_record();
$nombre = $conn->f('nombre');
$direccion = $conn->f('direccion');
$localidad = $conn->f('localidad');
$idalquiler = $conn->f('idalquiler');
$moneda = $conn->f('descripcion');
$simbolo_moneda = $conn->f('simbolo');
$observaciones = "OBSERVACIONES: Los fondos recibidos serán entregados a los acreedores";

$total = number_format($total,2,'.','');
$total_liq = number_format($total_liq,2,'.','');
$honorarios = number_format($honorarios,2,'.','');


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
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,10,"N de Liquidación  ".$nroliq);
$pdf->Cell(100,10,"Nro. de carpeta  ".$idalquiler);
$pdf->Cell(120,10,$fecha);
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,10,'Recibi de la firma ');
$pdf->Cell(50,10,$firma);
$pdf->Cell(80,10,'la cantidad de '.$moneda);
$pdf->Ln();
$pdf->Cell(100,10,$total_letras." ---------------------------------------------------------");
$pdf->Ln();
$pdf->Cell(120,10,'por el alquiler N² '.$idalquiler. ' por el alquiler de la propiedad ubicada en' );
$pdf->Ln();
$pdf->Cell(120,10,$direccion.' de la localidad de '.$localidad);
$pdf->Ln();
$pdf->Cell(120,10,'conforme se detalla a continuación');
$pdf->Ln();
//$pdf->Rect(20,100,100,20);

$pdf->SetFont('Arial','',9);
$header=array('Año','Mes','Importe');
//foreach($detalle as $linea) {
$pdf->ImprovedTableCuotas($header,$detalle);
//}
//$pdf->Ln();
//
// FaltarÌan los totales
//
//$pdf->Cell(200,8,'');
$pdf->SetXY(110,110);
$pdf->Cell(20,7,"Su parte proporcional",0,0,'C'); //Importe
$pdf->Ln();
$pdf->Cell(100,7,'');
$pdf->Cell(30,7,"Importe       " );
$pdf->Cell(30,7,$simbolo_moneda."     ".$total); //Importe
$pdf->Ln();
$pdf->Cell(100,7,'');
$pdf->Cell(30,7,"Neto a cobrar ");
$pdf->Cell(30,7,$simbolo_moneda."     ".$total,'T'); //Neto a cobrar
$pdf->Ln();
$pdf->Cell(100,7,'');
$pdf->Cell(30,7,"- Honorarios  " );
$pdf->Cell(30,7,$simbolo_moneda."     ".$honorarios,'T'); //Honorarios
$pdf->Ln();
$pdf->Cell(100,7,'');
$pdf->Cell(30,7,"Total         " );
$pdf->Cell(30,7,$simbolo_moneda."     ".$total_liq,'T'); //Total
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(100,8,'');
$pdf->Cell(40,8,$nombre,'T'); //Nombre para firma
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(160,8,$observaciones,'T'); //Nombre para firma


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