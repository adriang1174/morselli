<?php
//BindEvents Method @1-06EA5A22
function BindEvents()
{
    global $hipotecas;
    global $fichashipotecas;
    global $fichashipotecasRO;
    global $generacuotas;
    global $deuda;
    global $CCSEvents;
    $hipotecas->montohipoteca->CCSEvents["BeforeShow"] = "hipotecas_montohipoteca_BeforeShow";
    $hipotecas->fechainicio->CCSEvents["BeforeShow"] = "hipotecas_fechainicio_BeforeShow";
    $hipotecas->data_prop->CCSEvents["BeforeShow"] = "hipotecas_data_prop_BeforeShow";
    $hipotecas->data_deudor->CCSEvents["BeforeShow"] = "hipotecas_data_deudor_BeforeShow";
    $hipotecas->fechafin->CCSEvents["BeforeShow"] = "hipotecas_fechafin_BeforeShow";
    $hipotecas->idhipoteca->CCSEvents["BeforeShow"] = "hipotecas_idhipoteca_BeforeShow";
    $hipotecas->CCSEvents["BeforeUpdate"] = "hipotecas_BeforeUpdate";
    $fichashipotecas->CCSEvents["BeforeShow"] = "fichashipotecas_BeforeShow";
    $fichashipotecas->CCSEvents["BeforeShowRow"] = "fichashipotecas_BeforeShowRow";
    $fichashipotecas->CCSEvents["OnValidate"] = "fichashipotecas_OnValidate";
    $fichashipotecasRO->CCSEvents["BeforeShow"] = "fichashipotecasRO_BeforeShow";
    $fichashipotecasRO->CCSEvents["BeforeShowRow"] = "fichashipotecasRO_BeforeShowRow";
    $generacuotas->CCSEvents["BeforeShow"] = "generacuotas_BeforeShow";
    $generacuotas->CCSEvents["BeforeInsert"] = "generacuotas_BeforeInsert";
    $deuda->Label1->CCSEvents["BeforeShow"] = "deuda_Label1_BeforeShow";
    $deuda->CCSEvents["BeforeShow"] = "deuda_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//hipotecas_montohipoteca_BeforeShow @9-A6E7FEFB
function hipotecas_montohipoteca_BeforeShow(& $sender)
{
    $hipotecas_montohipoteca_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_montohipoteca_BeforeShow

//Custom Code @87-2A29BDB7
// -------------------------
$monto = $hipotecas->montohipoteca->GetValue();
if(!empty($monto))
	$hipotecas->montohipoteca->SetValue(number_format($monto, 2, ',', '.'));
// -------------------------
//End Custom Code

//Close hipotecas_montohipoteca_BeforeShow @9-A2E739B6
    return $hipotecas_montohipoteca_BeforeShow;
}
//End Close hipotecas_montohipoteca_BeforeShow

//hipotecas_fechainicio_BeforeShow @10-809155BA
function hipotecas_fechainicio_BeforeShow(& $sender)
{
    $hipotecas_fechainicio_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_fechainicio_BeforeShow

//Custom Code @53-2A29BDB7
// -------------------------
/*    if(strlen($hipotecas->fechainicio->GetValue())>10 and $hipotecas->Errors->ErrorsCount == 0)
	{
		//Hay que formatear
		//2009-08-26 00:00:00.000
		$y = substr($hipotecas->fechainicio->GetValue(),0,4);
		$m = substr($hipotecas->fechainicio->GetValue(),5,2);
		$d = substr($hipotecas->fechainicio->GetValue(),8,2);
		$hipotecas->fechainicio->SetValue($d."/".$m."/".$y);
	}	
*/
// -------------------------
//End Custom Code

//Close hipotecas_fechainicio_BeforeShow @10-25A6C345
    return $hipotecas_fechainicio_BeforeShow;
}
//End Close hipotecas_fechainicio_BeforeShow

//hipotecas_data_prop_BeforeShow @17-17D6D095
function hipotecas_data_prop_BeforeShow(& $sender)
{
    $hipotecas_data_prop_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_data_prop_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
    $db = new clsDBConnection1();
	$sql = "select direccion from propiedades where idpropiedad =".$hipotecas->idpropiedad->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$hipotecas->data_prop->SetValue($db->f("direccion"));
	}
// -------------------------
//End Custom Code

//Close hipotecas_data_prop_BeforeShow @17-3D76CF8A
    return $hipotecas_data_prop_BeforeShow;
}
//End Close hipotecas_data_prop_BeforeShow

