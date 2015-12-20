<?php
//BindEvents Method @1-D29C19D9
function BindEvents()
{
    global $propiedades;
    global $fichaspropiedades;
    $propiedades->CCSEvents["BeforeShow"] = "propiedades_BeforeShow";
    $fichaspropiedades->ds->CCSEvents["BeforeBuildUpdate"] = "fichaspropiedades_ds_BeforeBuildUpdate";
    $fichaspropiedades->CCSEvents["OnValidate"] = "fichaspropiedades_OnValidate";
    $fichaspropiedades->CCSEvents["BeforeShowRow"] = "fichaspropiedades_BeforeShowRow";
    $fichaspropiedades->ds->CCSEvents["BeforeBuildInsert"] = "fichaspropiedades_ds_BeforeBuildInsert";
    $fichaspropiedades->CCSEvents["BeforeShow"] = "fichaspropiedades_BeforeShow";
}
//End BindEvents Method

//propiedades_BeforeShow @2-9B07B712
function propiedades_BeforeShow(& $sender)
{
    $propiedades_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $propiedades; //Compatibility
//End propiedades_BeforeShow

//Custom Code @42-2A29BDB7
// -------------------------
$propiedades->idficha->SetValue(CCGetFromGet('idficha',''));
if(CCGetFromGet('idpropiedad','') == '')
{
	$db = new clsDBConnection1();
	$sql = 'select max(idpropiedad) as currid from propiedades';
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
		$curr = $db->f("currid");
	$db->close();
	$curr = $curr + 1;
}
else
	$curr = CCGetFromGet('idpropiedad','');

$propiedades->idpropiedad->SetValue($curr);
// -------------------------
//End Custom Code

//Close propiedades_BeforeShow @2-B5B849A9
    return $propiedades_BeforeShow;
}
//End Close propiedades_BeforeShow

//fichaspropiedades_ds_BeforeBuildUpdate @23-42B9B2FB
function fichaspropiedades_ds_BeforeBuildUpdate(& $sender)
{
    $fichaspropiedades_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichaspropiedades; //Compatibility
//End fichaspropiedades_ds_BeforeBuildUpdate

//Custom Code @40-2A29BDB7
// -------------------------
/*

for ($j = 1; $j <= $fichaspropiedades->PageSize + $fichaspropiedades->EmptyRows; $j++)  
if (strlen(CCGetParam("duenoporcentaje_" . $j, ""))!=0 )  
$total += CCGetParam("duenoporcentaje_" . $j, "");

if ($total !=100)
	if($fichaspropiedades->Errors->Count() == 0)
	{
		$fichaspropiedades->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
	}
*/
// -------------------------
//End Custom Code

//Close fichaspropiedades_ds_BeforeBuildUpdate @23-A6E0E5C1
    return $fichaspropiedades_ds_BeforeBuildUpdate;
}
//End Close fichaspropiedades_ds_BeforeBuildUpdate

//fichaspropiedades_OnValidate @23-ABE36553
function fichaspropiedades_OnValidate(& $sender)
{
    $fichaspropiedades_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichaspropiedades; //Compatibility
//End fichaspropiedades_OnValidate

//Custom Code @62-2A29BDB7
// -------------------------
for ($j = 1; $j <= $fichaspropiedades->PageSize + $fichaspropiedades->EmptyRows; $j++)  
if (strlen(CCGetParam("duenoporcentaje_" . $j, ""))!=0 )  
$total += CCGetParam("duenoporcentaje_" . $j, "");

if (round($total) !=100)
	if($fichaspropiedades->Errors->Count() == 0)
	{
		$fichaspropiedades->Errors->addError("La Sumatoria de los porcentajes no puede ser distinto de 100");
	}
// -------------------------
//End Custom Code

//Close fichaspropiedades_OnValidate @23-1593AA5B
    return $fichaspropiedades_OnValidate;
}
//End Close fichaspropiedades_OnValidate

//fichaspropiedades_BeforeShowRow @23-AAB4114B
function fichaspropiedades_BeforeShowRow(& $sender)
{
    $fichaspropiedades_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichaspropiedades; //Compatibility
//End fichaspropiedades_BeforeShowRow

//Custom Code @71-2A29BDB7
// -------------------------

	if($fichaspropiedades->idficha->GetValue()!='')
	{
	$db = new clsDBConnection1();
	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichaspropiedades->idficha->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$fichaspropiedades->nombre->SetValue($db->f('nombre'));
		$fichaspropiedades->nrodocumento->SetValue($db->f('nrodocumento'));
	}
	}
	//$db->close();
// -------------------------
//End Custom Code

//Close fichaspropiedades_BeforeShowRow @23-4AD63D88
    return $fichaspropiedades_BeforeShowRow;
}
//End Close fichaspropiedades_BeforeShowRow

//fichaspropiedades_ds_BeforeBuildInsert @23-D882ECE9
function fichaspropiedades_ds_BeforeBuildInsert(& $sender)
{
    $fichaspropiedades_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichaspropiedades; //Compatibility
//End fichaspropiedades_ds_BeforeBuildInsert

//Custom Code @72-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close fichaspropiedades_ds_BeforeBuildInsert @23-69C9244E
    return $fichaspropiedades_ds_BeforeBuildInsert;
}
//End Close fichaspropiedades_ds_BeforeBuildInsert

//fichaspropiedades_BeforeShow @23-E0EC84F5
function fichaspropiedades_BeforeShow(& $sender)
{
    $fichaspropiedades_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichaspropiedades; //Compatibility
//End fichaspropiedades_BeforeShow

//Custom Code @74-2A29BDB7
// -------------------------
$fichaspropiedades->idpropiedad->SetValue(CCGetFromGet('idpropiedad',''));
// -------------------------
//End Custom Code

//Close fichaspropiedades_BeforeShow @23-2A68CED2
    return $fichaspropiedades_BeforeShow;
}
//End Close fichaspropiedades_BeforeShow

//DEL  // -------------------------
//DEL  
//DEL  // -------------------------


//DEL  // -------------------------
//DEL  /*	$db = new clsDBConnection1();
//DEL  	$sql = 'select nombre,nrodocumento from fichas where idficha = '.$fichaspropiedades2->ds->idficha->GetValue();
//DEL  	$db->query($sql);
//DEL  	$Result = $db->next_record();
//DEL  	if($Result)
//DEL  	{
//DEL  		$fichaspropiedades2->nombre->SetValue($db->f('nombre'));
//DEL  		//$fichaspropiedades->nrodocumento->SetValue($db->f('nrodocumento'));
//DEL  	}
//DEL  	$db->close();
//DEL  	*/
//DEL  // -------------------------


//DEL  // -------------------------
//DEL  $propiedades->idpropiedad->SetValue(CCGetFromGet('idpropiedad',''));
//DEL  // -------------------------



?>
