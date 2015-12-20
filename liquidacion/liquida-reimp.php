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
//$nroliq = $_REQUEST['nroliq'];
//$liquida = $_REQUEST['liquida'];
$ficha = $_REQUEST['ficha'];
$idalquiler = $_REQUEST['idalquiler'];
$idcuota = $_REQUEST['idcuota'];
$idcuota_orig = $idcuota;

$conn = new clsDBConnection1();
//var_dump("c ".$idcuota);
$conn->query("EXEC sp_info_liquidacion ".$idcuota) ; 

$total = 0;
$honorarios = 0;
$detalle = array();
while($conn->next_record()){
	$linea = array('Año' => $conn->f('ano'),'Mes' => $conn->f('mes'),'Importe'=>$conn->f('importe'),'Detalle'=>$conn->f('detalles'));
	array_push($detalle,$linea);	
}

//totales
//var_dump("EXEC sp_info_liquidacion_total ".$idcuota);
$conn->query("EXEC sp_info_liquidacion_total ".$idcuota) ; 
$conn->next_record();
$total = $conn->f('total');
//honorarios
//var_dump("EXEC sp_info_liquidacion_honorarios ".$idcuota);
$conn->query("EXEC sp_info_liquidacion_honorarios ".$idcuota) ; 
while($conn->next_record()){
		if ($conn->f('idtipocuota') == 3)
			$honorarios = $conn->f('importe');
		else
			$ivahon = $conn->f('importe');
}
$total_liq = $total - $honorarios - $ivahon;
$n = new numerosALetras ( $total_liq ) ;
$total_letras = $n->resultado;
$total_liq = number_format($total_liq, 2, ',', '.');
$honorarios = number_format($honorarios, 2, ',', '.');
$ivahon = number_format($ivahon, 2, ',', '.');
$total = number_format($total, 2, ',', '.');

$sql = "select f.nombre,p.direccion,p.localidad,a.idalquiler,m.descripcion,m.simbolo,f2.nombre as inquilino
from fichas f
inner join fichaspropiedades fp on fp.idficha = f.idficha
inner join propiedades p on p.idpropiedad = fp.idpropiedad
inner join alquileres a on a.idpropiedad = p.idpropiedad
inner join monedas m on a.idmoneda = m.idmoneda
inner join fichasalquileres fa on(a.idalquiler = fa.idalquiler)
inner join fichas f2 on(f2.idficha = fa.idficha)
where
 a.idalquiler = ". $idalquiler;
//var_dump($sql);
$conn->query($sql);
$conn->next_record();
$nombre = $conn->f('nombre');
$direccion = $conn->f('direccion');
$localidad = $conn->f('localidad');
$idalquiler = $conn->f('idalquiler');
$moneda = $conn->f('descripcion');
$simbolo_moneda = $conn->f('simbolo');
$nombre_inquilino = $conn->f('inquilino');
$observaciones = "OBSERVACIONES: Los fondos recibidos serán entregados a los acreedores";

   //
   //Impuestos
   //
   $conn2 = new clsDBConnection1();
//   var_dump("sp_muestra_impuestos ".$idalquiler.",".$idcuota_orig);
   $conn2->query("sp_muestra_impuestos ".$idalquiler.",".$idcuota_orig);
   $i = 1;
   $impuesto = array();
   $vimpuesto = array();
   while($conn2->next_record()){
   			$impuesto[$i] = $conn2->f('nombreimpuesto');
			$vimpuesto[$i] = $conn2->f('txtimpuesto');
			$i++;
   }
   $conn2->close();



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
    $w=array(10,10,20,40);
    //Cabeceras
	$this->Cell(16,10,'',0);
    $this->Cell(100,60,'',1);
	$this->SetXY($this->GetX()-95,$this->GetY());
    $this->Cell($w[0],10,$header[0],0);
	$this->Cell($w[1],10,$header[1],0);
	$this->Cell($w[2],10,$header[2],0);
	$this->Cell($w[3],10,$header[3],0);
	//$this->Cell($w[4],10,$header[4],0);
    $this->Ln();
    //$this->SetXY($this->GetX()+21,$this->GetY());
	//Datos
	foreach($data as $linea)
    {
        $this->Cell(21,10,'',0);
		$this->Cell($w[0],8,$linea[$header[0]]);
        	$this->Cell($w[1],8,$linea[$header[1]]);
        	$this->Cell($w[2],8,number_format($linea[$header[2]], 2, ',', '.'),0,0,'R');
		$this->Cell($w[3],8,$linea[$header[3]]);
		//$this->Cell($w[4],8,number_format($linea[$header[4]], 2, ',', '.'));
		$this->Ln(3);
    }
    //LÌnea de cierre
#    $this->Cell(array_sum($w),0,'','T');
}
}

//Carga de datos
$pdf=new PDF();

