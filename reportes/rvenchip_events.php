<?php
//BindEvents Method @1-523DD37F
function BindEvents()
{
    global $Report1;
    $Report1->Navigator->CCSEvents["BeforeShow"] = "Report1_Navigator_BeforeShow";
}
//End BindEvents Method

//Report1_Navigator_BeforeShow @11-78E652A3
function Report1_Navigator_BeforeShow(& $sender)
{
    $Report1_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report1; //Compatibility
//End Report1_Navigator_BeforeShow

//Hide-Show Component @12-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report1_Navigator_BeforeShow @11-115E333B
    return $Report1_Navigator_BeforeShow;
}
//End Close Report1_Navigator_BeforeShow
?>
