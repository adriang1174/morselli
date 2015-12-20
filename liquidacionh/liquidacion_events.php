<?php
//BindEvents Method @1-5DD40EC4
function BindEvents()
{
    global $Grid1;
    global $Grid3;
    $Grid1->importe->CCSEvents["BeforeShow"] = "Grid1_importe_BeforeShow";
    $Grid1->punitorios->CCSEvents["BeforeShow"] = "Grid1_punitorios_BeforeShow";
    $Grid1->CCSEvents["BeforeShow"] = "Grid1_BeforeShow";
    $Grid3->importe->CCSEvents["BeforeShow"] = "Grid3_importe_BeforeShow";
    $Grid3->punitorios->CCSEvents["BeforeShow"] = "Grid3_punitorios_BeforeShow";
    $Grid3->CCSEvents["BeforeShow"] = "Grid3_BeforeShow";
}
//End BindEvents Method

//Grid1_importe_BeforeShow @13-49B2A323
function Grid1_importe_BeforeShow(& $sender)
{
    $Grid1_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_importe_BeforeShow

//Custom Code @64-2A29BDB7
// -------------------------
$Grid1->importe->SetValue( number_format($Grid1->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close Grid1_importe_BeforeShow @13-4ACCF67F
    return $Grid1_importe_BeforeShow;
}
//End Close Grid1_importe_BeforeShow

//Grid1_punitorios_BeforeShow @65-55338309
function Grid1_punitorios_BeforeShow(& $sender)
{
    $Grid1_punitorios_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_punitorios_BeforeShow

//Custom Code @66-2A29BDB7
// -------------------------
    $Grid1->punitorios->SetValue( number_format($Grid1->punitorios->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close Grid1_punitorios_BeforeShow @65-6625CF4D
    return $Grid1_punitorios_BeforeShow;
}
//End Close Grid1_punitorios_BeforeShow

//Grid1_BeforeShow @2-706857BD
function Grid1_BeforeShow(& $sender)
{
    $Grid1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_BeforeShow

//Custom Code @52-2A29BDB7
// -------------------------

	$db = new clsDBConnection1();
	$sql = "select f.nombre,fh.idhipoteca ,f.idficha 
			   from fichas f 
	           join fichashipotecas fh on (f.idficha = fh.idficha) 
			   where fh.idhipoteca= ".CCGetFromGet('idhipoteca','0');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
//		$txt = $db->f("nombre"). " por operación nro. " . $db->f("idhipoteca");
		$idhipoteca = $db->f("idhipoteca");
//		$Grid1->nombrefichahipoteca->SetValue($txt);
	}
	$db->close();
	$Grid1->idhipoteca->SetValue($idhipoteca);
//	$Grid1->idficha->SetValue($db->f("idficha"));

// -------------------------
//End Custom Code

//Close Grid1_BeforeShow @2-C0F58113
    return $Grid1_BeforeShow;
}
//End Close Grid1_BeforeShow

//Grid3_importe_BeforeShow @78-65825317
function Grid3_importe_BeforeShow(& $sender)
{
    $Grid3_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid3; //Compatibility
//End Grid3_importe_BeforeShow

//Custom Code @79-2A29BDB7
// -------------------------
//$Grid1->importe->SetValue( number_format($Grid1->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close Grid3_importe_BeforeShow @78-649C3FFF
    return $Grid3_importe_BeforeShow;
}
//End Close Grid3_importe_BeforeShow

//Grid3_punitorios_BeforeShow @91-5EE848C5
function Grid3_punitorios_BeforeShow(& $sender)
{
    $Grid3_punitorios_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid3; //Compatibility
//End Grid3_punitorios_BeforeShow

//Custom Code @92-2A29BDB7
// -------------------------
 //   $Grid1->punitorios->SetValue( number_format($Grid1->punitorios->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close Grid3_punitorios_BeforeShow @91-F643E910
    return $Grid3_punitorios_BeforeShow;
}
//End Close Grid3_punitorios_BeforeShow

//Grid3_BeforeShow @69-8D3210BF
function Grid3_BeforeShow(& $sender)
{
    $Grid3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid3; //Compatibility
//End Grid3_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------


// -------------------------
//End Custom Code

//Close Grid3_BeforeShow @69-219B45BE
    return $Grid3_BeforeShow;
}
//End Close Grid3_BeforeShow

//DEL  function Page_BeforeShow(& $sender)
//DEL  {
//DEL      $Page_BeforeShow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $liquidacion; //Compatibility
//DEL  	global $Grid1;


//DEL  // -------------------------
//DEL   	
//DEL  // -------------------------


?>
