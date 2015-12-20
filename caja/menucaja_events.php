<?php

// //Events @1-F81417CB

//menucaja_BeforeInitialize @1-7E91DFC4
function menucaja_BeforeInitialize(& $sender)
{
    $menucaja_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menucaja; //Compatibility
//End menucaja_BeforeInitialize

//Custom Code @3-2A29BDB7
// -------------------------
if (CCGetSession("AUTH_CASH",'') == '')
{
		header("Location: cajadenegada.php");
		exit;
}
// -------------------------
//End Custom Code

//Close menucaja_BeforeInitialize @1-AF5D6FE3
    return $menucaja_BeforeInitialize;
}
//End Close menucaja_BeforeInitialize
?>
