<?php
//BindEvents Method @1-6FA70F8C
function BindEvents()
{
    global $Grid1;
    global $Grid3;
    global $Link1;
    global $CCSEvents;
    $Grid1->importe->CCSEvents["BeforeShow"] = "Grid1_importe_BeforeShow";
    $Grid1->CCSEvents["BeforeShow"] = "Grid1_BeforeShow";
    $Grid3->importe->CCSEvents["BeforeShow"] = "Grid3_importe_BeforeShow";
    $Grid3->CCSEvents["BeforeShow"] = "Grid3_BeforeShow";
    $Link1->CCSEvents["BeforeShow"] = "Link1_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Grid1_importe_BeforeShow @13-49B2A323
function Grid1_importe_BeforeShow(& $sender)
{
    $Grid1_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_importe_BeforeShow

//Custom Code @64-2A29BDB7
// -------------------------
$Grid1->importe->SetValue( number_format($Grid1->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close Grid1_importe_BeforeShow @13-4ACCF67F
    return $Grid1_importe_BeforeShow;
}
//End Close Grid1_importe_BeforeShow

//Grid1_BeforeShow @2-706857BD
function Grid1_BeforeShow(& $sender)
{
    $Grid1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_BeforeShow

//Custom Code @52-2A29BDB7
// -------------------------

	if( CCGetFromGet('idalquiler','0') <> 0)
	{
		$db = new clsDBConnection1();
		$sql = "select f.nombre,a.idalquiler ,f.idficha 
				   from fichas f 
		           join fichaspropiedades fp on (f.idficha = fp.idficha) 
				   join alquileres a on (fp.idpropiedad = a.idpropiedad)
				   where a.idalquiler= ".CCGetFromGet('idalquiler','0');
		$db->query($sql);
		$Result = $db->next_record();
		if($Result)
		{
			$txt = $db->f("nombre"). " por contrato nro. " . $db->f("idalquiler");
			$idalquiler = $db->f("idalquiler");
			$Grid1->nombrefichacontrato->SetValue($txt);
		}
		$db->close();
		$Grid1->idalquiler->SetValue($idalquiler);
		$Grid1->idficha->SetValue($db->f("idficha"));
	}
// -------------------------
//End Custom Code

//Close Grid1_BeforeShow @2-C0F58113
    return $Grid1_BeforeShow;
}
//End Close Grid1_BeforeShow

//Grid3_importe_BeforeShow @74-65825317
function Grid3_importe_BeforeShow(& $sender)
{
    $Grid3_importe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid3; //Compatibility
//End Grid3_importe_BeforeShow

//Custom Code @75-2A29BDB7
// -------------------------
$Grid3->importe->SetValue( number_format($Grid3->importe->GetValue(), 2, ',', '.'));
// -------------------------
//End Custom Code

//Close Grid3_importe_BeforeShow @74-649C3FFF
    return $Grid3_importe_BeforeShow;
}
//End Close Grid3_importe_BeforeShow

//Grid3_BeforeShow @65-8D3210BF
function Grid3_BeforeShow(& $sender)
{
    $Grid3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid3; //Compatibility
	global $Grid1;
//End Grid3_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    if( CCGetFromGet('idalquiler','0') <> 0 )
	{
		$db = new clsDBConnection1();
		$sql = "select f.nombre,a.idalquiler ,f.idficha 
				   from fichas f 
		           join fichaspropiedades fp on (f.idficha = fp.idficha) 
				   join alquileres a on (fp.idpropiedad = a.idpropiedad)
				   where a.idalquiler= ".CCGetFromGet('idalquiler','0');
		$db->query($sql);
		$Result = $db->next_record();
		if($Result)
		{
			$txt = $db->f("nombre"). " por contrato nro. " . $db->f("idalquiler");
			$idalquiler = $db->f("idalquiler");
			$Grid3->nombrefichacontrato->SetValue($txt);
		}
		$db->close();
		$Grid3->idalquiler->SetValue($idalquiler);
		$Grid3->idficha->SetValue($db->f("idficha"));
	}

 
if(CCGetParam('verliq','0')=='0')
	$Grid3->Visible = false;
else
	$Grid3->Visible = true;
// -------------------------
//End Custom Code

//Close Grid3_BeforeShow @65-219B45BE
    return $Grid3_BeforeShow;
}
//End Close Grid3_BeforeShow

//DEL  // -------------------------
//DEL  if( CCGetParam('verliq','0') == '0')
//DEL  {
//DEL  	$Link1->SetValue('Ver cuotas liquidadas');
//DEL  	$Link1->Parameters = CCGetQueryString("QueryString", "");
//DEL      $Link1->Parameters = CCAddParam($Link1->Parameters, "verliq", "1");
//DEL  //	$Link1->SetLink($Link1->GetLink().'&verpagos=1');
//DEL  }
//DEL  else
//DEL  {
//DEL  	$Link1->SetValue('Ocultar cuotas liquidadas');
//DEL  	$Link1->Parameters = CCGetQueryString("QueryString", "");
//DEL      $Link1->Parameters = CCAddParam($Link1->Parameters, "verliq", "0");
//DEL  }
//DEL  
//DEL  // -------------------------

//Link1_BeforeShow @96-73B4F52C
function Link1_BeforeShow(& $sender)
{
    $Link1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Link1; //Compatibility
//End Link1_BeforeShow

//Custom Code @97-2A29BDB7
// -------------------------


if( CCGetParam('verliq','0') == '0')
 {
 	$Link1->SetValue('Ver cuotas liquidadas');
  	$Link1->Parameters = CCGetQueryString("QueryString", "");
    $Link1->Parameters = CCAddParam($Link1->Parameters, "verliq", "1");
 //	$Link1->SetLink($Link1->GetLink().'&verpagos=1');
 }
 else
 {
 	$Link1->SetValue('Ocultar cuotas liquidadas');
 	$Link1->Parameters = CCGetQueryString("QueryString", "");
    $Link1->Parameters = CCAddParam($Link1->Parameters, "verliq", "0");
 }
// -------------------------
//End Custom Code

//Close Link1_BeforeShow @96-368844F2
    return $Link1_BeforeShow;
}
//End Close Link1_BeforeShow

//Page_BeforeShow @1-9D0C5492
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $liquidacion; //Compatibility
	global $Link1;
	global $Grid1;
	global $Grid3;
//End Page_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
if( CCGetParam('verliq','0') == '0')
{
	$Link1->SetValue('Ver cuotas liquidadas');
}
else
{
	$Link1->SetValue('Ocultar cuotas liquidadas');
}

if(CCGetParam('idalquiler','0') == '0')
	{
		$Grid1->Visible = false;
		$Grid3->Visible = false;
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//DEL  function Page_BeforeShow(& $sender)
//DEL  {
//DEL      $Page_BeforeShow = true;
//DEL      $Component = & $sender;
//DEL      $Container = & CCGetParentContainer($sender);
//DEL      global $liquidacion; //Compatibility
//DEL  	global $Grid1;


//DEL  // -------------------------
//DEL   	
//DEL  // -------------------------


?>
