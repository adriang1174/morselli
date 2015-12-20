<?php
//BindEvents Method @1-18686CB2
function BindEvents()
{
    global $alquileres;
    global $anocontratoalquiler;
    global $anocontratoalquilerRO;
    global $fichasalquileres;
    global $generacuotas;
    global $fichasalquileresRO;
    global $CCSEvents;
    $alquileres->fechainicio->CCSEvents["BeforeShow"] = "alquileres_fechainicio_BeforeShow";
    $alquileres->porcentajehonorarios->CCSEvents["OnValidate"] = "alquileres_porcentajehonorarios_OnValidate";
    $alquileres->data_prop->CCSEvents["BeforeShow"] = "alquileres_data_prop_BeforeShow";
    $alquileres->fechafin->CCSEvents["BeforeShow"] = "alquileres_fechafin_BeforeShow";
    $alquileres->CCSEvents["BeforeShow"] = "alquileres_BeforeShow";
    $alquileres->ds->CCSEvents["AfterExecuteInsert"] = "alquileres_ds_AfterExecuteInsert";
    $alquileres->CCSEvents["AfterInsert"] = "alquileres_AfterInsert";
    $alquileres->ds->CCSEvents["BeforeExecuteInsert"] = "alquileres_ds_BeforeExecuteInsert";
    $alquileres->ds->CCSEvents["BeforeBuildInsert"] = "alquileres_ds_BeforeBuildInsert";
    $alquileres->CCSEvents["BeforeInsert"] = "alquileres_BeforeInsert";
    $alquileres->CCSEvents["OnValidate"] = "alquileres_OnValidate";
    $anocontratoalquiler->CCSEvents["BeforeShow"] = "anocontratoalquiler_BeforeShow";
    $anocontratoalquiler->ds->CCSEvents["BeforeBuildInsert"] = "anocontratoalquiler_ds_BeforeBuildInsert";
    $anocontratoalquilerRO->CCSEvents["BeforeShow"] = "anocontratoalquilerRO_BeforeShow";
    $fichasalquileres->CCSEvents["BeforeShow"] = "fichasalquileres_BeforeShow";
    $fichasalquileres->CCSEvents["BeforeShowRow"] = "fichasalquileres_BeforeShowRow";
    $fichasalquileres->CCSEvents["OnValidate"] = "fichasalquileres_OnValidate";
    $generacuotas->Button_Update->CCSEvents["OnClick"] = "generacuotas_Button_Update_OnClick";
    $generacuotas->CCSEvents["BeforeShow"] = "generacuotas_BeforeShow";
    $generacuotas->CCSEvents["OnValidate"] = "generacuotas_OnValidate";
    $fichasalquileresRO->CCSEvents["BeforeShowRow"] = "fichasalquileresRO_BeforeShowRow";
    $fichasalquileresRO->CCSEvents["BeforeShow"] = "fichasalquileresRO_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//alquileres_fechainicio_BeforeShow @10-7255D5C6
function alquileres_fechainicio_BeforeShow(& $sender)
{
    $alquileres_fechainicio_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_fechainicio_BeforeShow

//Custom Code @173-2A29BDB7
// -------------------------
/*    if(strlen($alquileres->fechainicio->GetValue())>10 and $alquileres->Errors->ErrorsCount == 0)
	{
		//Hay que formatear
		//2009-08-26 00:00:00.000
		$y = substr($alquileres->fechainicio->GetValue(),0,4);
		$m = substr($alquileres->fechainicio->GetValue(),5,2);
		$d = substr($alquileres->fechainicio->GetValue(),8,2);
		$alquileres->fechainicio->SetValue($d."/".$m."/".$y);
	}	*/

// -------------------------
//End Custom Code

//Close alquileres_fechainicio_BeforeShow @10-90277D91
    return $alquileres_fechainicio_BeforeShow;
}
//End Close alquileres_fechainicio_BeforeShow

//alquileres_porcentajehonorarios_OnValidate @15-26D4EF27
function alquileres_porcentajehonorarios_OnValidate(& $sender)
{
    $alquileres_porcentajehonorarios_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_porcentajehonorarios_OnValidate

//Custom Code @180-2A29BDB7
// -------------------------

  if ($alquileres->porcentajehonorarios->GetValue() < 1 or $alquileres->porcentajehonorarios->GetValue() > 100) {
    $alquileres->Errors->addError("Los honorarios (%) deben ser entre 1 y 100");
  }

// -------------------------
//End Custom Code

//Close alquileres_porcentajehonorarios_OnValidate @15-F46E755A
    return $alquileres_porcentajehonorarios_OnValidate;
}
//End Close alquileres_porcentajehonorarios_OnValidate

//alquileres_data_prop_BeforeShow @18-DA2C429B
function alquileres_data_prop_BeforeShow(& $sender)
{
    $alquileres_data_prop_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_data_prop_BeforeShow

//Custom Code @168-2A29BDB7
// -------------------------
    // Write your own code here.

$db = new clsDBConnection1();
	$sql = "select direccion from propiedades where idpropiedad =".$alquileres->idpropiedad->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$alquileres->data_prop->SetValue($db->f("direccion"));
	}

// -------------------------
//End Custom Code

//Close alquileres_data_prop_BeforeShow @18-929348BB
    return $alquileres_data_prop_BeforeShow;
}
//End Close alquileres_data_prop_BeforeShow

