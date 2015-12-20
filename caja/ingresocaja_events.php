<?php
//BindEvents Method @1-C3917D85
function BindEvents()
{
    global $movimientoscaja;
    global $movimientoscaja1;
    global $movimientoscaja2;
    global $CCSEvents;
    $movimientoscaja->fecha->CCSEvents["BeforeShow"] = "movimientoscaja_fecha_BeforeShow";
    $movimientoscaja->fecha->CCSEvents["OnValidate"] = "movimientoscaja_fecha_OnValidate";
    $movimientoscaja->tipomovimiento->CCSEvents["BeforeShow"] = "movimientoscaja_tipomovimiento_BeforeShow";
    $movimientoscaja->CCSEvents["OnValidate"] = "movimientoscaja_OnValidate";
    $movimientoscaja->CCSEvents["BeforeShow"] = "movimientoscaja_BeforeShow";
    $movimientoscaja1->importec->CCSEvents["BeforeShow"] = "movimientoscaja1_importec_BeforeShow";
    $movimientoscaja1->dia->CCSEvents["BeforeShow"] = "movimientoscaja1_dia_BeforeShow";
    $movimientoscaja1->CCSEvents["BeforeShow"] = "movimientoscaja1_BeforeShow";
    $movimientoscaja1->CCSEvents["BeforeShowRow"] = "movimientoscaja1_BeforeShowRow";
    $movimientoscaja2->importec->CCSEvents["BeforeShow"] = "movimientoscaja2_importec_BeforeShow";
    $movimientoscaja2->dia->CCSEvents["BeforeShow"] = "movimientoscaja2_dia_BeforeShow";
    $movimientoscaja2->CCSEvents["BeforeShow"] = "movimientoscaja2_BeforeShow";
    $movimientoscaja2->CCSEvents["BeforeShowRow"] = "movimientoscaja2_BeforeShowRow";
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
		if(CCGetParam('idmovimiento','')=='')
			{
			 		$fecha = CCGetParam('fecha','');
					$y = substr($fecha,6,4);
  					$m = substr($fecha,3,2);
  					$d = substr($fecha,0,2);
					$fecha= $y."-".$m."-".$d." ".date("H:i:s");
			 		$movimientoscaja->DataSource->fecha->SetDBValue($fecha);
			 		$movimientoscaja->fecha->SetValue($movimientoscaja->DataSource->fecha->GetValue());
			 }
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
$movimientoscaja->tipomovimiento->SetValue('C');
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
  	$hora = $movimientoscaja->fecha->GetValue();
	$fecha = substr($movimientoscaja->fecha->GetFormattedValue(),0,10)." 00:00:00";
	$h = $hora[4];
  	$m = $hora[5];
	//error_log("Hora: ".$h."min: ".$m);
	
	if($h<0 or $h>23 or $m<0 or $m>59 or strlen($h)==0 or strlen($m)==0)
  	{	
			$movimientoscaja->Errors->addError("Existe un error en la hora");
	}
	else
	{
			$db = new clsDBConnection1();
			$sql = "EXEC sp_validarcierrecaja ".$db->ToSQL(substr($movimientoscaja->fecha->GetFormattedValue(),0,10),cssDate);
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
if(CCGetParam('fecha','') == '' or CCGetSession("AUTH_CASH",'') <> 1)
	$movimientoscaja->Visible = false;
// -------------------------
//End Custom Code

//Close movimientoscaja_BeforeShow @3-3C386F4F
    return $movimientoscaja_BeforeShow;
}
//End Close movimientoscaja_BeforeShow

//movimientoscaja1_importec_BeforeShow @32-0D44D0D1
function movimientoscaja1_importec_BeforeShow(& $sender)
{
    $movimientoscaja1_importec_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja1; //Compatibility
//End movimientoscaja1_importec_BeforeShow

//Custom Code @48-2A29BDB7
// -------------------------
// -------------------------
//End Custom Code

//Close movimientoscaja1_importec_BeforeShow @32-2BEF9B5A
    return $movimientoscaja1_importec_BeforeShow;
}
//End Close movimientoscaja1_importec_BeforeShow

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
$movimientoscaja1->importec->SetValue(number_format($movimientoscaja1->importec->GetValue(),2,',','.'));
$movimientoscaja1->imported->SetValue(number_format($movimientoscaja1->imported->GetValue(),2,',','.'));
// -------------------------
//End Custom Code

//Close movimientoscaja1_BeforeShowRow @20-3525559F
    return $movimientoscaja1_BeforeShowRow;
}
//End Close movimientoscaja1_BeforeShowRow

//movimientoscaja2_importec_BeforeShow @71-E4F244E7
function movimientoscaja2_importec_BeforeShow(& $sender)
{
    $movimientoscaja2_importec_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja2; //Compatibility
//End movimientoscaja2_importec_BeforeShow

//Custom Code @72-2A29BDB7
// -------------------------
// -------------------------
//End Custom Code

//Close movimientoscaja2_importec_BeforeShow @71-5D0AA267
    return $movimientoscaja2_importec_BeforeShow;
}
//End Close movimientoscaja2_importec_BeforeShow

//movimientoscaja2_dia_BeforeShow @77-DA52886F
function movimientoscaja2_dia_BeforeShow(& $sender)
{
    $movimientoscaja2_dia_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja2; //Compatibility
//End movimientoscaja2_dia_BeforeShow

//Custom Code @78-2A29BDB7
// -------------------------
    $movimientoscaja2->dia->SetValue(CCGetParam("fecha",""));
// -------------------------
//End Custom Code

//Close movimientoscaja2_dia_BeforeShow @77-CF453F32
    return $movimientoscaja2_dia_BeforeShow;
}
//End Close movimientoscaja2_dia_BeforeShow

//movimientoscaja2_BeforeShow @62-D65A1DC0
function movimientoscaja2_BeforeShow(& $sender)
{
    $movimientoscaja2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja2; //Compatibility
//End movimientoscaja2_BeforeShow

//Custom Code @80-2A29BDB7
// -------------------------
if(CCGetParam('fecha','') == '')
	$movimientoscaja2->Visible = false;

// -------------------------
//End Custom Code

//Close movimientoscaja2_BeforeShow @62-AD6A055D
    return $movimientoscaja2_BeforeShow;
}
//End Close movimientoscaja2_BeforeShow

//movimientoscaja2_BeforeShowRow @62-AE314B6F
function movimientoscaja2_BeforeShowRow(& $sender)
{
    $movimientoscaja2_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $movimientoscaja2; //Compatibility
//End movimientoscaja2_BeforeShowRow

//Custom Code @81-2A29BDB7
// -------------------------
    if(CCGetSession("AUTH_CASH",'')<> 1)
		$movimientoscaja2->idmovimiento->SetLink("#");
$movimientoscaja2->importec->SetValue(number_format($movimientoscaja2->importec->GetValue(),2,',','.'));
$movimientoscaja2->imported->SetValue(number_format($movimientoscaja2->imported->GetValue(),2,',','.'));
// -------------------------
//End Custom Code

//Close movimientoscaja2_BeforeShowRow @62-66BF0E1B
    return $movimientoscaja2_BeforeShowRow;
}
//End Close movimientoscaja2_BeforeShowRow

//Page_BeforeInitialize @1-5711C732
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ingresocaja; //Compatibility
//End Page_BeforeInitialize

//Custom Code @18-2A29BDB7
// -------------------------
include_once("auth.php");
authorize_cash();
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
