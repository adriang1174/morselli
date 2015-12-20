<?php
//BindEvents Method @1-C7F2F08F
function BindEvents()
{
    global $liquida;
    $liquida->liquida->CCSEvents["BeforeShow"] = "liquida_liquida_BeforeShow";
    $liquida->ficha->CCSEvents["BeforeShow"] = "liquida_ficha_BeforeShow";
    $liquida->idalquiler->CCSEvents["BeforeShow"] = "liquida_idalquiler_BeforeShow";
}
//End BindEvents Method

//liquida_liquida_BeforeShow @5-5439676D
function liquida_liquida_BeforeShow(& $sender)
{
    $liquida_liquida_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $liquida; //Compatibility
//End liquida_liquida_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
   //var_dump($_POST);
   $liq = array();
   $liq = CCGetFromPost('liquida','');
   foreach($_POST['liquida'] as $ano => $meses)
   {
   		foreach($meses as $mes => $valor)
   				$str .= $ano.':'.$mes . ';';
   }
   $str = substr($str, 0, -1);
   //var_dump($liq);
   $liquida->liquida->SetValue($str);
// -------------------------
//End Custom Code

//Close liquida_liquida_BeforeShow @5-F0614F4D
    return $liquida_liquida_BeforeShow;
}
//End Close liquida_liquida_BeforeShow

//liquida_ficha_BeforeShow @7-098C6A60
function liquida_ficha_BeforeShow(& $sender)
{
    $liquida_ficha_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $liquida; //Compatibility
//End liquida_ficha_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
$liquida->ficha->SetValue(CCGetFromPost('idficha',''));

// -------------------------
//End Custom Code

//Close liquida_ficha_BeforeShow @7-47FD844B
    return $liquida_ficha_BeforeShow;
}
//End Close liquida_ficha_BeforeShow

//liquida_idalquiler_BeforeShow @9-154A256D
function liquida_idalquiler_BeforeShow(& $sender)
{
    $liquida_idalquiler_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $liquida; //Compatibility
//End liquida_idalquiler_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
$liquida->idalquiler->SetValue(CCGetFromPost('idalquiler',''));
// -------------------------
//End Custom Code

//Close liquida_idalquiler_BeforeShow @9-B4E539AC
    return $liquida_idalquiler_BeforeShow;
}
//End Close liquida_idalquiler_BeforeShow


?>