//alquileres_fechafin_BeforeShow @11-F6F14E3C
function alquileres_fechafin_BeforeShow(& $sender)
{
    $alquileres_fechafin_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_fechafin_BeforeShow

//Custom Code @174-2A29BDB7
// -------------------------
/*    if(strlen($alquileres->fechafin->GetValue())>10 and $alquileres->Errors->ErrorsCount == 0)
	{
		//Hay que formatear
		//2009-08-26 00:00:00.000
		$y = substr($alquileres->fechafin->GetValue(),0,4);
		$m = substr($alquileres->fechafin->GetValue(),5,2);
		$d = substr($alquileres->fechafin->GetValue(),8,2);
		$alquileres->fechafin->SetValue($d."/".$m."/".$y);
	}	*/
// -------------------------
//End Custom Code

//Close alquileres_fechafin_BeforeShow @11-6C0DEE2D
    return $alquileres_fechafin_BeforeShow;
}
//End Close alquileres_fechafin_BeforeShow

//alquileres_BeforeShow @3-AB9DD750
function alquileres_BeforeShow(& $sender)
{
    $alquileres_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
	global $fichasalquileres;
//End alquileres_BeforeShow

//Custom Code @54-2A29BDB7
// -------------------------
//error_log($alquileres->EditMode);
//----------------------------

// -------------------------
//End Custom Code

//Close alquileres_BeforeShow @3-E50CC55C
    return $alquileres_BeforeShow;
}
//End Close alquileres_BeforeShow

//alquileres_ds_AfterExecuteInsert @3-2289F1AB
function alquileres_ds_AfterExecuteInsert(& $sender)
{
    $alquileres_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_ds_AfterExecuteInsert

//Custom Code @81-2A29BDB7
// -------------------------
    // Write your own code here

//error_log($alquileres->idalquiler->GetValue());
//$ret = $alquileres->DataSource->Parameters["varKey85"]->GetValue();
//$ret = $alquileres->DataSource->cp["ret"]->GetValue();

//$alquileres->DataSource->idalquiler->SetValue($ret);
//error_log($ret);
// -------------------------
//End Custom Code

//Close alquileres_ds_AfterExecuteInsert @3-34DEA1AF
    return $alquileres_ds_AfterExecuteInsert;
}
//End Close alquileres_ds_AfterExecuteInsert

//alquileres_AfterInsert @3-1CB978F2
function alquileres_AfterInsert(& $sender)
{
    $alquileres_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_AfterInsert

//Custom Code @82-2A29BDB7
// -------------------------
    // Write your own code here.
//error_log($alquileres->idalquiler->GetValue());
//error_log($alquileres->DataSource->idalquiler->GetValue());
//$alquileres->idalquiler->SetValue(ccgetfrompost("idalquiler",""));
//$alquileres->DataSource->idalquiler->SetValue(ccgetfrompost("idalquiler",""));
// -------------------------
//End Custom Code

//Close alquileres_AfterInsert @3-1B952BD5
    return $alquileres_AfterInsert;
}
//End Close alquileres_AfterInsert

