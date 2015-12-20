<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
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
//#	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

$error = false;
//
// Traemos los datos del request
//
$idalquiler = $_REQUEST['idalquiler'];
$ano = $_REQUEST['ano'];
$mes = $_REQUEST['mes'];
//
// Averiguamos datos de inquilino, prop, alquiler, etc
//
$conn = new clsDBConnection1();
$sql = "select p.idpropiedad,p.direccion,p.localidad,a.idalquiler,m.descripcion as moneda,m.simbolo,
f.nombre as nombre_inquilino, tc.descripcion as tipo_iva, f.cuit,a.fechafin,
f.direccion as direccion_inquilino, f.localidad as localidad_inquilino
from fichas f
inner join fichasalquileres fa on fa.idficha = f.idficha
inner join alquileres a on a.idalquiler = fa.idalquiler
inner join propiedades p on p.idpropiedad = a.idpropiedad
inner join tipocontribuyente tc on tc.idtipocontribuyente = f.idtipocontribuyente
inner join monedas m on a.idmoneda = m.idmoneda
where
 a.idalquiler = " . $idalquiler;
 $conn->query($sql);
 $conn->next_record();
 $idpropiedad = $conn->f('idpropiedad');
 $direccion = $conn->f('direccion');
 $localidad = $conn->f('localidad');
 $moneda =  $conn->f('moneda');
 $simbolo = $conn->f('simbolo');
 $nombre_inquilino = $conn->f('nombre_inquilino');
 $direccion_inquilino = $conn->f('direccion_inquilino');
 $localidad_inquilino = $conn->f('localidad_inquilino');
 $tipo_iva = $conn->f('tipo_iva');
 $cuit = $conn->f('cuit');
 $vencimiento = date("j/n/Y",strtotime(substr($conn->f('fechafin'),0,10)));
 //var_dump($vencimiento);
 //
 // Averiguamos datos de los propietarios
 //
 $nombre_propietario = '';
$sql = "select f.nombre as nombre_propietario
from fichas f
inner join fichaspropiedades fp on f.idficha = fp.idficha
where idpropiedad = ".$idpropiedad;
$conn->query($sql);
while($conn->next_record()){
	$nombre_propietario .= $conn->f('nombre_propietario') . " Y ";
}
$nombre_propietario = substr($nombre_propietario,0,-3);
//
// Creamos el pdf y tantas paginas como recibos vayamos a imprimir
//
$pdf=new PDF();
$pdf->AliasNbPages();

$sql = "SELECT * from cuotas where idalquiler=".$idalquiler." and ano = ".$ano." and mes = ".$mes." and idtipocuota = 1";
/*
$sql = "EXEC sp_pago_cuotas_alquiler ".$nrorec.",".$idalquiler.",'".$cuotas."',".$otros1.
      ",'".$detalle1."',".
	  $otros2.",'".$detalle2."',".$otros3.",'".$detalle3."',".
	  $otros4.",'".$detalle4."',".$otros5.",'".$detalle5."',".
	  $otros6.",'".$detalle6."',".$otros7.",'".$detalle7."',".
	  $otros8.",'".$detalle8."',".$otros9.",'".$detalle9."',".
	  $otros10.",'".$detalle10."'";
*/
//$conn->query("EXEC sp_pago_cuotas_alquiler ".$nrorec.",".$idalquiler.",'".$cuotas."',".$otros); 

