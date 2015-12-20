<?php
//BindEvents Method @1-5071B462
function BindEvents()
{
    global $Report2;
    $Report2->Navigator->CCSEvents["BeforeShow"] = "Report2_Navigator_BeforeShow";
}
//End BindEvents Method

//Report2_Navigator_BeforeShow @53-BD937644
function Report2_Navigator_BeforeShow(& $sender)
{
    $Report2_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report2; //Compatibility
//End Report2_Navigator_BeforeShow

//Hide-Show Component @54-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report2_Navigator_BeforeShow @53-49409A13
    return $Report2_Navigator_BeforeShow;
}
//End Close Report2_Navigator_BeforeShow
?>
