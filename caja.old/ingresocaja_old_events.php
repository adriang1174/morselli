<?php
//BindEvents Method @1-D9526733
function BindEvents()
{
    global $movimientoscaja;
    global $movimientoscaja1;
    global $CCSEvents;
    $movimientoscaja->fecha->CCSEvents["BeforeShow"] = "movimientoscaja_fecha_BeforeShow";
    $movimientoscaja->tipomovimiento->CCSEvents["BeforeShow"] = "movimientoscaja_tipomovimiento_BeforeShow";
    $movimientoscaja->CCSEvents["OnValidate"] = "movimientoscaja_OnValidate";
    $movimientoscaja->CCSEvents["BeforeShow"] = "movimientoscaja_BeforeShow";
    $movimientoscaja1->CCSEvents["BeforeShow"] = "movimientoscaja1_BeforeShow";
}
//End BindEvents Method

//movimientoscaja_fecha_BeforeShow @13-762C778A
function movimientoscaja_fecha_BeforeShow(& $sender)
{
    $movimientoscaja_fecha_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja; //Compatibility
//End movimientoscaja_fecha_BeforeShow

//Custom Code @16-2A29BDB7
// -------------------------
$movimientoscaja->fecha->SetValue(CCGetParam('fecha',''));

if(strlen($movimientoscaja->fecha->GetValue())>10)
{
  		//Hay que formatear
  		//2009-08-26 00:00:00.000
  		$y = substr($movimientoscaja->fecha->GetValue(),0,4);
  		$m = substr($moviminetoscaja->fecha->GetValue(),5,2);
  		$d = substr($movimientoscaja->fecha->GetValue(),8,2);
  		$movimientoscaja->fecha->SetValue($d."/".$m."/".$y);
}
// -------------------------
//End Custom Code

//Close movimientoscaja_fecha_BeforeShow @13-0A610B0C
    return $movimientoscaja_fecha_BeforeShow;
}
//End Close movimientoscaja_fecha_BeforeShow

//movimientoscaja_tipomovimiento_BeforeShow @9-5913CED3
function movimientoscaja_tipomovimiento_BeforeShow(& $sender)
{
    $movimientoscaja_tipomovimiento_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja; //Compatibility
//End movimientoscaja_tipomovimiento_BeforeShow

//Custom Code @17-2A29BDB7
// -------------------------
$movimientoscaja->tipomovimiento->SetValue('C');
// -------------------------
//End Custom Code

//Close movimientoscaja_tipomovimiento_BeforeShow @9-3B3BFF21
    return $movimientoscaja_tipomovimiento_BeforeShow;
}
//End Close movimientoscaja_tipomovimiento_BeforeShow

//movimientoscaja_OnValidate @3-CFB30F78
function movimientoscaja_OnValidate(& $sender)
{
    $movimientoscaja_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja; //Compatibility
//End movimientoscaja_OnValidate

//Custom Code @19-2A29BDB7
// -------------------------
 	$db = new clsDBConnection1();
	$sql = "EXEC sp_validarcierrecaja ".$db->ToSQL($movimientoscaja->fecha->GetValue(),cssDate);
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if ($db->f("resultado")!='0')
		{
			$movimientoscaja->Errors->addError("No puede ingresar movimientos de caja en esta fecha. Verifique que no haya sido cerrada la caja");
		}
	}
	$db->close();

// -------------------------
//End Custom Code

//Close movimientoscaja_OnValidate @3-03C30BC6
    return $movimientoscaja_OnValidate;
}
//End Close movimientoscaja_OnValidate

//movimientoscaja_BeforeShow @3-CABC9A0B
function movimientoscaja_BeforeShow(& $sender)
{
    $movimientoscaja_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja; //Compatibility
//End movimientoscaja_BeforeShow

//Custom Code @41-2A29BDB7
// -------------------------
if(CCGetParam('fecha','') == '')
	$movimientoscaja->Visible = false;
// -------------------------
//End Custom Code

//Close movimientoscaja_BeforeShow @3-3C386F4F
    return $movimientoscaja_BeforeShow;
}
//End Close movimientoscaja_BeforeShow

//movimientoscaja1_BeforeShow @20-D86C33EA
function movimientoscaja1_BeforeShow(& $sender)
{
    $movimientoscaja1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja1; //Compatibility
//End movimientoscaja1_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
if(CCGetParam('fecha','') == '')
	$movimientoscaja1->Visible = false;
// -------------------------
//End Custom Code

//Close movimientoscaja1_BeforeShow @20-D10B2086
    return $movimientoscaja1_BeforeShow;
}
//End Close movimientoscaja1_BeforeShow

//Page_BeforeInitialize @1-FCBE0BE8
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ingresocaja_old; //Compatibility
//End Page_BeforeInitialize

//Custom Code @18-2A29BDB7
// -------------------------
include_once("auth.php");
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
