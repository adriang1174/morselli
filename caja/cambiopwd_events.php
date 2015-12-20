<?php
//BindEvents Method @1-D179C40C
function BindEvents()
{
    global $pwdcaja;
    global $CCSEvents;
    $pwdcaja->CCSEvents["BeforeUpdate"] = "pwdcaja_BeforeUpdate";
    $pwdcaja->CCSEvents["AfterUpdate"] = "pwdcaja_AfterUpdate";
}
//End BindEvents Method

//pwdcaja_BeforeUpdate @2-08EF2A70
function pwdcaja_BeforeUpdate(& $sender)
{
    $pwdcaja_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pwdcaja; //Compatibility
//End pwdcaja_BeforeUpdate

//Custom Code @8-2A29BDB7
// -------------------------
	if($pwdcaja->password->GetValue()== md5($pwdcaja->oldpassword->GetValue()))
    {
		$pwdcaja->password->SetValue(md5($pwdcaja->newpassword->GetValue()));
		$Redirect = "cambiopwdok.php";
	}
	else
		$pwdcaja->Errors->addError("La contraseña ingresada no es válida");
// -------------------------
//End Custom Code

//Close pwdcaja_BeforeUpdate @2-EBB3E8D0
    return $pwdcaja_BeforeUpdate;
}
//End Close pwdcaja_BeforeUpdate

//pwdcaja_AfterUpdate @2-D645DD30
function pwdcaja_AfterUpdate(& $sender)
{
    $pwdcaja_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pwdcaja; //Compatibility
//End pwdcaja_AfterUpdate

//Custom Code @12-2A29BDB7
// -------------------------
header("Location: cambiopwdok.php");
exit;
// -------------------------
//End Custom Code

//Close pwdcaja_AfterUpdate @2-1013BC4D
    return $pwdcaja_AfterUpdate;
}
//End Close pwdcaja_AfterUpdate

//Page_BeforeInitialize @1-36C07080
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cambiopwd; //Compatibility
//End Page_BeforeInitialize

//Custom Code @10-2A29BDB7
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