//hipotecas_data_deudor_BeforeShow @21-6F13A13B
function hipotecas_data_deudor_BeforeShow(& $sender)
{
    $hipotecas_data_deudor_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_data_deudor_BeforeShow

//Custom Code @45-2A29BDB7
// -------------------------
    $db = new clsDBConnection1();
	$sql = "select nombre from fichas where idficha in(select idficha from fichaspropiedades where idpropiedad =".$hipotecas->idpropiedad->GetValue().")";
	$db->query($sql);
	while($db->next_record())
	{
			$txt .=  $db->f("nombre").', ';
	}
	$txt = chop($txt);
	$txt = chop($txt); 
	$hipotecas->data_deudor->SetValue($txt);
	$db->close();
// -------------------------
//End Custom Code

//Close hipotecas_data_deudor_BeforeShow @21-2FFB92B4
    return $hipotecas_data_deudor_BeforeShow;
}
//End Close hipotecas_data_deudor_BeforeShow

//hipotecas_fechafin_BeforeShow @12-3808AF2B
function hipotecas_fechafin_BeforeShow(& $sender)
{
    $hipotecas_fechafin_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_fechafin_BeforeShow

//Custom Code @54-2A29BDB7
// -------------------------
/*    if(strlen($hipotecas->fechafin->GetValue())>10 and $hipotecas->Errors->ErrorsCount == 0)
	{
		//Hay que formatear
		//2009-08-26 00:00:00.000
		$y = substr($hipotecas->fechafin->GetValue(),0,4);
		$m = substr($hipotecas->fechafin->GetValue(),5,2);
		$d = substr($hipotecas->fechafin->GetValue(),8,2);
		$hipotecas->fechafin->SetValue($d."/".$m."/".$y);
	}	
*/
// -------------------------
//End Custom Code

//Close hipotecas_fechafin_BeforeShow @12-83919384
    return $hipotecas_fechafin_BeforeShow;
}
//End Close hipotecas_fechafin_BeforeShow

//hipotecas_idhipoteca_BeforeShow @85-ED852C24
function hipotecas_idhipoteca_BeforeShow(& $sender)
{
    $hipotecas_idhipoteca_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_idhipoteca_BeforeShow

//Custom Code @86-2A29BDB7
// ------------------------

// -------------------------
//End Custom Code

//Close hipotecas_idhipoteca_BeforeShow @85-977B450E
    return $hipotecas_idhipoteca_BeforeShow;
}
//End Close hipotecas_idhipoteca_BeforeShow

//hipotecas_BeforeUpdate @2-725FF2B2
function hipotecas_BeforeUpdate(& $sender)
{
    $hipotecas_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_BeforeUpdate

//Custom Code @88-2A29BDB7
// -------------------------
    $hipotecas->montohipoteca->SetValue(str_replace(',','.',str_replace('.','',$hipotecas->montohipoteca->GetValue())));
// -------------------------
//End Custom Code

//Close hipotecas_BeforeUpdate @2-192F9378
    return $hipotecas_BeforeUpdate;
}
//End Close hipotecas_BeforeUpdate

//fichashipotecas_BeforeShow @22-CBBCBAEC
function fichashipotecas_BeforeShow(& $sender)
{
    $fichashipotecas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecas; //Compatibility
//End fichashipotecas_BeforeShow

//Custom Code @46-2A29BDB7
// -------------------------
if(CCGetFromGet('idhipoteca','')!='')
{
	$db = new clsDBConnection1();
	$sql = 'select count(*) as cant from cuotas where idhipoteca = '.CCGetFromGet('idhipoteca','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
  	{
		if($db->f('cant')>0)
			$fichashipotecas->Visible = false;
		else
			$fichashipotecas->Visible = true;
	}
}
else
	$fichashipotecas->Visible = false;

// -------------------------
//End Custom Code

//Close fichashipotecas_BeforeShow @22-5744E8EB
    return $fichashipotecas_BeforeShow;
}
//End Close fichashipotecas_BeforeShow

//fichashipotecas_BeforeShowRow @22-B6C08B8F
function fichashipotecas_BeforeShowRow(& $sender)
{
    $fichashipotecas_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecas; //Compatibility
//End fichashipotecas_BeforeShowRow

//Custom Code @51-2A29BDB7
// -------------------------
	if($fichashipotecas->idficha->GetValue()!='')
	{
	$db = new clsDBConnection1();
	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichashipotecas->idficha->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$fichashipotecas->nombre->SetValue($db->f('nombre'));
		$fichashipotecas->nrodocumento->SetValue($db->f('nrodocumento'));
	}
	}

// -------------------------
//End Custom Code

//Close fichashipotecas_BeforeShowRow @22-906A0C2D
    return $fichashipotecas_BeforeShowRow;
}
//End Close fichashipotecas_BeforeShowRow

