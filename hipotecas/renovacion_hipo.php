<?php
//Include Common Files @1-CAAA724B
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "renovacion_hipo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordhipotecas { //hipotecas Class @3-08E7C8A3

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

//Class_Initialize Event @3-8DCE9072
    function clsRecordhipotecas($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record hipotecas/Error";
        $this->DataSource = new clshipotecasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "hipotecas";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->montohipoteca = & new clsControl(ccsTextBox, "montohipoteca", "Montohipoteca", ccsText, "", CCGetRequestParam("montohipoteca", $Method, NULL), $this);
            $this->fechainicio = & new clsControl(ccsTextBox, "fechainicio", "Fechainicio", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechainicio", $Method, NULL), $this);
            $this->DatePicker_fechainicio = & new clsDatePicker("DatePicker_fechainicio", "hipotecas", "fechainicio", $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->idestado = & new clsControl(ccsHidden, "idestado", "Idestado", ccsInteger, "", CCGetRequestParam("idestado", $Method, NULL), $this);
            $this->idestado->Required = true;
            $this->idpropiedad = & new clsControl(ccsHidden, "idpropiedad", "Idpropiedad", ccsInteger, "", CCGetRequestParam("idpropiedad", $Method, NULL), $this);
            $this->idpropiedad->Required = true;
            $this->data_prop = & new clsControl(ccsLabel, "data_prop", "data_prop", ccsText, "", CCGetRequestParam("data_prop", $Method, NULL), $this);
            $this->data_deudor = & new clsControl(ccsLabel, "data_deudor", "data_deudor", ccsText, "", CCGetRequestParam("data_deudor", $Method, NULL), $this);
            $this->fechafin = & new clsControl(ccsTextBox, "fechafin", "Fechafin", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechafin", $Method, NULL), $this);
            $this->DatePicker_fechafin = & new clsDatePicker("DatePicker_fechafin", "hipotecas", "fechafin", $this);
            $this->ListBox1 = & new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsTable;
            $this->ListBox1->DataSource = new clsDBConnection1();
            $this->ListBox1->ds = & $this->ListBox1->DataSource;
            $this->ListBox1->DataSource->SQL = "SELECT * \n" .
"FROM Monedas {SQL_Where} {SQL_OrderBy}";
            list($this->ListBox1->BoundColumn, $this->ListBox1->TextColumn, $this->ListBox1->DBFormat) = array("idmoneda", "descripcion", "");
            $this->data_hipo = & new clsControl(ccsLabel, "data_hipo", "data_hipo", ccsText, "", CCGetRequestParam("data_hipo", $Method, NULL), $this);
            $this->data_acreedor = & new clsControl(ccsLabel, "data_acreedor", "data_acreedor", ccsText, "", CCGetRequestParam("data_acreedor", $Method, NULL), $this);
            $this->idhipoteca = & new clsControl(ccsTextBox, "idhipoteca", "idhipoteca", ccsText, "", CCGetRequestParam("idhipoteca", $Method, NULL), $this);
            $this->idhipotecaold = & new clsControl(ccsHidden, "idhipotecaold", "idhipotecaold", ccsText, "", CCGetRequestParam("idhipotecaold", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->idestado->Value) && !strlen($this->idestado->Value) && $this->idestado->Value !== false)
                    $this->idestado->SetText(1);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @3-E061926D
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);
    }
//End Initialize Method

//Validate Method @3-CB01DFD2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->montohipoteca->Validate() && $Validation);
        $Validation = ($this->fechainicio->Validate() && $Validation);
        $Validation = ($this->idestado->Validate() && $Validation);
        $Validation = ($this->idpropiedad->Validate() && $Validation);
        $Validation = ($this->fechafin->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->idhipoteca->Validate() && $Validation);
        $Validation = ($this->idhipotecaold->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->montohipoteca->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechainicio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idestado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idpropiedad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechafin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idhipoteca->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idhipotecaold->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-F9AC4816
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->montohipoteca->Errors->Count());
        $errors = ($errors || $this->fechainicio->Errors->Count());
        $errors = ($errors || $this->DatePicker_fechainicio->Errors->Count());
        $errors = ($errors || $this->idestado->Errors->Count());
        $errors = ($errors || $this->idpropiedad->Errors->Count());
        $errors = ($errors || $this->data_prop->Errors->Count());
        $errors = ($errors || $this->data_deudor->Errors->Count());
        $errors = ($errors || $this->fechafin->Errors->Count());
        $errors = ($errors || $this->DatePicker_fechafin->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->data_hipo->Errors->Count());
        $errors = ($errors || $this->data_acreedor->Errors->Count());
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->idhipotecaold->Errors->Count());
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

//Operation Method @3-D20585AC
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
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = "renovacion_hipo.php" . "?" . CCGetQueryString("All", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
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

//InsertRow Method @3-6E094DEA
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->montohipoteca->SetValue($this->montohipoteca->GetValue(true));
        $this->DataSource->fechainicio->SetValue($this->fechainicio->GetValue(true));
        $this->DataSource->idestado->SetValue($this->idestado->GetValue(true));
        $this->DataSource->idpropiedad->SetValue($this->idpropiedad->GetValue(true));
        $this->DataSource->data_prop->SetValue($this->data_prop->GetValue(true));
        $this->DataSource->data_deudor->SetValue($this->data_deudor->GetValue(true));
        $this->DataSource->fechafin->SetValue($this->fechafin->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->data_hipo->SetValue($this->data_hipo->GetValue(true));
        $this->DataSource->data_acreedor->SetValue($this->data_acreedor->GetValue(true));
        $this->DataSource->idhipoteca->SetValue($this->idhipoteca->GetValue(true));
        $this->DataSource->idhipotecaold->SetValue($this->idhipotecaold->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @3-3FDC2014
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

        $this->ListBox1->Prepare();

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
                    $this->montohipoteca->SetValue($this->DataSource->montohipoteca->GetValue());
                    $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                    $this->idestado->SetValue($this->DataSource->idestado->GetValue());
                    $this->idpropiedad->SetValue($this->DataSource->idpropiedad->GetValue());
                    $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                    $this->ListBox1->SetValue($this->DataSource->ListBox1->GetValue());
                    $this->idhipoteca->SetValue($this->DataSource->idhipoteca->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->montohipoteca->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fechainicio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fechainicio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idestado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idpropiedad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->data_prop->Errors->ToString());
            $Error = ComposeStrings($Error, $this->data_deudor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fechafin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fechafin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->data_hipo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->data_acreedor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idhipoteca->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idhipotecaold->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        if($this->FormSubmitted || CCGetFromGet("ccsForm")) {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        } else {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("All", ""), "ccsForm", $CCSForm);
        }
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

        $this->montohipoteca->Show();
        $this->fechainicio->Show();
        $this->DatePicker_fechainicio->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->idestado->Show();
        $this->idpropiedad->Show();
        $this->data_prop->Show();
        $this->data_deudor->Show();
        $this->fechafin->Show();
        $this->DatePicker_fechafin->Show();
        $this->ListBox1->Show();
        $this->data_hipo->Show();
        $this->data_acreedor->Show();
        $this->idhipoteca->Show();
        $this->idhipotecaold->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End hipotecas Class @3-FCB6E20C

class clshipotecasDataSource extends clsDBConnection1 {  //hipotecasDataSource Class @3-279D5256

//DataSource Variables @3-E9843E26
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;

    var $InsertFields = array();

    // Datasource fields
    var $montohipoteca;
    var $fechainicio;
    var $idestado;
    var $idpropiedad;
    var $data_prop;
    var $data_deudor;
    var $fechafin;
    var $ListBox1;
    var $data_hipo;
    var $data_acreedor;
    var $idhipoteca;
    var $idhipotecaold;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-B81FFCDE
    function clshipotecasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record hipotecas/Error";
        $this->Initialize();
        $this->montohipoteca = new clsField("montohipoteca", ccsText, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->idestado = new clsField("idestado", ccsInteger, "");
        
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        
        $this->data_prop = new clsField("data_prop", ccsText, "");
        
        $this->data_deudor = new clsField("data_deudor", ccsText, "");
        
        $this->fechafin = new clsField("fechafin", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        
        $this->data_hipo = new clsField("data_hipo", ccsText, "");
        
        $this->data_acreedor = new clsField("data_acreedor", ccsText, "");
        
        $this->idhipoteca = new clsField("idhipoteca", ccsText, "");
        
        $this->idhipotecaold = new clsField("idhipotecaold", ccsText, "");
        

        $this->InsertFields["montohipoteca"] = array("Name" => "montohipoteca", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fechainicio"] = array("Name" => "fechainicio", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["idestado"] = array("Name" => "idestado", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["fechafin"] = array("Name" => "fechafin", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["idmoneda"] = array("Name" => "idmoneda", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["idhipoteca"] = array("Name" => "idhipoteca", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-767034E6
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @3-CE61A2A4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM hipotecas {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-FF1DB82E
    function SetValues()
    {
        $this->montohipoteca->SetDBValue($this->f("montohipoteca"));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->idestado->SetDBValue(trim($this->f("idestado")));
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->ListBox1->SetDBValue($this->f("idmoneda"));
        $this->idhipoteca->SetDBValue($this->f("idhipoteca"));
    }
//End SetValues Method

//Insert Method @3-1C4CFD89
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["montohipoteca"]["Value"] = $this->montohipoteca->GetDBValue(true);
        $this->InsertFields["fechainicio"]["Value"] = $this->fechainicio->GetDBValue(true);
        $this->InsertFields["idestado"]["Value"] = $this->idestado->GetDBValue(true);
        $this->InsertFields["idpropiedad"]["Value"] = $this->idpropiedad->GetDBValue(true);
        $this->InsertFields["fechafin"]["Value"] = $this->fechafin->GetDBValue(true);
        $this->InsertFields["idmoneda"]["Value"] = $this->ListBox1->GetDBValue(true);
        $this->InsertFields["idhipoteca"]["Value"] = $this->idhipoteca->GetDBValue(true);
        $this->SQL = CCBuildInsert("hipotecas", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End hipotecasDataSource Class @3-FCB6E20C

class clsRecordhipotecas1 { //hipotecas1 Class @24-5094F52C

//Variables @24-D6FF3E86

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

//Class_Initialize Event @24-95754910
    function clsRecordhipotecas1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record hipotecas1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "hipotecas1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_idhipoteca = & new clsControl(ccsTextBox, "s_idhipoteca", "s_idhipoteca", ccsInteger, "", CCGetRequestParam("s_idhipoteca", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @24-2B70AAC0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_idhipoteca->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_idhipoteca->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-F5022091
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_idhipoteca->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @24-ED598703
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

//Operation Method @24-C4FDB48D
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
        $Redirect = "renovacion_hipo.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "renovacion_hipo.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @24-9A9A105B
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
            $Error = ComposeStrings($Error, $this->s_idhipoteca->Errors->ToString());
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
        $this->s_idhipoteca->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End hipotecas1 Class @24-FCB6E20C

//Initialize Page @1-8A298D02
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
$TemplateFileName = "renovacion_hipo.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-004A2845
include_once("./renovacion_hipo_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5D366606
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$hipotecas = & new clsRecordhipotecas("", $MainPage);
$hipotecas1 = & new clsRecordhipotecas1("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->hipotecas = & $hipotecas;
$MainPage->hipotecas1 = & $hipotecas1;
$hipotecas->Initialize();

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

//Execute Components @1-A568E944
$Header->Operations();
$hipotecas->Operation();
$hipotecas1->Operation();
//End Execute Components

//Go to destination page @1-03749A96
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($hipotecas);
    unset($hipotecas1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-957F9EA9
$Header->Show();
$hipotecas->Show();
$hipotecas1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3F458588
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($hipotecas);
unset($hipotecas1);
unset($Tpl);
//End Unload Page


?>