//alquileres_ds_BeforeExecuteInsert @3-7A148321
function alquileres_ds_BeforeExecuteInsert(& $sender)
{
    $alquileres_ds_BeforeExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_ds_BeforeExecuteInsert

//Custom Code @83-2A29BDB7
// -------------------------

// -------------------------
//End Custom Code

//Close alquileres_ds_BeforeExecuteInsert @3-C96DC389
    return $alquileres_ds_BeforeExecuteInsert;
}
//End Close alquileres_ds_BeforeExecuteInsert

//alquileres_ds_BeforeBuildInsert @3-DC944A65
function alquileres_ds_BeforeBuildInsert(& $sender)
{
    $alquileres_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_ds_BeforeBuildInsert

//Custom Code @84-2A29BDB7
// -------------------------

// -------------------------
//End Custom Code

//Close alquileres_ds_BeforeBuildInsert @3-7DA4C202
    return $alquileres_ds_BeforeBuildInsert;
}
//End Close alquileres_ds_BeforeBuildInsert

//alquileres_BeforeInsert @3-65B9A5B8
function alquileres_BeforeInsert(& $sender)
{
    $alquileres_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_BeforeInsert

//Custom Code @87-2A29BDB7
// -------------------------

//	$alquileres->idalquiler->SetValue($curr);
//	$alquileres->DataSource->idalquiler->SetValue($curr);
	//Tengo que ponerlo especifico en el POST sino el sp no lo toma
//	$_POST["idalquiler"] = $curr;
	
	//$alquileres->DataSource->idalquiler->SetValue($curr);
// -------------------------
//End Custom Code

//Close alquileres_BeforeInsert @3-A78D03CE
    return $alquileres_BeforeInsert;
}
//End Close alquileres_BeforeInsert

//alquileres_OnValidate @3-3ADA67E6
function alquileres_OnValidate(& $sender)
{
    $alquileres_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $alquileres; //Compatibility
//End alquileres_OnValidate

//Custom Code @88-2A29BDB7
// -------------------------

// -------------------------
//End Custom Code

//Close alquileres_OnValidate @3-DAF7A1D5
    return $alquileres_OnValidate;
}
//End Close alquileres_OnValidate

//anocontratoalquiler_BeforeShow @92-C913A29D
function anocontratoalquiler_BeforeShow(& $sender)
{
    $anocontratoalquiler_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $anocontratoalquiler; //Compatibility
//End anocontratoalquiler_BeforeShow

//Custom Code @120-2A29BDB7
// -------------------------
$anocontratoalquiler->idalquiler->SetValue(CCGetFromGet('idalquiler',''));
if(CCGetFromGet('idalquiler','')!='')
{
	$db = new clsDBConnection1();
	$sql = "select count(*) as cantcuotas from cuotas where idalquiler = ".CCGetFromGet('idalquiler','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if($db->f("cantcuotas") > 0)
		{
			$anocontratoalquiler->Visible = false;
		}
		else
		{
			$anocontratoalquiler->Visible = true;
		}
	}
	$db->close();
}
else
	$anocontratoalquiler->Visible = false;
// -------------------------
//End Custom Code

//Close anocontratoalquiler_BeforeShow @92-3C3B25C3
    return $anocontratoalquiler_BeforeShow;
}
//End Close anocontratoalquiler_BeforeShow

//anocontratoalquiler_ds_BeforeBuildInsert @92-829490BA
function anocontratoalquiler_ds_BeforeBuildInsert(& $sender)
{
    $anocontratoalquiler_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $anocontratoalquiler; //Compatibility
//End anocontratoalquiler_ds_BeforeBuildInsert

//Custom Code @123-2A29BDB7
// -------------------------
    // Write your own code here.
	$anocontratoalquiler->idalquiler->SetValue(CCGetFromGet('idalquiler',''));
// -------------------------
//End Custom Code

//Close anocontratoalquiler_ds_BeforeBuildInsert @92-C6618C7F
    return $anocontratoalquiler_ds_BeforeBuildInsert;
}
//End Close anocontratoalquiler_ds_BeforeBuildInsert

