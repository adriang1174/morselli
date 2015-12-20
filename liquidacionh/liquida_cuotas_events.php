<?php
//BindEvents Method @1-C1F0D3FA
function BindEvents()
{
    global $liquida;
    $liquida->liquida->CCSEvents["BeforeShow"] = "liquida_liquida_BeforeShow";
    $liquida->ficha->CCSEvents["BeforeShow"] = "liquida_ficha_BeforeShow";
    $liquida->idhipoteca->CCSEvents["BeforeShow"] = "liquida_idhipoteca_BeforeShow";
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
		{
			   	foreach($valor as $idalquiler => $valor2)
					$str .= $ano.':'.$mes . ':' .$idalquiler . ';';
		}
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

//liquida_idhipoteca_BeforeShow @9-560F762B
function liquida_idhipoteca_BeforeShow(& $sender)
{
    $liquida_idhipoteca_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $liquida; //Compatibility
//End liquida_idhipoteca_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
$liquida->idhipoteca->SetValue(CCGetFromPost('idhipoteca',''));
// -------------------------
//End Custom Code

//Close liquida_idhipoteca_BeforeShow @9-2E3E8360
    return $liquida_idhipoteca_BeforeShow;
}
//End Close liquida_idhipoteca_BeforeShow
?>
