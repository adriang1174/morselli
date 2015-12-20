<?php
//Include Common Files @1-EECC4B03
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "hipotecas_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @15-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordhipotecas { //hipotecas Class @2-08E7C8A3

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

//Class_Initialize Event @2-C73F1AF3
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
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
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
            $this->idhipoteca = & new clsControl(ccsTextBox, "idhipoteca", "idhipoteca", ccsInteger, "", CCGetRequestParam("idhipoteca", $Method, NULL), $this);
            $this->honorario = & new clsControl(ccsTextBox, "honorario", "honorario", ccsText, "", CCGetRequestParam("honorario", $Method, NULL), $this);
            $this->honorario->Required = true;
            $this->liqhip = & new clsControl(ccsTextBox, "liqhip", "liqhip", ccsText, "", CCGetRequestParam("liqhip", $Method, NULL), $this);
            $this->liqhip->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->idestado->Value) && !strlen($this->idestado->Value) && $this->idestado->Value !== false)
                    $this->idestado->SetText(1);
                if(!is_array($this->honorario->Value) && !strlen($this->honorario->Value) && $this->honorario->Value !== false)
                    $this->honorario->SetText(0.3);
                if(!is_array($this->liqhip->Value) && !strlen($this->liqhip->Value) && $this->liqhip->Value !== false)
                    $this->liqhip->SetText(0.2);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-F8E0E99C
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidpropiedad"] = CCGetFromGet("idpropiedad", NULL);
        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);
    }
//End Initialize Method

