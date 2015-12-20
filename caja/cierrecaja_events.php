<?php
//BindEvents Method @1-9A77CF34
function BindEvents()
{
    global $cajaresumen;
    global $CCSEvents;
    $cajaresumen->fecha->CCSEvents["BeforeShow"] = "cajaresumen_fecha_BeforeShow";
    $cajaresumen->CCSEvents["BeforeShow"] = "cajaresumen_BeforeShow";
    $cajaresumen->CCSEvents["OnValidate"] = "cajaresumen_OnValidate";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//cajaresumen_fecha_BeforeShow @8-C3AA362A
function cajaresumen_fecha_BeforeShow(& $sender)
{
    $cajaresumen_fecha_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajaresumen; //Compatibility
//End cajaresumen_fecha_BeforeShow

//Custom Code @14-2A29BDB7
// -------------------------
/*if(strlen($cajaresumen->fecha->GetValue())>10)
{
  		//Hay que formatear
  		//2009-08-26 00:00:00.000
  		$y = substr($cajaresumen->fecha->GetValue(),0,4);
  		$m = substr($cajaresumen->fecha->GetValue(),5,2);
  		$d = substr($cajaresumen->fecha->GetValue(),8,2);
  		$cajaresumen->fecha->SetValue($d."/".$m."/".$y);
}	
*/
// -------------------------
//End Custom Code

//Close cajaresumen_fecha_BeforeShow @8-1DDAE2EC
    return $cajaresumen_fecha_BeforeShow;
}
//End Close cajaresumen_fecha_BeforeShow

//cajaresumen_BeforeShow @3-2AA29C74
function cajaresumen_BeforeShow(& $sender)
{
    $cajaresumen_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajaresumen; //Compatibility
//End cajaresumen_BeforeShow

//Custom Code @17-2A29BDB7
// -------------------------
//error_log($cajaresumen->DataSource->saldofinal->GetValue());
//error_log($cajaresumen->saldofinal->GetValue());
if(CCGetParam('s_fecha','') != '')
{
	 	$db = new clsDBConnection1();
		$sql = "EXEC sp_cajadiaria '".CCGetParam('s_fecha','')."'";
		$db->query($sql);
		$Result = $db->next_record();
		if($Result)
		{
			$cajaresumen->totalegresos->SetValue($db->f("totalegresos"));
			$cajaresumen->totalingresos->SetValue($db->f("totalingresos"));
			$cajaresumen->saldofinal->SetValue($db->f("saldofinal"));
			$cajaresumen->totalegresosdolar->SetValue($db->f("totalegresosdolar"));
			$cajaresumen->totalingresosdolar->SetValue($db->f("totalingresosdolar"));
			$cajaresumen->saldofinaldolar->SetValue($db->f("saldofinaldolar"));
		}
		$db->close();
}
else
		$cajaresumen->Visible = false;
// -------------------------
//End Custom Code

//Close cajaresumen_BeforeShow @3-0FBEDC05
    return $cajaresumen_BeforeShow;
}
//End Close cajaresumen_BeforeShow

//cajaresumen_OnValidate @3-F724A16F
function cajaresumen_OnValidate(& $sender)
{
    $cajaresumen_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajaresumen; //Compatibility
//End cajaresumen_OnValidate

//Custom Code @20-2A29BDB7
// -------------------------
//error_log($cajaresumen->DataSource->saldofinal->GetValue());
/*
if($cajaresumen->saldofinal->GetValue() <> '')
{
	$cajaresumen->UpdateAllowed = false;
	$cajaresumen->Errors->addError("Cierre efectuado");
}*/
// -------------------------
//End Custom Code

//Close cajaresumen_OnValidate @3-3045B88C
    return $cajaresumen_OnValidate;
}
//End Close cajaresumen_OnValidate

//Page_BeforeInitialize @1-6AB4B7E2
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cierrecaja; //Compatibility
//End Page_BeforeInitialize

//Custom Code @18-2A29BDB7
// -------------------------
include_once("auth.php");
authorize_cash(1);
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-E5D09DC5
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cierrecaja; //Compatibility
	global $cajaresumen;
//End Page_AfterInitialize

//Custom Code @21-2A29BDB7
// -------------------------
//error_log($cajaresumen->saldofinal->GetValue());
if(CCGetParam('s_fecha','') != '')
{
 	$db = new clsDBConnection1();
	$sql = "EXEC sp_validarcierrecaja ".$db->ToSQL(CCGetParam('s_fecha',''),ccsDate);
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if ($db->f("resultado")!='0')
		{
			$cajaresumen->Errors->addError($db->f("desc_resultado"));
			$cajaresumen->UpdateAllowed = false;
		}
	}
	$db->close();
}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
