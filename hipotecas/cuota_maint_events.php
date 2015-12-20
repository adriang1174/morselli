<?php
//BindEvents Method @1-A022F24D
function BindEvents()
{
    global $cuotas;
    $cuotas->fechavencimiento->CCSEvents["BeforeShow"] = "cuotas_fechavencimiento_BeforeShow";
    $cuotas->CCSEvents["BeforeShow"] = "cuotas_BeforeShow";
}
//End BindEvents Method

//cuotas_fechavencimiento_BeforeShow @8-9B820D87
function cuotas_fechavencimiento_BeforeShow(& $sender)
{
    $cuotas_fechavencimiento_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotas; //Compatibility
//End cuotas_fechavencimiento_BeforeShow

//Custom Code @13-2A29BDB7
// -------------------------
    if(strlen($cuotas->fechavencimiento->GetValue())>10)
	{
		//Hay que formatear
		//2009-08-26 00:00:00.000
		$y = substr($cuotas->fechavencimiento->GetValue(),0,4);
		$m = substr($cuotas->fechavencimiento->GetValue(),5,2);
		$d = substr($cuotas->fechavencimiento->GetValue(),8,2);
		$cuotas->fechavencimiento->SetValue($d."/".$m."/".$y);
	}	

// -------------------------
//End Custom Code

//Close cuotas_fechavencimiento_BeforeShow @8-D0E73D7F
    return $cuotas_fechavencimiento_BeforeShow;
}
//End Close cuotas_fechavencimiento_BeforeShow

//cuotas_BeforeShow @3-FC7C9867
function cuotas_BeforeShow(& $sender)
{
    $cuotas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotas; //Compatibility
//End cuotas_BeforeShow

//Custom Code @14-2A29BDB7
// -------------------------
$cuotas->idalquiler->SetValue(CCGetFromGet('idalquiler',''));
// -------------------------
//End Custom Code

//Close cuotas_BeforeShow @3-F2B5DFDD
    return $cuotas_BeforeShow;
}
//End Close cuotas_BeforeShow


?>
