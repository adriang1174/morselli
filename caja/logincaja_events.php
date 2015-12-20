<?php
//BindEvents Method @1-5F174568
function BindEvents()
{
    global $logincaja;
    $logincaja->lblError->CCSEvents["BeforeShow"] = "logincaja_lblError_BeforeShow";
}
//End BindEvents Method

//logincaja_lblError_BeforeShow @11-F0A6EE58
function logincaja_lblError_BeforeShow(& $sender)
{
    $logincaja_lblError_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $logincaja; //Compatibility
//End logincaja_lblError_BeforeShow

//Custom Code @12-2A29BDB7
// -------------------------
    if(CCGetParam('action','')=='error')
		$logincaja->lblError->SetValue("Contraseña incorrecta");
// -------------------------
//End Custom Code

//Close logincaja_lblError_BeforeShow @11-1D9F065A
    return $logincaja_lblError_BeforeShow;
}
//End Close logincaja_lblError_BeforeShow


?>
