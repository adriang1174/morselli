<?php
//BindEvents Method @1-38483A9D
function BindEvents()
{
    global $gastosescribania;
    $gastosescribania->Navigator->CCSEvents["BeforeShow"] = "gastosescribania_Navigator_BeforeShow";
}
//End BindEvents Method

//gastosescribania_Navigator_BeforeShow @28-ABAB6F07
function gastosescribania_Navigator_BeforeShow(& $sender)
{
    $gastosescribania_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $gastosescribania; //Compatibility
//End gastosescribania_Navigator_BeforeShow

//Hide-Show Component @29-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close gastosescribania_Navigator_BeforeShow @28-461A9942
    return $gastosescribania_Navigator_BeforeShow;
}
//End Close gastosescribania_Navigator_BeforeShow


?>
