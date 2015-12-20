<?php
//Include Common Files @1-DD52C262
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
define("FileName", "paga_cuotas.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordrecibo { //recibo Class @2-E3793E7B

//Variables @2-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @2-241A67CB
    function clsRecordrecibo($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record recibo/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "recibo";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->cuotas = & new clsControl(ccsHidden, "cuotas", "cuotas", ccsText, "", CCGetRequestParam("cuotas", $Method, NULL), $this);
            $this->idalquiler = & new clsControl(ccsHidden, "idalquiler", "idalquiler", ccsText, "", CCGetRequestParam("idalquiler", $Method, NULL), $this);
            $this->otros1 = & new clsControl(ccsTextBox, "otros1", "otros1", ccsFloat, "", CCGetRequestParam("otros1", $Method, NULL), $this);
            $this->observaciones = & new clsControl(ccsTextBox, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", $Method, NULL), $this);
            $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", $Method, NULL), $this);
            $this->domicilio = & new clsControl(ccsLabel, "domicilio", "domicilio", ccsText, "", CCGetRequestParam("domicilio", $Method, NULL), $this);
            $this->localidad = & new clsControl(ccsLabel, "localidad", "localidad", ccsText, "", CCGetRequestParam("localidad", $Method, NULL), $this);
            $this->cuit = & new clsControl(ccsLabel, "cuit", "cuit", ccsText, "", CCGetRequestParam("cuit", $Method, NULL), $this);
            $this->nrorec = & new clsControl(ccsTextBox, "nrorec", "nrorec", ccsText, "", CCGetRequestParam("nrorec", $Method, NULL), $this);
            $this->nrorec->Required = true;
            $this->propietario = & new clsControl(ccsLabel, "propietario", "propietario", ccsText, "", CCGetRequestParam("propietario", $Method, NULL), $this);
            $this->domicilio_propiedad = & new clsControl(ccsLabel, "domicilio_propiedad", "domicilio_propiedad", ccsText, "", CCGetRequestParam("domicilio_propiedad", $Method, NULL), $this);
            $this->localidad_propiedad = & new clsControl(ccsLabel, "localidad_propiedad", "localidad_propiedad", ccsText, "", CCGetRequestParam("localidad_propiedad", $Method, NULL), $this);
            $this->periodo = & new clsControl(ccsLabel, "periodo", "periodo", ccsText, "", CCGetRequestParam("periodo", $Method, NULL), $this);
            $this->fvto = & new clsControl(ccsLabel, "fvto", "fvto", ccsText, "", CCGetRequestParam("fvto", $Method, NULL), $this);
            $this->detalle1 = & new clsControl(ccsTextBox, "detalle1", "detalle1", ccsText, "", CCGetRequestParam("detalle1", $Method, NULL), $this);
            $this->otros2 = & new clsControl(ccsTextBox, "otros2", "otros2", ccsText, "", CCGetRequestParam("otros2", $Method, NULL), $this);
            $this->otros3 = & new clsControl(ccsTextBox, "otros3", "otros3", ccsText, "", CCGetRequestParam("otros3", $Method, NULL), $this);
            $this->otros4 = & new clsControl(ccsTextBox, "otros4", "otros4", ccsText, "", CCGetRequestParam("otros4", $Method, NULL), $this);
            $this->otros5 = & new clsControl(ccsTextBox, "otros5", "otros5", ccsText, "", CCGetRequestParam("otros5", $Method, NULL), $this);
            $this->otros6 = & new clsControl(ccsTextBox, "otros6", "otros6", ccsText, "", CCGetRequestParam("otros6", $Method, NULL), $this);
            $this->otros7 = & new clsControl(ccsTextBox, "otros7", "otros7", ccsText, "", CCGetRequestParam("otros7", $Method, NULL), $this);
            $this->otros8 = & new clsControl(ccsTextBox, "otros8", "otros8", ccsText, "", CCGetRequestParam("otros8", $Method, NULL), $this);
            $this->otros9 = & new clsControl(ccsTextBox, "otros9", "otros9", ccsText, "", CCGetRequestParam("otros9", $Method, NULL), $this);
            $this->otros10 = & new clsControl(ccsTextBox, "otros10", "otros10", ccsText, "", CCGetRequestParam("otros10", $Method, NULL), $this);
            $this->detalle3 = & new clsControl(ccsTextBox, "detalle3", "detalle3", ccsText, "", CCGetRequestParam("detalle3", $Method, NULL), $this);
            $this->detalle4 = & new clsControl(ccsTextBox, "detalle4", "detalle4", ccsText, "", CCGetRequestParam("detalle4", $Method, NULL), $this);
            $this->detalle5 = & new clsControl(ccsTextBox, "detalle5", "detalle5", ccsText, "", CCGetRequestParam("detalle5", $Method, NULL), $this);
            $this->detalle6 = & new clsControl(ccsTextBox, "detalle6", "detalle6", ccsText, "", CCGetRequestParam("detalle6", $Method, NULL), $this);
            $this->detalle7 = & new clsControl(ccsTextBox, "detalle7", "detalle7", ccsText, "", CCGetRequestParam("detalle7", $Method, NULL), $this);
            $this->detalle8 = & new clsControl(ccsTextBox, "detalle8", "detalle8", ccsText, "", CCGetRequestParam("detalle8", $Method, NULL), $this);
            $this->detalle9 = & new clsControl(ccsTextBox, "detalle9", "detalle9", ccsText, "", CCGetRequestParam("detalle9", $Method, NULL), $this);
            $this->detalle10 = & new clsControl(ccsTextBox, "detalle10", "detalle10", ccsText, "", CCGetRequestParam("detalle10", $Method, NULL), $this);
            $this->detalle2 = & new clsControl(ccsTextBox, "detalle2", "detalle2", ccsText, "", CCGetRequestParam("detalle2", $Method, NULL), $this);
            $this->impuestos1 = & new clsControl(ccsTextBox, "impuestos1", "impuestos1", ccsText, "", CCGetRequestParam("impuestos1", $Method, NULL), $this);
            $this->impuestos2 = & new clsControl(ccsTextBox, "impuestos2", "impuestos2", ccsText, "", CCGetRequestParam("impuestos2", $Method, NULL), $this);
            $this->impuestos3 = & new clsControl(ccsTextBox, "impuestos3", "impuestos3", ccsText, "", CCGetRequestParam("impuestos3", $Method, NULL), $this);
            $this->impuestos4 = & new clsControl(ccsTextBox, "impuestos4", "impuestos4", ccsText, "", CCGetRequestParam("impuestos4", $Method, NULL), $this);
            $this->impuestos5 = & new clsControl(ccsTextBox, "impuestos5", "impuestos5", ccsText, "", CCGetRequestParam("impuestos5", $Method, NULL), $this);
            $this->impuestos6 = & new clsControl(ccsTextBox, "impuestos6", "impuestos6", ccsText, "", CCGetRequestParam("impuestos6", $Method, NULL), $this);
            $this->impuestos7 = & new clsControl(ccsTextBox, "impuestos7", "impuestos7", ccsText, "", CCGetRequestParam("impuestos7", $Method, NULL), $this);
            $this->impuestos8 = & new clsControl(ccsTextBox, "impuestos8", "impuestos8", ccsText, "", CCGetRequestParam("impuestos8", $Method, NULL), $this);
            $this->impuestos9 = & new clsControl(ccsTextBox, "impuestos9", "impuestos9", ccsText, "", CCGetRequestParam("impuestos9", $Method, NULL), $this);
            $this->impuestos10 = & new clsControl(ccsTextBox, "impuestos10", "impuestos10", ccsText, "", CCGetRequestParam("impuestos10", $Method, NULL), $this);
            $this->importe_cuota = & new clsControl(ccsLabel, "importe_cuota", "importe_cuota", ccsText, "", CCGetRequestParam("importe_cuota", $Method, NULL), $this);
            $this->idimpuestos1 = & new clsControl(ccsListBox, "idimpuestos1", "idimpuestos1", ccsText, "", CCGetRequestParam("idimpuestos1", $Method, NULL), $this);
            $this->idimpuestos1->DSType = dsTable;
            $this->idimpuestos1->DataSource = new clsDBConnection1();
            $this->idimpuestos1->ds = & $this->idimpuestos1->DataSource;
            $this->idimpuestos1->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos1->BoundColumn, $this->idimpuestos1->TextColumn, $this->idimpuestos1->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos2 = & new clsControl(ccsListBox, "idimpuestos2", "idimpuestos2", ccsText, "", CCGetRequestParam("idimpuestos2", $Method, NULL), $this);
            $this->idimpuestos2->DSType = dsTable;
            $this->idimpuestos2->DataSource = new clsDBConnection1();
            $this->idimpuestos2->ds = & $this->idimpuestos2->DataSource;
            $this->idimpuestos2->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos2->BoundColumn, $this->idimpuestos2->TextColumn, $this->idimpuestos2->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos3 = & new clsControl(ccsListBox, "idimpuestos3", "idimpuestos3", ccsInteger, "", CCGetRequestParam("idimpuestos3", $Method, NULL), $this);
            $this->idimpuestos3->DSType = dsTable;
            $this->idimpuestos3->DataSource = new clsDBConnection1();
            $this->idimpuestos3->ds = & $this->idimpuestos3->DataSource;
            $this->idimpuestos3->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos3->BoundColumn, $this->idimpuestos3->TextColumn, $this->idimpuestos3->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos4 = & new clsControl(ccsListBox, "idimpuestos4", "idimpuestos4", ccsInteger, "", CCGetRequestParam("idimpuestos4", $Method, NULL), $this);
            $this->idimpuestos4->DSType = dsTable;
            $this->idimpuestos4->DataSource = new clsDBConnection1();
            $this->idimpuestos4->ds = & $this->idimpuestos4->DataSource;
            $this->idimpuestos4->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos4->BoundColumn, $this->idimpuestos4->TextColumn, $this->idimpuestos4->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos5 = & new clsControl(ccsListBox, "idimpuestos5", "idimpuestos5", ccsInteger, "", CCGetRequestParam("idimpuestos5", $Method, NULL), $this);
            $this->idimpuestos5->DSType = dsTable;
            $this->idimpuestos5->DataSource = new clsDBConnection1();
            $this->idimpuestos5->ds = & $this->idimpuestos5->DataSource;
            $this->idimpuestos5->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos5->BoundColumn, $this->idimpuestos5->TextColumn, $this->idimpuestos5->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos6 = & new clsControl(ccsListBox, "idimpuestos6", "idimpuestos6", ccsInteger, "", CCGetRequestParam("idimpuestos6", $Method, NULL), $this);
            $this->idimpuestos6->DSType = dsTable;
            $this->idimpuestos6->DataSource = new clsDBConnection1();
            $this->idimpuestos6->ds = & $this->idimpuestos6->DataSource;
            $this->idimpuestos6->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos6->BoundColumn, $this->idimpuestos6->TextColumn, $this->idimpuestos6->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos7 = & new clsControl(ccsListBox, "idimpuestos7", "idimpuestos7", ccsInteger, "", CCGetRequestParam("idimpuestos7", $Method, NULL), $this);
            $this->idimpuestos7->DSType = dsTable;
            $this->idimpuestos7->DataSource = new clsDBConnection1();
            $this->idimpuestos7->ds = & $this->idimpuestos7->DataSource;
            $this->idimpuestos7->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos7->BoundColumn, $this->idimpuestos7->TextColumn, $this->idimpuestos7->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos8 = & new clsControl(ccsListBox, "idimpuestos8", "idimpuestos8", ccsInteger, "", CCGetRequestParam("idimpuestos8", $Method, NULL), $this);
            $this->idimpuestos8->DSType = dsTable;
            $this->idimpuestos8->DataSource = new clsDBConnection1();
            $this->idimpuestos8->ds = & $this->idimpuestos8->DataSource;
            $this->idimpuestos8->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos8->BoundColumn, $this->idimpuestos8->TextColumn, $this->idimpuestos8->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos9 = & new clsControl(ccsListBox, "idimpuestos9", "idimpuestos9", ccsInteger, "", CCGetRequestParam("idimpuestos9", $Method, NULL), $this);
            $this->idimpuestos9->DSType = dsTable;
            $this->idimpuestos9->DataSource = new clsDBConnection1();
            $this->idimpuestos9->ds = & $this->idimpuestos9->DataSource;
            $this->idimpuestos9->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos9->BoundColumn, $this->idimpuestos9->TextColumn, $this->idimpuestos9->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->idimpuestos10 = & new clsControl(ccsListBox, "idimpuestos10", "idimpuestos10", ccsText, "", CCGetRequestParam("idimpuestos10", $Method, NULL), $this);
            $this->idimpuestos10->DSType = dsTable;
            $this->idimpuestos10->DataSource = new clsDBConnection1();
            $this->idimpuestos10->ds = & $this->idimpuestos10->DataSource;
            $this->idimpuestos10->DataSource->SQL = "SELECT * \n" .
"FROM impuestos {SQL_Where} {SQL_OrderBy}";
            list($this->idimpuestos10->BoundColumn, $this->idimpuestos10->TextColumn, $this->idimpuestos10->DBFormat) = array("idimpuesto", "nombreimpuesto", "");
            $this->acuerdo = & new clsControl(ccsTextBox, "acuerdo", "acuerdo", ccsText, "", CCGetRequestParam("acuerdo", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->nrorec->Value) && !strlen($this->nrorec->Value) && $this->nrorec->Value !== false)
                    $this->nrorec->SetText(99);
                if(!is_array($this->idimpuestos1->Value) && !strlen($this->idimpuestos1->Value) && $this->idimpuestos1->Value !== false)
                    $this->idimpuestos1->SetText(5);
                if(!is_array($this->idimpuestos2->Value) && !strlen($this->idimpuestos2->Value) && $this->idimpuestos2->Value !== false)
                    $this->idimpuestos2->SetText(3);
                if(!is_array($this->idimpuestos3->Value) && !strlen($this->idimpuestos3->Value) && $this->idimpuestos3->Value !== false)
                    $this->idimpuestos3->SetText(6);
                if(!is_array($this->idimpuestos4->Value) && !strlen($this->idimpuestos4->Value) && $this->idimpuestos4->Value !== false)
                    $this->idimpuestos4->SetText(1);
                if(!is_array($this->idimpuestos5->Value) && !strlen($this->idimpuestos5->Value) && $this->idimpuestos5->Value !== false)
                    $this->idimpuestos5->SetText(4);
                if(!is_array($this->idimpuestos6->Value) && !strlen($this->idimpuestos6->Value) && $this->idimpuestos6->Value !== false)
                    $this->idimpuestos6->SetText(2);
                if(!is_array($this->acuerdo->Value) && !strlen($this->acuerdo->Value) && $this->acuerdo->Value !== false)
                    $this->acuerdo->SetText(0);
            }
        }
    }
