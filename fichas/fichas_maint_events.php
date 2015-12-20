<?php
//BindEvents Method @1-5A5A7F18
function BindEvents()
{
    global $fichas;
    $fichas->CCSEvents["BeforeDelete"] = "fichas_BeforeDelete";
}
//End BindEvents Method

//fichas_BeforeDelete @2-A40460B8
function fichas_BeforeDelete(& $sender)
{
    $fichas_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichas; //Compatibility
//End fichas_BeforeDelete

//Custom Code @39-2A29BDB7
// -------------------------
    $db = new clsDBConnection1();
	$sql = "select count(*) as cont from fichaspropiedades where idficha = ".CCGetFromGet('idficha','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
	{
		if($db->f("cont") > 0)
			$fichas->Errors->addError("La ficha tiene propiedades asociadas. Borrelas primero");
	}
// -------------------------
//End Custom Code

//Close fichas_BeforeDelete @2-473A0767
    return $fichas_BeforeDelete;
}
//End Close fichas_BeforeDelete


?>
