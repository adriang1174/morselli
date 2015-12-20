<?php
//Include Common Files @1-97833948
define("RelativePath", "..");
define("PathToCurrentPage", "/caja/");
define("FileName", "cierrecaja.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-DFB6E2FC
include_once(RelativePath . "/caja/Header.php");
//End Include Page implementation

class clsRecordcajaresumen { //cajaresumen Class @3-A85D4A5D

//Variables @3-D6FF3E86

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

//Class_Initialize Event @3-5337652B
    function clsRecordcajaresumen($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record cajaresumen/Error";
        $this->DataSource = new clscajaresumenDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "cajaresumen";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->fecha = & new clsControl(ccsTextBox, "fecha", "Fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", $Method, NULL), $this);
            $this->fecha->Required = true;
            $this->saldoinicial = & new clsControl(ccsTextBox, "saldoinicial", "Saldoinicial", ccsFloat, "", CCGetRequestParam("saldoinicial", $Method, NULL), $this);
            $this->totalingresos = & new clsControl(ccsTextBox, "totalingresos", "Totalingresos", ccsFloat, "", CCGetRequestParam("totalingresos", $Method, NULL), $this);
            $this->totalegresos = & new clsControl(ccsTextBox, "totalegresos", "Totalegresos", ccsFloat, "", CCGetRequestParam("totalegresos", $Method, NULL), $this);
            $this->saldofinal = & new clsControl(ccsTextBox, "saldofinal", "Saldofinal", ccsFloat, "", CCGetRequestParam("saldofinal", $Method, NULL), $this);
            $this->saldoinicialdolar = & new clsControl(ccsTextBox, "saldoinicialdolar", "saldoinicialdolar", ccsInteger, "", CCGetRequestParam("saldoinicialdolar", $Method, NULL), $this);
            $this->totalingresosdolar = & new clsControl(ccsTextBox, "totalingresosdolar", "totalingresosdolar", ccsInteger, "", CCGetRequestParam("totalingresosdolar", $Method, NULL), $this);
            $this->totalegresosdolar = & new clsControl(ccsTextBox, "totalegresosdolar", "totalegresosdolar", ccsInteger, "", CCGetRequestParam("totalegresosdolar", $Method, NULL), $this);
            $this->saldofinaldolar = & new clsControl(ccsTextBox, "saldofinaldolar", "saldofinaldolar", ccsInteger, "", CCGetRequestParam("saldofinaldolar", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-56B8735A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urls_fecha"] = CCGetFromGet("s_fecha", NULL);
    }
//End Initialize Method

//Validate Method @3-698BB98D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->fecha->Validate() && $Validation);
        $Validation = ($this->saldoinicial->Validate() && $Validation);
        $Validation = ($this->totalingresos->Validate() && $Validation);
        $Validation = ($this->totalegresos->Validate() && $Validation);
        $Validation = ($this->saldofinal->Validate() && $Validation);
        $Validation = ($this->saldoinicialdolar->Validate() && $Validation);
        $Validation = ($this->totalingresosdolar->Validate() && $Validation);
        $Validation = ($this->totalegresosdolar->Validate() && $Validation);
        $Validation = ($this->saldofinaldolar->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->fecha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->saldoinicial->Errors->Count() == 0);
        $Validation =  $Validation && ($this->totalingresos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->totalegresos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->saldofinal->Errors->Count() == 0);
        $Validation =  $Validation && ($this->saldoinicialdolar->Errors->Count() == 0);
        $Validation =  $Validation && ($this->totalingresosdolar->Errors->Count() == 0);
        $Validation =  $Validation && ($this->totalegresosdolar->Errors->Count() == 0);
        $Validation =  $Validation && ($this->saldofinaldolar->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-85894D84
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->fecha->Errors->Count());
        $errors = ($errors || $this->saldoinicial->Errors->Count());
        $errors = ($errors || $this->totalingresos->Errors->Count());
        $errors = ($errors || $this->totalegresos->Errors->Count());
        $errors = ($errors || $this->saldofinal->Errors->Count());
        $errors = ($errors || $this->saldoinicialdolar->Errors->Count());
        $errors = ($errors || $this->totalingresosdolar->Errors->Count());
        $errors = ($errors || $this->totalegresosdolar->Errors->Count());
        $errors = ($errors || $this->saldofinaldolar->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-4C40C7B7
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @3-6357B31F
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->saldofinal->SetValue($this->saldofinal->GetValue(true));
        $this->DataSource->saldofinaldolar->SetValue($this->saldofinaldolar->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-91E6F3BF
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->saldoinicial->SetValue($this->DataSource->saldoinicial->GetValue());
                    $this->totalingresos->SetValue($this->DataSource->totalingresos->GetValue());
                    $this->totalegresos->SetValue($this->DataSource->totalegresos->GetValue());
                    $this->saldofinal->SetValue($this->DataSource->saldofinal->GetValue());
                    $this->saldoinicialdolar->SetValue($this->DataSource->saldoinicialdolar->GetValue());
                    $this->totalingresosdolar->SetValue($this->DataSource->totalingresosdolar->GetValue());
                    $this->totalegresosdolar->SetValue($this->DataSource->totalegresosdolar->GetValue());
                    $this->saldofinaldolar->SetValue($this->DataSource->saldofinaldolar->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->saldoinicial->Errors->ToString());
            $Error = ComposeStrings($Error, $this->totalingresos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->totalegresos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->saldofinal->Errors->ToString());
            $Error = ComposeStrings($Error, $this->saldoinicialdolar->Errors->ToString());
            $Error = ComposeStrings($Error, $this->totalingresosdolar->Errors->ToString());
            $Error = ComposeStrings($Error, $this->totalegresosdolar->Errors->ToString());
            $Error = ComposeStrings($Error, $this->saldofinaldolar->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->fecha->Show();
        $this->saldoinicial->Show();
        $this->totalingresos->Show();
        $this->totalegresos->Show();
        $this->saldofinal->Show();
        $this->saldoinicialdolar->Show();
        $this->totalingresosdolar->Show();
        $this->totalegresosdolar->Show();
        $this->saldofinaldolar->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End cajaresumen Class @3-FCB6E20C

class clscajaresumenDataSource extends clsDBConnection1 {  //cajaresumenDataSource Class @3-6FD91430

//DataSource Variables @3-B2934C32
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $fecha;
    var $saldoinicial;
    var $totalingresos;
    var $totalegresos;
    var $saldofinal;
    var $saldoinicialdolar;
    var $totalingresosdolar;
    var $totalegresosdolar;
    var $saldofinaldolar;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-F0A960A7
    function clscajaresumenDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record cajaresumen/Error";
        $this->Initialize();
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->saldoinicial = new clsField("saldoinicial", ccsFloat, "");
        
        $this->totalingresos = new clsField("totalingresos", ccsFloat, "");
        
        $this->totalegresos = new clsField("totalegresos", ccsFloat, "");
        
        $this->saldofinal = new clsField("saldofinal", ccsFloat, "");
        
        $this->saldoinicialdolar = new clsField("saldoinicialdolar", ccsInteger, "");
        
        $this->totalingresosdolar = new clsField("totalingresosdolar", ccsInteger, "");
        
        $this->totalegresosdolar = new clsField("totalegresosdolar", ccsInteger, "");
        
        $this->saldofinaldolar = new clsField("saldofinaldolar", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-EC0AEAB4
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("dd", "/", "mm", "/", "yyyy"), $this->Parameters["urls_fecha"], 01/01/1960, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @3-20F2AC6F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM cajaresumen\n" .
        "WHERE ( convert(varchar,fecha,103) = convert(varchar,'" . $this->SQLValue($this->wp->GetDBValue("1"), ccsDate) . "' ,103) ) ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-EE72236A
    function SetValues()
    {
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->saldoinicial->SetDBValue(trim($this->f("saldoinicial")));
        $this->totalingresos->SetDBValue(trim($this->f("totalingresos")));
        $this->totalegresos->SetDBValue(trim($this->f("totalegresos")));
        $this->saldofinal->SetDBValue(trim($this->f("saldofinal")));
        $this->saldoinicialdolar->SetDBValue(trim($this->f("saldoinicialdolar")));
        $this->totalingresosdolar->SetDBValue(trim($this->f("totalingresosdolar")));
        $this->totalegresosdolar->SetDBValue(trim($this->f("totalegresosdolar")));
        $this->saldofinaldolar->SetDBValue(trim($this->f("saldofinaldolar")));
    }
//End SetValues Method

//Update Method @3-C2965BEA
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["saldofinal"] = new clsSQLParameter("ctrlsaldofinal", ccsInteger, "", "", $this->saldofinal->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["saldofinaldolar"] = new clsSQLParameter("ctrlsaldofinaldolar", ccsInteger, "", "", $this->saldofinaldolar->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["fecha"] = new clsSQLParameter("ctrlfecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("dd", "/", "mm", "/", "yyyy"), $this->fecha->GetValue(true), 01/01/1960, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["saldofinal"]->GetValue()) and !strlen($this->cp["saldofinal"]->GetText()) and !is_bool($this->cp["saldofinal"]->GetValue())) 
            $this->cp["saldofinal"]->SetValue($this->saldofinal->GetValue(true));
        if (!strlen($this->cp["saldofinal"]->GetText()) and !is_bool($this->cp["saldofinal"]->GetValue(true))) 
            $this->cp["saldofinal"]->SetText(0);
        if (!is_null($this->cp["saldofinaldolar"]->GetValue()) and !strlen($this->cp["saldofinaldolar"]->GetText()) and !is_bool($this->cp["saldofinaldolar"]->GetValue())) 
            $this->cp["saldofinaldolar"]->SetValue($this->saldofinaldolar->GetValue(true));
        if (!strlen($this->cp["saldofinaldolar"]->GetText()) and !is_bool($this->cp["saldofinaldolar"]->GetValue(true))) 
            $this->cp["saldofinaldolar"]->SetText(0);
        if (!is_null($this->cp["fecha"]->GetValue()) and !strlen($this->cp["fecha"]->GetText()) and !is_bool($this->cp["fecha"]->GetValue())) 
            $this->cp["fecha"]->SetValue($this->fecha->GetValue(true));
        if (!strlen($this->cp["fecha"]->GetText()) and !is_bool($this->cp["fecha"]->GetValue(true))) 
            $this->cp["fecha"]->SetText(01/01/1960);
        $this->SQL = "update cajaresumen\n" .
        "set saldofinal = " . $this->SQLValue($this->cp["saldofinal"]->GetDBValue(), ccsInteger) . ",\n" .
        "saldofinaldolar = " . $this->SQLValue($this->cp["saldofinaldolar"]->GetDBValue(), ccsInteger) . "\n" .
        "where convert(varchar,fecha,103)= convert(varchar,'" . $this->SQLValue($this->cp["fecha"]->GetDBValue(), ccsDate) . "',103)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End cajaresumenDataSource Class @3-FCB6E20C

class clsRecordcajaresumen1 { //cajaresumen1 Class @28-0A3190B5

//Variables @28-D6FF3E86

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

//Class_Initialize Event @28-CBA26072
    function clsRecordcajaresumen1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record cajaresumen1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "cajaresumen1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_fecha = & new clsControl(ccsTextBox, "s_fecha", "s_fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_fecha", $Method, NULL), $this);
            $this->DatePicker_s_fecha = & new clsDatePicker("DatePicker_s_fecha", "cajaresumen1", "s_fecha", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @28-88FF839D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_fecha->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_fecha->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @28-2FF60E2A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_fecha->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_fecha->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @28-ED598703
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

//Operation Method @28-9BBF0E83
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
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "cierrecaja.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "cierrecaja.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @28-FFC40447
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_fecha->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_fecha->Show();
        $this->DatePicker_s_fecha->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End cajaresumen1 Class @28-FCB6E20C

//Initialize Page @1-15D91480
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
$TemplateFileName = "cierrecaja.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4141F1D6
include_once("./cierrecaja_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-64B5CB4A
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Headercaja = & new clsHeader("", "Headercaja", $MainPage);
$Headercaja->Initialize();
$cajaresumen = & new clsRecordcajaresumen("", $MainPage);
$cajaresumen1 = & new clsRecordcajaresumen1("", $MainPage);
$MainPage->Headercaja = & $Headercaja;
$MainPage->cajaresumen = & $cajaresumen;
$MainPage->cajaresumen1 = & $cajaresumen1;
$cajaresumen->Initialize();

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

//Execute Components @1-44BC0C73
$Headercaja->Operations();
$cajaresumen->Operation();
$cajaresumen1->Operation();
//End Execute Components

//Go to destination page @1-457FB27B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Headercaja->Class_Terminate();
    unset($Headercaja);
    unset($cajaresumen);
    unset($cajaresumen1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F72EE6C2
$Headercaja->Show();
$cajaresumen->Show();
$cajaresumen1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8A56E3BD
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Headercaja->Class_Terminate();
unset($Headercaja);
unset($cajaresumen);
unset($cajaresumen1);
unset($Tpl);
//End Unload Page


?>
