<?php
//BindEvents Method @1-9D066221
function BindEvents()
{
    global $hipotecas;
    $hipotecas->idhipoteca->CCSEvents["BeforeShow"] = "hipotecas_idhipoteca_BeforeShow";
    $hipotecas->idhipotecaRO->CCSEvents["BeforeShow"] = "hipotecas_idhipotecaRO_BeforeShow";
}
//End BindEvents Method

//hipotecas_idhipoteca_BeforeShow @21-ED852C24
function hipotecas_idhipoteca_BeforeShow(& $sender)
{
    $hipotecas_idhipoteca_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_idhipoteca_BeforeShow

//Custom Code @43-2A29BDB7
// -------------------------
if($hipotecas->descripcion == 1 or $hipotecas->descripcion == 'Vigente')
	$hipotecas->idhipoteca->Visible = true;
else
	$hipotecas->idhipoteca->Visible = false;
// -------------------------
//End Custom Code

//Close hipotecas_idhipoteca_BeforeShow @21-977B450E
    return $hipotecas_idhipoteca_BeforeShow;
}
//End Close hipotecas_idhipoteca_BeforeShow

//hipotecas_idhipotecaRO_BeforeShow @41-91C42A98
function hipotecas_idhipotecaRO_BeforeShow(& $sender)
{
    $hipotecas_idhipotecaRO_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $hipotecas; //Compatibility
//End hipotecas_idhipotecaRO_BeforeShow

//Custom Code @42-2A29BDB7
// -------------------------
if($hipotecas->descripcion == 1 or $hipotecas->descripcion == 'Vigente')
	$hipotecas->idhipotecaRO->Visible = false;
else
	$hipotecas->idhipotecaRO->Visible = true;
// -------------------------
//End Custom Code

//Close hipotecas_idhipotecaRO_BeforeShow @41-7330BC53
    return $hipotecas_idhipotecaRO_BeforeShow;
}
//End Close hipotecas_idhipotecaRO_BeforeShow


?>
