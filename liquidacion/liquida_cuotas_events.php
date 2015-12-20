<?php
//BindEvents Method @1-B9775B9F
function BindEvents()
{
    global $liquida;
    $liquida->nroliq->CCSEvents["BeforeShow"] = "liquida_nroliq_BeforeShow";
    $liquida->liquida->CCSEvents["BeforeShow"] = "liquida_liquida_BeforeShow";
    $liquida->ficha->CCSEvents["BeforeShow"] = "liquida_ficha_BeforeShow";
    $liquida->idalquiler->CCSEvents["BeforeShow"] = "liquida_idalquiler_BeforeShow";
}
//End BindEvents Method

//liquida_nroliq_BeforeShow @3-4B1DFD0A
function liquida_nroliq_BeforeShow(& $sender)
{
    $liquida_nroliq_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $liquida; //Compatibility
//End liquida_nroliq_BeforeShow

//Custom Code @11-2A29BDB7
// -------------------------
$liquida->nroliq->SetValue(CCGetFromPost('idalquiler',''));
// -------------------------
//End Custom Code

//Close liquida_nroliq_BeforeShow @3-C3D10C27
    return $liquida_nroliq_BeforeShow;
}
//End Close liquida_nroliq_BeforeShow

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
   				//Ver si ese ano/mes no está liquidado ya
				$idalquiler = CCGetFromPost('idalquiler','');
				$db = new clsDBConnection1();
				$sql = "select count(*) as cont from cuotas where idalquiler = ".CCGetFromGet('idalquiler','0').
					" and ano = ".$ano. " and mes = ".$mes.
					" and idtipocuota = 1 and fechaliquidacion is null";
				$db->query($sql);
				$Result = $db->next_record();
				if($Result)
				{
					if( $db->f("cont") == 0)
							$str .= $ano.':'.$mes . ';';
					else
							$liquida->Errors->AddError("Hay cuotas marcadas que ya han sido liquidadas. No se incluirán en esta liquidación");
				}
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