//fichashipotecas_OnValidate @22-CEB32F9F
function fichashipotecas_OnValidate(& $sender)
{
    $fichashipotecas_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecas; //Compatibility
//End fichashipotecas_OnValidate

//Custom Code @56-2A29BDB7
// -------------------------
/*
for ($j = 1; $j <= $fichashipotecas->PageSize + $fichashipotecas->EmptyRows; $j++)  
if (strlen(CCGetParam("porcentajehip_" . $j, ""))!=0 )  
$total += CCGetParam("porcentajehip_" . $j, "");

$fichashipotecas->suma->SetValue(round($total));
*/
/*
if (round($total) !=100)
	if($fichashipotecas->Errors->Count() == 0)
	{
		$fichashipotecas->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
	}

*/
// -------------------------
//End Custom Code

//Close fichashipotecas_OnValidate @22-68BF8C62
    return $fichashipotecas_OnValidate;
}
//End Close fichashipotecas_OnValidate

//fichashipotecasRO_BeforeShow @36-309BA324
function fichashipotecasRO_BeforeShow(& $sender)
{
    $fichashipotecasRO_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecasRO; //Compatibility
//End fichashipotecasRO_BeforeShow

//Custom Code @47-2A29BDB7
// -------------------------
if(CCGetFromGet('idhipoteca','')!='')
{
	$db = new clsDBConnection1();
	$sql = 'select count(*) as cant from cuotas where idhipoteca = '.CCGetFromGet('idhipoteca','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
  	{
		if($db->f('cant')>0)
			$fichashipotecasRO->Visible = true;
		else
			$fichashipotecasRO->Visible = false;
	}
}
else
	$fichashipotecasRO->Visible = false;
// -------------------------
//End Custom Code

//Close fichashipotecasRO_BeforeShow @36-F85EA490
    return $fichashipotecasRO_BeforeShow;
}
//End Close fichashipotecasRO_BeforeShow

//fichashipotecasRO_BeforeShowRow @36-08C8D418
function fichashipotecasRO_BeforeShowRow(& $sender)
{
    $fichashipotecasRO_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecasRO; //Compatibility
//End fichashipotecasRO_BeforeShowRow

//Custom Code @52-2A29BDB7
// -------------------------

	
	$db = new clsDBConnection1();
	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichashipotecasRO->idficha->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$fichashipotecasRO->nombre->SetValue($db->f('nombre'));
		$fichashipotecasRO->nrodocumento->SetValue($db->f('nrodocumento'));
	}
	
// -------------------------
//End Custom Code

//Close fichashipotecasRO_BeforeShowRow @36-69607240
    return $fichashipotecasRO_BeforeShowRow;
}
//End Close fichashipotecasRO_BeforeShowRow

//generacuotas_BeforeShow @67-51377D91
function generacuotas_BeforeShow(& $sender)
{
    $generacuotas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $generacuotas; //Compatibility
//End generacuotas_BeforeShow

//Custom Code @75-2A29BDB7
// -------------------------
 if(CCGetFromGet('idhipoteca','')!='')
{
	$db = new clsDBConnection1();
	$sql = "select count(*) as cantcuotas from cuotas where idhipoteca = ".CCGetFromGet('idhipoteca','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if($db->f("cantcuotas") > 0)
		{
			$generacuotas->exito->SetValue('Cuotas Generadas');
			$generacuotas->Button_Update->Visible = false;
			$generacuotas->Button_Insert->Visible = false;
		}
	}

	$db->close();
	}

// -------------------------
//End Custom Code

//Close generacuotas_BeforeShow @67-BCF4F7D6
    return $generacuotas_BeforeShow;
}
//End Close generacuotas_BeforeShow

//generacuotas_BeforeInsert @67-99AEFF35
function generacuotas_BeforeInsert(& $sender)
{
    $generacuotas_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $generacuotas; //Compatibility
	global $fichashipotecas;
//End generacuotas_BeforeInsert

//Custom Code @89-2A29BDB7
// -------------------------
/*
for ($j = 1; $j <= $fichashipotecas->PageSize + $fichashipotecas->EmptyRows; $j++)  
if (strlen(CCGetParam("porcentajehip_" . $j, ""))!=0 )  
$total += CCGetParam("porcentajehip_" . $j, "");

if (round($total) !=100)

	if($fichashipotecas->suma->GetValue() <> 100.0)
	{
		$fichashipotecas->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
		$generacuotas->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
		$generacuotas_BeforeInsert = false;
	}
*/
// -------------------------
//End Custom Code

//Close generacuotas_BeforeInsert @67-AE367B77
    return $generacuotas_BeforeInsert;
}
//End Close generacuotas_BeforeInsert

