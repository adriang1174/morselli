<?php
//BindEvents Method @1-055CC7EC
function BindEvents()
{
    global $recibo;
    $recibo->cuotas->CCSEvents["BeforeShow"] = "recibo_cuotas_BeforeShow";
    $recibo->idalquiler->CCSEvents["BeforeShow"] = "recibo_idalquiler_BeforeShow";
    $recibo->otros1->CCSEvents["BeforeShow"] = "recibo_otros1_BeforeShow";
    $recibo->acuerdo->CCSEvents["OnValidate"] = "recibo_acuerdo_OnValidate";
    $recibo->acuerdo->CCSEvents["BeforeShow"] = "recibo_acuerdo_BeforeShow";
    $recibo->CCSEvents["BeforeShow"] = "recibo_BeforeShow";
}
//End BindEvents Method

//recibo_cuotas_BeforeShow @5-7E4AC44A
function recibo_cuotas_BeforeShow(& $sender)
{
    $recibo_cuotas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_cuotas_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
   //var_dump($_POST);
   $paga = array();
   $paga = CCGetFromPost('paga','');
    foreach($paga as $idcuota=>$valor)
   {
   				$str .= $idcuota. ';';
   }
   $str = substr($str, 0, -1);
   //var_dump($liq);
   $recibo->cuotas->SetValue($str);
// -------------------------
//End Custom Code

//DEL  // -------------------------
//DEL  $liquida->ficha->SetValue(CCGetFromPost('idficha',''));
//DEL  
//DEL  // -------------------------

//Close recibo_cuotas_BeforeShow @5-9652D36B
    return $recibo_cuotas_BeforeShow;
}
//End Close recibo_cuotas_BeforeShow

//recibo_idalquiler_BeforeShow @9-1573C832
function recibo_idalquiler_BeforeShow(& $sender)
{
    $recibo_idalquiler_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_idalquiler_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
$recibo->idalquiler->SetValue(CCGetFromPost('idalquiler',''));
// -------------------------
//End Custom Code

//Close recibo_idalquiler_BeforeShow @9-677AFF67
    return $recibo_idalquiler_BeforeShow;
}
//End Close recibo_idalquiler_BeforeShow

//DEL  // -------------------------
//DEL     $paga = array();
//DEL     $paga = CCGetFromPost('paga','');
//DEL      foreach($paga as $idcuota=>$valor)
//DEL     {
//DEL      $recibo->Link1->Parameters = CCGetQueryString("QueryString", "");
//DEL  	$recibo->Link1->Parameters = CCAddParam($recibo->Link1->Parameters, "idcuota", $idcuota);
//DEL  	break; //Solo ponemos la primer cuota   	
//DEL     }
//DEL  
//DEL  // -------------------------

//recibo_otros1_BeforeShow @13-1D2E2354
function recibo_otros1_BeforeShow(& $sender)
{
    $recibo_otros1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_otros1_BeforeShow

//Custom Code @71-2A29BDB7
// -------------------------
    // Acá buscar vencimiento del contrato
	// diferencia entre la fecha de vencimiento de la cuota y la fecha corriente
	// ver si el día esta pasado y calcular el punitorio automatico
	// 0,5% diario
	$paga = array();
	$paga = CCGetFromPost('paga','');
	foreach($paga as $idcuota=>$valor)
	{
		$cuota = $idcuota;
		break;
	}

	$conn = new clsDBConnection1();
	$sql = "select datediff(day,fechavencimiento,getdate()) as dias, importe from cuotas where idcuota = ".$cuota;
	$conn->query($sql);
 	$conn->next_record();
	$punitorio = $conn->f('dias') * 0.005 * $conn->f('importe');
	if($punitorio > 0)
	{
			$recibo->otros1->SetValue($punitorio);
			$recibo->detalle1->SetValue("PUNITORIOS");
	}
// -------------------------
//End Custom Code

//Close recibo_otros1_BeforeShow @13-6CE94723
    return $recibo_otros1_BeforeShow;
}
//End Close recibo_otros1_BeforeShow

//recibo_acuerdo_OnValidate @70-796BAE0A
function recibo_acuerdo_OnValidate(& $sender)
{
    $recibo_acuerdo_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_acuerdo_OnValidate

//Custom Code @72-2A29BDB7
// -------------------------
//if($recibo->acuerdo->GetValue() = '')
//	$recibo->Errors->addError('El campo acuerdo no puede ser vacio. De no existir acuerdo, por favor indique 0');
// -------------------------
//End Custom Code

//Close recibo_acuerdo_OnValidate @70-C6C4C37A
    return $recibo_acuerdo_OnValidate;
}
//End Close recibo_acuerdo_OnValidate

//recibo_acuerdo_BeforeShow @70-2AB67A96
function recibo_acuerdo_BeforeShow(& $sender)
{
    $recibo_acuerdo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_acuerdo_BeforeShow

//Custom Code @73-2A29BDB7
// -------------------------
$recibo->acuerdo->SetValue('0');
// -------------------------
//End Custom Code

//Close recibo_acuerdo_BeforeShow @70-F93FA7F3
    return $recibo_acuerdo_BeforeShow;
}
//End Close recibo_acuerdo_BeforeShow

//recibo_BeforeShow @2-203C702A
function recibo_BeforeShow(& $sender)
{
    $recibo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_BeforeShow

//Custom Code @58-2A29BDB7
// -------------------------
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
 a.idalquiler = " . CCGetFromPost('idalquiler','');
 $conn->query($sql);
 $conn->next_record();
 $idpropiedad = $conn->f('idpropiedad');
 $direccion = $conn->f('direccion');
 $localidad = $conn->f('localidad');
  $nombre_inquilino = $conn->f('nombre_inquilino');
 $direccion_inquilino = $conn->f('direccion_inquilino');
 $localidad_inquilino = $conn->f('localidad_inquilino');
 $tipo_iva = $conn->f('tipo_iva');
 $cuit = $conn->f('cuit');
 $vencimiento = date("j/n/Y",strtotime(substr($conn->f('fechafin'),0,10)));

 $recibo->nombre->SetValue($nombre_inquilino);
 $recibo->domicilio->SetValue($direccion_inquilino);
 $recibo->localidad->SetValue($localidad_inquilino);
 $recibo->cuit->SetValue($cuit);
 $recibo->fvto->SetValue($vencimiento);
 $recibo->domicilio_propiedad->SetValue($direccion);
 $recibo->localidad_propiedad->SetValue($localidad);


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
$recibo->propietario->SetValue($nombre_propietario);

///////////////////

$paga = array();
$paga = CCGetFromPost('paga','');
foreach($paga as $idcuota=>$valor)
{
	$cuota = $idcuota;
	break;
}
	   		
$sql = "select * from cuotas where idcuota = ".$cuota;
$conn->query($sql);
$conn->next_record();
$recibo->importe_cuota->SetValue(number_format($conn->f('importe'),2,',','.'));

$fechavenc = strtotime(substr($conn->f('fechavencimiento'),0,10));
$periodo_ini = date("j/n/Y", mktime(0, 0, 0, date("m",$fechavenc) , 1, date("Y",$fechavenc)));
$periodo_fin = date("j/n/Y", mktime(0, 0, 0, date("m",$fechavenc)+1 , 0, date("Y",$fechavenc)));
$periodo = $periodo_ini . " - ". $periodo_fin;
$recibo->periodo->SetValue($periodo);



///////////////////
// -------------------------
//End Custom Code

//Close recibo_BeforeShow @2-3FF9EB39
    return $recibo_BeforeShow;
}
//End Close recibo_BeforeShow
?>
