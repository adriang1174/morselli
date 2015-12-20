<?php
//Include Common Files @1-362D1136
define("RelativePath", "..");
define("PathToCurrentPage", "/contrato/");
define("FileName", "contrato.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordalquileres { //alquileres Class @3-01FE6A1F

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

//Class_Initialize Event @3-3878020B
    function clsRecordalquileres($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record alquileres/Error";
        $this->DataSource = new clsalquileresDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "alquileres";
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
            $this->idpropiedad = & new clsControl(ccsHidden, "idpropiedad", "Idpropiedad", ccsInteger, "", CCGetRequestParam("idpropiedad", $Method, NULL), $this);
            $this->idpropiedad->Required = true;
            $this->idestado = & new clsControl(ccsHidden, "idestado", "Idestado", ccsInteger, "", CCGetRequestParam("idestado", $Method, NULL), $this);
            $this->fechainicio = & new clsControl(ccsTextBox, "fechainicio", "Fechainicio", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechainicio", $Method, NULL), $this);
            $this->fechainicio->Required = true;
            $this->porcentajehonorarios = & new clsControl(ccsTextBox, "porcentajehonorarios", "Porcentajehonorarios", ccsText, "", CCGetRequestParam("porcentajehonorarios", $Method, NULL), $this);
            $this->porcentajehonorarios->Required = true;
            $this->acuerdo = & new clsControl(ccsTextBox, "acuerdo", "Acuerdo", ccsText, "", CCGetRequestParam("acuerdo", $Method, NULL), $this);
            $this->data_prop = & new clsControl(ccsLabel, "data_prop", "data_prop", ccsText, "", CCGetRequestParam("data_prop", $Method, NULL), $this);
            $this->DatePicker_fechainicio1 = & new clsDatePicker("DatePicker_fechainicio1", "alquileres", "fechainicio", $this);
            $this->fechafin = & new clsControl(ccsTextBox, "fechafin", "Fechafin", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechafin", $Method, NULL), $this);
            $this->fechafin->Required = true;
            $this->DatePicker_fechafin1 = & new clsDatePicker("DatePicker_fechafin1", "alquileres", "fechafin", $this);
            $this->vto = & new clsControl(ccsListBox, "vto", "Vto", ccsInteger, "", CCGetRequestParam("vto", $Method, NULL), $this);
            $this->vto->DSType = dsTable;
            $this->vto->DataSource = new clsDBConnection1();
            $this->vto->ds = & $this->vto->DataSource;
            $this->vto->DataSource->SQL = "SELECT * \n" .
"FROM vencimientos {SQL_Where} {SQL_OrderBy}";
            list($this->vto->BoundColumn, $this->vto->TextColumn, $this->vto->DBFormat) = array("id", "descripcion", "");
            $this->vto->Required = true;
            $this->idmoneda = & new clsControl(ccsListBox, "idmoneda", "idmoneda", ccsText, "", CCGetRequestParam("idmoneda", $Method, NULL), $this);
            $this->idmoneda->DSType = dsTable;
            $this->idmoneda->DataSource = new clsDBConnection1();
            $this->idmoneda->ds = & $this->idmoneda->DataSource;
            $this->idmoneda->DataSource->SQL = "SELECT * \n" .
"FROM Monedas {SQL_Where} {SQL_OrderBy}";
            list($this->idmoneda->BoundColumn, $this->idmoneda->TextColumn, $this->idmoneda->DBFormat) = array("idmoneda", "descripcion", "");
            $this->idmoneda->Required = true;
            $this->idalquiler = & new clsControl(ccsTextBox, "idalquiler", "idalquiler", ccsInteger, "", CCGetRequestParam("idalquiler", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->idestado->Value) && !strlen($this->idestado->Value) && $this->idestado->Value !== false)
                    $this->idestado->SetText(1);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @3-440B4710
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);
    }
//End Initialize Method

//Validate Method @3-FBE2FCB7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idpropiedad->Validate() && $Validation);
        $Validation = ($this->idestado->Validate() && $Validation);
        $Validation = ($this->fechainicio->Validate() && $Validation);
        $Validation = ($this->porcentajehonorarios->Validate() && $Validation);
        $Validation = ($this->acuerdo->Validate() && $Validation);
        $Validation = ($this->fechafin->Validate() && $Validation);
        $Validation = ($this->vto->Validate() && $Validation);
        $Validation = ($this->idmoneda->Validate() && $Validation);
        $Validation = ($this->idalquiler->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idpropiedad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idestado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechainicio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->porcentajehonorarios->Errors->Count() == 0);
        $Validation =  $Validation && ($this->acuerdo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechafin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vto->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idmoneda->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idalquiler->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-AFB556AF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idpropiedad->Errors->Count());
        $errors = ($errors || $this->idestado->Errors->Count());
        $errors = ($errors || $this->fechainicio->Errors->Count());
        $errors = ($errors || $this->porcentajehonorarios->Errors->Count());
        $errors = ($errors || $this->acuerdo->Errors->Count());
        $errors = ($errors || $this->data_prop->Errors->Count());
        $errors = ($errors || $this->DatePicker_fechainicio1->Errors->Count());
        $errors = ($errors || $this->fechafin->Errors->Count());
        $errors = ($errors || $this->DatePicker_fechafin1->Errors->Count());
        $errors = ($errors || $this->vto->Errors->Count());
        $errors = ($errors || $this->idmoneda->Errors->Count());
        $errors = ($errors || $this->idalquiler->Errors->Count());
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

//Operation Method @3-37F2A9CB
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
        $Redirect = "contrato.php" . "?" . CCGetQueryString("All", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "contrato.php" . "?" . CCGetQueryString("All", array("ccsForm", "porcentajehonorarios", "fechainicio", "fechafin", "acuerdo", "vto", "ano1", "ano2", "ano3", "idalquiler", "idestado"));
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

//InsertRow Method @3-587A1EF3
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idpropiedad->SetValue($this->idpropiedad->GetValue(true));
        $this->DataSource->idestado->SetValue($this->idestado->GetValue(true));
        $this->DataSource->fechainicio->SetValue($this->fechainicio->GetValue(true));
        $this->DataSource->porcentajehonorarios->SetValue($this->porcentajehonorarios->GetValue(true));
        $this->DataSource->acuerdo->SetValue($this->acuerdo->GetValue(true));
        $this->DataSource->data_prop->SetValue($this->data_prop->GetValue(true));
        $this->DataSource->fechafin->SetValue($this->fechafin->GetValue(true));
        $this->DataSource->vto->SetValue($this->vto->GetValue(true));
        $this->DataSource->idmoneda->SetValue($this->idmoneda->GetValue(true));
        $this->DataSource->idalquiler->SetValue($this->idalquiler->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @3-F9E7EB44
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idpropiedad->SetValue($this->idpropiedad->GetValue(true));
        $this->DataSource->idestado->SetValue($this->idestado->GetValue(true));
        $this->DataSource->fechainicio->SetValue($this->fechainicio->GetValue(true));
        $this->DataSource->porcentajehonorarios->SetValue($this->porcentajehonorarios->GetValue(true));
        $this->DataSource->acuerdo->SetValue($this->acuerdo->GetValue(true));
        $this->DataSource->data_prop->SetValue($this->data_prop->GetValue(true));
        $this->DataSource->fechafin->SetValue($this->fechafin->GetValue(true));
        $this->DataSource->vto->SetValue($this->vto->GetValue(true));
        $this->DataSource->idmoneda->SetValue($this->idmoneda->GetValue(true));
        $this->DataSource->idalquiler->SetValue($this->idalquiler->GetValue(true));
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

//Show Method @3-EC5E70AC
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

        $this->vto->Prepare();
        $this->idmoneda->Prepare();

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
                    $this->idpropiedad->SetValue($this->DataSource->idpropiedad->GetValue());
                    $this->idestado->SetValue($this->DataSource->idestado->GetValue());
                    $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                    $this->porcentajehonorarios->SetValue($this->DataSource->porcentajehonorarios->GetValue());
                    $this->acuerdo->SetValue($this->DataSource->acuerdo->GetValue());
                    $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                    $this->vto->SetValue($this->DataSource->vto->GetValue());
                    $this->idmoneda->SetValue($this->DataSource->idmoneda->GetValue());
                    $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->idpropiedad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idestado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fechainicio->Errors->ToString());
            $Error = ComposeStrings($Error, $this->porcentajehonorarios->Errors->ToString());
            $Error = ComposeStrings($Error, $this->acuerdo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->data_prop->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fechainicio1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fechafin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fechafin1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idmoneda->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idalquiler->Errors->ToString());
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

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->idpropiedad->Show();
        $this->idestado->Show();
        $this->fechainicio->Show();
        $this->porcentajehonorarios->Show();
        $this->acuerdo->Show();
        $this->data_prop->Show();
        $this->DatePicker_fechainicio1->Show();
        $this->fechafin->Show();
        $this->DatePicker_fechafin1->Show();
        $this->vto->Show();
        $this->idmoneda->Show();
        $this->idalquiler->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End alquileres Class @3-FCB6E20C

class clsalquileresDataSource extends clsDBConnection1 {  //alquileresDataSource Class @3-0F6C066C

//DataSource Variables @3-29264F79
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
    var $idpropiedad;
    var $idestado;
    var $fechainicio;
    var $porcentajehonorarios;
    var $acuerdo;
    var $data_prop;
    var $fechafin;
    var $vto;
    var $idmoneda;
    var $idalquiler;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-87A4C015
    function clsalquileresDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record alquileres/Error";
        $this->Initialize();
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        
        $this->idestado = new clsField("idestado", ccsInteger, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->porcentajehonorarios = new clsField("porcentajehonorarios", ccsText, "");
        
        $this->acuerdo = new clsField("acuerdo", ccsText, "");
        
        $this->data_prop = new clsField("data_prop", ccsText, "");
        
        $this->fechafin = new clsField("fechafin", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->vto = new clsField("vto", ccsInteger, "");
        
        $this->idmoneda = new clsField("idmoneda", ccsText, "");
        
        $this->idalquiler = new clsField("idalquiler", ccsInteger, "");
        

        $this->InsertFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idestado"] = array("Name" => "idestado", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["fechainicio"] = array("Name" => "fechainicio", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["porcentajehonorarios"] = array("Name" => "porcentajehonorarios", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["acuerdo"] = array("Name" => "acuerdo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fechafin"] = array("Name" => "fechafin", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["vto"] = array("Name" => "vto", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idmoneda"] = array("Name" => "idmoneda", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["idalquiler"] = array("Name" => "idalquiler", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idestado"] = array("Name" => "idestado", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechainicio"] = array("Name" => "fechainicio", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["porcentajehonorarios"] = array("Name" => "porcentajehonorarios", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["acuerdo"] = array("Name" => "acuerdo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechafin"] = array("Name" => "fechafin", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["vto"] = array("Name" => "vto", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idmoneda"] = array("Name" => "idmoneda", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idalquiler"] = array("Name" => "idalquiler", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-EC01CAA7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idalquiler", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @3-F8411C44
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM alquileres {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-45064CB1
    function SetValues()
    {
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
        $this->idestado->SetDBValue(trim($this->f("idestado")));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->porcentajehonorarios->SetDBValue($this->f("porcentajehonorarios"));
        $this->acuerdo->SetDBValue($this->f("acuerdo"));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->vto->SetDBValue(trim($this->f("vto")));
        $this->idmoneda->SetDBValue($this->f("idmoneda"));
        $this->idalquiler->SetDBValue(trim($this->f("idalquiler")));
    }
//End SetValues Method

//Insert Method @3-79C86E78
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["idpropiedad"]["Value"] = $this->idpropiedad->GetDBValue(true);
        $this->InsertFields["idestado"]["Value"] = $this->idestado->GetDBValue(true);
        $this->InsertFields["fechainicio"]["Value"] = $this->fechainicio->GetDBValue(true);
        $this->InsertFields["porcentajehonorarios"]["Value"] = $this->porcentajehonorarios->GetDBValue(true);
        $this->InsertFields["acuerdo"]["Value"] = $this->acuerdo->GetDBValue(true);
        $this->InsertFields["fechafin"]["Value"] = $this->fechafin->GetDBValue(true);
        $this->InsertFields["vto"]["Value"] = $this->vto->GetDBValue(true);
        $this->InsertFields["idmoneda"]["Value"] = $this->idmoneda->GetDBValue(true);
        $this->InsertFields["idalquiler"]["Value"] = $this->idalquiler->GetDBValue(true);
        $this->SQL = CCBuildInsert("alquileres", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @3-D19A0322
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["idpropiedad"]["Value"] = $this->idpropiedad->GetDBValue(true);
        $this->UpdateFields["idestado"]["Value"] = $this->idestado->GetDBValue(true);
        $this->UpdateFields["fechainicio"]["Value"] = $this->fechainicio->GetDBValue(true);
        $this->UpdateFields["porcentajehonorarios"]["Value"] = $this->porcentajehonorarios->GetDBValue(true);
        $this->UpdateFields["acuerdo"]["Value"] = $this->acuerdo->GetDBValue(true);
        $this->UpdateFields["fechafin"]["Value"] = $this->fechafin->GetDBValue(true);
        $this->UpdateFields["vto"]["Value"] = $this->vto->GetDBValue(true);
        $this->UpdateFields["idmoneda"]["Value"] = $this->idmoneda->GetDBValue(true);
        $this->UpdateFields["idalquiler"]["Value"] = $this->idalquiler->GetDBValue(true);
        $this->SQL = CCBuildUpdate("alquileres", $this->UpdateFields, $this);
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

//Delete Method @3-8796DE09
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("postidalquiler", ccsInteger, "", "", CCGetFromPost("idalquiler", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["RETURN_VALUE"]->GetValue()) and !strlen($this->cp["RETURN_VALUE"]->GetText()) and !is_bool($this->cp["RETURN_VALUE"]->GetValue())) 
            $this->cp["RETURN_VALUE"]->SetText(CCGetFromGet("RETURN_VALUE", NULL));
        if (!is_null($this->cp["idalquiler"]->GetValue()) and !strlen($this->cp["idalquiler"]->GetText()) and !is_bool($this->cp["idalquiler"]->GetValue())) 
            $this->cp["idalquiler"]->SetText(CCGetFromPost("idalquiler", NULL));
        $this->SQL = "EXEC SP_BORRA_CONTRATO " . $this->ToSQL($this->cp["idalquiler"]->GetDBValue(), $this->cp["idalquiler"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End alquileresDataSource Class @3-FCB6E20C



class clsEditableGridanocontratoalquiler { //anocontratoalquiler Class @92-2F63334E

//Variables @92-F667987F

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $FormState;
    var $FormEnctype;
    var $CachedColumns;
    var $TotalRows;
    var $UpdatedRows;
    var $EmptyRows;
    var $Visible;
    var $RowsErrors;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;
    var $ControlsErrors;
    var $RowNumber;
    var $Attributes;
    var $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @92-86912013
    function clsEditableGridanocontratoalquiler($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid anocontratoalquiler/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "anocontratoalquiler";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["idalquiler"][0] = "idalquiler";
        $this->CachedColumns["ano"][0] = "ano";
        $this->DataSource = new clsanocontratoalquilerDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->ano = & new clsControl(ccsTextBox, "ano", "Ano", ccsInteger, "", NULL, $this);
        $this->ano->Required = true;
        $this->meses = & new clsControl(ccsTextBox, "meses", "Meses", ccsInteger, "", NULL, $this);
        $this->meses->Required = true;
        $this->monto = & new clsControl(ccsTextBox, "monto", "Monto", ccsFloat, "", NULL, $this);
        $this->monto->Required = true;
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->idalquiler = & new clsControl(ccsHidden, "idalquiler", "idalquiler", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @92-CBA44ABC
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @92-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @92-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @92-F8699AA8
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["ano"][$RowNumber] = CCGetFromPost("ano_" . $RowNumber, NULL);
            $this->FormParameters["meses"][$RowNumber] = CCGetFromPost("meses_" . $RowNumber, NULL);
            $this->FormParameters["monto"][$RowNumber] = CCGetFromPost("monto_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @92-365FB4FD
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idalquiler"] = $this->CachedColumns["idalquiler"][$this->RowNumber];
            $this->DataSource->CachedColumns["ano"] = $this->CachedColumns["ano"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->ano->SetText($this->FormParameters["ano"][$this->RowNumber], $this->RowNumber);
            $this->meses->SetText($this->FormParameters["meses"][$this->RowNumber], $this->RowNumber);
            $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @92-03FB59BD
    function ValidateRow()
    {
        global $CCSLocales;
        $this->ano->Validate();
        $this->meses->Validate();
        $this->monto->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meses->Errors->ToString());
        $errors = ComposeStrings($errors, $this->monto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->ano->Errors->Clear();
        $this->meses->Errors->Clear();
        $this->monto->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @92-19910500
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["ano"][$this->RowNumber]) && count($this->FormParameters["ano"][$this->RowNumber])) || strlen($this->FormParameters["ano"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["meses"][$this->RowNumber]) && count($this->FormParameters["meses"][$this->RowNumber])) || strlen($this->FormParameters["meses"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["monto"][$this->RowNumber]) && count($this->FormParameters["monto"][$this->RowNumber])) || strlen($this->FormParameters["monto"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @92-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @92-909F269B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @92-AC742D34
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idalquiler"] = $this->CachedColumns["idalquiler"][$this->RowNumber];
            $this->DataSource->CachedColumns["ano"] = $this->CachedColumns["ano"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->ano->SetText($this->FormParameters["ano"][$this->RowNumber], $this->RowNumber);
            $this->meses->SetText($this->FormParameters["meses"][$this->RowNumber], $this->RowNumber);
            $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @92-3F02DFF7
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ano->SetValue($this->ano->GetValue(true));
        $this->DataSource->meses->SetValue($this->meses->GetValue(true));
        $this->DataSource->monto->SetValue($this->monto->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @92-A80547FD
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ano->SetValue($this->ano->GetValue(true));
        $this->DataSource->meses->SetValue($this->meses->GetValue(true));
        $this->DataSource->monto->SetValue($this->monto->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @92-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @92-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @92-A1097DFA
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 2)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idalquiler"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["ano"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["idalquiler"][$RowNumber] = "";
                $this->CachedColumns["ano"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @92-F7DE31E6
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idalquiler"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["ano"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @92-36986D96
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["ano"] = $this->ano->Visible;
        $this->ControlsVisible["meses"] = $this->meses->Visible;
        $this->ControlsVisible["monto"] = $this->monto->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["idalquiler"][$this->RowNumber] = $this->DataSource->CachedColumns["idalquiler"];
                    $this->CachedColumns["ano"][$this->RowNumber] = $this->DataSource->CachedColumns["ano"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->ano->SetValue($this->DataSource->ano->GetValue());
                    $this->meses->SetValue($this->DataSource->meses->GetValue());
                    $this->monto->SetValue($this->DataSource->monto->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->ano->SetText($this->FormParameters["ano"][$this->RowNumber], $this->RowNumber);
                    $this->meses->SetText($this->FormParameters["meses"][$this->RowNumber], $this->RowNumber);
                    $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["idalquiler"][$this->RowNumber] = "";
                    $this->CachedColumns["ano"][$this->RowNumber] = "";
                    $this->ano->SetText("");
                    $this->meses->SetText("");
                    $this->monto->SetText("");
                } else {
                    $this->ano->SetText($this->FormParameters["ano"][$this->RowNumber], $this->RowNumber);
                    $this->meses->SetText($this->FormParameters["meses"][$this->RowNumber], $this->RowNumber);
                    $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ano->Show($this->RowNumber);
                $this->meses->Show($this->RowNumber);
                $this->monto->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["idalquiler"] == $this->CachedColumns["idalquiler"][$this->RowNumber]) && ($this->DataSource->CachedColumns["ano"] == $this->CachedColumns["ano"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->idalquiler->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End anocontratoalquiler Class @92-FCB6E20C

class clsanocontratoalquilerDataSource extends clsDBConnection1 {  //anocontratoalquilerDataSource Class @92-54150BA8

//DataSource Variables @92-9DAA9C4D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $ano;
    var $meses;
    var $monto;
    var $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @92-068886E8
    function clsanocontratoalquilerDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid anocontratoalquiler/Error";
        $this->Initialize();
        $this->ano = new clsField("ano", ccsInteger, "");
        
        $this->meses = new clsField("meses", ccsInteger, "");
        
        $this->monto = new clsField("monto", ccsFloat, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["ano"] = array("Name" => "ano", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["meses"] = array("Name" => "meses", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["monto"] = array("Name" => "monto", "Value" => "", "DataType" => ccsFloat);
        $this->InsertFields["idalquiler"] = array("Name" => "idalquiler", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ano"] = array("Name" => "ano", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["meses"] = array("Name" => "meses", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["monto"] = array("Name" => "monto", "Value" => "", "DataType" => ccsFloat);
        $this->UpdateFields["idalquiler"] = array("Name" => "idalquiler", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @92-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @92-EC01CAA7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idalquiler", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @92-82B7F697
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM anocontratoalquiler";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM anocontratoalquiler {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @92-34DD3E9E
    function SetValues()
    {
        $this->CachedColumns["idalquiler"] = $this->f("idalquiler");
        $this->CachedColumns["ano"] = $this->f("ano");
        $this->ano->SetDBValue(trim($this->f("ano")));
        $this->meses->SetDBValue(trim($this->f("meses")));
        $this->monto->SetDBValue(trim($this->f("monto")));
    }
//End SetValues Method

//Insert Method @92-A3B9FF87
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["ano"] = new clsSQLParameter("ctrlano", ccsInteger, "", "", $this->ano->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["meses"] = new clsSQLParameter("ctrlmeses", ccsInteger, "", "", $this->meses->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["monto"] = new clsSQLParameter("ctrlmonto", ccsFloat, "", "", $this->monto->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("postidalquiler", ccsInteger, "", "", CCGetFromPost("idalquiler", NULL), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["ano"]->GetValue()) and !strlen($this->cp["ano"]->GetText()) and !is_bool($this->cp["ano"]->GetValue())) 
            $this->cp["ano"]->SetValue($this->ano->GetValue(true));
        if (!is_null($this->cp["meses"]->GetValue()) and !strlen($this->cp["meses"]->GetText()) and !is_bool($this->cp["meses"]->GetValue())) 
            $this->cp["meses"]->SetValue($this->meses->GetValue(true));
        if (!is_null($this->cp["monto"]->GetValue()) and !strlen($this->cp["monto"]->GetText()) and !is_bool($this->cp["monto"]->GetValue())) 
            $this->cp["monto"]->SetValue($this->monto->GetValue(true));
        if (!is_null($this->cp["idalquiler"]->GetValue()) and !strlen($this->cp["idalquiler"]->GetText()) and !is_bool($this->cp["idalquiler"]->GetValue())) 
            $this->cp["idalquiler"]->SetText(CCGetFromPost("idalquiler", NULL));
        $this->InsertFields["ano"]["Value"] = $this->cp["ano"]->GetDBValue(true);
        $this->InsertFields["meses"]["Value"] = $this->cp["meses"]->GetDBValue(true);
        $this->InsertFields["monto"]["Value"] = $this->cp["monto"]->GetDBValue(true);
        $this->InsertFields["idalquiler"]["Value"] = $this->cp["idalquiler"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("anocontratoalquiler", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @92-D45C6C8D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["ano"] = new clsSQLParameter("ctrlano", ccsInteger, "", "", $this->ano->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["meses"] = new clsSQLParameter("ctrlmeses", ccsInteger, "", "", $this->meses->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["monto"] = new clsSQLParameter("ctrlmonto", ccsFloat, "", "", $this->monto->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("postidalquiler", ccsInteger, "", "", CCGetFromPost("idalquiler", NULL), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsidalquiler", ccsInteger, "", "", $this->CachedColumns["idalquiler"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "dsano", ccsInteger, "", "", $this->CachedColumns["ano"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("3", "urlidalquiler", ccsInteger, "", "", CCGetFromGet("idalquiler", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["ano"]->GetValue()) and !strlen($this->cp["ano"]->GetText()) and !is_bool($this->cp["ano"]->GetValue())) 
            $this->cp["ano"]->SetValue($this->ano->GetValue(true));
        if (!is_null($this->cp["meses"]->GetValue()) and !strlen($this->cp["meses"]->GetText()) and !is_bool($this->cp["meses"]->GetValue())) 
            $this->cp["meses"]->SetValue($this->meses->GetValue(true));
        if (!is_null($this->cp["monto"]->GetValue()) and !strlen($this->cp["monto"]->GetText()) and !is_bool($this->cp["monto"]->GetValue())) 
            $this->cp["monto"]->SetValue($this->monto->GetValue(true));
        if (!is_null($this->cp["idalquiler"]->GetValue()) and !strlen($this->cp["idalquiler"]->GetText()) and !is_bool($this->cp["idalquiler"]->GetValue())) 
            $this->cp["idalquiler"]->SetText(CCGetFromPost("idalquiler", NULL));
        $wp->Criterion[1] = $wp->Operation(opEqual, "idalquiler", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "ano", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsInteger),false);
        $wp->Criterion[3] = $wp->Operation(opEqual, "idalquiler", $wp->GetDBValue("3"), $this->ToSQL($wp->GetDBValue("3"), ccsInteger),false);
        $Where = $wp->opAND(
             false, $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]), 
             $wp->Criterion[3]);
        $this->UpdateFields["ano"]["Value"] = $this->cp["ano"]->GetDBValue(true);
        $this->UpdateFields["meses"]["Value"] = $this->cp["meses"]->GetDBValue(true);
        $this->UpdateFields["monto"]["Value"] = $this->cp["monto"]->GetDBValue(true);
        $this->UpdateFields["idalquiler"]["Value"] = $this->cp["idalquiler"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("anocontratoalquiler", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @92-79BC3537
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "idalquiler=" . $this->ToSQL($this->CachedColumns["idalquiler"], ccsInteger) . " AND ano=" . $this->ToSQL($this->CachedColumns["ano"], ccsInteger);
        $this->SQL = "DELETE FROM anocontratoalquiler";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End anocontratoalquilerDataSource Class @92-FCB6E20C

class clsGridanocontratoalquilerRO { //anocontratoalquilerRO class @101-324BC76A

//Variables @101-AC1EDBB9

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

//Class_Initialize Event @101-3A1C3CEE
    function clsGridanocontratoalquilerRO($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "anocontratoalquilerRO";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid anocontratoalquilerRO";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsanocontratoalquilerRODataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->ano = & new clsControl(ccsLabel, "ano", "ano", ccsInteger, "", CCGetRequestParam("ano", ccsGet, NULL), $this);
        $this->meses = & new clsControl(ccsLabel, "meses", "meses", ccsInteger, "", CCGetRequestParam("meses", ccsGet, NULL), $this);
        $this->monto = & new clsControl(ccsLabel, "monto", "monto", ccsFloat, "", CCGetRequestParam("monto", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @101-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @101-D161915A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);

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
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["meses"] = $this->meses->Visible;
            $this->ControlsVisible["monto"] = $this->monto->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ano->SetValue($this->DataSource->ano->GetValue());
                $this->meses->SetValue($this->DataSource->meses->GetValue());
                $this->monto->SetValue($this->DataSource->monto->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ano->Show();
                $this->meses->Show();
                $this->monto->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @101-BB125ED8
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->meses->Errors->ToString());
        $errors = ComposeStrings($errors, $this->monto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End anocontratoalquilerRO Class @101-FCB6E20C

class clsanocontratoalquilerRODataSource extends clsDBConnection1 {  //anocontratoalquilerRODataSource Class @101-68F4FB96

//DataSource Variables @101-64545AF7
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ano;
    var $meses;
    var $monto;
//End DataSource Variables

//DataSourceClass_Initialize Event @101-C9E9D2E9
    function clsanocontratoalquilerRODataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid anocontratoalquilerRO";
        $this->Initialize();
        $this->ano = new clsField("ano", ccsInteger, "");
        
        $this->meses = new clsField("meses", ccsInteger, "");
        
        $this->monto = new clsField("monto", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @101-6B8EF957
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ano";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @101-FEB25775
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idalquiler", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @101-82B7F697
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM anocontratoalquiler";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM anocontratoalquiler {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @101-8227AF70
    function SetValues()
    {
        $this->ano->SetDBValue(trim($this->f("ano")));
        $this->meses->SetDBValue(trim($this->f("meses")));
        $this->monto->SetDBValue(trim($this->f("monto")));
    }
//End SetValues Method

} //End anocontratoalquilerRODataSource Class @101-FCB6E20C

class clsEditableGridfichasalquileres { //fichasalquileres Class @107-E1195538

//Variables @107-F667987F

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $FormState;
    var $FormEnctype;
    var $CachedColumns;
    var $TotalRows;
    var $UpdatedRows;
    var $EmptyRows;
    var $Visible;
    var $RowsErrors;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;
    var $ControlsErrors;
    var $RowNumber;
    var $Attributes;
    var $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @107-41070DAE
    function clsEditableGridfichasalquileres($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid fichasalquileres/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "fichasalquileres";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["idficha"][0] = "idficha";
        $this->CachedColumns["idalquiler"][0] = "idalquiler";
        $this->DataSource = new clsfichasalquileresDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->idficha = & new clsControl(ccsTextBox, "idficha", "Idficha", ccsInteger, "", NULL, $this);
        $this->idficha->Required = true;
        $this->porcentajealq = & new clsControl(ccsTextBox, "porcentajealq", "Porcentajealq", ccsFloat, "", NULL, $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->nombre = & new clsControl(ccsTextBox, "nombre", "nombre", ccsText, "", NULL, $this);
        $this->nrodocumento = & new clsControl(ccsTextBox, "nrodocumento", "nrodocumento", ccsText, "", NULL, $this);
        $this->errorAjax = & new clsControl(ccsHidden, "errorAjax", "errorAjax", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @107-CBA44ABC
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @107-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @107-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @107-651BD873
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["idficha"][$RowNumber] = CCGetFromPost("idficha_" . $RowNumber, NULL);
            $this->FormParameters["porcentajealq"][$RowNumber] = CCGetFromPost("porcentajealq_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["nombre"][$RowNumber] = CCGetFromPost("nombre_" . $RowNumber, NULL);
            $this->FormParameters["nrodocumento"][$RowNumber] = CCGetFromPost("nrodocumento_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @107-83BCF224
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CachedColumns["idalquiler"] = $this->CachedColumns["idalquiler"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
            $this->porcentajealq->SetText($this->FormParameters["porcentajealq"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
            $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @107-C86D2D30
    function ValidateRow()
    {
        global $CCSLocales;
        $this->idficha->Validate();
        $this->porcentajealq->Validate();
        $this->CheckBox_Delete->Validate();
        $this->nombre->Validate();
        $this->nrodocumento->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajealq->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $this->idficha->Errors->Clear();
        $this->porcentajealq->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->nombre->Errors->Clear();
        $this->nrodocumento->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @107-944D9176
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["idficha"][$this->RowNumber]) && count($this->FormParameters["idficha"][$this->RowNumber])) || strlen($this->FormParameters["idficha"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["porcentajealq"][$this->RowNumber]) && count($this->FormParameters["porcentajealq"][$this->RowNumber])) || strlen($this->FormParameters["porcentajealq"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nombre"][$this->RowNumber]) && count($this->FormParameters["nombre"][$this->RowNumber])) || strlen($this->FormParameters["nombre"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nrodocumento"][$this->RowNumber]) && count($this->FormParameters["nrodocumento"][$this->RowNumber])) || strlen($this->FormParameters["nrodocumento"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @107-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @107-909F269B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @107-5854BD54
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CachedColumns["idalquiler"] = $this->CachedColumns["idalquiler"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
            $this->porcentajealq->SetText($this->FormParameters["porcentajealq"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
            $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @107-E6BEEBDD
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
        $this->DataSource->porcentajealq->SetValue($this->porcentajealq->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @107-6F0FD959
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
        $this->DataSource->porcentajealq->SetValue($this->porcentajealq->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @107-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @107-F49BF622
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var fichasalquileresElements;\n";
        $script .= "var fichasalquileresEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "idfichaID = 0;\n";
        $script .= "var " . $this->ComponentName . "porcentajealqID = 1;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 2;\n";
        $script .= "var " . $this->ComponentName . "nombreID = 3;\n";
        $script .= "var " . $this->ComponentName . "nrodocumentoID = 4;\n";
        $script .= "\nfunction initfichasalquileresElements() {\n";
        $script .= "\tvar ED = document.forms[\"fichasalquileres\"];\n";
        $script .= "\tfichasalquileresElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.idficha_" . $i . ", " . "ED.porcentajealq_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.nombre_" . $i . ", " . "ED.nrodocumento_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @107-3F24747A
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 2)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idficha"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idalquiler"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["idficha"][$RowNumber] = "";
                $this->CachedColumns["idalquiler"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @107-DD23A24C
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idficha"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idalquiler"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @107-FE28779D
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["idficha"] = $this->idficha->Visible;
        $this->ControlsVisible["porcentajealq"] = $this->porcentajealq->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["nombre"] = $this->nombre->Visible;
        $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["idficha"][$this->RowNumber] = $this->DataSource->CachedColumns["idficha"];
                    $this->CachedColumns["idalquiler"][$this->RowNumber] = $this->DataSource->CachedColumns["idalquiler"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                    $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                    $this->porcentajealq->SetValue($this->DataSource->porcentajealq->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                    $this->porcentajealq->SetText($this->FormParameters["porcentajealq"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["idficha"][$this->RowNumber] = "";
                    $this->CachedColumns["idalquiler"][$this->RowNumber] = "";
                    $this->idficha->SetText("");
                    $this->porcentajealq->SetText("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                } else {
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                    $this->porcentajealq->SetText($this->FormParameters["porcentajealq"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show($this->RowNumber);
                $this->porcentajealq->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                $this->nombre->Show($this->RowNumber);
                $this->nrodocumento->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["idficha"] == $this->CachedColumns["idficha"][$this->RowNumber]) && ($this->DataSource->CachedColumns["idalquiler"] == $this->CachedColumns["idalquiler"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->errorAjax->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End fichasalquileres Class @107-FCB6E20C

class clsfichasalquileresDataSource extends clsDBConnection1 {  //fichasalquileresDataSource Class @107-AEA717FB

//DataSource Variables @107-AE848792
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $idficha;
    var $porcentajealq;
    var $CheckBox_Delete;
    var $nombre;
    var $nrodocumento;
//End DataSource Variables

//DataSourceClass_Initialize Event @107-61000466
    function clsfichasalquileresDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid fichasalquileres/Error";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->porcentajealq = new clsField("porcentajealq", ccsFloat, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        

        $this->InsertFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["porcentajealq"] = array("Name" => "porcentajealq", "Value" => "", "DataType" => ccsFloat);
        $this->InsertFields["idalquiler"] = array("Name" => "idalquiler", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["porcentajealq"] = array("Name" => "porcentajealq", "Value" => "", "DataType" => ccsFloat);
        $this->UpdateFields["idalquiler"] = array("Name" => "idalquiler", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @107-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @107-EC01CAA7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idalquiler", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @107-C2E10B09
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichasalquileres";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM fichasalquileres {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @107-750FF77B
    function SetValues()
    {
        $this->CachedColumns["idficha"] = $this->f("idficha");
        $this->CachedColumns["idalquiler"] = $this->f("idalquiler");
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->porcentajealq->SetDBValue(trim($this->f("porcentajealq")));
    }
//End SetValues Method

//Insert Method @107-1195F446
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["porcentajealq"] = new clsSQLParameter("ctrlporcentajealq", ccsFloat, "", "", $this->porcentajealq->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("urlidalquiler", ccsInteger, "", "", CCGetFromGet("idalquiler", NULL), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        if (!is_null($this->cp["porcentajealq"]->GetValue()) and !strlen($this->cp["porcentajealq"]->GetText()) and !is_bool($this->cp["porcentajealq"]->GetValue())) 
            $this->cp["porcentajealq"]->SetValue($this->porcentajealq->GetValue(true));
        if (!is_null($this->cp["idalquiler"]->GetValue()) and !strlen($this->cp["idalquiler"]->GetText()) and !is_bool($this->cp["idalquiler"]->GetValue())) 
            $this->cp["idalquiler"]->SetText(CCGetFromGet("idalquiler", NULL));
        $this->InsertFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->InsertFields["porcentajealq"]["Value"] = $this->cp["porcentajealq"]->GetDBValue(true);
        $this->InsertFields["idalquiler"]["Value"] = $this->cp["idalquiler"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("fichasalquileres", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @107-5D58675C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["porcentajealq"] = new clsSQLParameter("ctrlporcentajealq", ccsFloat, "", "", $this->porcentajealq->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("urlidalquiler", ccsInteger, "", "", CCGetFromGet("idalquiler", NULL), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsidficha", ccsInteger, "", "", $this->CachedColumns["idficha"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "dsidalquiler", ccsInteger, "", "", $this->CachedColumns["idalquiler"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("3", "urlidalquiler", ccsInteger, "", "", CCGetFromGet("idalquiler", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        if (!is_null($this->cp["porcentajealq"]->GetValue()) and !strlen($this->cp["porcentajealq"]->GetText()) and !is_bool($this->cp["porcentajealq"]->GetValue())) 
            $this->cp["porcentajealq"]->SetValue($this->porcentajealq->GetValue(true));
        if (!is_null($this->cp["idalquiler"]->GetValue()) and !strlen($this->cp["idalquiler"]->GetText()) and !is_bool($this->cp["idalquiler"]->GetValue())) 
            $this->cp["idalquiler"]->SetText(CCGetFromGet("idalquiler", NULL));
        $wp->Criterion[1] = $wp->Operation(opEqual, "idficha", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "idalquiler", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsInteger),false);
        $wp->Criterion[3] = $wp->Operation(opEqual, "idalquiler", $wp->GetDBValue("3"), $this->ToSQL($wp->GetDBValue("3"), ccsInteger),false);
        $Where = $wp->opAND(
             false, $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]), 
             $wp->Criterion[3]);
        $this->UpdateFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->UpdateFields["porcentajealq"]["Value"] = $this->cp["porcentajealq"]->GetDBValue(true);
        $this->UpdateFields["idalquiler"]["Value"] = $this->cp["idalquiler"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("fichasalquileres", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @107-6FC32345
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "idficha=" . $this->ToSQL($this->CachedColumns["idficha"], ccsInteger) . " AND idalquiler=" . $this->ToSQL($this->CachedColumns["idalquiler"], ccsInteger);
        $this->SQL = "DELETE FROM fichasalquileres";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End fichasalquileresDataSource Class @107-FCB6E20C

class clsRecordgeneracuotas { //generacuotas Class @153-C85E89B0

//Variables @153-D6FF3E86

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

//Class_Initialize Event @153-1F1B9CD0
    function clsRecordgeneracuotas($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record generacuotas/Error";
        $this->DataSource = new clsgeneracuotasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "generacuotas";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->exito = & new clsControl(ccsLabel, "exito", "exito", ccsText, "", CCGetRequestParam("exito", $Method, NULL), $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @153-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @153-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @153-7E6CA5EC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->exito->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @153-ED598703
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

//Operation Method @153-DEE56275
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "contrato.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Insert") {
                $Redirect = "contrato.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @153-2B6A5BEC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @153-92E06AB0
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @153-F28ECC40
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
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->exito->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->exito->Show();
        $this->Button_Insert->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End generacuotas Class @153-FCB6E20C

class clsgeneracuotasDataSource extends clsDBConnection1 {  //generacuotasDataSource Class @153-3FC43890

//DataSource Variables @153-9641EC40
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $exito;
//End DataSource Variables

//DataSourceClass_Initialize Event @153-A42BFA11
    function clsgeneracuotasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record generacuotas/Error";
        $this->Initialize();
        $this->exito = new clsField("exito", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @153-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @153-E5349141
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM cuotas {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @153-BAF0975B
    function SetValues()
    {
    }
//End SetValues Method

//Insert Method @153-D1E68E92
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("urlidalquiler", ccsInteger, "", "", CCGetFromGet("idalquiler", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["RETURN_VALUE"]->GetValue()) and !strlen($this->cp["RETURN_VALUE"]->GetText()) and !is_bool($this->cp["RETURN_VALUE"]->GetValue())) 
            $this->cp["RETURN_VALUE"]->SetText(CCGetFromGet("RETURN_VALUE", NULL));
        if (!is_null($this->cp["idalquiler"]->GetValue()) and !strlen($this->cp["idalquiler"]->GetText()) and !is_bool($this->cp["idalquiler"]->GetValue())) 
            $this->cp["idalquiler"]->SetText(CCGetFromGet("idalquiler", NULL));
        $this->SQL = "EXEC SP_GENERA_CUOTAS_ALQUILER " . $this->ToSQL($this->cp["idalquiler"]->GetDBValue(), $this->cp["idalquiler"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @153-1CF1BB22
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("urlidalquiler", ccsInteger, "", "", CCGetFromGet("idalquiler", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["RETURN_VALUE"]->GetValue()) and !strlen($this->cp["RETURN_VALUE"]->GetText()) and !is_bool($this->cp["RETURN_VALUE"]->GetValue())) 
            $this->cp["RETURN_VALUE"]->SetText(CCGetFromGet("RETURN_VALUE", NULL));
        if (!is_null($this->cp["idalquiler"]->GetValue()) and !strlen($this->cp["idalquiler"]->GetText()) and !is_bool($this->cp["idalquiler"]->GetValue())) 
            $this->cp["idalquiler"]->SetText(CCGetFromGet("idalquiler", NULL));
        $this->SQL = "EXEC SP_GENERA_CUOTAS_ALQUILER " . $this->ToSQL($this->cp["idalquiler"]->GetDBValue(), $this->cp["idalquiler"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End generacuotasDataSource Class @153-FCB6E20C

class clsGridfichasalquileresRO { //fichasalquileresRO class @158-84A2BC19

//Variables @158-AC1EDBB9

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

//Class_Initialize Event @158-DB2964F8
    function clsGridfichasalquileresRO($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichasalquileresRO";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichasalquileresRO";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichasalquileresRODataSource($this);
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

        $this->idficha = & new clsControl(ccsLabel, "idficha", "idficha", ccsInteger, "", CCGetRequestParam("idficha", ccsGet, NULL), $this);
        $this->porcentajealq = & new clsControl(ccsLabel, "porcentajealq", "porcentajealq", ccsFloat, "", CCGetRequestParam("porcentajealq", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @158-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @158-B898174A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);

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
            $this->ControlsVisible["idficha"] = $this->idficha->Visible;
            $this->ControlsVisible["porcentajealq"] = $this->porcentajealq->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                $this->porcentajealq->SetValue($this->DataSource->porcentajealq->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show();
                $this->porcentajealq->Show();
                $this->nombre->Show();
                $this->nrodocumento->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @158-19674D02
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajealq->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichasalquileresRO Class @158-FCB6E20C

class clsfichasalquileresRODataSource extends clsDBConnection1 {  //fichasalquileresRODataSource Class @158-ED6353FC

//DataSource Variables @158-6307DBF8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idficha;
    var $porcentajealq;
//End DataSource Variables

//DataSourceClass_Initialize Event @158-E92C4C3A
    function clsfichasalquileresRODataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichasalquileresRO";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->porcentajealq = new clsField("porcentajealq", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @158-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @158-FEB25775
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idalquiler", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @158-C2E10B09
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichasalquileres";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM fichasalquileres {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @158-B962A09A
    function SetValues()
    {
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->porcentajealq->SetDBValue(trim($this->f("porcentajealq")));
    }
//End SetValues Method

} //End fichasalquileresRODataSource Class @158-FCB6E20C

//Initialize Page @1-34210A91
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
$TemplateFileName = "contrato.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4B8AD610
include_once("./contrato_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-160D6A08
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$alquileres = & new clsRecordalquileres("", $MainPage);
$anocontratoalquiler = & new clsEditableGridanocontratoalquiler("", $MainPage);
$anocontratoalquilerRO = & new clsGridanocontratoalquilerRO("", $MainPage);
$fichasalquileres = & new clsEditableGridfichasalquileres("", $MainPage);
$generacuotas = & new clsRecordgeneracuotas("", $MainPage);
$fichasalquileresRO = & new clsGridfichasalquileresRO("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->alquileres = & $alquileres;
$MainPage->anocontratoalquiler = & $anocontratoalquiler;
$MainPage->anocontratoalquilerRO = & $anocontratoalquilerRO;
$MainPage->fichasalquileres = & $fichasalquileres;
$MainPage->generacuotas = & $generacuotas;
$MainPage->fichasalquileresRO = & $fichasalquileresRO;
$alquileres->Initialize();
$anocontratoalquiler->Initialize();
$anocontratoalquilerRO->Initialize();
$fichasalquileres->Initialize();
$generacuotas->Initialize();
$fichasalquileresRO->Initialize();

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

//Execute Components @1-896945A8
$Header->Operations();
$alquileres->Operation();
$anocontratoalquiler->Operation();
$fichasalquileres->Operation();
$generacuotas->Operation();
//End Execute Components

//Go to destination page @1-5FDDAEE0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($alquileres);
    unset($anocontratoalquiler);
    unset($anocontratoalquilerRO);
    unset($fichasalquileres);
    unset($generacuotas);
    unset($fichasalquileresRO);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D1FA8E5B
$Header->Show();
$alquileres->Show();
$anocontratoalquiler->Show();
$anocontratoalquilerRO->Show();
$fichasalquileres->Show();
$generacuotas->Show();
$fichasalquileresRO->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C54F13D3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($alquileres);
unset($anocontratoalquiler);
unset($anocontratoalquilerRO);
unset($fichasalquileres);
unset($generacuotas);
unset($fichasalquileresRO);
unset($Tpl);
//End Unload Page


?>
