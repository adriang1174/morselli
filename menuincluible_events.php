<?php
// //Events @1-F81417CB

//menuincluible_JSMenu_Menu_Caption_BeforeShow @5-A021A946
function menuincluible_JSMenu_Menu_Caption_BeforeShow(& $sender)
{
    $menuincluible_JSMenu_Menu_Caption_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menuincluible; //Compatibility
//End menuincluible_JSMenu_Menu_Caption_BeforeShow

//Close menuincluible_JSMenu_Menu_Caption_BeforeShow @5-C2FE4C6A
    return $menuincluible_JSMenu_Menu_Caption_BeforeShow;
}
//End Close menuincluible_JSMenu_Menu_Caption_BeforeShow

//menuincluible_JSMenu_Menu_Url_BeforeShow @7-FF0E7A97
function menuincluible_JSMenu_Menu_Url_BeforeShow(& $sender)
{
    $menuincluible_JSMenu_Menu_Url_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menuincluible; //Compatibility
//End menuincluible_JSMenu_Menu_Url_BeforeShow

//Close menuincluible_JSMenu_Menu_Url_BeforeShow @7-4F16E36A
    return $menuincluible_JSMenu_Menu_Url_BeforeShow;
}
//End Close menuincluible_JSMenu_Menu_Url_BeforeShow


?>
