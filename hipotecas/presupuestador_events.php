<?php
//BindEvents Method @1-F9FCD587
function BindEvents()
{
    global $Report1;
    $Report1->porcentajevend->CCSEvents["BeforeShow"] = "Report1_porcentajevend_BeforeShow";
    $Report1->porcentajecomp->CCSEvents["BeforeShow"] = "Report1_porcentajecomp_BeforeShow";
}
//End BindEvents Method

//DEL  // -------------------------
//DEL  	$impcomp = (float) $gastosescribania->DataSource->importecomp->GetValue();
//DEL      if ($impcomp < 1 and $impcomp > 0.0000)
//DEL  	{
//DEL  		$porc = $gastosescribania->DataSource->importecomp->GetValue() * 100;
//DEL  		$porc = number_format($porc, 2, ',','.');
//DEL  		$importe = $gastosescribania->DataSource->importecomp->GetValue() * CCGetFromGet('operacion',0);
//DEL  		$importe = number_format($importe, 2, ',','.');
//DEL  		$txt = strval($importe) . " (" . strval($porc) . "%)";
//DEL  		$gastosescribania->importecomp->SetValue($txt );
//DEL  	}
//DEL  	else
//DEL  		$gastosescribania->importecomp->SetValue(number_format($impcomp, 2, ',','.'));
//DEL  
//DEL  	$impvend = (float) $gastosescribania->DataSource->importevend->GetValue();
//DEL      if ($impvend < 1 and $impvend > 0.0000)
//DEL  	{
//DEL  		$porc = $gastosescribania->DataSource->importevend->GetValue() * 100;
//DEL  		$porc = number_format($porc, 2, ',','.');
//DEL  		$importe = $gastosescribania->DataSource->importevend->GetValue() * CCGetFromGet('operacion',0);
//DEL  		$importe = number_format($importe, 2, ',','.');
//DEL  		$txt = strval($importe) . " (" . strval($porc) . "%)";
//DEL  		$gastosescribania->importevend->SetValue($txt );
//DEL  	}
//DEL  	else
//DEL  		$gastosescribania->importevend->SetValue(number_format($impvend, 2, ',','.'));
//DEL  
//DEL  // -------------------------

//Report1_porcentajevend_BeforeShow @28-8119913F
function Report1_porcentajevend_BeforeShow(& $sender)
{
    $Report1_porcentajevend_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report1; //Compatibility
//End Report1_porcentajevend_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
    if ($Report1->porcentajevend->GetValue()==0)
		$Report1->porcentajevend->SetValue(null);
// -------------------------
//End Custom Code

//Close Report1_porcentajevend_BeforeShow @28-914EDE33
    return $Report1_porcentajevend_BeforeShow;
}
//End Close Report1_porcentajevend_BeforeShow

//Report1_porcentajecomp_BeforeShow @30-4826ED65
function Report1_porcentajecomp_BeforeShow(& $sender)
{
    $Report1_porcentajecomp_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report1; //Compatibility
//End Report1_porcentajecomp_BeforeShow

//Custom Code @31-2A29BDB7
// -------------------------
    if ($Report1->porcentajecomp->GetValue()==0)
		$Report1->porcentajecomp->SetValue(null);
// -------------------------
//End Custom Code

//Close Report1_porcentajecomp_BeforeShow @30-E861C8E0
    return $Report1_porcentajecomp_BeforeShow;
}
//End Close Report1_porcentajecomp_BeforeShow

//DEL  // -------------------------
//DEL  	$impvend = (float) $gastosescribania1->DataSource->importevend->GetValue();
//DEL      if ($impvend < 1 and $impvend > 0.0000)
//DEL  	{
//DEL  		$porc = $gastosescribania1->DataSource->importevend->GetValue() * 100;
//DEL  		$porc = number_format($porc, 2, ',','.');
//DEL  		$importe = $gastosescribania1->DataSource->importevend->GetValue() * CCGetFromGet('operacion',0);
//DEL  		$importe = number_format($importe, 2, ',','.');
//DEL  		$txt = strval($importe) . " (" . strval($porc) . "%)";
//DEL  		$gastosescribania1->importevend->SetValue($txt );
//DEL  	}
//DEL  	else
//DEL  		$gastosescribania1->importevend->SetValue(number_format($impvend, 2, ',','.'));
//DEL  
//DEL  // -------------------------



?>
