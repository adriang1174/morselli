<?php
//BindEvents Method @1-702EA6CA
function BindEvents()
{
    global $Grid1;
    $Grid1->i1->CCSEvents["BeforeShow"] = "Grid1_i1_BeforeShow";
    $Grid1->i2->CCSEvents["BeforeShow"] = "Grid1_i2_BeforeShow";
    $Grid1->i3->CCSEvents["BeforeShow"] = "Grid1_i3_BeforeShow";
    $Grid1->i4->CCSEvents["BeforeShow"] = "Grid1_i4_BeforeShow";
    $Grid1->i5->CCSEvents["BeforeShow"] = "Grid1_i5_BeforeShow";
    $Grid1->i6->CCSEvents["BeforeShow"] = "Grid1_i6_BeforeShow";
    $Grid1->i7->CCSEvents["BeforeShow"] = "Grid1_i7_BeforeShow";
    $Grid1->i8->CCSEvents["BeforeShow"] = "Grid1_i8_BeforeShow";
    $Grid1->i9->CCSEvents["BeforeShow"] = "Grid1_i9_BeforeShow";
}
//End BindEvents Method

//Grid1_i1_BeforeShow @28-3A1CACF7
function Grid1_i1_BeforeShow(& $sender)
{
    $Grid1_i1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i1_BeforeShow

//Custom Code @47-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 1";
$conn->query($sql);
$conn->next_record();
$Grid1->i1->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i1_BeforeShow @28-D7585036
    return $Grid1_i1_BeforeShow;
}
//End Close Grid1_i1_BeforeShow

//Grid1_i2_BeforeShow @30-A592BD41
function Grid1_i2_BeforeShow(& $sender)
{
    $Grid1_i2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i2_BeforeShow

//Custom Code @48-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 2";
$conn->query($sql);
$conn->next_record();
$Grid1->i2->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i2_BeforeShow @30-AB3975ED
    return $Grid1_i2_BeforeShow;
}
//End Close Grid1_i2_BeforeShow

//Grid1_i3_BeforeShow @32-66384FEC
function Grid1_i3_BeforeShow(& $sender)
{
    $Grid1_i3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i3_BeforeShow

//Custom Code @49-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 3";
$conn->query($sql);
$conn->next_record();
$Grid1->i3->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i3_BeforeShow @32-3636949B
    return $Grid1_i3_BeforeShow;
}
//End Close Grid1_i3_BeforeShow

//Grid1_i4_BeforeShow @34-41FF986C
function Grid1_i4_BeforeShow(& $sender)
{
    $Grid1_i4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i4_BeforeShow

//Custom Code @50-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 4";
$conn->query($sql);
$conn->next_record();
$Grid1->i4->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i4_BeforeShow @34-53FB3E5B
    return $Grid1_i4_BeforeShow;
}
//End Close Grid1_i4_BeforeShow

//Grid1_i5_BeforeShow @36-82556AC1
function Grid1_i5_BeforeShow(& $sender)
{
    $Grid1_i5_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i5_BeforeShow

//Custom Code @51-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 5";
$conn->query($sql);
$conn->next_record();
$Grid1->i5->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i5_BeforeShow @36-CEF4DF2D
    return $Grid1_i5_BeforeShow;
}
//End Close Grid1_i5_BeforeShow

//Grid1_i6_BeforeShow @38-1DDB7B77
function Grid1_i6_BeforeShow(& $sender)
{
    $Grid1_i6_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i6_BeforeShow

//Custom Code @52-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 6";
$conn->query($sql);
$conn->next_record();
$Grid1->i6->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i6_BeforeShow @38-B295FAF6
    return $Grid1_i6_BeforeShow;
}
//End Close Grid1_i6_BeforeShow

//Grid1_i7_BeforeShow @40-DE7189DA
function Grid1_i7_BeforeShow(& $sender)
{
    $Grid1_i7_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i7_BeforeShow

//Custom Code @53-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 7";
$conn->query($sql);
$conn->next_record();
$Grid1->i7->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i7_BeforeShow @40-2F9A1B80
    return $Grid1_i7_BeforeShow;
}
//End Close Grid1_i7_BeforeShow

//Grid1_i8_BeforeShow @42-5254D477
function Grid1_i8_BeforeShow(& $sender)
{
    $Grid1_i8_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i8_BeforeShow

//Custom Code @54-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 8";
$conn->query($sql);
$conn->next_record();
$Grid1->i8->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i8_BeforeShow @42-790EAF76
    return $Grid1_i8_BeforeShow;
}
//End Close Grid1_i8_BeforeShow

//Grid1_i9_BeforeShow @44-91FE26DA
function Grid1_i9_BeforeShow(& $sender)
{
    $Grid1_i9_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid1; //Compatibility
//End Grid1_i9_BeforeShow

//Custom Code @55-2A29BDB7
// -------------------------
$conn = new clsDBConnection1();
$sql = "select nombreimpuesto from impuestos where idimpuesto = 9";
$conn->query($sql);
$conn->next_record();
$Grid1->i9->SetValue($conn->f('nombreimpuesto'));
$conn->close();
// -------------------------
//End Custom Code

//Close Grid1_i9_BeforeShow @44-E4014E00
    return $Grid1_i9_BeforeShow;
}
//End Close Grid1_i9_BeforeShow


?>