$conn->query($sql); 
while($conn->next_record()){
   /// nueva_pagina_recibo aca van varias pagins 
   $importe = $conn->f('importe');
   $fechavenc = strtotime(substr($conn->f('fechavencimiento'),0,10));
   $cuotas = $conn->f('idcuota');
   $acuerdo = $conn->f('acuerdo');
    if($acuerdo > 0 )
	    $observaciones .= "Por acuerdo entre las partes este mes aboné $".$importe. ". No implica compromiso futuro";
   //
   //Impuestos
   //
   $conn2 = new clsDBConnection1();
   $conn2->query("sp_muestra_impuestos_alquiler ".$idalquiler.",".$cuotas);
   $i = 1;
   $impuesto = array();
   $vimpuesto = array();
   while($conn2->next_record()){
   			$impuesto[$i] = $conn2->f('nombreimpuesto');
			$vimpuesto[$i] = $conn2->f('txtimpuesto');
			$i++;
   }
   $conn2->close();
   //   
   //Busqueda de otros
   //
	$detalle1 = '';
	$detalle2 = '';
	$detalle3 = '';
	$detalle4 = '';
	$detalle5 = '';
	$detalle6 = '';
	$detalle7 = '';
	$detalle8 = '';
	$detalle9 = '';
	$detalle10 = '';   
   $conn3 = new clsDBConnection1();
   $sql = "SELECT * from cuotas where idalquiler=".$idalquiler." and ano = ".$ano." and mes = ".$mes." and idtipocuota = 8 and fechapago is not null";
   $conn3->query($sql); 
   $i = 1;
   while($conn3->next_record()){
		${otros.$i} = $conn3->f('importe');
		${detalle.$i} = $conn3->f('detalles');
		$i++;
   }
   $conn3->close();		
	$otros1 = ($otros1 == '') ? 0:$otros1;
	$otros2 = ($otros2 == '') ? 0:$otros2;
	$otros3 = ($otros3 == '') ? 0:$otros3;
	$otros4 = ($otros4 == '') ? 0:$otros4;
	$otros5 = ($otros5 == '') ? 0:$otros5;
	$otros6 = ($otros6 == '') ? 0:$otros6;
	$otros7 = ($otros7 == '') ? 0:$otros7;
	$otros8 = ($otros8 == '') ? 0:$otros8;
	$otros9 = ($otros9 == '') ? 0:$otros9;
	$otros10 = ($otros10 == '') ? 0:$otros10;
   
	if(strtoupper($detalle1) == 'PUNITORIOS')
	{ 
		$otros = $otros2 + $otros3 + $otros4 + $otros5 + $otros6 + $otros7 + $otros8 + $otros9 + $otros10;  
		$punitorios = $otros1;
	}
	else
		$otros = $otros1 + $otros2 + $otros3 + $otros4 + $otros5 + $otros6 + $otros7 + $otros8 + $otros9 + $otros10;  
    //$total = $importe + $otros ;
	$total = $importe + $punitorios + $otros ;

   
   $otros = number_format($otros,2,',','.');
   $otros1 = number_format($otros1,2,',','.');
   $otros2 = number_format($otros2,2,',','.');
   $otros3 = number_format($otros3,2,',','.');
   $otros4 = number_format($otros4,2,',','.');
   $otros5 = number_format($otros5,2,',','.');
   $otros6 = number_format($otros6,2,',','.');
   $otros7 = number_format($otros7,2,',','.');
   $otros8 = number_format($otros8,2,',','.');
   $otros9 = number_format($otros9,2,',','.');
   $otros10 = number_format($otros10,2,',','.');
   //var_dump($total);
   $n = new numerosALetras ($total) ;
   $total_letras = $n->resultado;   
   $total = number_format($total,2,',','.');
   $importe = number_format($importe,2,',','.');
   $punitorios = number_format($punitorios,2,',','.');
   //var_dump($total_letras);
   $periodo_ini = date("j/n/Y", mktime(0, 0, 0, date("m",$fechavenc) , 1, date("Y",$fechavenc)));
   $periodo_fin = date("j/n/Y", mktime(0, 0, 0, date("m",$fechavenc)+1 , 0, date("Y",$fechavenc)));
   $periodo = $periodo_ini . " - ". $periodo_fin;
   //$vencimiento = $conn->f('fechafin');
   //$punitorios = 0;
   $fecha = date('d/m/Y');
   pdfPage($pdf);
}
$pdf->Output();

/*********************************************************************/


