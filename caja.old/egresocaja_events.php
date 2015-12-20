<?php
//BindEvents Method @1-8A6C1563
function BindEvents()
{
    global $movimientoscaja;
    global $movimientoscaja1;
    global $CCSEvents;
    $movimientoscaja->fecha->CCSEvents["BeforeShow"] = "movimientoscaja_fecha_BeforeShow";
    $movimientoscaja->fecha->CCSEvents["OnValidate"] = "movimientoscaja_fecha_OnValidate";
    $movimientoscaja->tipomovimiento->CCSEvents["BeforeShow"] = "movimientoscaja_tipomovimiento_BeforeShow";
    $movimientoscaja->CCSEvents["OnValidate"] = "movimientoscaja_OnValidate";
    $movimientoscaja->CCSEvents["BeforeShow"] = "movimientoscaja_BeforeShow";
    $movimientoscaja1->dia->CCSEvents["BeforeShow"] = "movimientoscaja1_dia_BeforeShow";
    $movimientoscaja1->CCSEvents["BeforeShow"] = "movimientoscaja1_BeforeShow";
    $movimientoscaja1->CCSEvents["BeforeShowRow"] = "movimientoscaja1_BeforeShowRow";
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
//if(CCGetParam('idmovimiento','')=='')
//	$movimientoscaja->fecha->SetValue(CCGetParam('fecha','')

if(strlen($movimientoscaja->fecha->GetValue())>10 and $movimientoscaja->Errors->ErrorsCount == 0)
{
  		//Hay que formatear
  		//2009-08-26 00:00:00.000
  		$y = substr($movimientoscaja->fecha->GetValue(),0,4);
  		$m = substr($movimientoscaja->fecha->GetValue(),5,2);
  		$d = substr($movimientoscaja->fecha->GetValue(),8,2);
		$h = substr($movimientoscaja->fecha->GetValue(),11,2);
		$i = substr($movimientoscaja->fecha->GetValue(),14,2);
		$s = substr($movimientoscaja->fecha->GetValue(),17,2);
  		$movimientoscaja->fecha->SetValue($d."/".$m."/".$y." ".$h.":".$i.":".$s);
//		$movimientoscaja->fecha->SetValue($d."/".$m."/".$y);
//		$movimientoscaja->hora->SetValue($h.":".$i.":".$s);
}
else
		if(CCGetParam('idmovimiento','')=='')
			$movimientoscaja->fecha->SetValue(CCGetParam('fecha','')." ".date("H:n:i"));
// -------------------------
//End Custom Code

//Close movimientoscaja_fecha_BeforeShow @13-0A610B0C
    return $movimientoscaja_fecha_BeforeShow;
}
//End Close movimientoscaja_fecha_BeforeShow

//movimientoscaja_fecha_OnValidate @13-0D9AC5B5
function movimientoscaja_fecha_OnValidate(& $sender)
{
    $movimientoscaja_fecha_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja; //Compatibility
//End movimientoscaja_fecha_OnValidate

//Custom Code @43-2A29BDB7
// -------------------------
 //$movimientoscaja->fecha->SetValue($movimientoscaja->fecha->GetValue(). " ".date("H:i:s"));
// -------------------------
//End Custom Code

//Close movimientoscaja_fecha_OnValidate @13-359A6F85
    return $movimientoscaja_fecha_OnValidate;
}
//End Close movimientoscaja_fecha_OnValidate

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
$movimientoscaja->tipomovimiento->SetValue('D');
// -------------------------
//End Custom Code

//Close movimientoscaja_tipomovimiento_BeforeShow @9-3B3BFF21
    return $movimientoscaja_tipomovimiento_BeforeShow;
}
//End Close movimientoscaja_tipomovimiento_BeforeShow

//DEL  // -------------------------
//DEL  	//Validamos la hora
//DEL  	list($h,$m,$s) = split(":",$movimientoscaja->hora->GetValue());
//DEL  	if($h<0 or $h>23 or $m<0 or $m>59 or strlen($h)==0 or strlen($m)==0)
//DEL  		$movimientoscaja->Errors->addError("Existe un error en la hora");
//DEL  // -------------------------

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
 	$hora = substr($movimientoscaja->fecha->GetValue(),11,8);
  	list($h,$m,$s) = split(":",$hora);
  	if($h<0 or $h>23 or $m<0 or $m>59 or strlen($h)==0 or strlen($m)==0)
  	{	
			$movimientoscaja->Errors->addError("Existe un error en la hora");
	}
	else
	{
			$db = new clsDBConnection1();
			$sql = "EXEC sp_validarcierrecaja ".$db->ToSQL(substr($movimientoscaja->fecha->GetValue(),0,10),cssDate);
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
	}
//$movimientoscaja->fecha->SetValue($movimientoscaja->fecha->GetValue()." ".$movimientoscaja->hora->GetValue());
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
if(CCGetParam('fecha','') == '' or CCGetSession("AUTH_CASH",'')<> 1)
	$movimientoscaja->Visible = false;
// -------------------------
//End Custom Code

//Close movimientoscaja_BeforeShow @3-3C386F4F
    return $movimientoscaja_BeforeShow;
}
//End Close movimientoscaja_BeforeShow

//movimientoscaja1_dia_BeforeShow @45-FA436904
function movimientoscaja1_dia_BeforeShow(& $sender)
{
    $movimientoscaja1_dia_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja1; //Compatibility
//End movimientoscaja1_dia_BeforeShow

//Custom Code @46-2A29BDB7
// -------------------------
    $movimientoscaja1->dia->SetValue(CCGetParam("fecha",""));
// -------------------------
//End Custom Code

//Close movimientoscaja1_dia_BeforeShow @45-25C3E250
    return $movimientoscaja1_dia_BeforeShow;
}
//End Close movimientoscaja1_dia_BeforeShow

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

//movimientoscaja1_BeforeShowRow @20-B3917F45
function movimientoscaja1_BeforeShowRow(& $sender)
{
    $movimientoscaja1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja1; //Compatibility
//End movimientoscaja1_BeforeShowRow

//Custom Code @47-2A29BDB7
// -------------------------
    if(CCGetSession("AUTH_CASH",'')<> 1)
		$movimientoscaja1->idmovimiento->SetLink("#");
// -------------------------
//End Custom Code

//Close movimientoscaja1_BeforeShowRow @20-3525559F
    return $movimientoscaja1_BeforeShowRow;
}
//End Close movimientoscaja1_BeforeShowRow

//Page_BeforeInitialize @1-FD1CAF21
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $egresocaja; //Compatibility
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
