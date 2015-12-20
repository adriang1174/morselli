<?php
//BindEvents Method @1-660DDD6A
function BindEvents()
{
    global $cuotas;
    global $cuotaspagadas;
    global $Link1;
    global $CCSEvents;
    $cuotas->importe->CCSEvents["BeforeShow"] = "cuotas_importe_BeforeShow";
    $cuotas->CCSEvents["BeforeShow"] = "cuotas_BeforeShow";
    $cuotaspagadas->importe->CCSEvents["BeforeShow"] = "cuotaspagadas_importe_BeforeShow";
    $cuotaspagadas->ivacom->CCSEvents["BeforeShow"] = "cuotaspagadas_ivacom_BeforeShow";
    $cuotaspagadas->otros->CCSEvents["BeforeShow"] = "cuotaspagadas_otros_BeforeShow";
    $cuotaspagadas->CCSEvents["BeforeShow"] = "cuotaspagadas_BeforeShow";
    $Link1->CCSEvents["BeforeShow"] = "Link1_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
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

//Custom Code @66-2A29BDB7
// -------------------------
    $cuotas->importe->SetValue('$ '.number_format($cuotas->importe->GetValue(), 2, ',', '.'));
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
$cuotas->idalquiler->SetValue(CCGetFromGet('idalquiler',''));
$cuotas->lblidalquiler->SetValue(CCGetFromGet('idalquiler',''));
// -------------------------
//End Custom Code

//Close cuotas_BeforeShow @29-F2B5DFDD
    return $cuotas_BeforeShow;
}
//End Close cuotas_BeforeShow

//cuotaspagadas_importe_BeforeShow @69-EC8E4C96
function cuotaspagadas_importe_BeforeShow(& $sender)
{
    $cuotaspagadas_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotaspagadas; //Compatibility
//End cuotaspagadas_importe_BeforeShow

//Custom Code @70-2A29BDB7
// -------------------------
    $cuotaspagadas->importe->SetValue('$ '.number_format($cuotaspagadas->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close cuotaspagadas_importe_BeforeShow @69-8A586B61
    return $cuotaspagadas_importe_BeforeShow;
}
//End Close cuotaspagadas_importe_BeforeShow

//cuotaspagadas_ivacom_BeforeShow @101-8545B643
function cuotaspagadas_ivacom_BeforeShow(& $sender)
{
    $cuotaspagadas_ivacom_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotaspagadas; //Compatibility
//End cuotaspagadas_ivacom_BeforeShow

//Custom Code @103-2A29BDB7
// -------------------------
    $cuotaspagadas->ivacom->SetValue('$ '.number_format($cuotaspagadas->ivacom->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close cuotaspagadas_ivacom_BeforeShow @101-ECC748F8
    return $cuotaspagadas_ivacom_BeforeShow;
}
//End Close cuotaspagadas_ivacom_BeforeShow

//cuotaspagadas_otros_BeforeShow @102-4B58AB57
function cuotaspagadas_otros_BeforeShow(& $sender)
{
    $cuotaspagadas_otros_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotaspagadas; //Compatibility
//End cuotaspagadas_otros_BeforeShow

//Custom Code @104-2A29BDB7
// -------------------------
        $cuotaspagadas->otros->SetValue('$ '.number_format($cuotaspagadas->otros->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close cuotaspagadas_otros_BeforeShow @102-A7E8EA2B
    return $cuotaspagadas_otros_BeforeShow;
}
//End Close cuotaspagadas_otros_BeforeShow

//cuotaspagadas_BeforeShow @67-3408E106
function cuotaspagadas_BeforeShow(& $sender)
{
    $cuotaspagadas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cuotaspagadas; //Compatibility
//End cuotaspagadas_BeforeShow

//Custom Code @84-2A29BDB7
// -------------------------
$cuotaspagadas->idalquiler->SetValue(CCGetFromGet('idalquiler',''));
$cuotaspagadas->lblidalquiler->SetValue(CCGetFromGet('idalquiler',''));

if(CCGetParam('verpagos','0')=='0')
	$cuotaspagadas->Visible = false;
else
	$cuotaspagadas->Visible = true;
// -------------------------
//End Custom Code

//Close cuotaspagadas_BeforeShow @67-79D1400F
    return $cuotaspagadas_BeforeShow;
}
//End Close cuotaspagadas_BeforeShow

//Link1_BeforeShow @96-73B4F52C
function Link1_BeforeShow(& $sender)
{
    $Link1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Link1; //Compatibility
//End Link1_BeforeShow

//Custom Code @98-2A29BDB7
// -------------------------
if( CCGetParam('verpagos','0') == '0')
{
	$Link1->SetValue('Ver cuotas pagadas');
	$Link1->Parameters = CCGetQueryString("QueryString", "");
    $Link1->Parameters = CCAddParam($Link1->Parameters, "verpagos", "1");
//	$Link1->SetLink($Link1->GetLink().'&verpagos=1');
}
else
{
	$Link1->SetValue('Ocultar cuotas pagadas');
	$Link1->Parameters = CCGetQueryString("QueryString", "");
    $Link1->Parameters = CCAddParam($Link1->Parameters, "verpagos", "0");
}

// -------------------------
//End Custom Code

//Close Link1_BeforeShow @96-368844F2
    return $Link1_BeforeShow;
}
//End Close Link1_BeforeShow

//Page_BeforeShow @1-C5DD64F4
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pagos; //Compatibility
	global $Link1;
//End Page_BeforeShow

//Custom Code @99-2A29BDB7
// -------------------------
if( CCGetParam('verpagos','0') == '0')
{
	$Link1->SetValue('Ver cuotas pagadas');
}
else
{
	$Link1->SetValue('Ocultar cuotas pagadas');
}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>
