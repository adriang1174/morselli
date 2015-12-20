<?php
//BindEvents Method @1-36DF8CA0
function BindEvents()
{
    global $hipoteca;
    global $deudores;
    global $deuda;
    global $acreedores;
    global $Anula;
    $hipoteca->CCSEvents["BeforeShow"] = "hipoteca_BeforeShow";
    $deudores->CCSEvents["BeforeShow"] = "deudores_BeforeShow";
    $deuda->Label1->CCSEvents["BeforeShow"] = "deuda_Label1_BeforeShow";
    $deuda->CCSEvents["BeforeShow"] = "deuda_BeforeShow";
    $acreedores->CCSEvents["BeforeShow"] = "acreedores_BeforeShow";
    $Anula->CCSEvents["BeforeShow"] = "Anula_BeforeShow";
}
//End BindEvents Method

//DEL  // -------------------------
//DEL      if(CCGetParam('idhipoteca','')!='')
//DEL  	{
//DEL  		$db = new clsDBConnection1();
//DEL  		$sql = "select * from hipotecas where idestado =1 and idhipoteca = ".CCGetParam('idhipoteca','') ;
//DEL  		$db->query($sql);
//DEL  		$Result = $db->next_record();
//DEL  		if(!$Result)
//DEL  				$hipotecas->Errors->addError("La operación no existe o no está vigente");
//DEL  	}
//DEL  // -------------------------

//hipoteca_BeforeShow @6-44C26A23
function hipoteca_BeforeShow(& $sender)
{
    $hipoteca_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipoteca; //Compatibility
//End hipoteca_BeforeShow

//Custom Code @111-2A29BDB7
// -------------------------
if(CCGetParam('idhipoteca','')!='')
{
  if ($hipoteca->DataSource->RecordsCount == 0) 
     $hipoteca->Visible = False;
  else
	{
		$hipoteca->Visible = True;
		$db = new clsDBConnection1();
		$sql = "select count(*) as cuotaspagas from hipotecas h
				join cuotas c on(h.idhipoteca = c.idhipoteca)
				where h.idestado in(1,4) and h.idhipoteca = ".CCGetParam('idhipoteca','') . " and
				fechapago is not null";
		$db->query($sql);
		$Result = $db->next_record();
		if($db->f('cuotaspagas') == 0)
				$hipoteca->cuotaspagas->SetValue("No");
		else
	    		$hipoteca->cuotaspagas->SetValue("Si");
		$db->close();
	}

}
else
	$hipoteca->Visible = false;

// -------------------------
//End Custom Code

//Close hipoteca_BeforeShow @6-02A0DF18
    return $hipoteca_BeforeShow;
}
//End Close hipoteca_BeforeShow

//deudores_BeforeShow @28-63790833
function deudores_BeforeShow(& $sender)
{
    $deudores_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $deudores; //Compatibility
//End deudores_BeforeShow

//Custom Code @112-2A29BDB7
// -------------------------
if(CCGetParam('idhipoteca','')!='')
{
  if ($deudores->DataSource->RecordsCount == 0) 
     $deudores->Visible = False;
  else
	$deudores->Visible = True;

}
else
	$deudores->Visible = false;
// -------------------------
//End Custom Code

//Close deudores_BeforeShow @28-39E37655
    return $deudores_BeforeShow;
}
//End Close deudores_BeforeShow

//deuda_Label1_BeforeShow @56-3C70009B
function deuda_Label1_BeforeShow(& $sender)
{
    $deuda_Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $deuda; //Compatibility
//End deuda_Label1_BeforeShow

//Custom Code @115-2A29BDB7
// -------------------------
    $deuda->Label1->SetValue(date("d/m/Y"));
// -------------------------
//End Custom Code

//Close deuda_Label1_BeforeShow @56-7C1FDFDD
    return $deuda_Label1_BeforeShow;
}
//End Close deuda_Label1_BeforeShow

//deuda_BeforeShow @50-CDF1E129
function deuda_BeforeShow(& $sender)
{
    $deuda_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $deuda; //Compatibility
//End deuda_BeforeShow

//Custom Code @113-2A29BDB7
// -------------------------
if(CCGetParam('idhipoteca','')!='')
{
		$db = new clsDBConnection1();
		$sql = "select * from hipotecas where idestado = 1 and idhipoteca = ".CCGetParam('idhipoteca','') ;
		$db->query($sql);
		$Result = $db->next_record();
		if($Result)
				$deuda->Visible = true;
		else
	    		$deuda->Visible = false;
}
else
		$deuda->Visible = false;

// -------------------------
//End Custom Code

//Close deuda_BeforeShow @50-26F827BC
    return $deuda_BeforeShow;
}
//End Close deuda_BeforeShow

