<?php
// //Events @1-F81417CB

//Header_Menu1_BeforeShow @4-1ADE4921
function Header_Menu1_BeforeShow(& $sender)
{
    $Header_Menu1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
	global $Menu1
//End Header_Menu1_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    $Header->Menu1->ItemLink->p
// -------------------------
//End Custom Code

//Close Header_Menu1_BeforeShow @4-1D0F9EC0
    return $Header_Menu1_BeforeShow;
}
//End Close Header_Menu1_BeforeShow


?>