//Validate Method @2-09A82764
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
        $Validation = ($this->honorario->Validate() && $Validation);
        $Validation = ($this->liqhip->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->montohipoteca->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechainicio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idestado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idpropiedad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechafin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idhipoteca->Errors->Count() == 0);
        $Validation =  $Validation && ($this->honorario->Errors->Count() == 0);
        $Validation =  $Validation && ($this->liqhip->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-29805ED2
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
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->honorario->Errors->Count());
        $errors = ($errors || $this->liqhip->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
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

//Operation Method @2-B908BA44
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

//InsertRow Method @2-96277D00
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
        $this->DataSource->idhipoteca->SetValue($this->idhipoteca->GetValue(true));
        $this->DataSource->honorario->SetValue($this->honorario->GetValue(true));
        $this->DataSource->liqhip->SetValue($this->liqhip->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-848FA6EF
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->montohipoteca->SetValue($this->montohipoteca->GetValue(true));
        $this->DataSource->fechainicio->SetValue($this->fechainicio->GetValue(true));
        $this->DataSource->idestado->SetValue($this->idestado->GetValue(true));
        $this->DataSource->idpropiedad->SetValue($this->idpropiedad->GetValue(true));
        $this->DataSource->data_prop->SetValue($this->data_prop->GetValue(true));
        $this->DataSource->data_deudor->SetValue($this->data_deudor->GetValue(true));
        $this->DataSource->fechafin->SetValue($this->fechafin->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->idhipoteca->SetValue($this->idhipoteca->GetValue(true));
        $this->DataSource->honorario->SetValue($this->honorario->GetValue(true));
        $this->DataSource->liqhip->SetValue($this->liqhip->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-4381615B
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
                    $this->honorario->SetValue($this->DataSource->honorario->GetValue());
                    $this->liqhip->SetValue($this->DataSource->liqhip->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
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
            $Error = ComposeStrings($Error, $this->idhipoteca->Errors->ToString());
            $Error = ComposeStrings($Error, $this->honorario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->liqhip->Errors->ToString());
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
        $this->idhipoteca->Show();
        $this->honorario->Show();
        $this->liqhip->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End hipotecas Class @2-FCB6E20C

class clshipotecasDataSource extends clsDBConnection1 {  //hipotecasDataSource Class @2-279D5256

//DataSource Variables @2-7346DBF5
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
    var $montohipoteca;
    var $fechainicio;
    var $idestado;
    var $idpropiedad;
    var $data_prop;
    var $data_deudor;
    var $fechafin;
    var $ListBox1;
    var $idhipoteca;
    var $honorario;
    var $liqhip;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-057E5349
    function clshipotecasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record hipotecas/Error";
        $this->Initialize();
        $this->montohipoteca = new clsField("montohipoteca", ccsText, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->idestado = new clsField("idestado", ccsInteger, "");
        
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        
        $this->data_prop = new clsField("data_prop", ccsText, "");
        
        $this->data_deudor = new clsField("data_deudor", ccsText, "");
        
        $this->fechafin = new clsField("fechafin", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss", ".", "S"));
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        
        $this->idhipoteca = new clsField("idhipoteca", ccsInteger, "");
        
        $this->honorario = new clsField("honorario", ccsText, "");
        
        $this->liqhip = new clsField("liqhip", ccsText, "");
        

        $this->InsertFields["montohipoteca"] = array("Name" => "montohipoteca", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fechainicio"] = array("Name" => "fechainicio", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["idestado"] = array("Name" => "idestado", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["fechafin"] = array("Name" => "fechafin", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["idmoneda"] = array("Name" => "idmoneda", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["idhipoteca"] = array("Name" => "idhipoteca", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["honorario"] = array("Name" => "honorario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["liqhip"] = array("Name" => "liqhip", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["montohipoteca"] = array("Name" => "montohipoteca", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechainicio"] = array("Name" => "fechainicio", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["idestado"] = array("Name" => "idestado", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechafin"] = array("Name" => "fechafin", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["idmoneda"] = array("Name" => "idmoneda", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idhipoteca"] = array("Name" => "idhipoteca", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["honorario"] = array("Name" => "honorario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["liqhip"] = array("Name" => "liqhip", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-B03381A7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidpropiedad", ccsInteger, "", "", $this->Parameters["urlidpropiedad"], "", false);
        $this->wp->AddParameter("2", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idpropiedad", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "idhipoteca", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-CE61A2A4
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

//SetValues Method @2-B51A4546
    function SetValues()
    {
        $this->montohipoteca->SetDBValue($this->f("montohipoteca"));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->idestado->SetDBValue(trim($this->f("idestado")));
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->ListBox1->SetDBValue($this->f("idmoneda"));
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->honorario->SetDBValue($this->f("honorario"));
        $this->liqhip->SetDBValue($this->f("liqhip"));
    }
//End SetValues Method

//Insert Method @2-6685AB5F
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
        $this->InsertFields["honorario"]["Value"] = $this->honorario->GetDBValue(true);
        $this->InsertFields["liqhip"]["Value"] = $this->liqhip->GetDBValue(true);
        $this->SQL = CCBuildInsert("hipotecas", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-1281CF53
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["montohipoteca"]["Value"] = $this->montohipoteca->GetDBValue(true);
        $this->UpdateFields["fechainicio"]["Value"] = $this->fechainicio->GetDBValue(true);
        $this->UpdateFields["idestado"]["Value"] = $this->idestado->GetDBValue(true);
        $this->UpdateFields["idpropiedad"]["Value"] = $this->idpropiedad->GetDBValue(true);
        $this->UpdateFields["fechafin"]["Value"] = $this->fechafin->GetDBValue(true);
        $this->UpdateFields["idmoneda"]["Value"] = $this->ListBox1->GetDBValue(true);
        $this->UpdateFields["idhipoteca"]["Value"] = $this->idhipoteca->GetDBValue(true);
        $this->UpdateFields["honorario"]["Value"] = $this->honorario->GetDBValue(true);
        $this->UpdateFields["liqhip"]["Value"] = $this->liqhip->GetDBValue(true);
        $this->SQL = CCBuildUpdate("hipotecas", $this->UpdateFields, $this);
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

//Delete Method @2-9FBBA3A3
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM hipotecas";
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

} //End hipotecasDataSource Class @2-FCB6E20C

//Include Page implementation @16-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

class clsEditableGridfichashipotecas { //fichashipotecas Class @22-3A31F1A9

//Variables @22-F667987F

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

//Class_Initialize Event @22-18C95115
    function clsEditableGridfichashipotecas($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid fichashipotecas/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "fichashipotecas";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["idhipoteca"][0] = "idhipoteca";
        $this->CachedColumns["idficha"][0] = "idficha";
        $this->DataSource = new clsfichashipotecasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
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
        $this->monto = & new clsControl(ccsTextBox, "monto", "Monto", ccsInteger, "", NULL, $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->errorAjax = & new clsControl(ccsHidden, "errorAjax", "errorAjax", ccsText, "", NULL, $this);
        $this->nombre = & new clsControl(ccsTextBox, "nombre", "nombre", ccsText, "", NULL, $this);
        $this->nrodocumento = & new clsControl(ccsTextBox, "nrodocumento", "nrodocumento", ccsText, "", NULL, $this);
        $this->suma = & new clsControl(ccsHidden, "suma", "suma", ccsFloat, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @22-6FCE9FC1
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @22-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @22-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @22-143B40AD
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["idficha"][$RowNumber] = CCGetFromPost("idficha_" . $RowNumber, NULL);
            $this->FormParameters["monto"][$RowNumber] = CCGetFromPost("monto_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["nombre"][$RowNumber] = CCGetFromPost("nombre_" . $RowNumber, NULL);
            $this->FormParameters["nrodocumento"][$RowNumber] = CCGetFromPost("nrodocumento_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @22-34B95DD5
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idhipoteca"] = $this->CachedColumns["idhipoteca"][$this->RowNumber];
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
            $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @22-44F490C6
    function ValidateRow()
    {
        global $CCSLocales;
        $this->idficha->Validate();
        $this->monto->Validate();
        $this->CheckBox_Delete->Validate();
        $this->nombre->Validate();
        $this->nrodocumento->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->monto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $this->idficha->Errors->Clear();
        $this->monto->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->nombre->Errors->Clear();
        $this->nrodocumento->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @22-F68656AD
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["idficha"][$this->RowNumber]) && count($this->FormParameters["idficha"][$this->RowNumber])) || strlen($this->FormParameters["idficha"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["monto"][$this->RowNumber]) && count($this->FormParameters["monto"][$this->RowNumber])) || strlen($this->FormParameters["monto"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nombre"][$this->RowNumber]) && count($this->FormParameters["nombre"][$this->RowNumber])) || strlen($this->FormParameters["nombre"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nrodocumento"][$this->RowNumber]) && count($this->FormParameters["nrodocumento"][$this->RowNumber])) || strlen($this->FormParameters["nrodocumento"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @22-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @22-909F269B
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

//UpdateGrid Method @22-E1CF5D67
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idhipoteca"] = $this->CachedColumns["idhipoteca"][$this->RowNumber];
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
            $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @22-5C51376C
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
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

//UpdateRow Method @22-8E2ACDD1
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
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

//DeleteRow Method @22-A4A656F6
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

//FormScript Method @22-C9C59A16
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var fichashipotecasElements;\n";
        $script .= "var fichashipotecasEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "idfichaID = 0;\n";
        $script .= "var " . $this->ComponentName . "montoID = 1;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 2;\n";
        $script .= "var " . $this->ComponentName . "nombreID = 3;\n";
        $script .= "var " . $this->ComponentName . "nrodocumentoID = 4;\n";
        $script .= "\nfunction initfichashipotecasElements() {\n";
        $script .= "\tvar ED = document.forms[\"fichashipotecas\"];\n";
        $script .= "\tfichashipotecasElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.idficha_" . $i . ", " . "ED.monto_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.nombre_" . $i . ", " . "ED.nrodocumento_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @22-73E8755B
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
                $this->CachedColumns["idhipoteca"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idficha"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["idhipoteca"][$RowNumber] = "";
                $this->CachedColumns["idficha"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @22-6DD60A4D
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idhipoteca"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idficha"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @22-B9D02C15
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
        $this->ControlsVisible["monto"] = $this->monto->Visible;
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
                    $this->CachedColumns["idhipoteca"][$this->RowNumber] = $this->DataSource->CachedColumns["idhipoteca"];
                    $this->CachedColumns["idficha"][$this->RowNumber] = $this->DataSource->CachedColumns["idficha"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                    $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                    $this->monto->SetValue($this->DataSource->monto->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                    $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["idhipoteca"][$this->RowNumber] = "";
                    $this->CachedColumns["idficha"][$this->RowNumber] = "";
                    $this->idficha->SetText("");
                    $this->monto->SetText("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                } else {
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                    $this->monto->SetText($this->FormParameters["monto"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show($this->RowNumber);
                $this->monto->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["idhipoteca"] == $this->CachedColumns["idhipoteca"][$this->RowNumber]) && ($this->DataSource->CachedColumns["idficha"] == $this->CachedColumns["idficha"][$this->RowNumber])) {
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
        $this->suma->Show();

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

} //End fichashipotecas Class @22-FCB6E20C

class clsfichashipotecasDataSource extends clsDBConnection1 {  //fichashipotecasDataSource Class @22-3D1FBBF7

//DataSource Variables @22-CDB8B1C6
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
    var $monto;
    var $CheckBox_Delete;
    var $nombre;
    var $nrodocumento;
//End DataSource Variables

//DataSourceClass_Initialize Event @22-7DF69E61
    function clsfichashipotecasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid fichashipotecas/Error";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->monto = new clsField("monto", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        

        $this->InsertFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["monto"] = array("Name" => "monto", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idhipoteca"] = array("Name" => "idhipoteca", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["monto"] = array("Name" => "monto", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @22-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @22-767034E6
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

//Open Method @22-7FEA1804
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichashipotecas";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM fichashipotecas {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @22-AA7AB458
    function SetValues()
    {
        $this->CachedColumns["idhipoteca"] = $this->f("idhipoteca");
        $this->CachedColumns["idficha"] = $this->f("idficha");
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->monto->SetDBValue(trim($this->f("monto")));
    }
//End SetValues Method

//Insert Method @22-E576EAD4
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["monto"] = new clsSQLParameter("ctrlmonto", ccsInteger, "", "", $this->monto->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["idhipoteca"] = new clsSQLParameter("urlidhipoteca", ccsInteger, "", "", CCGetFromGet("idhipoteca", NULL), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        if (!is_null($this->cp["monto"]->GetValue()) and !strlen($this->cp["monto"]->GetText()) and !is_bool($this->cp["monto"]->GetValue())) 
            $this->cp["monto"]->SetValue($this->monto->GetValue(true));
        if (!is_null($this->cp["idhipoteca"]->GetValue()) and !strlen($this->cp["idhipoteca"]->GetText()) and !is_bool($this->cp["idhipoteca"]->GetValue())) 
            $this->cp["idhipoteca"]->SetText(CCGetFromGet("idhipoteca", NULL));
        $this->InsertFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->InsertFields["monto"]["Value"] = $this->cp["monto"]->GetDBValue(true);
        $this->InsertFields["idhipoteca"]["Value"] = $this->cp["idhipoteca"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("fichashipotecas", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @22-259BC565
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["monto"] = new clsSQLParameter("ctrlmonto", ccsInteger, "", "", $this->monto->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsidhipoteca", ccsInteger, "", "", $this->CachedColumns["idhipoteca"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "dsidficha", ccsInteger, "", "", $this->CachedColumns["idficha"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("3", "urlidhipoteca", ccsInteger, "", "", CCGetFromGet("idhipoteca", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        if (!is_null($this->cp["monto"]->GetValue()) and !strlen($this->cp["monto"]->GetText()) and !is_bool($this->cp["monto"]->GetValue())) 
            $this->cp["monto"]->SetValue($this->monto->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "idhipoteca", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "idficha", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsInteger),false);
        $wp->Criterion[3] = $wp->Operation(opEqual, "idhipoteca", $wp->GetDBValue("3"), $this->ToSQL($wp->GetDBValue("3"), ccsInteger),false);
        $Where = $wp->opAND(
             false, $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]), 
             $wp->Criterion[3]);
        $this->UpdateFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->UpdateFields["monto"]["Value"] = $this->cp["monto"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("fichashipotecas", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @22-202EEEE3
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "idhipoteca=" . $this->ToSQL($this->CachedColumns["idhipoteca"], ccsInteger) . " AND idficha=" . $this->ToSQL($this->CachedColumns["idficha"], ccsInteger);
        $this->SQL = "DELETE FROM fichashipotecas";
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

} //End fichashipotecasDataSource Class @22-FCB6E20C

class clsGridfichashipotecasRO { //fichashipotecasRO class @36-385F5117

//Variables @36-AC1EDBB9

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

//Class_Initialize Event @36-A84F03C0
    function clsGridfichashipotecasRO($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichashipotecasRO";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichashipotecasRO";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichashipotecasRODataSource($this);
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
        $this->monto = & new clsControl(ccsLabel, "monto", "monto", ccsInteger, "", CCGetRequestParam("monto", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @36-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @36-97D0F6C4
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);

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
            $this->ControlsVisible["monto"] = $this->monto->Visible;
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
                $this->monto->SetValue($this->DataSource->monto->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show();
                $this->monto->Show();
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

//GetErrors Method @36-49CD4176
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->monto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichashipotecasRO Class @36-FCB6E20C

class clsfichashipotecasRODataSource extends clsDBConnection1 {  //fichashipotecasRODataSource Class @36-9EB6608B

//DataSource Variables @36-5BA3E496
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idficha;
    var $monto;
//End DataSource Variables

//DataSourceClass_Initialize Event @36-EE14F44A
    function clsfichashipotecasRODataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichashipotecasRO";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->monto = new clsField("monto", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @36-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @36-0B47678B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @36-7FEA1804
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichashipotecas";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM fichashipotecas {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @36-E85E7666
    function SetValues()
    {
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->monto->SetDBValue(trim($this->f("monto")));
    }
//End SetValues Method

} //End fichashipotecasRODataSource Class @36-FCB6E20C

class clsRecordgeneracuotas { //generacuotas Class @67-C85E89B0

//Variables @67-D6FF3E86

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

//Class_Initialize Event @67-5DB8244C
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
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->exito = & new clsControl(ccsLabel, "exito", "exito", ccsText, "", CCGetRequestParam("exito", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @67-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @67-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @67-7E6CA5EC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->exito->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @67-ED598703
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

//Operation Method @67-F7FDE82C
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
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = "hipotecas_maint.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "hipotecas_maint.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @67-2B6A5BEC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @67-997650F5
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->exito->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End generacuotas Class @67-FCB6E20C

class clsgeneracuotasDataSource extends clsDBConnection1 {  //generacuotasDataSource Class @67-3FC43890

//DataSource Variables @67-72C086B2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $exito;
//End DataSource Variables

//DataSourceClass_Initialize Event @67-A42BFA11
    function clsgeneracuotasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record generacuotas/Error";
        $this->Initialize();
        $this->exito = new clsField("exito", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @67-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @67-B106E38F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM anohipoteca {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @67-BAF0975B
    function SetValues()
    {
    }
//End SetValues Method

//Insert Method @67-2E7507A5
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idhipoteca"] = new clsSQLParameter("urlidhipoteca", ccsInteger, "", "", CCGetFromGet("idhipoteca", NULL), 1, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["RETURN_VALUE"]->GetValue()) and !strlen($this->cp["RETURN_VALUE"]->GetText()) and !is_bool($this->cp["RETURN_VALUE"]->GetValue())) 
            $this->cp["RETURN_VALUE"]->SetText(CCGetFromGet("RETURN_VALUE", NULL));
        if (!is_null($this->cp["idhipoteca"]->GetValue()) and !strlen($this->cp["idhipoteca"]->GetText()) and !is_bool($this->cp["idhipoteca"]->GetValue())) 
            $this->cp["idhipoteca"]->SetText(CCGetFromGet("idhipoteca", NULL));
        if (!strlen($this->cp["idhipoteca"]->GetText()) and !is_bool($this->cp["idhipoteca"]->GetValue(true))) 
            $this->cp["idhipoteca"]->SetText(1);
        $this->SQL = "EXEC SP_GENERA_CUOTAS_HIPOTECA " . $this->ToSQL($this->cp["idhipoteca"]->GetDBValue(), $this->cp["idhipoteca"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End generacuotasDataSource Class @67-FCB6E20C

class clsGriddeuda { //deuda class @76-1BDB2C0B

//Variables @76-AC1EDBB9

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

//Class_Initialize Event @76-F18484F3
    function clsGriddeuda($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "deuda";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid deuda";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdeudaDataSource($this);
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

        $this->deuda = & new clsControl(ccsLabel, "deuda", "deuda", ccsText, "", CCGetRequestParam("deuda", ccsGet, NULL), $this);
        $this->liquidacionp = & new clsControl(ccsLabel, "liquidacionp", "liquidacionp", ccsText, "", CCGetRequestParam("liquidacionp", ccsGet, NULL), $this);
        $this->Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @76-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @76-8A530257
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlRETURN_VALUE"] = CCGetFromGet("RETURN_VALUE", NULL);
        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);

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
            $this->ControlsVisible["deuda"] = $this->deuda->Visible;
            $this->ControlsVisible["liquidacionp"] = $this->liquidacionp->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->deuda->SetValue($this->DataSource->deuda->GetValue());
                $this->liquidacionp->SetValue($this->DataSource->liquidacionp->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->deuda->Show();
                $this->liquidacionp->Show();
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
        $this->Label1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @76-1ABCBB7F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->deuda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->liquidacionp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End deuda Class @76-FCB6E20C

class clsdeudaDataSource extends clsDBConnection1 {  //deudaDataSource Class @76-CD5BF076

//DataSource Variables @76-F0FE2A3B
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;


    // Datasource fields
    var $deuda;
    var $liquidacionp;
//End DataSource Variables

//DataSourceClass_Initialize Event @76-8A5D0E93
    function clsdeudaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid deuda";
        $this->Initialize();
        $this->deuda = new clsField("deuda", ccsText, "");
        
        $this->liquidacionp = new clsField("liquidacionp", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @76-BF7F5B01
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @76-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @76-4D2CEDC5
    function Open()
    {
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idhipoteca"] = new clsSQLParameter("urlidhipoteca", ccsInteger, "", "", CCGetFromGet("idhipoteca", NULL), "", false, $this->ErrorBlock);
            $this->RecordsCount = "CCS not counted";
          
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "EXEC sp_deuda_hipoteca " . $this->ToSQL($this->cp["idhipoteca"]->GetDBValue(), $this->cp["idhipoteca"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query($this->SQL);
        $this->RecordsCount = "CCS not counted";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        if ($this->Errors->count()) return false;
        if ($this->RecordsCount == "CCS not counted") {
            $this->RecordsCount = $this->num_rows();
        }
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @76-048359B6
    function SetValues()
    {
        $this->deuda->SetDBValue($this->f("deuda"));
        $this->liquidacionp->SetDBValue($this->f("liquidacionp"));
    }
//End SetValues Method

} //End deudaDataSource Class @76-FCB6E20C



//Initialize Page @1-E16E016C
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
$TemplateFileName = "hipotecas_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-83550DE3
include_once("./hipotecas_maint_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FB949385
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$hipotecas = & new clsRecordhipotecas("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$fichashipotecas = & new clsEditableGridfichashipotecas("", $MainPage);
$fichashipotecasRO = & new clsGridfichashipotecasRO("", $MainPage);
$generacuotas = & new clsRecordgeneracuotas("", $MainPage);
$deuda = & new clsGriddeuda("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->hipotecas = & $hipotecas;
$MainPage->Footer = & $Footer;
$MainPage->fichashipotecas = & $fichashipotecas;
$MainPage->fichashipotecasRO = & $fichashipotecasRO;
$MainPage->generacuotas = & $generacuotas;
$MainPage->deuda = & $deuda;
$hipotecas->Initialize();
$fichashipotecas->Initialize();
$fichashipotecasRO->Initialize();
$generacuotas->Initialize();
$deuda->Initialize();

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

//Execute Components @1-E4D2F6C5
$Header->Operations();
$hipotecas->Operation();
$Footer->Operations();
$fichashipotecas->Operation();
$generacuotas->Operation();
//End Execute Components

//Go to destination page @1-65B7BF1E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($hipotecas);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($fichashipotecas);
    unset($fichashipotecasRO);
    unset($generacuotas);
    unset($deuda);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B55D1D62
$Header->Show();
$hipotecas->Show();
$Footer->Show();
$fichashipotecas->Show();
$fichashipotecasRO->Show();
$generacuotas->Show();
$deuda->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D6A5C779
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($hipotecas);
$Footer->Class_Terminate();
unset($Footer);
unset($fichashipotecas);
unset($fichashipotecasRO);
unset($generacuotas);
unset($deuda);
unset($Tpl);
//End Unload Page


?>
