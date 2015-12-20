<?php
// //Events @1-F81417CB

//Headercaja_JSMenu_Menu_Caption_BeforeShow @5-E68452FA
function Headercaja_JSMenu_Menu_Caption_BeforeShow(& $sender)
{
    $Headercaja_JSMenu_Menu_Caption_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Headercaja; //Compatibility
//End Headercaja_JSMenu_Menu_Caption_BeforeShow

//Close Headercaja_JSMenu_Menu_Caption_BeforeShow @5-10138393
    return $Headercaja_JSMenu_Menu_Caption_BeforeShow;
}
//End Close Headercaja_JSMenu_Menu_Caption_BeforeShow

//Headercaja_JSMenu_Menu_Url_BeforeShow @7-DE761D24
function Headercaja_JSMenu_Menu_Url_BeforeShow(& $sender)
{
    $Headercaja_JSMenu_Menu_Url_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Headercaja; //Compatibility
//End Headercaja_JSMenu_Menu_Url_BeforeShow

//Close Headercaja_JSMenu_Menu_Url_BeforeShow @7-FB5B93D9
    return $Headercaja_JSMenu_Menu_Url_BeforeShow;
}
//End Close Headercaja_JSMenu_Menu_Url_BeforeShow
?>
