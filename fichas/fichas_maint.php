<?php
//Include Common Files @1-02D40154
define("RelativePath", "..");
define("PathToCurrentPage", "/fichas/");
define("FileName", "fichas_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @30-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordfichas { //fichas Class @2-5BA7C2BC

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

//Class_Initialize Event @2-9FDEF026
    function clsRecordfichas($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record fichas/Error";
        $this->DataSource = new clsfichasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "fichas";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nombre = & new clsControl(ccsTextBox, "nombre", "Nombre", ccsText, "", CCGetRequestParam("nombre", $Method, NULL), $this);
            $this->nombre->Required = true;
            $this->direccion = & new clsControl(ccsTextBox, "direccion", "Direccion", ccsText, "", CCGetRequestParam("direccion", $Method, NULL), $this);
            $this->direccion->Required = true;
            $this->localidad = & new clsControl(ccsTextBox, "localidad", "Localidad", ccsText, "", CCGetRequestParam("localidad", $Method, NULL), $this);
            $this->localidad->Required = true;
            $this->provincia = & new clsControl(ccsListBox, "provincia", "Provincia", ccsInteger, "", CCGetRequestParam("provincia", $Method, NULL), $this);
            $this->provincia->DSType = dsTable;
            $this->provincia->DataSource = new clsDBConnection1();
            $this->provincia->ds = & $this->provincia->DataSource;
            $this->provincia->DataSource->SQL = "SELECT * \n" .
"FROM provincias {SQL_Where} {SQL_OrderBy}";
            list($this->provincia->BoundColumn, $this->provincia->TextColumn, $this->provincia->DBFormat) = array("idprovincia", "desprovincia", "");
            $this->codigopostal = & new clsControl(ccsTextBox, "codigopostal", "Codigopostal", ccsText, "", CCGetRequestParam("codigopostal", $Method, NULL), $this);
            $this->telefono = & new clsControl(ccsTextBox, "telefono", "Telefono", ccsText, "", CCGetRequestParam("telefono", $Method, NULL), $this);
            $this->telefono->Required = true;
            $this->celular = & new clsControl(ccsTextBox, "celular", "Celular", ccsText, "", CCGetRequestParam("celular", $Method, NULL), $this);
            $this->email = & new clsControl(ccsTextBox, "email", "Email", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
            $this->actividad = & new clsControl(ccsTextBox, "actividad", "Actividad", ccsText, "", CCGetRequestParam("actividad", $Method, NULL), $this);
            $this->idtipodocumento = & new clsControl(ccsListBox, "idtipodocumento", "Idtipodocumento", ccsInteger, "", CCGetRequestParam("idtipodocumento", $Method, NULL), $this);
            $this->idtipodocumento->DSType = dsTable;
            $this->idtipodocumento->DataSource = new clsDBConnection1();
            $this->idtipodocumento->ds = & $this->idtipodocumento->DataSource;
            $this->idtipodocumento->DataSource->SQL = "SELECT * \n" .
"FROM tipodocumentos {SQL_Where} {SQL_OrderBy}";
            list($this->idtipodocumento->BoundColumn, $this->idtipodocumento->TextColumn, $this->idtipodocumento->DBFormat) = array("idtipodocumento", "destipodocumento", "");
            $this->idtipodocumento->Required = true;
            $this->tipocont = & new clsControl(ccsListBox, "tipocont", "Tipocont", ccsInteger, "", CCGetRequestParam("tipocont", $Method, NULL), $this);
            $this->tipocont->DSType = dsTable;
            $this->tipocont->DataSource = new clsDBConnection1();
            $this->tipocont->ds = & $this->tipocont->DataSource;
            $this->tipocont->DataSource->SQL = "SELECT * \n" .
"FROM tipocontribuyente {SQL_Where} {SQL_OrderBy}";
            list($this->tipocont->BoundColumn, $this->tipocont->TextColumn, $this->tipocont->DBFormat) = array("idtipocontribuyente", "descripcion", "");
            $this->tipocont->Required = true;
            $this->nrodocumento = & new clsControl(ccsTextBox, "nrodocumento", "Nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", $Method, NULL), $this);
            $this->nrodocumento->Required = true;
            $this->cuit = & new clsControl(ccsTextBox, "cuit", "Cuit", ccsText, "", CCGetRequestParam("cuit", $Method, NULL), $this);
            $this->fechanac = & new clsControl(ccsTextBox, "fechanac", "Fechanac", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechanac", $Method, NULL), $this);
            $this->DatePicker_fechanac = & new clsDatePicker("DatePicker_fechanac", "fichas", "fechanac", $this);
            $this->nacionalidad = & new clsControl(ccsListBox, "nacionalidad", "Nacionalidad", ccsText, "", CCGetRequestParam("nacionalidad", $Method, NULL), $this);
            $this->nacionalidad->DSType = dsTable;
            $this->nacionalidad->DataSource = new clsDBConnection1();
            $this->nacionalidad->ds = & $this->nacionalidad->DataSource;
            $this->nacionalidad->DataSource->SQL = "SELECT * \n" .
"FROM nacionalidad {SQL_Where} {SQL_OrderBy}";
            list($this->nacionalidad->BoundColumn, $this->nacionalidad->TextColumn, $this->nacionalidad->DBFormat) = array("idnacionalidad", "desnacionalidad", "");
            $this->idestadocivil = & new clsControl(ccsListBox, "idestadocivil", "Idestadocivil", ccsInteger, "", CCGetRequestParam("idestadocivil", $Method, NULL), $this);
            $this->idestadocivil->DSType = dsTable;
            $this->idestadocivil->DataSource = new clsDBConnection1();
            $this->idestadocivil->ds = & $this->idestadocivil->DataSource;
            $this->idestadocivil->DataSource->SQL = "SELECT * \n" .
"FROM estadocivil {SQL_Where} {SQL_OrderBy}";
            list($this->idestadocivil->BoundColumn, $this->idestadocivil->TextColumn, $this->idestadocivil->DBFormat) = array("idestadocivil", "desestadocivil", "");
            $this->idestadocivil->Required = true;
            $this->nupcias = & new clsControl(ccsListBox, "nupcias", "Nupcias", ccsText, "", CCGetRequestParam("nupcias", $Method, NULL), $this);
            $this->nupcias->DSType = dsTable;
            $this->nupcias->DataSource = new clsDBConnection1();
            $this->nupcias->ds = & $this->nupcias->DataSource;
            $this->nupcias->DataSource->SQL = "SELECT * \n" .
"FROM nupcias {SQL_Where} {SQL_OrderBy}";
            list($this->nupcias->BoundColumn, $this->nupcias->TextColumn, $this->nupcias->DBFormat) = array("idnupcias", "desnupcias", "");
            $this->conyuge = & new clsControl(ccsTextBox, "conyuge", "Conyuge", ccsText, "", CCGetRequestParam("conyuge", $Method, NULL), $this);
            $this->padre = & new clsControl(ccsTextBox, "padre", "Padre", ccsText, "", CCGetRequestParam("padre", $Method, NULL), $this);
            $this->madre = & new clsControl(ccsTextBox, "madre", "Madre", ccsText, "", CCGetRequestParam("madre", $Method, NULL), $this);
            $this->observaciones = & new clsControl(ccsTextArea, "observaciones", "Observaciones", ccsText, "", CCGetRequestParam("observaciones", $Method, NULL), $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->localidad->Value) && !strlen($this->localidad->Value) && $this->localidad->Value !== false)
                    $this->localidad->SetText("C.A.B.A.");
                if(!is_array($this->provincia->Value) && !strlen($this->provincia->Value) && $this->provincia->Value !== false)
                    $this->provincia->SetText(3);
                if(!is_array($this->idtipodocumento->Value) && !strlen($this->idtipodocumento->Value) && $this->idtipodocumento->Value !== false)
                    $this->idtipodocumento->SetText(1);
                if(!is_array($this->tipocont->Value) && !strlen($this->tipocont->Value) && $this->tipocont->Value !== false)
                    $this->tipocont->SetText(1);
                if(!is_array($this->idestadocivil->Value) && !strlen($this->idestadocivil->Value) && $this->idestadocivil->Value !== false)
                    $this->idestadocivil->SetText(2);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-EBC7A879
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidficha"] = CCGetFromGet("idficha", NULL);
    }
//End Initialize Method

//Validate Method @2-18C00105
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->nombre->Validate() && $Validation);
        $Validation = ($this->direccion->Validate() && $Validation);
        $Validation = ($this->localidad->Validate() && $Validation);
        $Validation = ($this->provincia->Validate() && $Validation);
        $Validation = ($this->codigopostal->Validate() && $Validation);
        $Validation = ($this->telefono->Validate() && $Validation);
        $Validation = ($this->celular->Validate() && $Validation);
        $Validation = ($this->email->Validate() && $Validation);
        $Validation = ($this->actividad->Validate() && $Validation);
        $Validation = ($this->idtipodocumento->Validate() && $Validation);
        $Validation = ($this->tipocont->Validate() && $Validation);
        $Validation = ($this->nrodocumento->Validate() && $Validation);
        $Validation = ($this->cuit->Validate() && $Validation);
        $Validation = ($this->fechanac->Validate() && $Validation);
        $Validation = ($this->nacionalidad->Validate() && $Validation);
        $Validation = ($this->idestadocivil->Validate() && $Validation);
        $Validation = ($this->nupcias->Validate() && $Validation);
        $Validation = ($this->conyuge->Validate() && $Validation);
        $Validation = ($this->padre->Validate() && $Validation);
        $Validation = ($this->madre->Validate() && $Validation);
        $Validation = ($this->observaciones->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nombre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->direccion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->localidad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->provincia->Errors->Count() == 0);
        $Validation =  $Validation && ($this->codigopostal->Errors->Count() == 0);
        $Validation =  $Validation && ($this->telefono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->celular->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->actividad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idtipodocumento->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tipocont->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nrodocumento->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cuit->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fechanac->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nacionalidad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idestadocivil->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nupcias->Errors->Count() == 0);
        $Validation =  $Validation && ($this->conyuge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->padre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->madre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->observaciones->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-182C3E7F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nombre->Errors->Count());
        $errors = ($errors || $this->direccion->Errors->Count());
        $errors = ($errors || $this->localidad->Errors->Count());
        $errors = ($errors || $this->provincia->Errors->Count());
        $errors = ($errors || $this->codigopostal->Errors->Count());
        $errors = ($errors || $this->telefono->Errors->Count());
        $errors = ($errors || $this->celular->Errors->Count());
        $errors = ($errors || $this->email->Errors->Count());
        $errors = ($errors || $this->actividad->Errors->Count());
        $errors = ($errors || $this->idtipodocumento->Errors->Count());
        $errors = ($errors || $this->tipocont->Errors->Count());
        $errors = ($errors || $this->nrodocumento->Errors->Count());
        $errors = ($errors || $this->cuit->Errors->Count());
        $errors = ($errors || $this->fechanac->Errors->Count());
        $errors = ($errors || $this->DatePicker_fechanac->Errors->Count());
        $errors = ($errors || $this->nacionalidad->Errors->Count());
        $errors = ($errors || $this->idestadocivil->Errors->Count());
        $errors = ($errors || $this->nupcias->Errors->Count());
        $errors = ($errors || $this->conyuge->Errors->Count());
        $errors = ($errors || $this->padre->Errors->Count());
        $errors = ($errors || $this->madre->Errors->Count());
        $errors = ($errors || $this->observaciones->Errors->Count());
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

