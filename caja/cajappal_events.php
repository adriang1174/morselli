<?php
//Page_BeforeInitialize @1-56CF5233
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cajappal; //Compatibility
//End Page_BeforeInitialize

//Custom Code @3-2A29BDB7
// -------------------------
include_once("auth.php");
authorize_cash();
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
