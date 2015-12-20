<?php
//Include Common Files @1-29E2B536
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
define("FileName", "alquileres_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @18-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordalquileres { //alquileres Class @2-01FE6A1F

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

//Class_Initialize Event @2-734CB6A1
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
            $this->idpropiedad = & new clsControl(ccsListBox, "idpropiedad", "Idpropiedad", ccsInteger, "", CCGetRequestParam("idpropiedad", $Method, NULL), $this);
            $this->idpropiedad->DSType = dsTable;
            $this->idpropiedad->DataSource = new clsDBConnection1();
            $this->idpropiedad->ds = & $this->idpropiedad->DataSource;
            $this->idpropiedad->DataSource->SQL = "SELECT * \n" .
"FROM propiedades {SQL_Where} {SQL_OrderBy}";
            list($this->idpropiedad->BoundColumn, $this->idpropiedad->TextColumn, $this->idpropiedad->DBFormat) = array("idpropiedad", "direccion", "");
            $this->idpropiedad->Required = true;
            $this->idestado = & new clsControl(ccsListBox, "idestado", "Idestado", ccsInteger, "", CCGetRequestParam("idestado", $Method, NULL), $this);
            $this->idestado->DSType = dsTable;
            $this->idestado->DataSource = new clsDBConnection1();
            $this->idestado->ds = & $this->idestado->DataSource;
            $this->idestado->DataSource->SQL = "SELECT * \n" .
"FROM estados {SQL_Where} {SQL_OrderBy}";
            list($this->idestado->BoundColumn, $this->idestado->TextColumn, $this->idestado->DBFormat) = array("idestado", "descripcion", "");
            $this->idestado->Required = true;
            $this->fechainicio = & new clsControl(ccsTextBox, "fechainicio", "Fechainicio", ccsText, "", CCGetRequestParam("fechainicio", $Method, NULL), $this);
            $this->fechafin = & new clsControl(ccsTextBox, "fechafin", "Fechafin", ccsText, "", CCGetRequestParam("fechafin", $Method, NULL), $this);
            $this->ano1 = & new clsControl(ccsTextBox, "ano1", "Ano1", ccsText, "", CCGetRequestParam("ano1", $Method, NULL), $this);
            $this->ano2 = & new clsControl(ccsTextBox, "ano2", "Ano2", ccsText, "", CCGetRequestParam("ano2", $Method, NULL), $this);
            $this->ano3 = & new clsControl(ccsTextBox, "ano3", "Ano3", ccsText, "", CCGetRequestParam("ano3", $Method, NULL), $this);
            $this->porcentajehonorarios = & new clsControl(ccsTextBox, "porcentajehonorarios", "Porcentajehonorarios", ccsText, "", CCGetRequestParam("porcentajehonorarios", $Method, NULL), $this);
            $this->vto = & new clsControl(ccsTextBox, "vto", "Vto", ccsText, "", CCGetRequestParam("vto", $Method, NULL), $this);
            $this->acuerdo = & new clsControl(ccsTextBox, "acuerdo", "Acuerdo", ccsText, "", CCGetRequestParam("acuerdo", $Method, NULL), $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-440B4710
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);
    }
//End Initialize Method

//Validate Method @2-3C209957
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idpropiedad->Validate() && $Validation);
        $Validation = ($this->idestado->Validate() && $Validation);
        $Validation = ($this->fechainicio->Validate() && $Validation);
        $Validation = ($this->fechafin->Validate() && $Validation);
        $Validation = ($this->ano1->Validate() && $Validation);
        $Validation = ($this->ano2->Validate() && $Validation);
        $Validation = ($this->ano3->Validate() && $Validation);
        $Validation = ($this->porcentajehonorarios->Validate() && $Validation);
        $Validation = ($this->vto->Validate() && $Validation);
        $Validation = ($this->acuerdo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idpropiedad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idestado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechainicio->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechafin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ano1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ano2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ano3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->porcentajehonorarios->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vto->Errors->Count() == 0);
        $Validation =  $Validation && ($this->acuerdo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-C54AA183
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idpropiedad->Errors->Count());
        $errors = ($errors || $this->idestado->Errors->Count());
        $errors = ($errors || $this->fechainicio->Errors->Count());
        $errors = ($errors || $this->fechafin->Errors->Count());
        $errors = ($errors || $this->ano1->Errors->Count());
        $errors = ($errors || $this->ano2->Errors->Count());
        $errors = ($errors || $this->ano3->Errors->Count());
        $errors = ($errors || $this->porcentajehonorarios->Errors->Count());
        $errors = ($errors || $this->vto->Errors->Count());
        $errors = ($errors || $this->acuerdo->Errors->Count());
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

