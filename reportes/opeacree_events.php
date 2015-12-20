<?php
//BindEvents Method @1-69D4ECE6
function BindEvents()
{
    global $Report1;
    $Report1->importe->CCSEvents["BeforeShow"] = "Report1_importe_BeforeShow";
    $Report1->Navigator->CCSEvents["BeforeShow"] = "Report1_Navigator_BeforeShow";
}
//End BindEvents Method

//Report1_importe_BeforeShow @36-8FCC15B2
function Report1_importe_BeforeShow(& $sender)
{
    $Report1_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report1; //Compatibility
//End Report1_importe_BeforeShow

//Custom Code @37-2A29BDB7
// -------------------------
    $Report1->importe->SetValue('$ '.number_format($Report1->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close Report1_importe_BeforeShow @36-0B7A7F69
    return $Report1_importe_BeforeShow;
}
//End Close Report1_importe_BeforeShow

//Report1_Navigator_BeforeShow @16-78E652A3
function Report1_Navigator_BeforeShow(& $sender)
{
    $Report1_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report1; //Compatibility
//End Report1_Navigator_BeforeShow

//Hide-Show Component @17-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report1_Navigator_BeforeShow @16-115E333B
    return $Report1_Navigator_BeforeShow;
}
//End Close Report1_Navigator_BeforeShow


?>