//deuda_Label1_BeforeShow @80-3C70009B
function deuda_Label1_BeforeShow(& $sender)
{
    $deuda_Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $deuda; //Compatibility
//End deuda_Label1_BeforeShow

//Custom Code @81-2A29BDB7
// -------------------------
    $deuda->Label1->SetValue(date("d/m/Y"));
// -------------------------
//End Custom Code

//Close deuda_Label1_BeforeShow @80-7C1FDFDD
    return $deuda_Label1_BeforeShow;
}
//End Close deuda_Label1_BeforeShow

//deuda_BeforeShow @76-CDF1E129
function deuda_BeforeShow(& $sender)
{
    $deuda_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $deuda; //Compatibility
//End deuda_BeforeShow

//Custom Code @82-2A29BDB7
// -------------------------
 if(CCGetFromGet('idhipoteca','')!='')
{
	$db = new clsDBConnection1();
	$sql = "select count(*) as cantcuotas from cuotas where idhipoteca = ".CCGetFromGet('idhipoteca','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if($db->f("cantcuotas") > 0)
				$deuda->Visible = true;
		else
				$deuda->Visible = false;
	}
	$db->close();
}
else
	$deuda->Visible = false;
// -------------------------
//End Custom Code

//Close deuda_BeforeShow @76-26F827BC
    return $deuda_BeforeShow;
}
//End Close deuda_BeforeShow

//DEL  // -------------------------
//DEL  
//DEL  if(CCGetFromGet('idhipoteca','')!='')
//DEL  {
//DEL  	$db = new clsDBConnection1();
//DEL  	$sql = "select count(*) as cantcuotas from cuotas where idhipoteca = ".CCGetFromGet('idhipoteca','');
//DEL  	$db->query($sql);
//DEL  	$Result = $db->next_record();
//DEL  	if($Result)
//DEL  	{
//DEL  		if($db->f("cantcuotas") > 0)
//DEL  		{
//DEL  			$anohipoteca->Visible = false;
//DEL  		}
//DEL  		else
//DEL  		{
//DEL  			$anohipoteca->Visible = true;
//DEL  		}
//DEL  	}
//DEL  	$db->close();
//DEL  }
//DEL  else
//DEL  	$anohipoteca->Visible = false;
//DEL  // -------------------------

//DEL  // -------------------------
//DEL  if(CCGetFromGet('idhipoteca','')!='')
//DEL  {
//DEL  	$db = new clsDBConnection1();
//DEL  	$sql = "select count(*) as cantcuotas from cuotas where idhipoteca = ".CCGetFromGet('idhipoteca','');
//DEL  	$db->query($sql);
//DEL  	$Result = $db->next_record();
//DEL  	if($Result)
//DEL  	{
//DEL  		if($db->f("cantcuotas") > 0)
//DEL  		{
//DEL  			$anohipotecaRO->Visible = true;
//DEL  		}
//DEL  		else
//DEL  		{
//DEL  			$anohipotecaRO->Visible = false;
//DEL  		}
//DEL  	}
//DEL  	$db->close();
//DEL  }
//DEL  else
//DEL  	$anohipotecaRO->Visible = false;
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL  if(CCGetFromGet('idhipoteca','')!='')
//DEL  {
//DEL  	$db = new clsDBConnection1();
//DEL  	$sql = "select count(*) as cantcuotas from cuotas where idhipoteca = ".CCGetFromGet('idhipoteca','');
//DEL  	$db->query($sql);
//DEL  	$Result = $db->next_record();
//DEL  	if($Result)
//DEL  	{
//DEL  		if($db->f("cantcuotas") > 0)
//DEL  		{
//DEL  			$generacuotas->exito->SetValue('Cuotas Generadas');
//DEL  			$generacuotas->Button_Update->Visible = false;
//DEL  		}
//DEL  	}
//DEL  
//DEL  	$db->close();
//DEL  }
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL  
//DEL  // -------------------------

//Page_BeforeShow @1-6095AECC
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas_maint; //Compatibility
//End Page_BeforeShow

//Custom Code @55-2A29BDB7
// -------------------------
 $idhipoteca = CCGetFromGet('idhipoteca','');
 if(empty($idhipoteca))
{
 	$idpropiedad = CCGetFromGet('idpropiedad','');
 	$idhipoteca = buscaHipotecaPropiedad($idpropiedad);
 	if(!empty($idhipoteca))
	{
			header("Location: hipotecas_maint.php?idpropiedad=".$idpropiedad."&idhipoteca=".$idhipoteca);
			exit;
	}
}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function buscaHipotecaPropiedad($idpropiedad)
{
   $db = new clsDBConnection1();
	$sql = 'select idhipoteca from hipotecas where idpropiedad = '.$idpropiedad.' and idestado = 1';
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
 		$ret = $db->f('idhipoteca');
	else
		$ret = '';
    $db->close();
	return $ret;
}
?>
