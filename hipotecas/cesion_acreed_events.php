<?php
//BindEvents Method @1-431BF260
function BindEvents()
{
    global $hipoteca;
    global $deudores;
    global $deuda;
    global $acreedores;
    global $fichashipotecascesion;
    global $Cesion;
    $hipoteca->CCSEvents["BeforeShow"] = "hipoteca_BeforeShow";
    $deudores->CCSEvents["BeforeShow"] = "deudores_BeforeShow";
    $deuda->Label1->CCSEvents["BeforeShow"] = "deuda_Label1_BeforeShow";
    $deuda->CCSEvents["BeforeShow"] = "deuda_BeforeShow";
    $acreedores->CCSEvents["BeforeShow"] = "acreedores_BeforeShow";
    $fichashipotecascesion->CCSEvents["BeforeShow"] = "fichashipotecascesion_BeforeShow";
    $fichashipotecascesion->CCSEvents["BeforeShowRow"] = "fichashipotecascesion_BeforeShowRow";
    $fichashipotecascesion->CCSEvents["OnValidate"] = "fichashipotecascesion_OnValidate";
    $Cesion->CCSEvents["BeforeShow"] = "Cesion_BeforeShow";
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
	$hipoteca->Visible = True;

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
		$sql = "select * from hipotecas where idestado =1 and idhipoteca = ".CCGetParam('idhipoteca','') ;
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

//fichashipotecascesion_BeforeShow @81-7E9316C1
function fichashipotecascesion_BeforeShow(& $sender)
{
    $fichashipotecascesion_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecascesion; //Compatibility
//End fichashipotecascesion_BeforeShow

//Custom Code @92-2A29BDB7
// -------------------------
if(CCGetParam('idhipoteca','')!='')
{
		$db = new clsDBConnection1();
		$sql = "select * from hipotecas where idestado =1 and idhipoteca = ".CCGetParam('idhipoteca','') ;
		$db->query($sql);
		$Result = $db->next_record();
		if($Result)
				$fichashipotecascesion->Visible = true;
		else
	    		$fichashipotecascesion->Visible = false;
}
else
		$fichashipotecascesion->Visible = false;

// -------------------------
//End Custom Code

//Close fichashipotecascesion_BeforeShow @81-588BA03D
    return $fichashipotecascesion_BeforeShow;
}
//End Close fichashipotecascesion_BeforeShow

//fichashipotecascesion_BeforeShowRow @81-827E0AB0
function fichashipotecascesion_BeforeShowRow(& $sender)
{
    $fichashipotecascesion_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecascesion; //Compatibility
//End fichashipotecascesion_BeforeShowRow

//Custom Code @93-2A29BDB7
// -------------------------
	if($fichashipotecascesion->idficha->GetValue()!='')
	{
	$db = new clsDBConnection1();
	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichashipotecascesion->idficha->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$fichashipotecascesion->nombre->SetValue($db->f('nombre'));
		$fichashipotecascesion->nrodocumento->SetValue($db->f('nrodocumento'));
	}
	}

// -------------------------
//End Custom Code

//Close fichashipotecascesion_BeforeShowRow @81-2A155F8C
    return $fichashipotecascesion_BeforeShowRow;
}
//End Close fichashipotecascesion_BeforeShowRow

//fichashipotecascesion_OnValidate @81-81056E3A
function fichashipotecascesion_OnValidate(& $sender)
{
    $fichashipotecascesion_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichashipotecascesion; //Compatibility
//End fichashipotecascesion_OnValidate

//Custom Code @94-2A29BDB7
// -------------------------
for ($j = 1; $j <= $fichashipotecascesion->PageSize + $fichashipotecascesion->EmptyRows; $j++)  
if (strlen(CCGetParam("porcentajehip_" . $j, ""))!=0 )  
$total += CCGetParam("porcentajehip_" . $j, "");

if (round($total) !=100)
	if($fichashipotecascesion->Errors->Count() == 0)
	{
		$fichashipotecascesion->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
	}

// -------------------------
//End Custom Code

//Close fichashipotecascesion_OnValidate @81-6770C4B4
    return $fichashipotecascesion_OnValidate;
}
//End Close fichashipotecascesion_OnValidate

//Cesion_BeforeShow @106-DBF480A2
function Cesion_BeforeShow(& $sender)
{
    $Cesion_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Cesion; //Compatibility
//End Cesion_BeforeShow

//Custom Code @114-2A29BDB7
// -------------------------
if(CCGetParam('idhipoteca','')!='')
{
		$db = new clsDBConnection1();
		$sql = "select * from hipotecas where idestado =1 and idhipoteca = ".CCGetParam('idhipoteca','') ;
		$db->query($sql);
		$Result = $db->next_record();
		if($Result)
				$Cesion->Visible = true;
		else
	    		$Cesion->Visible = false;
}
else
		$Cesion->Visible = false;
// -------------------------
//End Custom Code

//Close Cesion_BeforeShow @106-AB8D2C78
    return $Cesion_BeforeShow;
}
//End Close Cesion_BeforeShow

//DEL  // -------------------------
//DEL  
//DEL  // -------------------------

?>