//Operation Method @2-A2864C4E
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
        $Redirect = "../alquileres_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-099741D4
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idpropiedad->SetValue($this->idpropiedad->GetValue(true));
        $this->DataSource->idestado->SetValue($this->idestado->GetValue(true));
        $this->DataSource->fechainicio->SetValue($this->fechainicio->GetValue(true));
        $this->DataSource->fechafin->SetValue($this->fechafin->GetValue(true));
        $this->DataSource->ano1->SetValue($this->ano1->GetValue(true));
        $this->DataSource->ano2->SetValue($this->ano2->GetValue(true));
        $this->DataSource->ano3->SetValue($this->ano3->GetValue(true));
        $this->DataSource->porcentajehonorarios->SetValue($this->porcentajehonorarios->GetValue(true));
        $this->DataSource->vto->SetValue($this->vto->GetValue(true));
        $this->DataSource->acuerdo->SetValue($this->acuerdo->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-75B3DB20
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idpropiedad->SetValue($this->idpropiedad->GetValue(true));
        $this->DataSource->idestado->SetValue($this->idestado->GetValue(true));
        $this->DataSource->fechainicio->SetValue($this->fechainicio->GetValue(true));
        $this->DataSource->fechafin->SetValue($this->fechafin->GetValue(true));
        $this->DataSource->ano1->SetValue($this->ano1->GetValue(true));
        $this->DataSource->ano2->SetValue($this->ano2->GetValue(true));
        $this->DataSource->ano3->SetValue($this->ano3->GetValue(true));
        $this->DataSource->porcentajehonorarios->SetValue($this->porcentajehonorarios->GetValue(true));
        $this->DataSource->vto->SetValue($this->vto->GetValue(true));
        $this->DataSource->acuerdo->SetValue($this->acuerdo->GetValue(true));
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

//Show Method @2-8467B4EB
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

        $this->idpropiedad->Prepare();
        $this->idestado->Prepare();

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
                    $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                    $this->ano1->SetValue($this->DataSource->ano1->GetValue());
                    $this->ano2->SetValue($this->DataSource->ano2->GetValue());
                    $this->ano3->SetValue($this->DataSource->ano3->GetValue());
                    $this->porcentajehonorarios->SetValue($this->DataSource->porcentajehonorarios->GetValue());
                    $this->vto->SetValue($this->DataSource->vto->GetValue());
                    $this->acuerdo->SetValue($this->DataSource->acuerdo->GetValue());
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
            $Error = ComposeStrings($Error, $this->fechafin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ano1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ano2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ano3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->porcentajehonorarios->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->acuerdo->Errors->ToString());
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

        $this->idpropiedad->Show();
        $this->idestado->Show();
        $this->fechainicio->Show();
        $this->fechafin->Show();
        $this->ano1->Show();
        $this->ano2->Show();
        $this->ano3->Show();
        $this->porcentajehonorarios->Show();
        $this->vto->Show();
        $this->acuerdo->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End alquileres Class @2-FCB6E20C

class clsalquileresDataSource extends clsDBConnection1 {  //alquileresDataSource Class @2-0F6C066C

//DataSource Variables @2-1EA1CEF3
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
    var $fechafin;
    var $ano1;
    var $ano2;
    var $ano3;
    var $porcentajehonorarios;
    var $vto;
    var $acuerdo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-ADF542C2
    function clsalquileresDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record alquileres/Error";
        $this->Initialize();
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        
        $this->idestado = new clsField("idestado", ccsInteger, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsText, "");
        
        $this->fechafin = new clsField("fechafin", ccsText, "");
        
        $this->ano1 = new clsField("ano1", ccsText, "");
        
        $this->ano2 = new clsField("ano2", ccsText, "");
        
        $this->ano3 = new clsField("ano3", ccsText, "");
        
        $this->porcentajehonorarios = new clsField("porcentajehonorarios", ccsText, "");
        
        $this->vto = new clsField("vto", ccsText, "");
        
        $this->acuerdo = new clsField("acuerdo", ccsText, "");
        

        $this->InsertFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idestado"] = array("Name" => "idestado", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["fechainicio"] = array("Name" => "fechainicio", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fechafin"] = array("Name" => "fechafin", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ano1"] = array("Name" => "ano1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ano2"] = array("Name" => "ano2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ano3"] = array("Name" => "ano3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["porcentajehonorarios"] = array("Name" => "porcentajehonorarios", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["vto"] = array("Name" => "vto", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["acuerdo"] = array("Name" => "acuerdo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idestado"] = array("Name" => "idestado", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechainicio"] = array("Name" => "fechainicio", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechafin"] = array("Name" => "fechafin", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ano1"] = array("Name" => "ano1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ano2"] = array("Name" => "ano2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ano3"] = array("Name" => "ano3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["porcentajehonorarios"] = array("Name" => "porcentajehonorarios", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["vto"] = array("Name" => "vto", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["acuerdo"] = array("Name" => "acuerdo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-EC01CAA7
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

//Open Method @2-F8411C44
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

//SetValues Method @2-5B91BDCD
    function SetValues()
    {
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
        $this->idestado->SetDBValue(trim($this->f("idestado")));
        $this->fechainicio->SetDBValue($this->f("fechainicio"));
        $this->fechafin->SetDBValue($this->f("fechafin"));
        $this->ano1->SetDBValue($this->f("ano1"));
        $this->ano2->SetDBValue($this->f("ano2"));
        $this->ano3->SetDBValue($this->f("ano3"));
        $this->porcentajehonorarios->SetDBValue($this->f("porcentajehonorarios"));
        $this->vto->SetDBValue($this->f("vto"));
        $this->acuerdo->SetDBValue($this->f("acuerdo"));
    }
//End SetValues Method

//Insert Method @2-8560C137
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["idpropiedad"]["Value"] = $this->idpropiedad->GetDBValue(true);
        $this->InsertFields["idestado"]["Value"] = $this->idestado->GetDBValue(true);
        $this->InsertFields["fechainicio"]["Value"] = $this->fechainicio->GetDBValue(true);
        $this->InsertFields["fechafin"]["Value"] = $this->fechafin->GetDBValue(true);
        $this->InsertFields["ano1"]["Value"] = $this->ano1->GetDBValue(true);
        $this->InsertFields["ano2"]["Value"] = $this->ano2->GetDBValue(true);
        $this->InsertFields["ano3"]["Value"] = $this->ano3->GetDBValue(true);
        $this->InsertFields["porcentajehonorarios"]["Value"] = $this->porcentajehonorarios->GetDBValue(true);
        $this->InsertFields["vto"]["Value"] = $this->vto->GetDBValue(true);
        $this->InsertFields["acuerdo"]["Value"] = $this->acuerdo->GetDBValue(true);
        $this->SQL = CCBuildInsert("alquileres", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-DAE7ACE4
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["idpropiedad"]["Value"] = $this->idpropiedad->GetDBValue(true);
        $this->UpdateFields["idestado"]["Value"] = $this->idestado->GetDBValue(true);
        $this->UpdateFields["fechainicio"]["Value"] = $this->fechainicio->GetDBValue(true);
        $this->UpdateFields["fechafin"]["Value"] = $this->fechafin->GetDBValue(true);
        $this->UpdateFields["ano1"]["Value"] = $this->ano1->GetDBValue(true);
        $this->UpdateFields["ano2"]["Value"] = $this->ano2->GetDBValue(true);
        $this->UpdateFields["ano3"]["Value"] = $this->ano3->GetDBValue(true);
        $this->UpdateFields["porcentajehonorarios"]["Value"] = $this->porcentajehonorarios->GetDBValue(true);
        $this->UpdateFields["vto"]["Value"] = $this->vto->GetDBValue(true);
        $this->UpdateFields["acuerdo"]["Value"] = $this->acuerdo->GetDBValue(true);
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

//Delete Method @2-DE87DA60
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM alquileres";
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

} //End alquileresDataSource Class @2-FCB6E20C

//Include Page implementation @19-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-7C089F5E
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
$TemplateFileName = "alquileres_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-ED556AD1
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$alquileres = & new clsRecordalquileres("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->Header = & $Header;
$MainPage->alquileres = & $alquileres;
$MainPage->Footer = & $Footer;
$alquileres->Initialize();

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

//Execute Components @1-D628532A
$Header->Operations();
$alquileres->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-4709BC94
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($alquileres);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F8A0295D
$Header->Show();
$alquileres->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B58F873E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($alquileres);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
