<?php
//BindEvents Method @1-08C5EEC1
function BindEvents()
{
    global $Grid1;
    $Grid1->CCSEvents["BeforeShow"] = "Grid1_BeforeShow";
}
//End BindEvents Method

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
	$sql = "select f.nombre,a.idalquiler ,f.idficha 
			   from fichas f 
	           join fichaspropiedades fp on (f.idficha = fp.idficha) 
			   join alquileres a on (fp.idpropiedad = a.idpropiedad)
			   where a.idalquiler= ".CCGetFromGet('idalquiler','0');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		$txt = $db->f("nombre"). " por contrato nro. " . $db->f("idalquiler");
		$idalquiler = $db->f("idalquiler");
		$Grid1->nombrefichacontrato->SetValue($txt);
	}
	$db->close();
	$Grid1->idalquiler->SetValue($idalquiler);
	$Grid1->idficha->SetValue($db->f("idficha"));

// -------------------------
//End Custom Code

//Close Grid1_BeforeShow @2-C0F58113
    return $Grid1_BeforeShow;
}
//End Close Grid1_BeforeShow

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
