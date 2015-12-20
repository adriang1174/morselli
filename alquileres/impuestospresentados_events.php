<?php
//BindEvents Method @1-4DAE7650
function BindEvents()
{
    global $impuestos_impuestosanocon;
    $impuestos_impuestosanocon->Label3->CCSEvents["BeforeShow"] = "impuestos_impuestosanocon_Label3_BeforeShow";
    $impuestos_impuestosanocon->CCSEvents["BeforeShow"] = "impuestos_impuestosanocon_BeforeShow";
}
//End BindEvents Method

//impuestos_impuestosanocon_Label3_BeforeShow @114-BAA0253A
function impuestos_impuestosanocon_Label3_BeforeShow(& $sender)
{
    $impuestos_impuestosanocon_Label3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $impuestos_impuestosanocon; //Compatibility
//End impuestos_impuestosanocon_Label3_BeforeShow

//Custom Code @115-2A29BDB7
// -------------------------
  $NewConnection = new clsDBConnection1();
  $idalquiler =	CCGetFromGet('idalquiler','');
  $ano = CCGetFromGet('ano','');
  
  $NewConnection->query("select (year(fechainicio)+ ".$ano." - 1) as descripcion
  from alquileres 
  where alquileres.idalquiler = ". $idalquiler);
  
  while($NewConnection->next_record()){
  $impuestos_impuestosanocon->Label3->SetValue($NewConnection->f("descripcion"));
  	}

// -------------------------
//End Custom Code

//Close impuestos_impuestosanocon_Label3_BeforeShow @114-AD971061
    return $impuestos_impuestosanocon_Label3_BeforeShow;
}
//End Close impuestos_impuestosanocon_Label3_BeforeShow

//DEL  // -------------------------
//DEL  $NewConnection = new clsDBConnection1();
//DEL  $idalquiler =	CCGetFromGet('idalquiler','');
//DEL  $ano = CCGetFromGet('ano','');
//DEL  
//DEL  $NewConnection->query("select (year(fechainicio)+ ".$ano." - 1) as descripcion
//DEL  from alquileres 
//DEL  where alquileres.idalquiler = ". $idalquiler);
//DEL  
//DEL  while($NewConnection->next_record()){
//DEL  $impuestos_impuestosanocon->Label3->SetValue($NewConnection->f("descripcion"));
//DEL  	}
//DEL      //$NewConnection->close();
//DEL  // -------------------------

//impuestos_impuestosanocon_BeforeShow @2-64D4E176
function impuestos_impuestosanocon_BeforeShow(& $sender)
{
    $impuestos_impuestosanocon_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $impuestos_impuestosanocon; //Compatibility
//End impuestos_impuestosanocon_BeforeShow

//Custom Code @112-2A29BDB7
// -------------------------

$impuestos_impuestosanocon->Label1->SetValue(CCGetFromGet('idalquiler',''));

$NewConnection = new clsDBConnection1();
$query =	CCGetFromGet('idalquiler','');

$NewConnection->query("select direccion from alquileres a, propiedades b where a.idpropiedad = b.idpropiedad and a.idalquiler = '". $query . "'");

while($NewConnection->next_record()){
$impuestos_impuestosanocon->Label2->SetValue($NewConnection->f("direccion"));
	}
    $NewConnection->close();
// -------------------------
//End Custom Code

//Close impuestos_impuestosanocon_BeforeShow @2-B16531CC
    return $impuestos_impuestosanocon_BeforeShow;
}
//End Close impuestos_impuestosanocon_BeforeShow


?>
