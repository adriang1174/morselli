<?php

//DEL  // -------------------------
//DEL     //error_log($cajaresumen->fecha->GetValue());
//DEL      //if(strlen($cajaresumen->fecha->GetValue())>10)
//DEL  	//{
//DEL  		//Hay que formatear
//DEL  		//2009-08-26 00:00:00.000
//DEL  		//$y = substr($cajaresumen->fecha->GetValue(),0,4);
//DEL  		//$m = substr($cajaresumen->fecha->GetValue(),5,2);
//DEL  		//$d = substr($cajaresumen->fecha->GetValue(),8,2);
//DEL  		//$cajaresumen->fecha->SetValue($d."/".$m."/".$y);
//DEL  	//}	
//DEL  // -------------------------

//BindEvents Method @1-DCC6C8A9
function BindEvents()
{
    global $cajaresumen;
    global $CCSEvents;
    $cajaresumen->saldoinicial->CCSEvents["BeforeShow"] = "cajaresumen_saldoinicial_BeforeShow";
    $cajaresumen->fecha->CCSEvents["BeforeShow"] = "cajaresumen_fecha_BeforeShow";
    $cajaresumen->CCSEvents["OnValidate"] = "cajaresumen_OnValidate";
    $cajaresumen->CCSEvents["BeforeShow"] = "cajaresumen_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//cajaresumen_saldoinicial_BeforeShow @10-710040E9
function cajaresumen_saldoinicial_BeforeShow(& $sender)
{
    $cajaresumen_saldoinicial_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajaresumen; //Compatibility
//End cajaresumen_saldoinicial_BeforeShow

//Custom Code @20-2A29BDB7
// -------------------------
//Proponemos saldo final del dia ant

 	$db = new clsDBConnection1();
	$sql = "select isnull(saldofinal,0) as saldoant from cajaresumen
			where fecha = convert(varchar ,getdate()-1,103)";
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$cajaresumen->saldoinicial->SetValue($db->f("saldoant"));
	}
	$db->close();
// -------------------------
//End Custom Code

//Close cajaresumen_saldoinicial_BeforeShow @10-DACDD206
    return $cajaresumen_saldoinicial_BeforeShow;
}
//End Close cajaresumen_saldoinicial_BeforeShow

//cajaresumen_fecha_BeforeShow @14-C3AA362A
function cajaresumen_fecha_BeforeShow(& $sender)
{
    $cajaresumen_fecha_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajaresumen; //Compatibility
//End cajaresumen_fecha_BeforeShow

//Custom Code @17-2A29BDB7
// -------------------------
if(CCGetParam('s_fecha','') <> '')
{
			$fecha = CCGetParam('s_fecha','');
			$y = substr($fecha,6,4);
  			$m = substr($fecha,3,2);
  			$d = substr($fecha,0,2);
			$fecha= $y."-".$m."-".$d." ".date("H:i:s");
			$cajaresumen->DataSource->fecha->SetDBValue($fecha);
			$cajaresumen->fecha->SetValue($cajaresumen->DataSource->fecha->GetValue());
}
/*

if(strlen($cajaresumen->fecha->GetValue())==0)
{
  		//$cajaresumen->fecha->SetValue(date("d/m/Y"));
		$cajaresumen->fecha->SetValue(CCGetParam('s_fecha',''));
}
*/
/*
if(strlen($cajaresumen->fecha->GetValue())>10)
{
  		//Hay que formatear
  		//2009-08-26 00:00:00.000
  		$y = substr($cajaresumen->fecha->GetValue(),0,4);
  		$m = substr($cajaresumen->fecha->GetValue(),5,2);
  		$d = substr($cajaresumen->fecha->GetValue(),8,2);
  		$cajaresumen->fecha->SetValue($d."/".$m."/".$y);
}	
*/
// ------------
// -------------------------
//End Custom Code

//Close cajaresumen_fecha_BeforeShow @14-1DDAE2EC
    return $cajaresumen_fecha_BeforeShow;
}
//End Close cajaresumen_fecha_BeforeShow

//cajaresumen_OnValidate @3-F724A16F
function cajaresumen_OnValidate(& $sender)
{
    $cajaresumen_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajaresumen; //Compatibility
//End cajaresumen_OnValidate

//Custom Code @21-2A29BDB7
// -------------------------
 	$db = new clsDBConnection1();
	
	$sql = "EXEC sp_validaraperturacaja ".$db->ToSQL(substr($cajaresumen->fecha->GetFormattedValue(),0,10),cssDate);
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if ($db->f("resultado")!='0')
			$cajaresumen->Errors->addError($db->f("desc_resultado"));
	}
	$db->close();

