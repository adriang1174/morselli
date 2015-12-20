<?php
//BindEvents Method @1-B2217EFE
function BindEvents()
{
    global $recibo;
    $recibo->cuotas->CCSEvents["BeforeShow"] = "recibo_cuotas_BeforeShow";
    $recibo->idhipoteca->CCSEvents["BeforeShow"] = "recibo_idhipoteca_BeforeShow";
}
//End BindEvents Method

//recibo_cuotas_BeforeShow @5-7E4AC44A
function recibo_cuotas_BeforeShow(& $sender)
{
    $recibo_cuotas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_cuotas_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
   //var_dump($_POST);

   $db = new clsDBConnection1();
   $paga = array();
   $paga = $_POST['paga'];
    foreach($paga as $ano=>$valor)
   {
				foreach($valor as $mes=>$v)
				{
				 		$sql = "select idcuota from cuotas where idhipoteca = ".CCGetFromPost('idhipoteca','')." and ano = ".$ano." and mes = ".$mes." and idtipocuota = 4";
						$db->query($sql);
						while($db->next_record())
								$str .= $db->f('idcuota'). ';';					
				}				
   }
   $str = substr($str, 0, -1);
   //var_dump($liq);
   $recibo->cuotas->SetValue($str);
// -------------------------
//End Custom Code

//DEL  // -------------------------
//DEL  $liquida->ficha->SetValue(CCGetFromPost('idficha',''));
//DEL  
//DEL  // -------------------------

//Close recibo_cuotas_BeforeShow @5-9652D36B
    return $recibo_cuotas_BeforeShow;
}
//End Close recibo_cuotas_BeforeShow

//recibo_idhipoteca_BeforeShow @9-45A04389
function recibo_idhipoteca_BeforeShow(& $sender)
{
    $recibo_idhipoteca_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $recibo; //Compatibility
//End recibo_idhipoteca_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
$recibo->idhipoteca->SetValue(CCGetFromPost('idhipoteca',''));
// -------------------------
//End Custom Code

//Close recibo_idhipoteca_BeforeShow @9-FDA145AB
    return $recibo_idhipoteca_BeforeShow;
}
//End Close recibo_idhipoteca_BeforeShow
?>