//acreedores_BeforeShow @57-2FC399E1
function acreedores_BeforeShow(& $sender)
{
    $acreedores_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $acreedores; //Compatibility
//End acreedores_BeforeShow

//Custom Code @80-2A29BDB7
// -------------------------
$acreedores->idhipoteca->SetValue(CCGetParam('idhipoteca',''));

if(CCGetParam('idhipoteca','')!='')
{
  if ($acreedores->DataSource->RecordsCount == 0) 
     $acreedores->Visible = False;
  else
	$acreedores->Visible = True;
}
else
	$acreedores->Visible = false;
// -------------------------
//End Custom Code

//Close acreedores_BeforeShow @57-67FA95E8
    return $acreedores_BeforeShow;
}
//End Close acreedores_BeforeShow

//DEL  // -------------------------
//DEL  if(CCGetParam('idhipoteca','')!='')
//DEL  {
//DEL  		$db = new clsDBConnection1();
//DEL  		$sql = "select * from hipotecas where idestado =1 and idhipoteca = ".CCGetParam('idhipoteca','') ;
//DEL  		$db->query($sql);
//DEL  		$Result = $db->next_record();
//DEL  		if($Result)
//DEL  				$fichashipotecascesion->Visible = true;
//DEL  		else
//DEL  	    		$fichashipotecascesion->Visible = false;
//DEL  }
//DEL  else
//DEL  		$fichashipotecascesion->Visible = false;
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL  	if($fichashipotecascesion->idficha->GetValue()!='')
//DEL  	{
//DEL  	$db = new clsDBConnection1();
//DEL  	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichashipotecascesion->idficha->GetValue();
//DEL  	$db->query($sql);
//DEL  	$Result = $db->next_record();
//DEL  	if($Result)
//DEL  	{
//DEL  		$fichashipotecascesion->nombre->SetValue($db->f('nombre'));
//DEL  		$fichashipotecascesion->nrodocumento->SetValue($db->f('nrodocumento'));
//DEL  	}
//DEL  	}
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL  for ($j = 1; $j <= $fichashipotecascesion->PageSize + $fichashipotecascesion->EmptyRows; $j++)  
//DEL  if (strlen(CCGetParam("porcentajehip_" . $j, ""))!=0 )  
//DEL  $total += CCGetParam("porcentajehip_" . $j, "");
//DEL  
//DEL  if (round($total) !=100)
//DEL  	if($fichashipotecascesion->Errors->Count() == 0)
//DEL  	{
//DEL  		$fichashipotecascesion->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
//DEL  	}
//DEL  
//DEL  // -------------------------

//Anula_BeforeShow @106-6F0D4460
function Anula_BeforeShow(& $sender)
{
    $Anula_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Anula; //Compatibility
//End Anula_BeforeShow

//Custom Code @114-2A29BDB7
// -------------------------
if(CCGetParam('idhipoteca','')!='')
{
		/*
		$db = new clsDBConnection1();
		$sql = "select count(*) as cuotaspagas from hipotecas h
				join cuotas c on(h.idhipoteca = c.idhipoteca)
				where h.idestado in(1,4) and h.idhipoteca = ".CCGetParam('idhipoteca','') . " and
				fechapago is not null";
		$db->query($sql);
		$Result = $db->next_record();
		if($db->f('cuotaspagas') == 0)
				$Anula->Visible = true;
		else
	    		$Anula->Visible = false;
		*/
		$Anula->Visible = true;
		if(CCGetParam('st','') == 'a')
		{
				$Anula->exito->SetValue("La operación ha sido anulada");
				$Anula->Button_Insert->Visible = false;
		}
}
else
		$Anula->Visible = false;
// -------------------------
//End Custom Code

//Close Anula_BeforeShow @106-E54726F6
    return $Anula_BeforeShow;
}
//End Close Anula_BeforeShow
//DEL  // -------------------------
//DEL  
//DEL  // -------------------------

?>
