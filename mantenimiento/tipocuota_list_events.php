<?php
//BindEvents Method @1-37F245CA
function BindEvents()
{
    global $tipocuota;
    $tipocuota->Navigator->CCSEvents["BeforeShow"] = "tipocuota_Navigator_BeforeShow";
}
//End BindEvents Method

//tipocuota_Navigator_BeforeShow @21-C2253402
function tipocuota_Navigator_BeforeShow(& $sender)
{
    $tipocuota_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tipocuota; //Compatibility
//End tipocuota_Navigator_BeforeShow

//Hide-Show Component @22-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close tipocuota_Navigator_BeforeShow @21-B6005019
    return $tipocuota_Navigator_BeforeShow;
}
//End Close tipocuota_Navigator_BeforeShow


?>
