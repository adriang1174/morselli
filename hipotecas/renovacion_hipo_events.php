<?php
//BindEvents Method @1-15864997
function BindEvents()
{
    global $hipotecas;
    global $CCSEvents;
    $hipotecas->fechainicio->CCSEvents["BeforeShow"] = "hipotecas_fechainicio_BeforeShow";
    $hipotecas->data_prop->CCSEvents["BeforeShow"] = "hipotecas_data_prop_BeforeShow";
    $hipotecas->data_deudor->CCSEvents["BeforeShow"] = "hipotecas_data_deudor_BeforeShow";
    $hipotecas->fechafin->CCSEvents["BeforeShow"] = "hipotecas_fechafin_BeforeShow";
    $hipotecas->data_acreedor->CCSEvents["BeforeShow"] = "hipotecas_data_acreedor_BeforeShow";
    $hipotecas->idhipotecaold->CCSEvents["BeforeShow"] = "hipotecas_idhipotecaold_BeforeShow";
    $hipotecas->CCSEvents["BeforeShow"] = "hipotecas_BeforeShow";
    $hipotecas->CCSEvents["AfterInsert"] = "hipotecas_AfterInsert";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//hipotecas_fechainicio_BeforeShow @5-809155BA
function hipotecas_fechainicio_BeforeShow(& $sender)
{
    $hipotecas_fechainicio_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_fechainicio_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
    if(strlen($hipotecas->fechainicio->GetValue())>10 and $hipotecas->Errors->ErrorsCount == 0)
	{
		//Hay que formatear
		//2009-08-26 00:00:00.000
		$y = substr($hipotecas->fechainicio->GetValue(),0,4);
		$m = substr($hipotecas->fechainicio->GetValue(),5,2);
		$d = substr($hipotecas->fechainicio->GetValue(),8,2);
		$hipotecas->fechainicio->SetValue($d."/".$m."/".$y);
	}	
// -------------------------
//End Custom Code

//Close hipotecas_fechainicio_BeforeShow @5-25A6C345
    return $hipotecas_fechainicio_BeforeShow;
}
//End Close hipotecas_fechainicio_BeforeShow

//hipotecas_data_prop_BeforeShow @13-17D6D095
function hipotecas_data_prop_BeforeShow(& $sender)
{
    $hipotecas_data_prop_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_data_prop_BeforeShow

//Custom Code @14-2A29BDB7
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

//Close hipotecas_data_prop_BeforeShow @13-3D76CF8A
    return $hipotecas_data_prop_BeforeShow;
}
//End Close hipotecas_data_prop_BeforeShow

//hipotecas_data_deudor_BeforeShow @15-6F13A13B
function hipotecas_data_deudor_BeforeShow(& $sender)
{
    $hipotecas_data_deudor_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_data_deudor_BeforeShow

//Custom Code @16-2A29BDB7
// -------------------------
    $db = new clsDBConnection1();
	$sql = "select nombre from fichas f
			join fichaspropiedades fp on(f.idficha = fp.idficha)
			join hipotecas h on(h.idpropiedad = fp.idpropiedad)
	where h.idhipoteca = ". CCGetFromGet('s_idhipoteca','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$hipotecas->data_deudor->SetValue($db->f("nombre"));
	}
// -------------------------
//End Custom Code

//Close hipotecas_data_deudor_BeforeShow @15-2FFB92B4
    return $hipotecas_data_deudor_BeforeShow;
}
//End Close hipotecas_data_deudor_BeforeShow

//hipotecas_fechafin_BeforeShow @17-3808AF2B
function hipotecas_fechafin_BeforeShow(& $sender)
{
    $hipotecas_fechafin_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_fechafin_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
    if(strlen($hipotecas->fechafin->GetValue())>10 and $hipotecas->Errors->ErrorsCount == 0)
	{
		//Hay que formatear
		//2009-08-26 00:00:00.000
		$y = substr($hipotecas->fechafin->GetValue(),0,4);
		$m = substr($hipotecas->fechafin->GetValue(),5,2);
		$d = substr($hipotecas->fechafin->GetValue(),8,2);
		$hipotecas->fechafin->SetValue($d."/".$m."/".$y);
	}	

// -------------------------
//End Custom Code

//Close hipotecas_fechafin_BeforeShow @17-83919384
    return $hipotecas_fechafin_BeforeShow;
}
//End Close hipotecas_fechafin_BeforeShow

//hipotecas_data_acreedor_BeforeShow @36-1C8B68F0
function hipotecas_data_acreedor_BeforeShow(& $sender)
{
    $hipotecas_data_acreedor_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_data_acreedor_BeforeShow

//Custom Code @37-2A29BDB7
// -------------------------
    $db = new clsDBConnection1();
	$sql = "select nombre from fichas f
			join fichashipotecas fh on(f.idficha = fh.idficha)
			join hipotecas h on(h.idhipoteca = fh.idhipoteca)
	where h.idhipoteca = ". CCGetFromGet('s_idhipoteca','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$hipotecas->data_acreedor->SetValue($db->f("nombre"));
	}