function pdfPage($pdf)
{
	global $nombre_inquilino,$direccion_inquilino,$localidad_inquilino,$tipo_iva,$cuit,$idalquiler,
	$nrorec,$nombre_propietario,$moneda,$total_letras,$direccion,$localidad,$periodo,$vencimiento,
	$importe,$detalle1,$detalle2,$detalle3,$detalle4,$detalle5,$detalle6,$detalle7,$detalle8,$detalle9,
	$detalle10,$otros,$total,$observaciones,$impuesto,$vimpuesto,$fecha,
	$otros1,$otros2,$otros3,$otros4,$otros5,$otros6,$otros7,$otros8,$otros9,$otros10,$punitorios;
	//Carga de datos

	if (!$error)
	{
	//CreaciÛn del objeto de la clase heredada
	#function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
	//$pdf=new PDF();
	//$pdf->AliasNbPages();
	$pdf->AddPage();

//	$pdf->Ln();
	$pdf->SetXY(167,8);
	$pdf->Ln();
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(187,16,$fecha,0,0,'R');
	$pdf->Ln(35);


	//Cabecera
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(160,22,'',1);


//	$pdf->SetXY($pdf->GetX()-175,$pdf->GetY());
	$pdf->SetXY($pdf->GetX()-155,$pdf->GetY());
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(22,10,'Señor(es): ');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(40,12,$nombre_inquilino); //$nombre
	$pdf->SetFont('Arial','',10);
	//$pdf->Cell(108,10,$fecha,0,0,'R'); 
	$pdf->Ln(5);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(5,10,'');
	$pdf->Cell(17,10,'Domicilio: ');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(90,10,$direccion_inquilino); //$domicilio_inquilino
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,10,'Localidad: ');
	$pdf->Cell(30,10,$localidad_inquilino); //$domicilio
	$pdf->Ln(5);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->Cell(20,10,'I.V.A.: ');
	$pdf->Cell(30,10,$tipo_iva); //$tipo_iva
	$pdf->Cell(30,10,'');
	$pdf->Cell(20,10,'CUIT/CUIL: ');
	$pdf->Cell(30,10,$cuit); //$cuit
	$pdf->Cell(25,10,'');

	//Cuerpo
	$pdf->SetXY($pdf->GetX()-160,$pdf->GetY()+12);
	$pdf->Cell(160,110,'',1);
	$pdf->SetXY($pdf->GetX()-155,$pdf->GetY());
	$pdf->Cell(50,10,'Cobranzas por Terceros No: ');
	//$pdf->Cell(20,10,$nrorec); //$recibo
	$pdf->Cell(20,10,$idalquiler); //Ponemos el nro de contrato
	$pdf->Ln(5);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->Cell(40,10,'Por cuenta y orden de: ');
	$pdf->Ln(6);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(160,10,$nombre_propietario); //$nombre , concatenar los nombres de los propietarios
	$pdf->Ln(6);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(35,10,'Recibí la cantidad de ');
	$pdf->Cell(15,10,$moneda); //$moneda
	$pdf->Cell(100,10,$total_letras.'-------------'); //$total_letras
	$pdf->Ln(6);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());	
	$pdf->Cell(5,10,'');
	$pdf->Cell(100,10,'por el alquiler de la propiedad ubicada en:');
	$pdf->Ln(6);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(120,10,$direccion); //$domicilio_propiedad
	$pdf->Cell(30,10,$localidad); //$localidad_propiedad
	$pdf->Ln(6);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,10,'Período: ');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(45,10,$periodo); //$período
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(45,10,'(Vencimiento del contrato: ');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,10,$vencimiento); //$vencimiento
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(1,10,')'); 
	$pdf->Ln(8);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(90,10,'');
	$pdf->Cell(20,10,'[*]Detalle');
	$pdf->Ln(6);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->Cell(40,10,'Alquiler ');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,10,'$ ' .$importe,0,0,'R'); //$total
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,10,'');
	if(abs($otros1) >0 and strtoupper($detalle1) <> 'PUNITORIOS')
		$pdf->Cell(50,10,'$ '.$otros1."    ".$detalle1); //$detalle_lin1
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if(abs($otros2) >0 )
		$pdf->Cell(50,10,'$ '.$otros2."    ".$detalle2); //$detalle_lin2
	$pdf->Ln(2);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->Cell(40,10,'Punitorios ');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,10,'$ '.$punitorios,0,0,'R'); //$punitorios
	$pdf->SetFont('Arial','',10);
	$pdf->Ln(2);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if(abs($otros3) >0 )
		$pdf->Cell(50,10,'$ '.$otros3."    ".$detalle3); //$detalle_lin3
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->Cell(40,10,'Otros(*) ');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,10,'$ '.$otros,0,0,'R'); //$otros
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,10,'');
	if(abs($otros4) >0 )
		$pdf->Cell(50,10,'$ '.$otros4."    ".$detalle4); //$detalle_lin3
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if(abs($otros5) >0 )
		$pdf->Cell(50,10,'$ '.$otros5."    ".$detalle5); //$detalle_lin3
	$pdf->Ln(2);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->Cell(40,10,'TOTAL: ','B');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,10,'$ '.$total,'B',0,'R'); //$total_final
	$pdf->SetFont('Arial','',10);
	$pdf->Ln(2);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if(abs($otros6) >0 )
		$pdf->Cell(50,10,'$ '.$otros6."    ".$detalle6); //$detalle_lin3
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if(abs($otros7) >0 )
		$pdf->Cell(50,10,'$ '.$otros7."    ".$detalle7); //$detalle_lin3
	$pdf->Ln(2);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(40,10,'Total ABONADO: ');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,10,'$ '.$total,0,0,'R'); //$total_abonado
	$pdf->SetFont('Arial','',10);
	$pdf->Ln(2);
	$pdf->Cell(85,10,'');
	if(abs($otros8) >0 )
		$pdf->Cell(50,10,'$ '.$otros8."    ".$detalle8); //$detalle_lin3
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if(abs($otros9) >0 )
		$pdf->Cell(50,10,'$ '.$otros9."    ".$detalle9); //$detalle_lin3
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if(abs($otros10) >0 )
		$pdf->Cell(50,10,'$ '.$otros10."    ".$detalle10); //$detalle_lin3
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(85,10,'');
	if($otros10 >0 )
		$pdf->Cell(50,10,'$ '.$otros10."    ".$detalle10); //$detalle_lin3

	$pdf->Ln(8);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(90,10,'');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,10,'p/ O. MORSELLI E HIJOS','T');
	//Observaciones  
	$pdf->SetXY($pdf->GetX()-160,$pdf->GetY()+13);
	$pdf->Cell(160,20,'',1);
	$pdf->SetXY($pdf->GetX()-155,$pdf->GetY());
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(50,10,'OBSERVACIONES');
	$pdf->Ln(4);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(155,10,$observaciones); //$observaciones
	$pdf->Ln(7);
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->Cell(5,10,'');
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(50,10,'El locatario entregó los siguientes comprobantes:');
	//Impuestos
	$pdf->SetXY($pdf->GetX()-265,$pdf->GetY()+9);
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
	$pdf->SetXY($pdf->GetX()+20,$pdf->GetY());
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,10,$vimpuesto[1],1,0,'L'); //$vimpuesto1
	$pdf->Cell(20,10,$vimpuesto[2],1,0,'L'); //$vimpuesto2
	$pdf->Cell(20,10,$vimpuesto[3],1,0,'L'); //$vimpuesto3
	$pdf->Cell(20,10,$vimpuesto[4],1,0,'L'); //vimpuesto4
	$pdf->Cell(20,10,$vimpuesto[5],1,0,'L'); //$vimpuesto5
	$pdf->Cell(20,10,$vimpuesto[6],1,0,'L'); //$vimpuesto6
	$pdf->Cell(20,10,$vimpuesto[7],1,0,'L'); //$vimpuesto7
	$pdf->Cell(20,10,$vimpuesto[8],1,0,'L'); //$vimpuesto8
	//$pdf->Cell(20,10,$vimpuesto[9],1,0,'L'); //$vimpuesto9
	//Linea vertical
	$x1 = $pdf->GetX() -80;
	$y1 = $pdf->GetY() -90;
	$x2 = $x1;
	$y2 = $y1 + 60;
	$pdf->Line($x1,$y1,$x2,$y2);

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
}
?>