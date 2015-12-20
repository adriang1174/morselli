<?php
//BindEvents Method @1-34BD3FF3
function BindEvents()
{
    global $fichaspropiedades_propied;
    $fichaspropiedades_propied->CCSEvents["BeforeShow"] = "fichaspropiedades_propied_BeforeShow";
}
//End BindEvents Method

//fichaspropiedades_propied_BeforeShow @3-3D42E554
function fichaspropiedades_propied_BeforeShow(& $sender)
{
    $fichaspropiedades_propied_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fichaspropiedades_propied; //Compatibility
//End fichaspropiedades_propied_BeforeShow

//Custom Code @33-2A29BDB7
// -------------------------
	$db = new clsDBConnection1();
	$sql = 'select nombre from fichas where idficha = '.CCGetFromGet('idficha','');
	$db->query($sql);
	$Result = $db->next_record();
	if($Result)
  	{
		 $fichaspropiedades_propied->Label1->SetValue($db->f('nombre'));
	}
	$db->close();
// -------------------------
//End Custom Code

//Close fichaspropiedades_propied_BeforeShow @3-10DD679A
    return $fichaspropiedades_propied_BeforeShow;
}
//End Close fichaspropiedades_propied_BeforeShow


?>