// -------------------------
//End Custom Code

//Close hipotecas_data_acreedor_BeforeShow @36-72DE4DDD
    return $hipotecas_data_acreedor_BeforeShow;
}
//End Close hipotecas_data_acreedor_BeforeShow

//hipotecas_idhipotecaold_BeforeShow @40-5B27F220
function hipotecas_idhipotecaold_BeforeShow(& $sender)
{
    $hipotecas_idhipotecaold_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_idhipotecaold_BeforeShow

//Custom Code @41-2A29BDB7
// -------------------------
  $hipotecas->idhipotecaold->SetValue(CCGetFromGet('s_idhipoteca','0'));
// -------------------------
//End Custom Code

//Close hipotecas_idhipotecaold_BeforeShow @40-070782B7
    return $hipotecas_idhipotecaold_BeforeShow;
}
//End Close hipotecas_idhipotecaold_BeforeShow

//hipotecas_BeforeShow @3-0DB53850
function hipotecas_BeforeShow(& $sender)
{
    $hipotecas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_BeforeShow

//Custom Code @23-2A29BDB7
// -------------------------
    if(CCGetFromGet('s_idhipoteca','')=='')
		$hipotecas->Visible = false;
	else
	{	
		$renovacion_hipo->hipotecas->Visible = true;

	    $db = new clsDBConnection1();
		$sql = "select dateadd(d,1,fechafin) as fechainicionew,fechafin,fechainicio, idestado,idpropiedad,montohipoteca,h.idmoneda,simbolo from hipotecas h join monedas m on h.idmoneda = m.idmoneda where idhipoteca =".CCGetFromGet('s_idhipoteca','');
		$db->query($sql);
		$Result = $db->next_record();
		if($Result)
		{
			//$hipotecas->data_deudor->SetValue($db->f("nombre"));
			///Ver tema del estado...debería darse de alta como no vigente
			//$hipotecas->idestado->SetValue($db->f("idestado"));
			$hipotecas->idhipoteca->SetValue(CCGetFromGet('s_idhipoteca',0));
			$hipotecas->idestado->SetValue(1);
			$hipotecas->idpropiedad->SetValue($db->f("idpropiedad"));
			$hipotecas->montohipoteca->SetValue($db->f("montohipoteca"));
			$hipotecas->ListBox1->SetValue($db->f("idmoneda"));
			//error_log($db->f("fechainicionew"));
			//error_log(CCFormatDate(CCParseDate($db->f("fechainicionew"),array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn",":","ss")),array("dd","/","mm","/","yyyy")));
			$datei = CCParseDate($db->f("fechainicionew"),array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn",":","ss"));
			//error_log($datei);
			$hipotecas->fechainicio->SetValue($datei);
			
			$txt = "Va a proceder a renovar la operación nro. ".CCGetFromGet('s_idhipoteca','');
			$txt .= ", vigente desde el ".$db->f("fechainicio")." hasta el ".$db->f("fechafin");
			$txt.= ". El monto original de la operación es de ".$db->f("simbolo")." ".$db->f("montohipoteca");
			$hipotecas->data_hipo->SetValue($txt);
			
		}
		$db->close();
	}
// -------------------------
//End Custom Code

//Close hipotecas_BeforeShow @3-84ED4F3D
    return $hipotecas_BeforeShow;
}
//End Close hipotecas_BeforeShow

//hipotecas_AfterInsert @3-9BEF72A3
function hipotecas_AfterInsert(& $sender)
{
    $hipotecas_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_AfterInsert

//Custom Code @38-2A29BDB7
// -------------------------
	    $db = new clsDBConnection1();
		//$sql = "select ident_current('hipotecas') as idhipoteca";
		//$db->query($sql);
		//$Result = $db->next_record();
		//if($Result)
		//{
		
		    $sql = "insert into fichashipotecas select ". $hipotecas->idhipoteca->GetValue() . " as idhipoteca, idficha,porcentajehip, monto,acreedor,deudor
		           from fichashipotecas where idhipoteca = ". $hipotecas->idhipotecaold->GetValue();
			$db->query($sql);
			header('Location: hipotecas_maint.php?idhipoteca='.$hipotecas->idhipoteca->GetValue()."&idpropiedad=".$hipotecas->idpropiedad->GetValue());
			exit;
		//}
// -------------------------
//End Custom Code

//Close hipotecas_AfterInsert @3-21419B91
    return $hipotecas_AfterInsert;
}
//End Close hipotecas_AfterInsert

//Page_BeforeShow @1-D3CCE2FB
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $renovacion_hipo; //Compatibility
//End Page_BeforeShow

//Custom Code @27-2A29BDB7
// -------------------------

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