//End Class_Initialize Event

//Validate Method @2-6C986619
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->cuotas->Validate() && $Validation);
        $Validation = ($this->idalquiler->Validate() && $Validation);
        $Validation = ($this->otros1->Validate() && $Validation);
        $Validation = ($this->observaciones->Validate() && $Validation);
        $Validation = ($this->nrorec->Validate() && $Validation);
        $Validation = ($this->detalle1->Validate() && $Validation);
        $Validation = ($this->otros2->Validate() && $Validation);
        $Validation = ($this->otros3->Validate() && $Validation);
        $Validation = ($this->otros4->Validate() && $Validation);
        $Validation = ($this->otros5->Validate() && $Validation);
        $Validation = ($this->otros6->Validate() && $Validation);
        $Validation = ($this->otros7->Validate() && $Validation);
        $Validation = ($this->otros8->Validate() && $Validation);
        $Validation = ($this->otros9->Validate() && $Validation);
        $Validation = ($this->otros10->Validate() && $Validation);
        $Validation = ($this->detalle3->Validate() && $Validation);
        $Validation = ($this->detalle4->Validate() && $Validation);
        $Validation = ($this->detalle5->Validate() && $Validation);
        $Validation = ($this->detalle6->Validate() && $Validation);
        $Validation = ($this->detalle7->Validate() && $Validation);
        $Validation = ($this->detalle8->Validate() && $Validation);
        $Validation = ($this->detalle9->Validate() && $Validation);
        $Validation = ($this->detalle10->Validate() && $Validation);
        $Validation = ($this->detalle2->Validate() && $Validation);
        $Validation = ($this->impuestos1->Validate() && $Validation);
        $Validation = ($this->impuestos2->Validate() && $Validation);
        $Validation = ($this->impuestos3->Validate() && $Validation);
        $Validation = ($this->impuestos4->Validate() && $Validation);
        $Validation = ($this->impuestos5->Validate() && $Validation);
        $Validation = ($this->impuestos6->Validate() && $Validation);
        $Validation = ($this->impuestos7->Validate() && $Validation);
        $Validation = ($this->impuestos8->Validate() && $Validation);
        $Validation = ($this->impuestos9->Validate() && $Validation);
        $Validation = ($this->impuestos10->Validate() && $Validation);
        $Validation = ($this->idimpuestos1->Validate() && $Validation);
        $Validation = ($this->idimpuestos2->Validate() && $Validation);
        $Validation = ($this->idimpuestos3->Validate() && $Validation);
        $Validation = ($this->idimpuestos4->Validate() && $Validation);
        $Validation = ($this->idimpuestos5->Validate() && $Validation);
        $Validation = ($this->idimpuestos6->Validate() && $Validation);
        $Validation = ($this->idimpuestos7->Validate() && $Validation);
        $Validation = ($this->idimpuestos8->Validate() && $Validation);
        $Validation = ($this->idimpuestos9->Validate() && $Validation);
        $Validation = ($this->idimpuestos10->Validate() && $Validation);
        $Validation = ($this->acuerdo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->cuotas->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idalquiler->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->observaciones->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nrorec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros8->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros9->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros10->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle8->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle9->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle10->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos8->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos9->Errors->Count() == 0);
        $Validation =  $Validation && ($this->impuestos10->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos8->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos9->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idimpuestos10->Errors->Count() == 0);
        $Validation =  $Validation && ($this->acuerdo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-AA9641F8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->cuotas->Errors->Count());
        $errors = ($errors || $this->idalquiler->Errors->Count());
        $errors = ($errors || $this->otros1->Errors->Count());
        $errors = ($errors || $this->observaciones->Errors->Count());
        $errors = ($errors || $this->nombre->Errors->Count());
        $errors = ($errors || $this->domicilio->Errors->Count());
        $errors = ($errors || $this->localidad->Errors->Count());
        $errors = ($errors || $this->cuit->Errors->Count());
        $errors = ($errors || $this->nrorec->Errors->Count());
        $errors = ($errors || $this->propietario->Errors->Count());
        $errors = ($errors || $this->domicilio_propiedad->Errors->Count());
        $errors = ($errors || $this->localidad_propiedad->Errors->Count());
        $errors = ($errors || $this->periodo->Errors->Count());
        $errors = ($errors || $this->fvto->Errors->Count());
        $errors = ($errors || $this->detalle1->Errors->Count());
        $errors = ($errors || $this->otros2->Errors->Count());
        $errors = ($errors || $this->otros3->Errors->Count());
        $errors = ($errors || $this->otros4->Errors->Count());
        $errors = ($errors || $this->otros5->Errors->Count());
        $errors = ($errors || $this->otros6->Errors->Count());
        $errors = ($errors || $this->otros7->Errors->Count());
        $errors = ($errors || $this->otros8->Errors->Count());
        $errors = ($errors || $this->otros9->Errors->Count());
        $errors = ($errors || $this->otros10->Errors->Count());
        $errors = ($errors || $this->detalle3->Errors->Count());
        $errors = ($errors || $this->detalle4->Errors->Count());
        $errors = ($errors || $this->detalle5->Errors->Count());
        $errors = ($errors || $this->detalle6->Errors->Count());
        $errors = ($errors || $this->detalle7->Errors->Count());
        $errors = ($errors || $this->detalle8->Errors->Count());
        $errors = ($errors || $this->detalle9->Errors->Count());
        $errors = ($errors || $this->detalle10->Errors->Count());
        $errors = ($errors || $this->detalle2->Errors->Count());
        $errors = ($errors || $this->impuestos1->Errors->Count());
        $errors = ($errors || $this->impuestos2->Errors->Count());
        $errors = ($errors || $this->impuestos3->Errors->Count());
        $errors = ($errors || $this->impuestos4->Errors->Count());
        $errors = ($errors || $this->impuestos5->Errors->Count());
        $errors = ($errors || $this->impuestos6->Errors->Count());
        $errors = ($errors || $this->impuestos7->Errors->Count());
        $errors = ($errors || $this->impuestos8->Errors->Count());
        $errors = ($errors || $this->impuestos9->Errors->Count());
        $errors = ($errors || $this->impuestos10->Errors->Count());
        $errors = ($errors || $this->importe_cuota->Errors->Count());
        $errors = ($errors || $this->idimpuestos1->Errors->Count());
        $errors = ($errors || $this->idimpuestos2->Errors->Count());
        $errors = ($errors || $this->idimpuestos3->Errors->Count());
        $errors = ($errors || $this->idimpuestos4->Errors->Count());
        $errors = ($errors || $this->idimpuestos5->Errors->Count());
        $errors = ($errors || $this->idimpuestos6->Errors->Count());
        $errors = ($errors || $this->idimpuestos7->Errors->Count());
        $errors = ($errors || $this->idimpuestos8->Errors->Count());
        $errors = ($errors || $this->idimpuestos9->Errors->Count());
        $errors = ($errors || $this->idimpuestos10->Errors->Count());
        $errors = ($errors || $this->acuerdo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @2-20CEF869
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-92168C0B
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->idimpuestos1->Prepare();
        $this->idimpuestos2->Prepare();
        $this->idimpuestos3->Prepare();
        $this->idimpuestos4->Prepare();
        $this->idimpuestos5->Prepare();
        $this->idimpuestos6->Prepare();
        $this->idimpuestos7->Prepare();
        $this->idimpuestos8->Prepare();
        $this->idimpuestos9->Prepare();
        $this->idimpuestos10->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->cuotas->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idalquiler->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->observaciones->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nombre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->domicilio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->localidad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cuit->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nrorec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->propietario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->domicilio_propiedad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->localidad_propiedad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->periodo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fvto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros8->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros9->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros10->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle8->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle9->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle10->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos8->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos9->Errors->ToString());
            $Error = ComposeStrings($Error, $this->impuestos10->Errors->ToString());
            $Error = ComposeStrings($Error, $this->importe_cuota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos8->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos9->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idimpuestos10->Errors->ToString());
            $Error = ComposeStrings($Error, $this->acuerdo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->cuotas->Show();
        $this->idalquiler->Show();
        $this->otros1->Show();
        $this->observaciones->Show();
        $this->nombre->Show();
        $this->domicilio->Show();
        $this->localidad->Show();
        $this->cuit->Show();
        $this->nrorec->Show();
        $this->propietario->Show();
        $this->domicilio_propiedad->Show();
        $this->localidad_propiedad->Show();
        $this->periodo->Show();
        $this->fvto->Show();
        $this->detalle1->Show();
        $this->otros2->Show();
        $this->otros3->Show();
        $this->otros4->Show();
        $this->otros5->Show();
        $this->otros6->Show();
        $this->otros7->Show();
        $this->otros8->Show();
        $this->otros9->Show();
        $this->otros10->Show();
        $this->detalle3->Show();
        $this->detalle4->Show();
        $this->detalle5->Show();
        $this->detalle6->Show();
        $this->detalle7->Show();
        $this->detalle8->Show();
        $this->detalle9->Show();
        $this->detalle10->Show();
        $this->detalle2->Show();
        $this->impuestos1->Show();
        $this->impuestos2->Show();
        $this->impuestos3->Show();
        $this->impuestos4->Show();
        $this->impuestos5->Show();
        $this->impuestos6->Show();
        $this->impuestos7->Show();
        $this->impuestos8->Show();
        $this->impuestos9->Show();
        $this->impuestos10->Show();
        $this->importe_cuota->Show();
        $this->idimpuestos1->Show();
        $this->idimpuestos2->Show();
        $this->idimpuestos3->Show();
        $this->idimpuestos4->Show();
        $this->idimpuestos5->Show();
        $this->idimpuestos6->Show();
        $this->idimpuestos7->Show();
        $this->idimpuestos8->Show();
        $this->idimpuestos9->Show();
        $this->idimpuestos10->Show();
        $this->acuerdo->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End recibo Class @2-FCB6E20C

//Initialize Page @1-045A5547
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "paga_cuotas.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-12C5AB45
include_once("./paga_cuotas_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B54DE4B6
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$recibo = & new clsRecordrecibo("", $MainPage);
$Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Page = "#";
$MainPage->recibo = & $recibo;
$MainPage->Link1 = & $Link1;

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-D92C8A1C
$recibo->Operation();
//End Execute Components

//Go to destination page @1-E5BB94DE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($recibo);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-85C534AC
$recibo->Show();
$Link1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4EFE7AA7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($recibo);
unset($Tpl);
//End Unload Page


?>