// -------------------------
//End Custom Code

//Close cajaresumen_OnValidate @3-3045B88C
    return $cajaresumen_OnValidate;
}
//End Close cajaresumen_OnValidate

//cajaresumen_BeforeShow @3-2AA29C74
function cajaresumen_BeforeShow(& $sender)
{
    $cajaresumen_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajaresumen; //Compatibility
//End cajaresumen_BeforeShow

//Custom Code @27-2A29BDB7
// -------------------------
if(CCGetParam('s_fecha','') == '')
	$cajaresumen->Visible = false;
// -------------------------
//End Custom Code

//Close cajaresumen_BeforeShow @3-0FBEDC05
    return $cajaresumen_BeforeShow;
}
//End Close cajaresumen_BeforeShow

//DEL  // -------------------------
//DEL  /*if(strlen($cajaresumen->fecha->GetValue())>10)
//DEL  {
//DEL    		//Hay que formatear
//DEL    		//2009-08-26 00:00:00.000
//DEL    		$y = substr($cajaresumen->fecha->GetValue(),0,4);
//DEL    		$m = substr($cajaresumen->fecha->GetValue(),5,2);
//DEL    		$d = substr($cajaresumen->fecha->GetValue(),8,2);
//DEL    		$cajaresumen->fecha->SetValue($d."/".$m."/".$y);
//DEL  }	
//DEL  */
//DEL  // -------------------------

//DEL  // -------------------------
//DEL  //error_log($cajaresumen->DataSource->saldofinal->GetValue());
//DEL  //error_log($cajaresumen->saldofinal->GetValue());
//DEL  if(CCGetParam('s_fecha','') != '')
//DEL  {
//DEL  	 	$db = new clsDBConnection1();
//DEL  		$sql = "EXEC sp_cajadiaria '".CCGetParam('s_fecha','')."'";
//DEL  		$db->query($sql);
//DEL  		$Result = $db->next_record();
//DEL  		if($Result)
//DEL  		{
//DEL  			$cajaresumen2->totalegresos->SetValue($db->f("totalegresos"));
//DEL  			$cajaresumen2->totalingresos->SetValue($db->f("totalingresos"));
//DEL  			$cajaresumen2->saldofinal->SetValue($db->f("saldofinal"));
//DEL  			$cajaresumen2->totalegresosdolar->SetValue($db->f("totalegresosdolar"));
//DEL  			$cajaresumen2->totalingresosdolar->SetValue($db->f("totalingresosdolar"));
//DEL  			$cajaresumen2->saldofinaldolar->SetValue($db->f("saldofinaldolar"));
//DEL  		}
//DEL  		$db->close();
//DEL  }
//DEL  else
//DEL  		$cajaresumen->Visible = false;
//DEL  // -------------------------

//DEL  // -------------------------
//DEL  //error_log($cajaresumen->DataSource->saldofinal->GetValue());
//DEL  /*
//DEL  if($cajaresumen->saldofinal->GetValue() <> '')
//DEL  {
//DEL  	$cajaresumen->UpdateAllowed = false;
//DEL  	$cajaresumen->Errors->addError("Cierre efectuado");
//DEL  }*/
//DEL  // -------------------------

//Page_BeforeInitialize @1-89317F08
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $aperturacaja; //Compatibility
//End Page_BeforeInitialize

//Custom Code @13-2A29BDB7
// -------------------------
include_once("auth.php");
authorize_cash(1);
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-884F8BDF
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $aperturacaja; //Compatibility
	global $cajaresumen;
//End Page_AfterInitialize

//Custom Code @28-2A29BDB7
// -------------------------

/*****
 * Comentario transitorio, corregir
 *
if(CCGetParam('s_fecha','') != '')
{
 	$db = new clsDBConnection1();
	$sql = "EXEC sp_validaraperturacaja ".$db->ToSQL(CCGetParam('s_fecha',''),ccsDate);
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if ($db->f("resultado")!='0')
		{
			$cajaresumen->Errors->addError($db->f("desc_resultado"));
			$cajaresumen->UpdateAllowed = false;
			$cajaresumen->InsertAllowed = false;
			$cajaresumen->DeleteAllowed = false;
		}
	}
	$db->close();
}
*/
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