//anocontratoalquilerRO_BeforeShow @101-69B2A983
function anocontratoalquilerRO_BeforeShow(& $sender)
{
    $anocontratoalquilerRO_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $anocontratoalquilerRO; //Compatibility
//End anocontratoalquilerRO_BeforeShow

//Custom Code @121-2A29BDB7
// -------------------------

if(CCGetFromGet('idalquiler','')!='')
{
	$db = new clsDBConnection1();
	$sql = "select count(*) as cantcuotas from cuotas where idalquiler = ".CCGetFromGet('idalquiler','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if($db->f("cantcuotas") > 0)
		{
			$anocontratoalquilerRO->Visible = true;
		}
		else
		{
			$anocontratoalquilerRO->Visible = false;
		}
	}
	$db->close();
}
else
	$anocontratoalquilerRO->Visible = false;

//$anocontratoalquilerRO->Visible = false;

// -------------------------
//End Custom Code

//Close anocontratoalquilerRO_BeforeShow @101-40D6DF48
    return $anocontratoalquilerRO_BeforeShow;
}
//End Close anocontratoalquilerRO_BeforeShow

//fichasalquileres_BeforeShow @107-1D9A3FA1
function fichasalquileres_BeforeShow(& $sender)
{
    $fichasalquileres_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichasalquileres; //Compatibility
//End fichasalquileres_BeforeShow

//Custom Code @122-2A29BDB7
// -------------------------
if(CCGetFromGet('idalquiler','')!='')
{
	$db = new clsDBConnection1();
	$sql = 'select count(*) as cant from cuotas where idalquiler = '.CCGetFromGet('idalquiler','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
  	{
		if($db->f('cant')>0)
			$fichasalquileres->Visible = false;
		else
			$fichasalquileres->Visible = true;
	}
}
else
	$fichasalquileres->Visible = false;
// -------------------------
//End Custom Code

//Close fichasalquileres_BeforeShow @107-8A6F1B1A
    return $fichasalquileres_BeforeShow;
}
//End Close fichasalquileres_BeforeShow

//fichasalquileres_BeforeShowRow @107-74402249
function fichasalquileres_BeforeShowRow(& $sender)
{
    $fichasalquileres_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichasalquileres; //Compatibility
//End fichasalquileres_BeforeShowRow

//Custom Code @140-2A29BDB7
// -------------------------
	if($fichasalquileres->idficha->GetValue()!='')
	{
	$db = new clsDBConnection1();
	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichasalquileres->idficha->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$fichasalquileres->nombre->SetValue($db->f('nombre'));
		$fichasalquileres->nrodocumento->SetValue($db->f('nrodocumento'));
	}
	}

// -------------------------
//End Custom Code

//Close fichasalquileres_BeforeShowRow @107-B7415E29
    return $fichasalquileres_BeforeShowRow;
}
//End Close fichasalquileres_BeforeShowRow

//fichasalquileres_OnValidate @107-EBF246A8
function fichasalquileres_OnValidate(& $sender)
{
    $fichasalquileres_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichasalquileres; //Compatibility
//End fichasalquileres_OnValidate

//Custom Code @143-2A29BDB7
// -------------------------
for ($j = 1; $j <= $fichasalquileres->PageSize + $fichasalquileres->EmptyRows; $j++)  
if (strlen(CCGetParam("porcentajealq_" . $j, ""))!=0 )  
$total += CCGetParam("porcentajealq_" . $j, "");

if (round($total) !=100)
	if($fichasalquileres->Errors->Count() == 0)
	{
		$fichasalquileres->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
	}

// -------------------------
//End Custom Code

//Close fichasalquileres_OnValidate @107-B5947F93
    return $fichasalquileres_OnValidate;
}
//End Close fichasalquileres_OnValidate

//generacuotas_Button_Update_OnClick @155-BA615EA4
function generacuotas_Button_Update_OnClick(& $sender)
{
    $generacuotas_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $generacuotas; //Compatibility
//End generacuotas_Button_Update_OnClick

//Custom Code @175-2A29BDB7
// -------------------------
//	return confirm('Esta acción perfecciona las cuotas del contrato. Al continuar, ya no podrá modificar la información relativa al mismo. Desea continuar?');

// -------------------------
//End Custom Code

//Close generacuotas_Button_Update_OnClick @155-BC5A1798
    return $generacuotas_Button_Update_OnClick;
}
//End Close generacuotas_Button_Update_OnClick

