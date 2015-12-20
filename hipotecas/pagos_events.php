<?php
//BindEvents Method @1-BBA5C39F
function BindEvents()
{
    global $cuotas;
    global $cuotas1;
    $cuotas->importe->CCSEvents["BeforeShow"] = "cuotas_importe_BeforeShow";
    $cuotas->CCSEvents["BeforeShow"] = "cuotas_BeforeShow";
    $cuotas1->importe->CCSEvents["BeforeShow"] = "cuotas1_importe_BeforeShow";
    $cuotas1->CCSEvents["BeforeShow"] = "cuotas1_BeforeShow";
}
//End BindEvents Method

//cuotas_importe_BeforeShow @40-1AB3545F
function cuotas_importe_BeforeShow(& $sender)
{
    $cuotas_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotas; //Compatibility
//End cuotas_importe_BeforeShow

//Custom Code @81-2A29BDB7
// -------------------------
$cuotas->importe->SetValue('u$s '.number_format($cuotas->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close cuotas_importe_BeforeShow @40-82B3D01A
    return $cuotas_importe_BeforeShow;
}
//End Close cuotas_importe_BeforeShow

//cuotas_BeforeShow @29-FC7C9867
function cuotas_BeforeShow(& $sender)
{
    $cuotas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotas; //Compatibility
//End cuotas_BeforeShow

//Custom Code @65-2A29BDB7
// -------------------------
$cuotas->idhipoteca->SetValue(CCGetFromGet('idhipoteca',''));
$cuotas->lblidhipoteca->SetValue(CCGetFromGet('idhipoteca',''));
// -------------------------
//End Custom Code

//Close cuotas_BeforeShow @29-F2B5DFDD
    return $cuotas_BeforeShow;
}
//End Close cuotas_BeforeShow

//cuotas1_importe_BeforeShow @85-A3DCE4E1
function cuotas1_importe_BeforeShow(& $sender)
{
    $cuotas1_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotas1; //Compatibility
//End cuotas1_importe_BeforeShow

//Custom Code @86-2A29BDB7
// -------------------------
$cuotas1->importe->SetValue('u$s '.number_format($cuotas1->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close cuotas1_importe_BeforeShow @85-4EDE1A82
    return $cuotas1_importe_BeforeShow;
}
//End Close cuotas1_importe_BeforeShow

//cuotas1_BeforeShow @83-AB387583
function cuotas1_BeforeShow(& $sender)
{
    $cuotas1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotas1; //Compatibility
//End cuotas1_BeforeShow

//Custom Code @96-2A29BDB7
// -------------------------
$cuotas1->idhipoteca->SetValue(CCGetFromGet('idhipoteca',''));
$cuotas1->lblidhipoteca->SetValue(CCGetFromGet('idhipoteca',''));
// -------------------------
//End Custom Code

//Close cuotas1_BeforeShow @83-CFC45F5E
    return $cuotas1_BeforeShow;
}
//End Close cuotas1_BeforeShow


?>
