<?php
//BindEvents Method @1-627F4FD4
function BindEvents()
{
    global $propiedades;
    $propiedades->estado->CCSEvents["BeforeShow"] = "propiedades_estado_BeforeShow";
}
//End BindEvents Method

//propiedades_estado_BeforeShow @43-1F31CE10
function propiedades_estado_BeforeShow(& $sender)
{
    $propiedades_estado_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $propiedades; //Compatibility
//End propiedades_estado_BeforeShow

//Custom Code @55-2A29BDB7
// -------------------------
	$db = new clsDBConnection1();
	$sql = 'select descripcion from estadospropiedades where idestado = '.$propiedades->estado->GetValue();
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
		$propiedades->estado->SetValue($db->f("descripcion"));
	//$db->close();

// -------------------------
//End Custom Code

//Close propiedades_estado_BeforeShow @43-18FCF8A7
    return $propiedades_estado_BeforeShow;
}
//End Close propiedades_estado_BeforeShow


?>