//generacuotas_BeforeShow @153-51377D91
function generacuotas_BeforeShow(& $sender)
{
    $generacuotas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $generacuotas; //Compatibility
//End generacuotas_BeforeShow

//Custom Code @157-2A29BDB7
// -------------------------
if(CCGetFromGet('idalquiler','')!='')
{
	$db = new clsDBConnection1();
	$sql = "select count(*) as cantcuotas from cuotas where idalquiler = ".CCGetFromGet('idalquiler','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if($db->f("cantcuotas") > 0)
		{
			$generacuotas->exito->SetValue('Cuotas Generadas');
			$generacuotas->Button_Update->Visible = false;
		}
	}

	$db->close();
	}
// -------------------------
//End Custom Code

//Close generacuotas_BeforeShow @153-BCF4F7D6
    return $generacuotas_BeforeShow;
}
//End Close generacuotas_BeforeShow

//generacuotas_OnValidate @153-E77F90F5
function generacuotas_OnValidate(& $sender)
{
    $generacuotas_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $generacuotas; //Compatibility
//End generacuotas_OnValidate

//Custom Code @176-2A29BDB7
// -------------------------
	$db = new clsDBConnection1();
	$sql = 'EXEC SP_VALIDA_CONTRATO '.CCGetFromGet('idalquiler','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if($db->f('resultado')=='1')
			$generacuotas->Errors->addError($db->f('descripcion'));
	}
	$db->close();
// -------------------------
//End Custom Code

//Close generacuotas_OnValidate @153-830F935F
    return $generacuotas_OnValidate;
}
//End Close generacuotas_OnValidate

//fichasalquileresRO_BeforeShowRow @158-D776A0A0
function fichasalquileresRO_BeforeShowRow(& $sender)
{
    $fichasalquileresRO_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichasalquileresRO; //Compatibility
//End fichasalquileresRO_BeforeShowRow

//Custom Code @166-2A29BDB7
// -------------------------
	$db = new clsDBConnection1();
	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichasalquileresRO->idficha->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$fichasalquileresRO->nombre->SetValue($db->f('nombre'));
		$fichasalquileresRO->nrodocumento->SetValue($db->f('nrodocumento'));
	}
// -------------------------
//End Custom Code

//Close fichasalquileresRO_BeforeShowRow @158-8869A0B7
    return $fichasalquileresRO_BeforeShowRow;
}
//End Close fichasalquileresRO_BeforeShowRow

