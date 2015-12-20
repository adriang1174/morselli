<?php
//Include Common Files @1-7E0FBD21
define("RelativePath", "..");
define("PathToCurrentPage", "/caja/");
define("FileName", "egresocaja.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-9E1FD136
include_once(RelativePath . "/caja/Headercaja.php");
//End Include Page implementation

class clsRecordmovimientoscaja { //movimientoscaja Class @3-4C87C187

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

//Class_Initialize Event @3-442E7963
    function clsRecordmovimientoscaja($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record movimientoscaja/Error";
        $this->DataSource = new clsmovimientoscajaDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "movimientoscaja";
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
            $this->idmoneda = & new clsControl(ccsListBox, "idmoneda", "Idmoneda", ccsInteger, "", CCGetRequestParam("idmoneda", $Method, NULL), $this);
            $this->idmoneda->DSType = dsTable;
            $this->idmoneda->DataSource = new clsDBConnection1();
            $this->idmoneda->ds = & $this->idmoneda->DataSource;
            $this->idmoneda->DataSource->SQL = "SELECT * \n" .
"FROM Monedas {SQL_Where} {SQL_OrderBy}";
            list($this->idmoneda->BoundColumn, $this->idmoneda->TextColumn, $this->idmoneda->DBFormat) = array("idmoneda", "descripcion", "");
            $this->idmoneda->Required = true;
            $this->idcodgasto = & new clsControl(ccsListBox, "idcodgasto", "Idcodgasto", ccsInteger, "", CCGetRequestParam("idcodgasto", $Method, NULL), $this);
            $this->idcodgasto->DSType = dsTable;
            $this->idcodgasto->DataSource = new clsDBConnection1();
            $this->idcodgasto->ds = & $this->idcodgasto->DataSource;
            $this->idcodgasto->DataSource->SQL = "SELECT * \n" .
"FROM codigosgastos {SQL_Where} {SQL_OrderBy}";
            list($this->idcodgasto->BoundColumn, $this->idcodgasto->TextColumn, $this->idcodgasto->DBFormat) = array("idcodgasto", "descripcion", "");
            $this->idcodgasto->Required = true;
            $this->numero = & new clsControl(ccsTextBox, "numero", "Numero", ccsText, "", CCGetRequestParam("numero", $Method, NULL), $this);
            $this->importe = & new clsControl(ccsTextBox, "importe", "Importe", ccsFloat, "", CCGetRequestParam("importe", $Method, NULL), $this);
            $this->importe->Required = true;
            $this->fecha = & new clsControl(ccsTextBox, "fecha", "Fecha", ccsText, "", CCGetRequestParam("fecha", $Method, NULL), $this);
            $this->DatePicker_fecha = & new clsDatePicker("DatePicker_fecha", "movimientoscaja", "fecha", $this);
            $this->tipomovimiento = & new clsControl(ccsHidden, "tipomovimiento", "Tipomovimiento", ccsText, "", CCGetRequestParam("tipomovimiento", $Method, NULL), $this);
            $this->tipomovimiento->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @3-54B8809E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidmovimiento"] = CCGetFromGet("idmovimiento", NULL);
    }
//End Initialize Method

//Validate Method @3-D2FCC517
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idmoneda->Validate() && $Validation);
        $Validation = ($this->idcodgasto->Validate() && $Validation);
        $Validation = ($this->numero->Validate() && $Validation);
        $Validation = ($this->importe->Validate() && $Validation);
        $Validation = ($this->fecha->Validate() && $Validation);
        $Validation = ($this->tipomovimiento->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idmoneda->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idcodgasto->Errors->Count() == 0);
        $Validation =  $Validation && ($this->numero->Errors->Count() == 0);
        $Validation =  $Validation && ($this->importe->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipomovimiento->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-13F5CD47
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idmoneda->Errors->Count());
        $errors = ($errors || $this->idcodgasto->Errors->Count());
        $errors = ($errors || $this->numero->Errors->Count());
        $errors = ($errors || $this->importe->Errors->Count());
        $errors = ($errors || $this->fecha->Errors->Count());
        $errors = ($errors || $this->DatePicker_fecha->Errors->Count());
        $errors = ($errors || $this->tipomovimiento->Errors->Count());
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

//Operation Method @3-1F5214FF
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
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "idmovimiento"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @3-FDA73DDC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idmoneda->SetValue($this->idmoneda->GetValue(true));
        $this->DataSource->idcodgasto->SetValue($this->idcodgasto->GetValue(true));
        $this->DataSource->numero->SetValue($this->numero->GetValue(true));
        $this->DataSource->importe->SetValue($this->importe->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->tipomovimiento->SetValue($this->tipomovimiento->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @3-8970D78F
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idmoneda->SetValue($this->idmoneda->GetValue(true));
        $this->DataSource->idcodgasto->SetValue($this->idcodgasto->GetValue(true));
        $this->DataSource->numero->SetValue($this->numero->GetValue(true));
        $this->DataSource->importe->SetValue($this->importe->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->tipomovimiento->SetValue($this->tipomovimiento->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @3-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @3-2E0C875A
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

        $this->idmoneda->Prepare();
        $this->idcodgasto->Prepare();

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
                    $this->idmoneda->SetValue($this->DataSource->idmoneda->GetValue());
                    $this->idcodgasto->SetValue($this->DataSource->idcodgasto->GetValue());
                    $this->numero->SetValue($this->DataSource->numero->GetValue());
                    $this->importe->SetValue($this->DataSource->importe->GetValue());
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->tipomovimiento->SetValue($this->DataSource->tipomovimiento->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->idmoneda->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idcodgasto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->numero->Errors->ToString());
            $Error = ComposeStrings($Error, $this->importe->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipomovimiento->Errors->ToString());
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
        $this->idmoneda->Show();
        $this->idcodgasto->Show();
        $this->numero->Show();
        $this->importe->Show();
        $this->fecha->Show();
        $this->DatePicker_fecha->Show();
        $this->tipomovimiento->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End movimientoscaja Class @3-FCB6E20C

class clsmovimientoscajaDataSource extends clsDBConnection1 {  //movimientoscajaDataSource Class @3-8233EBE7

//DataSource Variables @3-CB60A7C2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $idmoneda;
    var $idcodgasto;
    var $numero;
    var $importe;
    var $fecha;
    var $tipomovimiento;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-B4CEC8CC
    function clsmovimientoscajaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record movimientoscaja/Error";
        $this->Initialize();
        $this->idmoneda = new clsField("idmoneda", ccsInteger, "");
        
        $this->idcodgasto = new clsField("idcodgasto", ccsInteger, "");
        
        $this->numero = new clsField("numero", ccsText, "");
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->fecha = new clsField("fecha", ccsText, "");
        
        $this->tipomovimiento = new clsField("tipomovimiento", ccsText, "");
        

        $this->InsertFields["idmoneda"] = array("Name" => "idmoneda", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idcodgasto"] = array("Name" => "idcodgasto", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["numero"] = array("Name" => "numero", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["importe"] = array("Name" => "importe", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tipomovimiento"] = array("Name" => "tipomovimiento", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idmoneda"] = array("Name" => "idmoneda", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idcodgasto"] = array("Name" => "idcodgasto", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["numero"] = array("Name" => "numero", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["importe"] = array("Name" => "importe", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipomovimiento"] = array("Name" => "tipomovimiento", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-CEC3E071
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidmovimiento", ccsInteger, "", "", $this->Parameters["urlidmovimiento"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idmovimiento", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @3-D16DD54D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM movimientoscaja {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-AC222B87
    function SetValues()
    {
        $this->idmoneda->SetDBValue(trim($this->f("idmoneda")));
        $this->idcodgasto->SetDBValue(trim($this->f("idcodgasto")));
        $this->numero->SetDBValue($this->f("numero"));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->fecha->SetDBValue($this->f("fecha"));
        $this->tipomovimiento->SetDBValue($this->f("tipomovimiento"));
    }
//End SetValues Method

//Insert Method @3-370EC66C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["idmoneda"]["Value"] = $this->idmoneda->GetDBValue(true);
        $this->InsertFields["idcodgasto"]["Value"] = $this->idcodgasto->GetDBValue(true);
        $this->InsertFields["numero"]["Value"] = $this->numero->GetDBValue(true);
        $this->InsertFields["importe"]["Value"] = $this->importe->GetDBValue(true);
        $this->InsertFields["fecha"]["Value"] = $this->fecha->GetDBValue(true);
        $this->InsertFields["tipomovimiento"]["Value"] = $this->tipomovimiento->GetDBValue(true);
        $this->SQL = CCBuildInsert("movimientoscaja", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @3-04B38042
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["idmoneda"]["Value"] = $this->idmoneda->GetDBValue(true);
        $this->UpdateFields["idcodgasto"]["Value"] = $this->idcodgasto->GetDBValue(true);
        $this->UpdateFields["numero"]["Value"] = $this->numero->GetDBValue(true);
        $this->UpdateFields["importe"]["Value"] = $this->importe->GetDBValue(true);
        $this->UpdateFields["fecha"]["Value"] = $this->fecha->GetDBValue(true);
        $this->UpdateFields["tipomovimiento"]["Value"] = $this->tipomovimiento->GetDBValue(true);
        $this->SQL = CCBuildUpdate("movimientoscaja", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @3-FF1759CA
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM movimientoscaja";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End movimientoscajaDataSource Class @3-FCB6E20C

class clsGridmovimientoscaja1 { //movimientoscaja1 class @20-42C0179A

//Variables @20-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @20-6D903427
    function clsGridmovimientoscaja1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "movimientoscaja1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid movimientoscaja1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmovimientoscaja1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->idmovimiento = & new clsControl(ccsLink, "idmovimiento", "idmovimiento", ccsInteger, "", CCGetRequestParam("idmovimiento", ccsGet, NULL), $this);
        $this->idmovimiento->Page = "egresocaja.php";
        $this->fecha = & new clsControl(ccsLabel, "fecha", "fecha", ccsText, "", CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->numero = & new clsControl(ccsLabel, "numero", "numero", ccsText, "", CCGetRequestParam("numero", ccsGet, NULL), $this);
        $this->idmoneda = & new clsControl(ccsLabel, "idmoneda", "idmoneda", ccsText, "", CCGetRequestParam("idmoneda", ccsGet, NULL), $this);
        $this->idcodgasto = & new clsControl(ccsHidden, "idcodgasto", "idcodgasto", ccsInteger, "", CCGetRequestParam("idcodgasto", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsHidden, "importe", "importe", ccsFloat, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->importec = & new clsControl(ccsLabel, "importec", "importec", ccsText, "", CCGetRequestParam("importec", ccsGet, NULL), $this);
        $this->imported = & new clsControl(ccsLabel, "imported", "imported", ccsText, "", CCGetRequestParam("imported", ccsGet, NULL), $this);
        $this->tipomovimiento = & new clsControl(ccsHidden, "tipomovimiento", "tipomovimiento", ccsText, "", CCGetRequestParam("tipomovimiento", ccsGet, NULL), $this);
        $this->descripcion = & new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->idcuota = & new clsControl(ccsHidden, "idcuota", "idcuota", ccsInteger, "", CCGetRequestParam("idcuota", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->dia = & new clsControl(ccsLabel, "dia", "dia", ccsText, "", CCGetRequestParam("dia", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @20-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @20-2FC8EC32
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlfecha"] = CCGetFromGet("fecha", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["idmovimiento"] = $this->idmovimiento->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["numero"] = $this->numero->Visible;
            $this->ControlsVisible["idmoneda"] = $this->idmoneda->Visible;
            $this->ControlsVisible["idcodgasto"] = $this->idcodgasto->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["importec"] = $this->importec->Visible;
            $this->ControlsVisible["imported"] = $this->imported->Visible;
            $this->ControlsVisible["tipomovimiento"] = $this->tipomovimiento->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["idcuota"] = $this->idcuota->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idmovimiento->SetValue($this->DataSource->idmovimiento->GetValue());
                $this->idmovimiento->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idmovimiento->Parameters = CCAddParam($this->idmovimiento->Parameters, "idmovimiento", $this->DataSource->f("idmovimiento"));
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->numero->SetValue($this->DataSource->numero->GetValue());
                $this->idmoneda->SetValue($this->DataSource->idmoneda->GetValue());
                $this->idcodgasto->SetValue($this->DataSource->idcodgasto->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->importec->SetValue($this->DataSource->importec->GetValue());
                $this->imported->SetValue($this->DataSource->imported->GetValue());
                $this->tipomovimiento->SetValue($this->DataSource->tipomovimiento->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->idcuota->SetValue($this->DataSource->idcuota->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idmovimiento->Show();
                $this->fecha->Show();
                $this->numero->Show();
                $this->idmoneda->Show();
                $this->idcodgasto->Show();
                $this->importe->Show();
                $this->importec->Show();
                $this->imported->Show();
                $this->tipomovimiento->Show();
                $this->descripcion->Show();
                $this->idcuota->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $this->dia->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @20-51A9E256
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idmovimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numero->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idmoneda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcodgasto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importec->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imported->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipomovimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End movimientoscaja1 Class @20-FCB6E20C

class clsmovimientoscaja1DataSource extends clsDBConnection1 {  //movimientoscaja1DataSource Class @20-C3AE3DE7

//DataSource Variables @20-9790DB18
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idmovimiento;
    var $fecha;
    var $numero;
    var $idmoneda;
    var $idcodgasto;
    var $importe;
    var $importec;
    var $imported;
    var $tipomovimiento;
    var $descripcion;
    var $idcuota;
//End DataSource Variables

//DataSourceClass_Initialize Event @20-E7E7099B
    function clsmovimientoscaja1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid movimientoscaja1";
        $this->Initialize();
        $this->idmovimiento = new clsField("idmovimiento", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsText, "");
        
        $this->numero = new clsField("numero", ccsText, "");
        
        $this->idmoneda = new clsField("idmoneda", ccsText, "");
        
        $this->idcodgasto = new clsField("idcodgasto", ccsInteger, "");
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->importec = new clsField("importec", ccsText, "");
        
        $this->imported = new clsField("imported", ccsText, "");
        
        $this->tipomovimiento = new clsField("tipomovimiento", ccsText, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->idcuota = new clsField("idcuota", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @20-7177D94D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "fecha";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @20-BA42F3CD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlfecha", ccsText, "", "", $this->Parameters["urlfecha"], "", false);
    }
//End Prepare Method

//Open Method @20-7911B2E8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT idmovimiento,m.idmoneda,mo.simbolo,c.idcuota,c.idhipoteca,c.idalquiler,m.idcodgasto,tipomovimiento,fecha,numero,m.importe,\n" .
        "case when c.idcuota is not null then\n" .
        "		t.descripcion\n" .
        "else\n" .
        "		--case when tipomovimiento = 'C' then\n" .
        "		--	'Ingreso manual'\n" .
        "		--     when tipomovimiento = 'D' then\n" .
        "		--	'Egreso manual'\n" .
        "		--end \n" .
        "	g.descripcion		\n" .
        "end as descripcion,\n" .
        "case when tipomovimiento = 'C' then\n" .
        "		m.importe\n" .
        "else\n" .
        "		null\n" .
        "end as importec,\n" .
        "case when tipomovimiento = 'D' then\n" .
        "		m.importe\n" .
        "else\n" .
        "		null\n" .
        "end as imported\n" .
        "FROM movimientoscaja m left join\n" .
        "cuotas c on(m.idcuota = c.idcuota)\n" .
        "left join tipocuota t on(c.idtipocuota = t.idtipocuota)\n" .
        "left join codigosgastos g on(g.idcodgasto = m.idcodgasto)\n" .
        "left join monedas mo on(mo.idmoneda = m.idmoneda)\n" .
        "WHERE fecha >= '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' and fecha < dateadd(d,1,'" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "')) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} idmovimiento,m.idmoneda,mo.simbolo,c.idcuota,c.idhipoteca,c.idalquiler,m.idcodgasto,tipomovimiento,fecha,numero,m.importe,\n" .
        "case when c.idcuota is not null then\n" .
        "		t.descripcion\n" .
        "else\n" .
        "		--case when tipomovimiento = 'C' then\n" .
        "		--	'Ingreso manual'\n" .
        "		--     when tipomovimiento = 'D' then\n" .
        "		--	'Egreso manual'\n" .
        "		--end \n" .
        "	g.descripcion		\n" .
        "end as descripcion,\n" .
        "case when tipomovimiento = 'C' then\n" .
        "		m.importe\n" .
        "else\n" .
        "		null\n" .
        "end as importec,\n" .
        "case when tipomovimiento = 'D' then\n" .
        "		m.importe\n" .
        "else\n" .
        "		null\n" .
        "end as imported\n" .
        "FROM movimientoscaja m left join\n" .
        "cuotas c on(m.idcuota = c.idcuota)\n" .
        "left join tipocuota t on(c.idtipocuota = t.idtipocuota)\n" .
        "left join codigosgastos g on(g.idcodgasto = m.idcodgasto)\n" .
        "left join monedas mo on(mo.idmoneda = m.idmoneda)\n" .
        "WHERE fecha >= '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' and fecha < dateadd(d,1,'" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "') {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @20-42691327
    function SetValues()
    {
        $this->idmovimiento->SetDBValue(trim($this->f("idmovimiento")));
        $this->fecha->SetDBValue($this->f("fecha"));
        $this->numero->SetDBValue($this->f("numero"));
        $this->idmoneda->SetDBValue($this->f("simbolo"));
        $this->idcodgasto->SetDBValue(trim($this->f("idcodgasto")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->importec->SetDBValue($this->f("importec"));
        $this->imported->SetDBValue($this->f("imported"));
        $this->tipomovimiento->SetDBValue($this->f("tipomovimiento"));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->idcuota->SetDBValue(trim($this->f("idcuota")));
    }
//End SetValues Method

} //End movimientoscaja1DataSource Class @20-FCB6E20C

class clsRecordbuscafecha { //buscafecha Class @36-DD78086D

//Variables @36-D6FF3E86

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

//Class_Initialize Event @36-05EB2195
    function clsRecordbuscafecha($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record buscafecha/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "buscafecha";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->fecha = & new clsControl(ccsTextBox, "fecha", "fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha", $Method, NULL), $this);
            $this->DatePicker_s_fecha = & new clsDatePicker("DatePicker_s_fecha", "buscafecha", "fecha", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @36-29629424
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->fecha->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->fecha->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @36-66A0BE7E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->fecha->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_fecha->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @36-ED598703
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

//Operation Method @36-D1772401
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
        $Redirect = "egresocaja.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "egresocaja.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @36-27A793D5
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
            $Error = ComposeStrings($Error, $this->fecha->Errors->ToString());
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
        $this->fecha->Show();
        $this->DatePicker_s_fecha->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End buscafecha Class @36-FCB6E20C

class clsGridnupcias { //nupcias class @48-93C6FD61

//Variables @48-971B9B12

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
    var $Sorter_idnupcias;
    var $Sorter_desnupcias;
//End Variables

//Class_Initialize Event @48-7163B6B6
    function clsGridnupcias($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "nupcias";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid nupcias";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsnupciasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("nupciasOrder", "");
        $this->SorterDirection = CCGetParam("nupciasDir", "");

        $this->idnupcias = & new clsControl(ccsLink, "idnupcias", "idnupcias", ccsText, "", CCGetRequestParam("idnupcias", ccsGet, NULL), $this);
        $this->idnupcias->Page = "egresocaja.php";
        $this->desnupcias = & new clsControl(ccsLabel, "desnupcias", "desnupcias", ccsText, "", CCGetRequestParam("desnupcias", ccsGet, NULL), $this);
        $this->nupcias_Insert = & new clsControl(ccsLink, "nupcias_Insert", "nupcias_Insert", ccsText, "", CCGetRequestParam("nupcias_Insert", ccsGet, NULL), $this);
        $this->nupcias_Insert->Parameters = CCGetQueryString("QueryString", array("idnupcias", "ccsForm"));
        $this->nupcias_Insert->Page = "egresocaja.php";
        $this->Sorter_idnupcias = & new clsSorter($this->ComponentName, "Sorter_idnupcias", $FileName, $this);
        $this->Sorter_desnupcias = & new clsSorter($this->ComponentName, "Sorter_desnupcias", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @48-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @48-5A0EFC76
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["idnupcias"] = $this->idnupcias->Visible;
            $this->ControlsVisible["desnupcias"] = $this->desnupcias->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idnupcias->SetValue($this->DataSource->idnupcias->GetValue());
                $this->idnupcias->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idnupcias->Parameters = CCAddParam($this->idnupcias->Parameters, "idnupcias", $this->DataSource->f("idnupcias"));
                $this->desnupcias->SetValue($this->DataSource->desnupcias->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idnupcias->Show();
                $this->desnupcias->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->nupcias_Insert->Show();
        $this->Sorter_idnupcias->Show();
        $this->Sorter_desnupcias->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @48-5444F8A9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idnupcias->Errors->ToString());
        $errors = ComposeStrings($errors, $this->desnupcias->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End nupcias Class @48-FCB6E20C

class clsnupciasDataSource extends clsDBConnection1 {  //nupciasDataSource Class @48-E4408F13

//DataSource Variables @48-8F93328B
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idnupcias;
    var $desnupcias;
//End DataSource Variables

//DataSourceClass_Initialize Event @48-928E1D36
    function clsnupciasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid nupcias";
        $this->Initialize();
        $this->idnupcias = new clsField("idnupcias", ccsText, "");
        
        $this->desnupcias = new clsField("desnupcias", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @48-7561FDC4
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idnupcias" => array("idnupcias", ""), 
            "Sorter_desnupcias" => array("desnupcias", "")));
    }
//End SetOrder Method

//Prepare Method @48-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @48-67E47D16
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM nupcias";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} idnupcias, desnupcias \n\n" .
        "FROM nupcias {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @48-32EDCBD4
    function SetValues()
    {
        $this->idnupcias->SetDBValue($this->f("idnupcias"));
        $this->desnupcias->SetDBValue($this->f("desnupcias"));
    }
//End SetValues Method

} //End nupciasDataSource Class @48-FCB6E20C

class clsRecordnupcias1 { //nupcias1 Class @57-1507D1F7

//Variables @57-D6FF3E86

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

//Class_Initialize Event @57-522D0A62
    function clsRecordnupcias1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record nupcias1/Error";
        $this->DataSource = new clsnupcias1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "nupcias1";
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
            $this->idnupcias = & new clsControl(ccsTextBox, "idnupcias", $CCSLocales->GetText("idnupcias"), ccsText, "", CCGetRequestParam("idnupcias", $Method, NULL), $this);
            $this->idnupcias->Required = true;
            $this->desnupcias = & new clsControl(ccsTextBox, "desnupcias", $CCSLocales->GetText("desnupcias"), ccsText, "", CCGetRequestParam("desnupcias", $Method, NULL), $this);
            $this->desnupcias->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @57-63A4C814
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidnupcias"] = CCGetFromGet("idnupcias", NULL);
    }
//End Initialize Method

//Validate Method @57-0A467984
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idnupcias->Validate() && $Validation);
        $Validation = ($this->desnupcias->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idnupcias->Errors->Count() == 0);
        $Validation =  $Validation && ($this->desnupcias->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @57-4F919211
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idnupcias->Errors->Count());
        $errors = ($errors || $this->desnupcias->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @57-ED598703
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

//Operation Method @57-B908BA44
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
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @57-044EDF7D
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idnupcias->SetValue($this->idnupcias->GetValue(true));
        $this->DataSource->desnupcias->SetValue($this->desnupcias->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @57-BE74C87D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idnupcias->SetValue($this->idnupcias->GetValue(true));
        $this->DataSource->desnupcias->SetValue($this->desnupcias->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @57-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @57-2488E205
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
                    $this->idnupcias->SetValue($this->DataSource->idnupcias->GetValue());
                    $this->desnupcias->SetValue($this->DataSource->desnupcias->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->idnupcias->Errors->ToString());
            $Error = ComposeStrings($Error, $this->desnupcias->Errors->ToString());
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
        $this->idnupcias->Show();
        $this->desnupcias->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End nupcias1 Class @57-FCB6E20C

class clsnupcias1DataSource extends clsDBConnection1 {  //nupcias1DataSource Class @57-79187886

//DataSource Variables @57-7E55A41F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $idnupcias;
    var $desnupcias;
//End DataSource Variables

//DataSourceClass_Initialize Event @57-CCB0745F
    function clsnupcias1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record nupcias1/Error";
        $this->Initialize();
        $this->idnupcias = new clsField("idnupcias", ccsText, "");
        
        $this->desnupcias = new clsField("desnupcias", ccsText, "");
        

        $this->InsertFields["idnupcias"] = array("Name" => "idnupcias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["desnupcias"] = array("Name" => "desnupcias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idnupcias"] = array("Name" => "idnupcias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["desnupcias"] = array("Name" => "desnupcias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @57-FBA77944
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidnupcias", ccsText, "", "", $this->Parameters["urlidnupcias"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idnupcias", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @57-55617727
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM nupcias {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @57-32EDCBD4
    function SetValues()
    {
        $this->idnupcias->SetDBValue($this->f("idnupcias"));
        $this->desnupcias->SetDBValue($this->f("desnupcias"));
    }
//End SetValues Method

//Insert Method @57-6E407FD6
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["idnupcias"]["Value"] = $this->idnupcias->GetDBValue(true);
        $this->InsertFields["desnupcias"]["Value"] = $this->desnupcias->GetDBValue(true);
        $this->SQL = CCBuildInsert("nupcias", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @57-1FE350C4
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["idnupcias"]["Value"] = $this->idnupcias->GetDBValue(true);
        $this->UpdateFields["desnupcias"]["Value"] = $this->desnupcias->GetDBValue(true);
        $this->SQL = CCBuildUpdate("nupcias", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @57-909F5263
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM nupcias";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End nupcias1DataSource Class @57-FCB6E20C

//Initialize Page @1-D993E956
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
$TemplateFileName = "egresocaja.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-EA50525D
include_once("./egresocaja_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6BFF56A4
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Headercaja = & new clsHeadercaja("", "Headercaja", $MainPage);
$Headercaja->Initialize();
$movimientoscaja = & new clsRecordmovimientoscaja("", $MainPage);
$movimientoscaja1 = & new clsGridmovimientoscaja1("", $MainPage);
$buscafecha = & new clsRecordbuscafecha("", $MainPage);
$nupcias = & new clsGridnupcias("", $MainPage);
$nupcias1 = & new clsRecordnupcias1("", $MainPage);
$MainPage->Headercaja = & $Headercaja;
$MainPage->movimientoscaja = & $movimientoscaja;
$MainPage->movimientoscaja1 = & $movimientoscaja1;
$MainPage->buscafecha = & $buscafecha;
$MainPage->nupcias = & $nupcias;
$MainPage->nupcias1 = & $nupcias1;
$movimientoscaja->Initialize();
$movimientoscaja1->Initialize();
$nupcias->Initialize();
$nupcias1->Initialize();

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

//Execute Components @1-AA1059F2
$Headercaja->Operations();
$movimientoscaja->Operation();
$buscafecha->Operation();
$nupcias1->Operation();
//End Execute Components

//Go to destination page @1-18015FE2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Headercaja->Class_Terminate();
    unset($Headercaja);
    unset($movimientoscaja);
    unset($movimientoscaja1);
    unset($buscafecha);
    unset($nupcias);
    unset($nupcias1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B87627E1
$Headercaja->Show();
$movimientoscaja->Show();
$movimientoscaja1->Show();
$buscafecha->Show();
$nupcias->Show();
$nupcias1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C48D1FED
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Headercaja->Class_Terminate();
unset($Headercaja);
unset($movimientoscaja);
unset($movimientoscaja1);
unset($buscafecha);
unset($nupcias);
unset($nupcias1);
unset($Tpl);
//End Unload Page


?>
