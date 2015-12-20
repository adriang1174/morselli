<?php
//BindEvents Method @1-16F697FF
function BindEvents()
{
    global $impuestos;
    $impuestos->Navigator->CCSEvents["BeforeShow"] = "impuestos_Navigator_BeforeShow";
}
//End BindEvents Method

//impuestos_Navigator_BeforeShow @21-A41B0ADF
function impuestos_Navigator_BeforeShow(& $sender)
{
    $impuestos_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $impuestos; //Compatibility
//End impuestos_Navigator_BeforeShow

//Hide-Show Component @22-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close impuestos_Navigator_BeforeShow @21-4EF13582
    return $impuestos_Navigator_BeforeShow;
}
//End Close impuestos_Navigator_BeforeShow


?>