if (!$error)
{

	$pdf->AddPage();
	$pdf->SetXY(167,8);
	$pdf->SetFont('Arial','',10);
	$pdf->Ln(10);
	$pdf->Cell(187,15,$fecha,0,0,'R');
	$pdf->Ln(36);

	//Cabecera
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(160,10,'',1);


//	$pdf->SetXY($pdf->GetX()-175,$pdf->GetY());
	$pdf->SetXY($pdf->GetX()-149,$pdf->GetY());
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(22,10,'Señor(es): ');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(40,12,$nombre); //$nombre
	//$pdf->SetFont('Arial','',10);
	//$pdf->Cell(108,10,$fecha,0,0,'R'); 
	//$pdf->Ln(8);
	
	//Cuerpo
	//$pdf->SetXY($pdf->GetX()-139,$pdf->GetY()+14);
	$pdf->SetXY(26,$pdf->GetY()+10);
	$pdf->Cell(160,106,'',1);
	$pdf->SetXY($pdf->GetX()-159,$pdf->GetY());
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(70,10,'Rendicion de cobranzas por Terceros No: ');
	//$pdf->Cell(20,10,$nrorec); //$recibo
	$pdf->Cell(20,10,$idalquiler); //Ponemos el nro de contrato
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(35,10,'Recibi Ustedes ');
	$pdf->Ln(4);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(80,10,'la cantidad de '.$moneda);
	$pdf->Ln(4);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(100,10,$total_letras." ---------------------------------------------------------");
	$pdf->Ln(4);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(120,10,' por el alquiler de la propiedad ubicada en' );
	$pdf->Ln(4);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(120,10,$direccion.' de la localidad de '.$localidad);
	$pdf->Ln(4);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(120,10,'Pagado por: '.$nombre_inquilino);
	$pdf->Ln(4);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(120,10,'conforme se detalla a continuación');
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',9);
	$header=array('Año','Mes','Importe','Detalle');
	//foreach($detalle as $linea) {
	$pdf->ImprovedTableCuotas($header,$detalle);

	//$pdf->SetXY($pdf->GetX()+116,$pdf->GetY()-18);
	//echo "Arranca neto a cobrar: X: ".$pdf->GetX()." Y: ".$pdf->GetY()."  ";
	$pdf->SetXY(126,100);
	$pdf->Cell(40,10,'Neto a cobrar','T'); //Neto a cobrar
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+5);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,$total,0,0,'R'); 
	$pdf->SetFont('Arial','',10);
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+8);
	$pdf->Cell(40,10,'Honorarios','T'); //Honorarios
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+5);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,$honorarios,0,0,'R'); 
	$pdf->SetFont('Arial','',10);
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+8);
	$pdf->Cell(40,10,'Iva s/Honorarios','T'); //IVA s/Honorarios
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+5);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,$ivahon,0,0,'R'); 
	$pdf->SetFont('Arial','',10);
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+8);
	$pdf->SetLineWidth(1);
	$pdf->Cell(40,10,'A Pagar','T'); //A Pagar
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+5);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,$total_liq,'B',0,'R'); 
	$pdf->SetFont('Arial','',10);
	$pdf->SetXY($pdf->GetX()-40,$pdf->GetY()+20);
	$pdf->SetLineWidth(0.2);

	//Observaciones  
	$pdf->Cell(40,8,'Firma y aclaración de firma','T'); //Nombre para firma
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->SetXY($pdf->GetX()-160,$pdf->GetY()-13);
	$pdf->Cell(50,10,'TOTALES  '); 
	$pdf->Cell(50,10,$total); 	
	$pdf->SetXY($pdf->GetX()-100,$pdf->GetY()+19);

	$pdf->Cell(160,18,'',1);
	$pdf->SetXY($pdf->GetX()-175,$pdf->GetY());
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(16,10,'',0);
	$pdf->Cell(50,10,'OBSERVACIONES');
	$pdf->Ln(8);
	$pdf->Cell(21,10,'');
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(50,10,'El locatario entregó los siguientes comprobantes:');
	//Impuestos
	$pdf->SetXY($pdf->GetX()-265,$pdf->GetY()+10);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,10,$impuesto[1],1,0,'C'); //$impuesto1
	$pdf->Cell(20,10,$impuesto[2],1,0,'C'); //$impuesto2
	$pdf->Cell(20,10,$impuesto[3],1,0,'C'); //$impuesto3
	$pdf->Cell(20,10,$impuesto[4],1,0,'C'); //$impuesto4
	$pdf->Cell(20,10,$impuesto[5],1,0,'C'); //$impuesto5
	$pdf->Cell(20,10,$impuesto[6],1,0,'C'); //$impuesto6
	$pdf->Cell(20,10,$impuesto[7],1,0,'C'); //$impuesto7
	$pdf->Cell(20,10,$impuesto[8],1,0,'C'); //$impuesto8
	//$pdf->Cell(20,10,$impuesto[9],1,0,'C'); //$impuesto9
	$pdf->Ln();
	$pdf->Cell(16,10,'',0);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,10,$vimpuesto[1],1,0,'L'); //$vimpuesto1
	$pdf->Cell(20,10,$vimpuesto[2],1,0,'L'); //$vimpuesto2
	$pdf->Cell(20,10,$vimpuesto[3],1,0,'L'); //$vimpuesto3
	$pdf->Cell(20,10,$vimpuesto[4],1,0,'L'); //vimpuesto4
	$pdf->Cell(20,10,$vimpuesto[5],1,0,'L'); //$vimpuesto5
	$pdf->Cell(20,10,$vimpuesto[6],1,0,'L'); //$vimpuesto6
	$pdf->Cell(20,10,$vimpuesto[7],1,0,'L'); //$vimpuesto7
	$pdf->Cell(20,10,$vimpuesto[8],1,0,'L'); //$vimpuesto8
//	$pdf->Cell(20,10,$vimpuesto[9],1,0,'L'); //$vimpuesto9

	//$pdf->Output();
	}
	else
	{
	//$pdf=new PDF();
	//$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,12,'Error al generar una factura',0,0,'L');
	}
	$pdf->Output();

?>