//fichasalquileresRO_BeforeShow @158-1EFDAB56
function fichasalquileresRO_BeforeShow(& $sender)
{
    $fichasalquileresRO_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichasalquileresRO; //Compatibility
//End fichasalquileresRO_BeforeShow

//Custom Code @167-2A29BDB7
// -------------------------
if(CCGetFromGet('idalquiler','')!='')
{
    $db = new clsDBConnection1();
	$sql = 'select count(*) as cant from cuotas where idalquiler = '.CCGetFromGet('idalquiler','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
  	{
		if($db->f('cant')>0)
			$fichasalquileresRO->Visible = true;
		else
			$fichasalquileresRO->Visible = false;
	}
}
else
	$fichasalquileresRO->Visible = false;
// -------------------------
//End Custom Code

//Close fichasalquileresRO_BeforeShow @158-D14D0AE1
    return $fichasalquileresRO_BeforeShow;
}
//End Close fichasalquileresRO_BeforeShow

//Page_BeforeShow @1-10B123F7
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $contrato; //Compatibility
//End Page_BeforeShow

//Custom Code @172-2A29BDB7
// -------------------------
// $idalquiler = CCGetFromGet('idalquiler','');
// if(empty($idalquiler))
//{
// 	$idpropiedad = CCGetFromGet('idpropiedad','');
// 	$idalquiler = buscaContratoAlquiler($idpropiedad);
// 	if(!empty($idalquiler))
//	{
//			header("Location: contrato.php?idpropiedad=".$idpropiedad."&idalquiler=".$idalquiler);
//			exit;
//	}
//}
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//DEL  // -------------------------
//DEL  if(CCGetFromGet('idalquiler','')!='')
//DEL  	$fichasalquileres->Visible = true;
//DEL  else
//DEL  	$fichasalquileres->Visible = false;
//DEL  // -------------------------


//DEL  // -------------------------
//DEL  	if($fichasalquileres->idficha->GetValue()!='')
//DEL  	{
//DEL  	$db = new clsDBConnection1();
//DEL  	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichasalquileres->idficha->GetValue();
//DEL  	$db->query($sql);
//DEL  	$Result = $db->next_record();
//DEL  	if($Result)
//DEL  	{
//DEL  		$fichasalquileres->nombre->SetValue($db->f('nombre'));
//DEL  		$fichasalquileres->nrodocumento->SetValue($db->f('nrodocumento'));
//DEL  	}
//DEL  	}
//DEL  
//DEL  // -------------------------


//DEL  // -------------------------
//DEL  for ($j = 1; $j <= $fichasalquileres->PageSize + $fichasalquileres->EmptyRows; $j++)  
//DEL  if (strlen(CCGetParam("porcentajealq_" . $j, ""))!=0 )  
//DEL  $total += CCGetParam("porcentajealq_" . $j, "");
//DEL  
//DEL  if (round($total) !=100)
//DEL  	if($fichasalquileres->Errors->Count() == 0)
//DEL  	{
//DEL  		$fichasalquileres->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
//DEL  	}
//DEL  
//DEL  // -------------------------


//DEL  // -------------------------
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      $db = new clsDBConnection1();
//DEL  $sql = "select ' - ' + nombre + ' Nro. Doc: '+ nrodocumento as data_inq from fichas where idFicha = ".$fichasalquileres->DataSource->inquilino->GetValue();
//DEL  $db->query($sql);
//DEL  $Result = $db->next_record();
//DEL  if($Result)
//DEL  	$fichasalquileres->data_inq->SetValue($db->f("data_inq"));
//DEL  $db->close();
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL   if(CCGetFromGet('action','')=='addInq')
//DEL   	$Panel1->Visible = true;
//DEL   else
//DEL    	$Panel1->Visible = false;
//DEL  // -------------------------

//DEL  function Page_BeforeShow(& $sender)
//DEL  {
//DEL      $Page_BeforeShow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $contrato; //Compatibility
//DEL  	global $alquileres;


//DEL  // -------------------------
//DEL  
//DEL   if(CCGetFromGet('idalquiler','')!='')
//DEL  {
//DEL   	$contrato->fichasalquileres->Visible = true;
//DEL  	$db = new clsDBConnection1();
//DEL  	$sql = "select count(*) as cantcuotas from cuotas where idalquiler = ".CCGetFromGet('idalquiler','');
//DEL  	$db->query($sql);
//DEL  	$Result = $db->next_record();
//DEL  	if($Result)
//DEL  	{
//DEL  		if($db->f("cantcuotas") > 0)
//DEL  		{
//DEL  			$contrato->anocontratoalquiler->Visible = false;
//DEL  			$contrato->anocontratoalquilerRO->Visible = true;
//DEL  		}
//DEL  		else
//DEL  		{
//DEL  			$contrato->anocontratoalquiler->Visible = true;
//DEL  			$contrato->anocontratoalquilerRO->Visible = false;
//DEL  			error_log('deberia apagar el RO');
//DEL  		}
//DEL  	}
//DEL  	$db->close();
//DEL  }
//DEL   else
//DEL  {
//DEL   	$contrato->fichasalquileres->Visible = false;
//DEL  	$contrato->anocontratoalquiler->Visible = false;
//DEL  	$contrato->anocontratoalquilerRO->Visible = false;
//DEL  }
//DEL  
//DEL  // -------------------------
function buscaContratoAlquiler($idpropiedad)
{
   $db = new clsDBConnection1();
	$sql = 'select idalquiler from alquileres where idpropiedad = '.$idpropiedad.' and getdate() between fechainicio and fechafin';
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
 		$ret = $db->f('idalquiler');
	else
		$ret = '';
    $db->close();
	return $ret;
}


?>