//Operation Method @2-A225E0B7
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
        $Redirect = "fichas_maint.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-9BEC9181
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->nombre->SetValue($this->nombre->GetValue(true));
        $this->DataSource->direccion->SetValue($this->direccion->GetValue(true));
        $this->DataSource->localidad->SetValue($this->localidad->GetValue(true));
        $this->DataSource->provincia->SetValue($this->provincia->GetValue(true));
        $this->DataSource->codigopostal->SetValue($this->codigopostal->GetValue(true));
        $this->DataSource->telefono->SetValue($this->telefono->GetValue(true));
        $this->DataSource->celular->SetValue($this->celular->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->actividad->SetValue($this->actividad->GetValue(true));
        $this->DataSource->idtipodocumento->SetValue($this->idtipodocumento->GetValue(true));
        $this->DataSource->tipocont->SetValue($this->tipocont->GetValue(true));
        $this->DataSource->nrodocumento->SetValue($this->nrodocumento->GetValue(true));
        $this->DataSource->cuit->SetValue($this->cuit->GetValue(true));
        $this->DataSource->fechanac->SetValue($this->fechanac->GetValue(true));
        $this->DataSource->nacionalidad->SetValue($this->nacionalidad->GetValue(true));
        $this->DataSource->idestadocivil->SetValue($this->idestadocivil->GetValue(true));
        $this->DataSource->nupcias->SetValue($this->nupcias->GetValue(true));
        $this->DataSource->conyuge->SetValue($this->conyuge->GetValue(true));
        $this->DataSource->padre->SetValue($this->padre->GetValue(true));
        $this->DataSource->madre->SetValue($this->madre->GetValue(true));
        $this->DataSource->observaciones->SetValue($this->observaciones->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-A631BACE
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nombre->SetValue($this->nombre->GetValue(true));
        $this->DataSource->direccion->SetValue($this->direccion->GetValue(true));
        $this->DataSource->localidad->SetValue($this->localidad->GetValue(true));
        $this->DataSource->provincia->SetValue($this->provincia->GetValue(true));
        $this->DataSource->codigopostal->SetValue($this->codigopostal->GetValue(true));
        $this->DataSource->telefono->SetValue($this->telefono->GetValue(true));
        $this->DataSource->celular->SetValue($this->celular->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->actividad->SetValue($this->actividad->GetValue(true));
        $this->DataSource->idtipodocumento->SetValue($this->idtipodocumento->GetValue(true));
        $this->DataSource->tipocont->SetValue($this->tipocont->GetValue(true));
        $this->DataSource->nrodocumento->SetValue($this->nrodocumento->GetValue(true));
        $this->DataSource->cuit->SetValue($this->cuit->GetValue(true));
        $this->DataSource->fechanac->SetValue($this->fechanac->GetValue(true));
        $this->DataSource->nacionalidad->SetValue($this->nacionalidad->GetValue(true));
        $this->DataSource->idestadocivil->SetValue($this->idestadocivil->GetValue(true));
        $this->DataSource->nupcias->SetValue($this->nupcias->GetValue(true));
        $this->DataSource->conyuge->SetValue($this->conyuge->GetValue(true));
        $this->DataSource->padre->SetValue($this->padre->GetValue(true));
        $this->DataSource->madre->SetValue($this->madre->GetValue(true));
        $this->DataSource->observaciones->SetValue($this->observaciones->GetValue(true));
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

//Show Method @2-B1F8059A
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

        $this->provincia->Prepare();
        $this->idtipodocumento->Prepare();
        $this->tipocont->Prepare();
        $this->nacionalidad->Prepare();
        $this->idestadocivil->Prepare();
        $this->nupcias->Prepare();

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
                    $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                    $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                    $this->localidad->SetValue($this->DataSource->localidad->GetValue());
                    $this->provincia->SetValue($this->DataSource->provincia->GetValue());
                    $this->codigopostal->SetValue($this->DataSource->codigopostal->GetValue());
                    $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                    $this->celular->SetValue($this->DataSource->celular->GetValue());
                    $this->email->SetValue($this->DataSource->email->GetValue());
                    $this->actividad->SetValue($this->DataSource->actividad->GetValue());
                    $this->idtipodocumento->SetValue($this->DataSource->idtipodocumento->GetValue());
                    $this->tipocont->SetValue($this->DataSource->tipocont->GetValue());
                    $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                    $this->cuit->SetValue($this->DataSource->cuit->GetValue());
                    $this->fechanac->SetValue($this->DataSource->fechanac->GetValue());
                    $this->nacionalidad->SetValue($this->DataSource->nacionalidad->GetValue());
                    $this->idestadocivil->SetValue($this->DataSource->idestadocivil->GetValue());
                    $this->nupcias->SetValue($this->DataSource->nupcias->GetValue());
                    $this->conyuge->SetValue($this->DataSource->conyuge->GetValue());
                    $this->padre->SetValue($this->DataSource->padre->GetValue());
                    $this->madre->SetValue($this->DataSource->madre->GetValue());
                    $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nombre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->direccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->localidad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->provincia->Errors->ToString());
            $Error = ComposeStrings($Error, $this->codigopostal->Errors->ToString());
            $Error = ComposeStrings($Error, $this->telefono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->celular->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->actividad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idtipodocumento->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tipocont->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nrodocumento->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cuit->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fechanac->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_fechanac->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nacionalidad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idestadocivil->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nupcias->Errors->ToString());
            $Error = ComposeStrings($Error, $this->conyuge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->padre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->madre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->observaciones->Errors->ToString());
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

        $this->nombre->Show();
        $this->direccion->Show();
        $this->localidad->Show();
        $this->provincia->Show();
        $this->codigopostal->Show();
        $this->telefono->Show();
        $this->celular->Show();
        $this->email->Show();
        $this->actividad->Show();
        $this->idtipodocumento->Show();
        $this->tipocont->Show();
        $this->nrodocumento->Show();
        $this->cuit->Show();
        $this->fechanac->Show();
        $this->DatePicker_fechanac->Show();
        $this->nacionalidad->Show();
        $this->idestadocivil->Show();
        $this->nupcias->Show();
        $this->conyuge->Show();
        $this->padre->Show();
        $this->madre->Show();
        $this->observaciones->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End fichas Class @2-FCB6E20C

class clsfichasDataSource extends clsDBConnection1 {  //fichasDataSource Class @2-05DD9D51

//DataSource Variables @2-D7DD1FF3
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
    var $nombre;
    var $direccion;
    var $localidad;
    var $provincia;
    var $codigopostal;
    var $telefono;
    var $celular;
    var $email;
    var $actividad;
    var $idtipodocumento;
    var $tipocont;
    var $nrodocumento;
    var $cuit;
    var $fechanac;
    var $nacionalidad;
    var $idestadocivil;
    var $nupcias;
    var $conyuge;
    var $padre;
    var $madre;
    var $observaciones;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FCDF98B1
    function clsfichasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record fichas/Error";
        $this->Initialize();
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->localidad = new clsField("localidad", ccsText, "");
        
        $this->provincia = new clsField("provincia", ccsInteger, "");
        
        $this->codigopostal = new clsField("codigopostal", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->celular = new clsField("celular", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->actividad = new clsField("actividad", ccsText, "");
        
        $this->idtipodocumento = new clsField("idtipodocumento", ccsInteger, "");
        
        $this->tipocont = new clsField("tipocont", ccsInteger, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->cuit = new clsField("cuit", ccsText, "");
        
        $this->fechanac = new clsField("fechanac", ccsDate, $this->DateFormat);
        
        $this->nacionalidad = new clsField("nacionalidad", ccsText, "");
        
        $this->idestadocivil = new clsField("idestadocivil", ccsInteger, "");
        
        $this->nupcias = new clsField("nupcias", ccsText, "");
        
        $this->conyuge = new clsField("conyuge", ccsText, "");
        
        $this->padre = new clsField("padre", ccsText, "");
        
        $this->madre = new clsField("madre", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        

        $this->InsertFields["nombre"] = array("Name" => "nombre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["direccion"] = array("Name" => "direccion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["localidad"] = array("Name" => "localidad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["provincia"] = array("Name" => "provincia", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["codigopostal"] = array("Name" => "codigopostal", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["telefono"] = array("Name" => "telefono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["celular"] = array("Name" => "celular", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["actividad"] = array("Name" => "actividad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["idtipodocumento"] = array("Name" => "idtipodocumento", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["idtipocontribuyente"] = array("Name" => "idtipocontribuyente", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nrodocumento"] = array("Name" => "nrodocumento", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cuit"] = array("Name" => "cuit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fechanac"] = array("Name" => "fechanac", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["nacionalidad"] = array("Name" => "nacionalidad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["idestadocivil"] = array("Name" => "idestadocivil", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nupcias"] = array("Name" => "nupcias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["conyuge"] = array("Name" => "conyuge", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["padre"] = array("Name" => "padre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["madre"] = array("Name" => "madre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["observaciones"] = array("Name" => "observaciones", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nombre"] = array("Name" => "nombre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["direccion"] = array("Name" => "direccion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["localidad"] = array("Name" => "localidad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["provincia"] = array("Name" => "provincia", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["codigopostal"] = array("Name" => "codigopostal", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["telefono"] = array("Name" => "telefono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["celular"] = array("Name" => "celular", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["actividad"] = array("Name" => "actividad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idtipodocumento"] = array("Name" => "idtipodocumento", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idtipocontribuyente"] = array("Name" => "idtipocontribuyente", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nrodocumento"] = array("Name" => "nrodocumento", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cuit"] = array("Name" => "cuit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fechanac"] = array("Name" => "fechanac", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["nacionalidad"] = array("Name" => "nacionalidad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["idestadocivil"] = array("Name" => "idestadocivil", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nupcias"] = array("Name" => "nupcias", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["conyuge"] = array("Name" => "conyuge", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["padre"] = array("Name" => "padre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["madre"] = array("Name" => "madre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["observaciones"] = array("Name" => "observaciones", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-43EC2572
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidficha", ccsInteger, "", "", $this->Parameters["urlidficha"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idficha", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-803EE292
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM fichas {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9B99ED4A
    function SetValues()
    {
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->localidad->SetDBValue($this->f("localidad"));
        $this->provincia->SetDBValue(trim($this->f("provincia")));
        $this->codigopostal->SetDBValue($this->f("codigopostal"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->celular->SetDBValue($this->f("celular"));
        $this->email->SetDBValue($this->f("email"));
        $this->actividad->SetDBValue($this->f("actividad"));
        $this->idtipodocumento->SetDBValue(trim($this->f("idtipodocumento")));
        $this->tipocont->SetDBValue(trim($this->f("idtipocontribuyente")));
        $this->nrodocumento->SetDBValue($this->f("nrodocumento"));
        $this->cuit->SetDBValue($this->f("cuit"));
        $this->fechanac->SetDBValue(trim($this->f("fechanac")));
        $this->nacionalidad->SetDBValue($this->f("nacionalidad"));
        $this->idestadocivil->SetDBValue(trim($this->f("idestadocivil")));
        $this->nupcias->SetDBValue($this->f("nupcias"));
        $this->conyuge->SetDBValue($this->f("conyuge"));
        $this->padre->SetDBValue($this->f("padre"));
        $this->madre->SetDBValue($this->f("madre"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
    }
//End SetValues Method

//Insert Method @2-F4FDFA60
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["nombre"]["Value"] = $this->nombre->GetDBValue(true);
        $this->InsertFields["direccion"]["Value"] = $this->direccion->GetDBValue(true);
        $this->InsertFields["localidad"]["Value"] = $this->localidad->GetDBValue(true);
        $this->InsertFields["provincia"]["Value"] = $this->provincia->GetDBValue(true);
        $this->InsertFields["codigopostal"]["Value"] = $this->codigopostal->GetDBValue(true);
        $this->InsertFields["telefono"]["Value"] = $this->telefono->GetDBValue(true);
        $this->InsertFields["celular"]["Value"] = $this->celular->GetDBValue(true);
        $this->InsertFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->InsertFields["actividad"]["Value"] = $this->actividad->GetDBValue(true);
        $this->InsertFields["idtipodocumento"]["Value"] = $this->idtipodocumento->GetDBValue(true);
        $this->InsertFields["idtipocontribuyente"]["Value"] = $this->tipocont->GetDBValue(true);
        $this->InsertFields["nrodocumento"]["Value"] = $this->nrodocumento->GetDBValue(true);
        $this->InsertFields["cuit"]["Value"] = $this->cuit->GetDBValue(true);
        $this->InsertFields["fechanac"]["Value"] = $this->fechanac->GetDBValue(true);
        $this->InsertFields["nacionalidad"]["Value"] = $this->nacionalidad->GetDBValue(true);
        $this->InsertFields["idestadocivil"]["Value"] = $this->idestadocivil->GetDBValue(true);
        $this->InsertFields["nupcias"]["Value"] = $this->nupcias->GetDBValue(true);
        $this->InsertFields["conyuge"]["Value"] = $this->conyuge->GetDBValue(true);
        $this->InsertFields["padre"]["Value"] = $this->padre->GetDBValue(true);
        $this->InsertFields["madre"]["Value"] = $this->madre->GetDBValue(true);
        $this->InsertFields["observaciones"]["Value"] = $this->observaciones->GetDBValue(true);
        $this->SQL = CCBuildInsert("fichas", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-82A4C5DF
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["nombre"]["Value"] = $this->nombre->GetDBValue(true);
        $this->UpdateFields["direccion"]["Value"] = $this->direccion->GetDBValue(true);
        $this->UpdateFields["localidad"]["Value"] = $this->localidad->GetDBValue(true);
        $this->UpdateFields["provincia"]["Value"] = $this->provincia->GetDBValue(true);
        $this->UpdateFields["codigopostal"]["Value"] = $this->codigopostal->GetDBValue(true);
        $this->UpdateFields["telefono"]["Value"] = $this->telefono->GetDBValue(true);
        $this->UpdateFields["celular"]["Value"] = $this->celular->GetDBValue(true);
        $this->UpdateFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->UpdateFields["actividad"]["Value"] = $this->actividad->GetDBValue(true);
        $this->UpdateFields["idtipodocumento"]["Value"] = $this->idtipodocumento->GetDBValue(true);
        $this->UpdateFields["idtipocontribuyente"]["Value"] = $this->tipocont->GetDBValue(true);
        $this->UpdateFields["nrodocumento"]["Value"] = $this->nrodocumento->GetDBValue(true);
        $this->UpdateFields["cuit"]["Value"] = $this->cuit->GetDBValue(true);
        $this->UpdateFields["fechanac"]["Value"] = $this->fechanac->GetDBValue(true);
        $this->UpdateFields["nacionalidad"]["Value"] = $this->nacionalidad->GetDBValue(true);
        $this->UpdateFields["idestadocivil"]["Value"] = $this->idestadocivil->GetDBValue(true);
        $this->UpdateFields["nupcias"]["Value"] = $this->nupcias->GetDBValue(true);
        $this->UpdateFields["conyuge"]["Value"] = $this->conyuge->GetDBValue(true);
        $this->UpdateFields["padre"]["Value"] = $this->padre->GetDBValue(true);
        $this->UpdateFields["madre"]["Value"] = $this->madre->GetDBValue(true);
        $this->UpdateFields["observaciones"]["Value"] = $this->observaciones->GetDBValue(true);
        $this->SQL = CCBuildUpdate("fichas", $this->UpdateFields, $this);
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

//Delete Method @2-9B578BBC
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM fichas";
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

} //End fichasDataSource Class @2-FCB6E20C

//Include Page implementation @31-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-A1CF0AC2
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
$TemplateFileName = "fichas_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-488F62EA
include_once("./fichas_maint_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-44C34999
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$fichas = & new clsRecordfichas("", $MainPage);
$Panel1 = & new clsPanel("Panel1", $MainPage);
$Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Parameters = CCAddParam($Link1->Parameters, "idficha", CCGetFromGet("idficha", NULL));
$Link1->Page = "../propiedades/propiedades_list_ficha.php";
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->Header = & $Header;
$MainPage->fichas = & $fichas;
$MainPage->Panel1 = & $Panel1;
$MainPage->Link1 = & $Link1;
$MainPage->Footer = & $Footer;
$Panel1->AddComponent("Link1", $Link1);
$fichas->Initialize();

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

//Execute Components @1-7E527E6F
$Header->Operations();
$fichas->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-45F31712
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($fichas);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D6C6B9E3
$Header->Show();
$fichas->Show();
$Footer->Show();
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B19E7A14
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($fichas);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
