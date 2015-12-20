<?php
//Include Common Files @1-1C98B41D
define("RelativePath", "..");
define("PathToCurrentPage", "/propiedades/");
define("FileName", "propiedades_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpropiedades { //propiedades Class @2-915B4767

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

//Class_Initialize Event @2-F302BE14
    function clsRecordpropiedades($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record propiedades/Error";
        $this->DataSource = new clspropiedadesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "propiedades";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->direccion = & new clsControl(ccsTextBox, "direccion", "Direccion", ccsText, "", CCGetRequestParam("direccion", $Method, NULL), $this);
            $this->localidad = & new clsControl(ccsTextBox, "localidad", "Localidad", ccsText, "", CCGetRequestParam("localidad", $Method, NULL), $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->telefono = & new clsControl(ccsTextBox, "telefono", "Telefono", ccsText, "", CCGetRequestParam("telefono", $Method, NULL), $this);
            $this->codigopostal = & new clsControl(ccsTextBox, "codigopostal", "Codigopostal", ccsText, "", CCGetRequestParam("codigopostal", $Method, NULL), $this);
            $this->idtipopropiedad = & new clsControl(ccsListBox, "idtipopropiedad", "Idtipopropiedad", ccsInteger, "", CCGetRequestParam("idtipopropiedad", $Method, NULL), $this);
            $this->idtipopropiedad->DSType = dsTable;
            $this->idtipopropiedad->DataSource = new clsDBConnection1();
            $this->idtipopropiedad->ds = & $this->idtipopropiedad->DataSource;
            $this->idtipopropiedad->DataSource->SQL = "SELECT * \n" .
"FROM tipopropiedades {SQL_Where} {SQL_OrderBy}";
            list($this->idtipopropiedad->BoundColumn, $this->idtipopropiedad->TextColumn, $this->idtipopropiedad->DBFormat) = array("idtipopropiedad", "destipopropiedad", "");
            $this->idtipopropiedad->Required = true;
            $this->cantocup = & new clsControl(ccsTextBox, "cantocup", "Cantocup", ccsText, "", CCGetRequestParam("cantocup", $Method, NULL), $this);
            $this->estado = & new clsControl(ccsListBox, "estado", "estado", ccsText, "", CCGetRequestParam("estado", $Method, NULL), $this);
            $this->estado->DSType = dsTable;
            $this->estado->DataSource = new clsDBConnection1();
            $this->estado->ds = & $this->estado->DataSource;
            $this->estado->DataSource->SQL = "SELECT * \n" .
"FROM estadospropiedades {SQL_Where} {SQL_OrderBy}";
            list($this->estado->BoundColumn, $this->estado->TextColumn, $this->estado->DBFormat) = array("idestado", "descripcion", "");
            $this->administ = & new clsControl(ccsTextBox, "administ", "Administ", ccsText, "", CCGetRequestParam("administ", $Method, NULL), $this);
            $this->idficha = & new clsControl(ccsHidden, "idficha", "idficha", ccsInteger, "", CCGetRequestParam("idficha", $Method, NULL), $this);
            $this->idpropiedad = & new clsControl(ccsHidden, "idpropiedad", "idpropiedad", ccsInteger, "", CCGetRequestParam("idpropiedad", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->localidad->Value) && !strlen($this->localidad->Value) && $this->localidad->Value !== false)
                    $this->localidad->SetText("C.A.B.A.");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-FA0F87DA
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlidpropiedad"] = CCGetFromGet("idpropiedad", NULL);
    }
//End Initialize Method

//Validate Method @2-0C1BC985
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->direccion->Validate() && $Validation);
        $Validation = ($this->localidad->Validate() && $Validation);
        $Validation = ($this->telefono->Validate() && $Validation);
        $Validation = ($this->codigopostal->Validate() && $Validation);
        $Validation = ($this->idtipopropiedad->Validate() && $Validation);
        $Validation = ($this->cantocup->Validate() && $Validation);
        $Validation = ($this->estado->Validate() && $Validation);
        $Validation = ($this->administ->Validate() && $Validation);
        $Validation = ($this->idficha->Validate() && $Validation);
        $Validation = ($this->idpropiedad->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->direccion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->localidad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->telefono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->codigopostal->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idtipopropiedad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cantocup->Errors->Count() == 0);
        $Validation =  $Validation && ($this->estado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->administ->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idficha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idpropiedad->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-AF3A8BC3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->direccion->Errors->Count());
        $errors = ($errors || $this->localidad->Errors->Count());
        $errors = ($errors || $this->telefono->Errors->Count());
        $errors = ($errors || $this->codigopostal->Errors->Count());
        $errors = ($errors || $this->idtipopropiedad->Errors->Count());
        $errors = ($errors || $this->cantocup->Errors->Count());
        $errors = ($errors || $this->estado->Errors->Count());
        $errors = ($errors || $this->administ->Errors->Count());
        $errors = ($errors || $this->idficha->Errors->Count());
        $errors = ($errors || $this->idpropiedad->Errors->Count());
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

//Operation Method @2-AC173822
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
        $Redirect = "propiedades_maint.php" . "?" . CCGetQueryString("All", array("ccsForm"));
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

//InsertRow Method @2-2B6A5BEC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-92E06AB0
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
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

//Show Method @2-D8D02FF7
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

        $this->idtipopropiedad->Prepare();
        $this->estado->Prepare();

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
                    $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                    $this->localidad->SetValue($this->DataSource->localidad->GetValue());
                    $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                    $this->codigopostal->SetValue($this->DataSource->codigopostal->GetValue());
                    $this->idtipopropiedad->SetValue($this->DataSource->idtipopropiedad->GetValue());
                    $this->cantocup->SetValue($this->DataSource->cantocup->GetValue());
                    $this->estado->SetValue($this->DataSource->estado->GetValue());
                    $this->administ->SetValue($this->DataSource->administ->GetValue());
                    $this->idpropiedad->SetValue($this->DataSource->idpropiedad->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->direccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->localidad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->telefono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->codigopostal->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idtipopropiedad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cantocup->Errors->ToString());
            $Error = ComposeStrings($Error, $this->estado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->administ->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idficha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idpropiedad->Errors->ToString());
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

        $this->direccion->Show();
        $this->localidad->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->telefono->Show();
        $this->codigopostal->Show();
        $this->idtipopropiedad->Show();
        $this->cantocup->Show();
        $this->estado->Show();
        $this->administ->Show();
        $this->idficha->Show();
        $this->idpropiedad->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End propiedades Class @2-FCB6E20C

class clspropiedadesDataSource extends clsDBConnection1 {  //propiedadesDataSource Class @2-0FC356A5

//DataSource Variables @2-291FFE2D
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


    // Datasource fields
    var $direccion;
    var $localidad;
    var $telefono;
    var $codigopostal;
    var $idtipopropiedad;
    var $cantocup;
    var $estado;
    var $administ;
    var $idficha;
    var $idpropiedad;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-557A8F96
    function clspropiedadesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record propiedades/Error";
        $this->Initialize();
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->localidad = new clsField("localidad", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->codigopostal = new clsField("codigopostal", ccsText, "");
        
        $this->idtipopropiedad = new clsField("idtipopropiedad", ccsInteger, "");
        
        $this->cantocup = new clsField("cantocup", ccsText, "");
        
        $this->estado = new clsField("estado", ccsText, "");
        
        $this->administ = new clsField("administ", ccsText, "");
        
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-A4374F27
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidpropiedad", ccsInteger, "", "", $this->Parameters["urlidpropiedad"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idpropiedad", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-7AAA4574
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM propiedades {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-EFBAAD79
    function SetValues()
    {
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->localidad->SetDBValue($this->f("localidad"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->codigopostal->SetDBValue($this->f("codigopostal"));
        $this->idtipopropiedad->SetDBValue(trim($this->f("idtipopropiedad")));
        $this->cantocup->SetDBValue($this->f("cantocup"));
        $this->estado->SetDBValue($this->f("estado"));
        $this->administ->SetDBValue($this->f("administ"));
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
    }
//End SetValues Method

//Insert Method @2-77BCFDB4
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idficha"] = new clsSQLParameter("postidficha", ccsInteger, "", "", CCGetFromPost("idficha", NULL), "", false, $this->ErrorBlock);
        $this->cp["idpropiedad"] = new clsSQLParameter("postidpropiedad", ccsInteger, "", "", CCGetFromPost("idpropiedad", NULL), "", false, $this->ErrorBlock);
        $this->cp["idtipopropiedad"] = new clsSQLParameter("postidtipopropiedad", ccsInteger, "", "", CCGetFromPost("idtipopropiedad", NULL), "", false, $this->ErrorBlock);
        $this->cp["direccion"] = new clsSQLParameter("postdireccion", ccsText, "", "", CCGetFromPost("direccion", NULL), "", false, $this->ErrorBlock);
        $this->cp["localidad"] = new clsSQLParameter("postlocalidad", ccsText, "", "", CCGetFromPost("localidad", NULL), "", false, $this->ErrorBlock);
        $this->cp["telefono"] = new clsSQLParameter("posttelefono", ccsText, "", "", CCGetFromPost("telefono", NULL), "", false, $this->ErrorBlock);
        $this->cp["codigopostal"] = new clsSQLParameter("postcodigopostal", ccsText, "", "", CCGetFromPost("codigopostal", NULL), "", false, $this->ErrorBlock);
        $this->cp["entre"] = new clsSQLParameter("postentre", ccsText, "", "", CCGetFromPost("entre", NULL), "", false, $this->ErrorBlock);
        $this->cp["cantocup"] = new clsSQLParameter("postcantocup", ccsText, "", "", CCGetFromPost("cantocup", NULL), "", false, $this->ErrorBlock);
        $this->cp["estado"] = new clsSQLParameter("postestado", ccsText, "", "", CCGetFromPost("estado", NULL), "", false, $this->ErrorBlock);
        $this->cp["administ"] = new clsSQLParameter("postadminist", ccsText, "", "", CCGetFromPost("administ", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["RETURN_VALUE"]->GetValue()) and !strlen($this->cp["RETURN_VALUE"]->GetText()) and !is_bool($this->cp["RETURN_VALUE"]->GetValue())) 
            $this->cp["RETURN_VALUE"]->SetText(CCGetFromGet("RETURN_VALUE", NULL));
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetText(CCGetFromPost("idficha", NULL));
        if (!is_null($this->cp["idpropiedad"]->GetValue()) and !strlen($this->cp["idpropiedad"]->GetText()) and !is_bool($this->cp["idpropiedad"]->GetValue())) 
            $this->cp["idpropiedad"]->SetText(CCGetFromPost("idpropiedad", NULL));
        if (!is_null($this->cp["idtipopropiedad"]->GetValue()) and !strlen($this->cp["idtipopropiedad"]->GetText()) and !is_bool($this->cp["idtipopropiedad"]->GetValue())) 
            $this->cp["idtipopropiedad"]->SetText(CCGetFromPost("idtipopropiedad", NULL));
        if (!is_null($this->cp["direccion"]->GetValue()) and !strlen($this->cp["direccion"]->GetText()) and !is_bool($this->cp["direccion"]->GetValue())) 
            $this->cp["direccion"]->SetText(CCGetFromPost("direccion", NULL));
        if (!is_null($this->cp["localidad"]->GetValue()) and !strlen($this->cp["localidad"]->GetText()) and !is_bool($this->cp["localidad"]->GetValue())) 
            $this->cp["localidad"]->SetText(CCGetFromPost("localidad", NULL));
        if (!is_null($this->cp["telefono"]->GetValue()) and !strlen($this->cp["telefono"]->GetText()) and !is_bool($this->cp["telefono"]->GetValue())) 
            $this->cp["telefono"]->SetText(CCGetFromPost("telefono", NULL));
        if (!is_null($this->cp["codigopostal"]->GetValue()) and !strlen($this->cp["codigopostal"]->GetText()) and !is_bool($this->cp["codigopostal"]->GetValue())) 
            $this->cp["codigopostal"]->SetText(CCGetFromPost("codigopostal", NULL));
        if (!is_null($this->cp["entre"]->GetValue()) and !strlen($this->cp["entre"]->GetText()) and !is_bool($this->cp["entre"]->GetValue())) 
            $this->cp["entre"]->SetText(CCGetFromPost("entre", NULL));
        if (!is_null($this->cp["cantocup"]->GetValue()) and !strlen($this->cp["cantocup"]->GetText()) and !is_bool($this->cp["cantocup"]->GetValue())) 
            $this->cp["cantocup"]->SetText(CCGetFromPost("cantocup", NULL));
        if (!is_null($this->cp["estado"]->GetValue()) and !strlen($this->cp["estado"]->GetText()) and !is_bool($this->cp["estado"]->GetValue())) 
            $this->cp["estado"]->SetText(CCGetFromPost("estado", NULL));
        if (!is_null($this->cp["administ"]->GetValue()) and !strlen($this->cp["administ"]->GetText()) and !is_bool($this->cp["administ"]->GetValue())) 
            $this->cp["administ"]->SetText(CCGetFromPost("administ", NULL));
        $this->SQL = "EXEC SP_GUARDA_PROPIEDAD " . $this->ToSQL($this->cp["idficha"]->GetDBValue(), $this->cp["idficha"]->DataType) . ", "
             . $this->ToSQL($this->cp["idpropiedad"]->GetDBValue(), $this->cp["idpropiedad"]->DataType) . ", "
             . $this->ToSQL($this->cp["idtipopropiedad"]->GetDBValue(), $this->cp["idtipopropiedad"]->DataType) . ", "
             . $this->ToSQL($this->cp["direccion"]->GetDBValue(), $this->cp["direccion"]->DataType) . ", "
             . $this->ToSQL($this->cp["localidad"]->GetDBValue(), $this->cp["localidad"]->DataType) . ", "
             . $this->ToSQL($this->cp["telefono"]->GetDBValue(), $this->cp["telefono"]->DataType) . ", "
             . $this->ToSQL($this->cp["codigopostal"]->GetDBValue(), $this->cp["codigopostal"]->DataType) . ", "
             . $this->ToSQL($this->cp["entre"]->GetDBValue(), $this->cp["entre"]->DataType) . ", "
             . $this->ToSQL($this->cp["cantocup"]->GetDBValue(), $this->cp["cantocup"]->DataType) . ", "
             . $this->ToSQL($this->cp["estado"]->GetDBValue(), $this->cp["estado"]->DataType) . ", "
             . $this->ToSQL($this->cp["administ"]->GetDBValue(), $this->cp["administ"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-49DDF646
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idficha"] = new clsSQLParameter("postidficha", ccsInteger, "", "", CCGetFromPost("idficha", NULL), "", false, $this->ErrorBlock);
        $this->cp["idpropiedad"] = new clsSQLParameter("postidpropiedad", ccsInteger, "", "", CCGetFromPost("idpropiedad", NULL), "", false, $this->ErrorBlock);
        $this->cp["idtipopropiedad"] = new clsSQLParameter("postidtipopropiedad", ccsInteger, "", "", CCGetFromPost("idtipopropiedad", NULL), "", false, $this->ErrorBlock);
        $this->cp["direccion"] = new clsSQLParameter("postdireccion", ccsText, "", "", CCGetFromPost("direccion", NULL), "", false, $this->ErrorBlock);
        $this->cp["localidad"] = new clsSQLParameter("postlocalidad", ccsText, "", "", CCGetFromPost("localidad", NULL), "", false, $this->ErrorBlock);
        $this->cp["telefono"] = new clsSQLParameter("posttelefono", ccsText, "", "", CCGetFromPost("telefono", NULL), "", false, $this->ErrorBlock);
        $this->cp["codigopostal"] = new clsSQLParameter("postcodigopostal", ccsText, "", "", CCGetFromPost("codigopostal", NULL), "", false, $this->ErrorBlock);
        $this->cp["entre"] = new clsSQLParameter("postentre", ccsText, "", "", CCGetFromPost("entre", NULL), "", false, $this->ErrorBlock);
        $this->cp["cantocup"] = new clsSQLParameter("postcantocup", ccsText, "", "", CCGetFromPost("cantocup", NULL), "", false, $this->ErrorBlock);
        $this->cp["estado"] = new clsSQLParameter("postestado", ccsText, "", "", CCGetFromPost("estado", NULL), "", false, $this->ErrorBlock);
        $this->cp["administ"] = new clsSQLParameter("postadminist", ccsText, "", "", CCGetFromPost("administ", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["RETURN_VALUE"]->GetValue()) and !strlen($this->cp["RETURN_VALUE"]->GetText()) and !is_bool($this->cp["RETURN_VALUE"]->GetValue())) 
            $this->cp["RETURN_VALUE"]->SetText(CCGetFromGet("RETURN_VALUE", NULL));
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetText(CCGetFromPost("idficha", NULL));
        if (!is_null($this->cp["idpropiedad"]->GetValue()) and !strlen($this->cp["idpropiedad"]->GetText()) and !is_bool($this->cp["idpropiedad"]->GetValue())) 
            $this->cp["idpropiedad"]->SetText(CCGetFromPost("idpropiedad", NULL));
        if (!is_null($this->cp["idtipopropiedad"]->GetValue()) and !strlen($this->cp["idtipopropiedad"]->GetText()) and !is_bool($this->cp["idtipopropiedad"]->GetValue())) 
            $this->cp["idtipopropiedad"]->SetText(CCGetFromPost("idtipopropiedad", NULL));
        if (!is_null($this->cp["direccion"]->GetValue()) and !strlen($this->cp["direccion"]->GetText()) and !is_bool($this->cp["direccion"]->GetValue())) 
            $this->cp["direccion"]->SetText(CCGetFromPost("direccion", NULL));
        if (!is_null($this->cp["localidad"]->GetValue()) and !strlen($this->cp["localidad"]->GetText()) and !is_bool($this->cp["localidad"]->GetValue())) 
            $this->cp["localidad"]->SetText(CCGetFromPost("localidad", NULL));
        if (!is_null($this->cp["telefono"]->GetValue()) and !strlen($this->cp["telefono"]->GetText()) and !is_bool($this->cp["telefono"]->GetValue())) 
            $this->cp["telefono"]->SetText(CCGetFromPost("telefono", NULL));
        if (!is_null($this->cp["codigopostal"]->GetValue()) and !strlen($this->cp["codigopostal"]->GetText()) and !is_bool($this->cp["codigopostal"]->GetValue())) 
            $this->cp["codigopostal"]->SetText(CCGetFromPost("codigopostal", NULL));
        if (!is_null($this->cp["entre"]->GetValue()) and !strlen($this->cp["entre"]->GetText()) and !is_bool($this->cp["entre"]->GetValue())) 
            $this->cp["entre"]->SetText(CCGetFromPost("entre", NULL));
        if (!is_null($this->cp["cantocup"]->GetValue()) and !strlen($this->cp["cantocup"]->GetText()) and !is_bool($this->cp["cantocup"]->GetValue())) 
            $this->cp["cantocup"]->SetText(CCGetFromPost("cantocup", NULL));
        if (!is_null($this->cp["estado"]->GetValue()) and !strlen($this->cp["estado"]->GetText()) and !is_bool($this->cp["estado"]->GetValue())) 
            $this->cp["estado"]->SetText(CCGetFromPost("estado", NULL));
        if (!is_null($this->cp["administ"]->GetValue()) and !strlen($this->cp["administ"]->GetText()) and !is_bool($this->cp["administ"]->GetValue())) 
            $this->cp["administ"]->SetText(CCGetFromPost("administ", NULL));
        $this->SQL = "EXEC SP_GUARDA_PROPIEDAD " . $this->ToSQL($this->cp["idficha"]->GetDBValue(), $this->cp["idficha"]->DataType) . ", "
             . $this->ToSQL($this->cp["idpropiedad"]->GetDBValue(), $this->cp["idpropiedad"]->DataType) . ", "
             . $this->ToSQL($this->cp["idtipopropiedad"]->GetDBValue(), $this->cp["idtipopropiedad"]->DataType) . ", "
             . $this->ToSQL($this->cp["direccion"]->GetDBValue(), $this->cp["direccion"]->DataType) . ", "
             . $this->ToSQL($this->cp["localidad"]->GetDBValue(), $this->cp["localidad"]->DataType) . ", "
             . $this->ToSQL($this->cp["telefono"]->GetDBValue(), $this->cp["telefono"]->DataType) . ", "
             . $this->ToSQL($this->cp["codigopostal"]->GetDBValue(), $this->cp["codigopostal"]->DataType) . ", "
             . $this->ToSQL($this->cp["entre"]->GetDBValue(), $this->cp["entre"]->DataType) . ", "
             . $this->ToSQL($this->cp["cantocup"]->GetDBValue(), $this->cp["cantocup"]->DataType) . ", "
             . $this->ToSQL($this->cp["estado"]->GetDBValue(), $this->cp["estado"]->DataType) . ", "
             . $this->ToSQL($this->cp["administ"]->GetDBValue(), $this->cp["administ"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-4C05A16E
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idpropiedad"] = new clsSQLParameter("postidpropiedad", ccsInteger, "", "", CCGetFromPost("idpropiedad", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["RETURN_VALUE"]->GetValue()) and !strlen($this->cp["RETURN_VALUE"]->GetText()) and !is_bool($this->cp["RETURN_VALUE"]->GetValue())) 
            $this->cp["RETURN_VALUE"]->SetText(CCGetFromGet("RETURN_VALUE", NULL));
        if (!is_null($this->cp["idpropiedad"]->GetValue()) and !strlen($this->cp["idpropiedad"]->GetText()) and !is_bool($this->cp["idpropiedad"]->GetValue())) 
            $this->cp["idpropiedad"]->SetText(CCGetFromPost("idpropiedad", NULL));
        $this->SQL = "EXEC SP_BORRA_PROPIEDAD " . $this->ToSQL($this->cp["idpropiedad"]->GetDBValue(), $this->cp["idpropiedad"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End propiedadesDataSource Class @2-FCB6E20C

class clsEditableGridfichaspropiedades { //fichaspropiedades Class @23-34B11533

//Variables @23-F667987F

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

//Class_Initialize Event @23-0139084B
    function clsEditableGridfichaspropiedades($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid fichaspropiedades/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "fichaspropiedades";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["idpropiedad"][0] = "idpropiedad";
        $this->CachedColumns["idficha"][0] = "idficha";
        $this->DataSource = new clsfichaspropiedadesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 30;
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

        $this->duenoporcentaje = & new clsControl(ccsTextBox, "duenoporcentaje", "Duenoporcentaje", ccsFloat, "", NULL, $this);
        $this->duenoporcentaje->Required = true;
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->nombre = & new clsControl(ccsTextBox, "nombre", "nombre", ccsText, "", NULL, $this);
        $this->nrodocumento = & new clsControl(ccsTextBox, "nrodocumento", "nrodocumento", ccsText, "", NULL, $this);
        $this->errorAjax = & new clsControl(ccsHidden, "errorAjax", "errorAjax", ccsText, "", NULL, $this);
        $this->idficha = & new clsControl(ccsTextBox, "idficha", "idficha", ccsInteger, "", NULL, $this);
        $this->idpropiedad = & new clsControl(ccsHidden, "idpropiedad", "idpropiedad", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @23-860C872D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlidpropiedad"] = CCGetFromGet("idpropiedad", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @23-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @23-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @23-4450953E
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["duenoporcentaje"][$RowNumber] = CCGetFromPost("duenoporcentaje_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["nombre"][$RowNumber] = CCGetFromPost("nombre_" . $RowNumber, NULL);
            $this->FormParameters["nrodocumento"][$RowNumber] = CCGetFromPost("nrodocumento_" . $RowNumber, NULL);
            $this->FormParameters["idficha"][$RowNumber] = CCGetFromPost("idficha_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @23-CFB599CE
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idpropiedad"] = $this->CachedColumns["idpropiedad"][$this->RowNumber];
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->duenoporcentaje->SetText($this->FormParameters["duenoporcentaje"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
            $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @23-63867AD1
    function ValidateRow()
    {
        global $CCSLocales;
        $this->duenoporcentaje->Validate();
        $this->CheckBox_Delete->Validate();
        $this->nombre->Validate();
        $this->nrodocumento->Validate();
        $this->idficha->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->duenoporcentaje->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $this->duenoporcentaje->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->nombre->Errors->Clear();
        $this->nrodocumento->Errors->Clear();
        $this->idficha->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @23-D18D1D11
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["duenoporcentaje"][$this->RowNumber]) && count($this->FormParameters["duenoporcentaje"][$this->RowNumber])) || strlen($this->FormParameters["duenoporcentaje"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nombre"][$this->RowNumber]) && count($this->FormParameters["nombre"][$this->RowNumber])) || strlen($this->FormParameters["nombre"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nrodocumento"][$this->RowNumber]) && count($this->FormParameters["nrodocumento"][$this->RowNumber])) || strlen($this->FormParameters["nrodocumento"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["idficha"][$this->RowNumber]) && count($this->FormParameters["idficha"][$this->RowNumber])) || strlen($this->FormParameters["idficha"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @23-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @23-909F269B
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

//UpdateGrid Method @23-7A0C186F
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idpropiedad"] = $this->CachedColumns["idpropiedad"][$this->RowNumber];
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->duenoporcentaje->SetText($this->FormParameters["duenoporcentaje"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
            $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @23-93041F7D
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
        $this->DataSource->duenoporcentaje->SetValue($this->duenoporcentaje->GetValue(true));
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

//UpdateRow Method @23-5ABDDA1B
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->duenoporcentaje->SetValue($this->duenoporcentaje->GetValue(true));
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
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

//DeleteRow Method @23-A4A656F6
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

//FormScript Method @23-BB48B9BD
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var fichaspropiedadesElements;\n";
        $script .= "var fichaspropiedadesEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "duenoporcentajeID = 0;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 1;\n";
        $script .= "var " . $this->ComponentName . "nombreID = 2;\n";
        $script .= "var " . $this->ComponentName . "nrodocumentoID = 3;\n";
        $script .= "var " . $this->ComponentName . "idfichaID = 4;\n";
        $script .= "\nfunction initfichaspropiedadesElements() {\n";
        $script .= "\tvar ED = document.forms[\"fichaspropiedades\"];\n";
        $script .= "\tfichaspropiedadesElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.duenoporcentaje_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.nombre_" . $i . ", " . "ED.nrodocumento_" . $i . ", " . "ED.idficha_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @23-A1873E95
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
                $this->CachedColumns["idpropiedad"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idficha"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["idpropiedad"][$RowNumber] = "";
                $this->CachedColumns["idficha"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @23-8DCF1A97
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idpropiedad"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idficha"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @23-322ADFED
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
        $this->ControlsVisible["duenoporcentaje"] = $this->duenoporcentaje->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["nombre"] = $this->nombre->Visible;
        $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
        $this->ControlsVisible["idficha"] = $this->idficha->Visible;
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
                    $this->CachedColumns["idpropiedad"][$this->RowNumber] = $this->DataSource->CachedColumns["idpropiedad"];
                    $this->CachedColumns["idficha"][$this->RowNumber] = $this->DataSource->CachedColumns["idficha"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                    $this->duenoporcentaje->SetValue($this->DataSource->duenoporcentaje->GetValue());
                    $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->duenoporcentaje->SetText($this->FormParameters["duenoporcentaje"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["idpropiedad"][$this->RowNumber] = "";
                    $this->CachedColumns["idficha"][$this->RowNumber] = "";
                    $this->duenoporcentaje->SetText("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                    $this->idficha->SetText("");
                } else {
                    $this->duenoporcentaje->SetText($this->FormParameters["duenoporcentaje"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->duenoporcentaje->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                $this->nombre->Show($this->RowNumber);
                $this->nrodocumento->Show($this->RowNumber);
                $this->idficha->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["idpropiedad"] == $this->CachedColumns["idpropiedad"][$this->RowNumber]) && ($this->DataSource->CachedColumns["idficha"] == $this->CachedColumns["idficha"][$this->RowNumber])) {
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
        $this->idpropiedad->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        if($this->FormSubmitted || CCGetFromGet("ccsForm")) {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        } else {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("All", ""), "ccsForm", $CCSForm);
        }
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

} //End fichaspropiedades Class @23-FCB6E20C

class clsfichaspropiedadesDataSource extends clsDBConnection1 {  //fichaspropiedadesDataSource Class @23-61099B53

//DataSource Variables @23-A31C2D7E
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
    var $duenoporcentaje;
    var $CheckBox_Delete;
    var $nombre;
    var $nrodocumento;
    var $idficha;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-A2635D1B
    function clsfichaspropiedadesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid fichaspropiedades/Error";
        $this->Initialize();
        $this->duenoporcentaje = new clsField("duenoporcentaje", ccsFloat, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->idficha = new clsField("idficha", ccsInteger, "");
        

        $this->InsertFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["duenoporcentaje"] = array("Name" => "duenoporcentaje", "Value" => "", "DataType" => ccsFloat);
        $this->InsertFields["idpropiedad"] = array("Name" => "idpropiedad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["duenoporcentaje"] = array("Name" => "duenoporcentaje", "Value" => "", "DataType" => ccsFloat);
        $this->UpdateFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @23-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @23-FD507464
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidpropiedad", ccsInteger, "", "", $this->Parameters["urlidpropiedad"], -1, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idpropiedad", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-F15398E3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichaspropiedades";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} idpropiedad, idficha, duenoporcentaje \n\n" .
        "FROM fichaspropiedades {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @23-EF5E6076
    function SetValues()
    {
        $this->CachedColumns["idpropiedad"] = $this->f("idpropiedad");
        $this->CachedColumns["idficha"] = $this->f("idficha");
        $this->duenoporcentaje->SetDBValue(trim($this->f("duenoporcentaje")));
        $this->idficha->SetDBValue(trim($this->f("idficha")));
    }
//End SetValues Method

//Insert Method @23-ED54D15E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["duenoporcentaje"] = new clsSQLParameter("ctrlduenoporcentaje", ccsFloat, "", "", $this->duenoporcentaje->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idpropiedad"] = new clsSQLParameter("postidpropiedad", ccsInteger, "", "", CCGetFromPost("idpropiedad", NULL), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        if (!is_null($this->cp["duenoporcentaje"]->GetValue()) and !strlen($this->cp["duenoporcentaje"]->GetText()) and !is_bool($this->cp["duenoporcentaje"]->GetValue())) 
            $this->cp["duenoporcentaje"]->SetValue($this->duenoporcentaje->GetValue(true));
        if (!is_null($this->cp["idpropiedad"]->GetValue()) and !strlen($this->cp["idpropiedad"]->GetText()) and !is_bool($this->cp["idpropiedad"]->GetValue())) 
            $this->cp["idpropiedad"]->SetText(CCGetFromPost("idpropiedad", NULL));
        $this->InsertFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->InsertFields["duenoporcentaje"]["Value"] = $this->cp["duenoporcentaje"]->GetDBValue(true);
        $this->InsertFields["idpropiedad"]["Value"] = $this->cp["idpropiedad"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("fichaspropiedades", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-11A62E86
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["duenoporcentaje"] = new clsSQLParameter("ctrlduenoporcentaje", ccsFloat, "", "", $this->duenoporcentaje->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsidpropiedad", ccsInteger, "", "", $this->CachedColumns["idpropiedad"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "dsidficha", ccsInteger, "", "", $this->CachedColumns["idficha"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["duenoporcentaje"]->GetValue()) and !strlen($this->cp["duenoporcentaje"]->GetText()) and !is_bool($this->cp["duenoporcentaje"]->GetValue())) 
            $this->cp["duenoporcentaje"]->SetValue($this->duenoporcentaje->GetValue(true));
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "idpropiedad", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "idficha", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsInteger),false);
        $Where = $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]);
        $this->UpdateFields["duenoporcentaje"]["Value"] = $this->cp["duenoporcentaje"]->GetDBValue(true);
        $this->UpdateFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("fichaspropiedades", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-E56A3711
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "idpropiedad=" . $this->ToSQL($this->CachedColumns["idpropiedad"], ccsInteger) . " AND idficha=" . $this->ToSQL($this->CachedColumns["idficha"], ccsInteger);
        $this->SQL = "DELETE FROM fichaspropiedades";
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

} //End fichaspropiedadesDataSource Class @23-FCB6E20C

//Include Page implementation @80-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsGridcontratos { //contratos class @86-D547D4B4

//Variables @86-AC1EDBB9

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

//Class_Initialize Event @86-31344F7E
    function clsGridcontratos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "contratos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid contratos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscontratosDataSource($this);
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

        $this->idalquiler = & new clsControl(ccsLink, "idalquiler", "idalquiler", ccsInteger, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->idalquiler->Page = "../contrato/contrato.php";
        $this->moneda = & new clsControl(ccsLabel, "moneda", "moneda", ccsInteger, "", CCGetRequestParam("moneda", ccsGet, NULL), $this);
        $this->fechainicio = & new clsControl(ccsLabel, "fechainicio", "fechainicio", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechainicio", ccsGet, NULL), $this);
        $this->fechafin = & new clsControl(ccsLabel, "fechafin", "fechafin", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechafin", ccsGet, NULL), $this);
        $this->porcentajehonorarios = & new clsControl(ccsLabel, "porcentajehonorarios", "porcentajehonorarios", ccsFloat, "", CCGetRequestParam("porcentajehonorarios", ccsGet, NULL), $this);
        $this->vto = & new clsControl(ccsLabel, "vto", "vto", ccsInteger, "", CCGetRequestParam("vto", ccsGet, NULL), $this);
        $this->acuerdo = & new clsControl(ccsLabel, "acuerdo", "acuerdo", ccsText, "", CCGetRequestParam("acuerdo", ccsGet, NULL), $this);
        $this->idpropiedad = & new clsControl(ccsHidden, "idpropiedad", "idpropiedad", ccsInteger, "", CCGetRequestParam("idpropiedad", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @86-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @86-BEA641CB
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidpropiedad"] = CCGetFromGet("idpropiedad", NULL);

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
            $this->ControlsVisible["idalquiler"] = $this->idalquiler->Visible;
            $this->ControlsVisible["moneda"] = $this->moneda->Visible;
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["fechafin"] = $this->fechafin->Visible;
            $this->ControlsVisible["porcentajehonorarios"] = $this->porcentajehonorarios->Visible;
            $this->ControlsVisible["vto"] = $this->vto->Visible;
            $this->ControlsVisible["acuerdo"] = $this->acuerdo->Visible;
            $this->ControlsVisible["idpropiedad"] = $this->idpropiedad->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                $this->idalquiler->Parameters = "";
                $this->idalquiler->Parameters = CCAddParam($this->idalquiler->Parameters, "idalquiler", $this->DataSource->f("idalquiler"));
                $this->idalquiler->Parameters = CCAddParam($this->idalquiler->Parameters, "idpropiedad", $this->DataSource->f("idpropiedad"));
                $this->moneda->SetValue($this->DataSource->moneda->GetValue());
                $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                $this->porcentajehonorarios->SetValue($this->DataSource->porcentajehonorarios->GetValue());
                $this->vto->SetValue($this->DataSource->vto->GetValue());
                $this->acuerdo->SetValue($this->DataSource->acuerdo->GetValue());
                $this->idpropiedad->SetValue($this->DataSource->idpropiedad->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idalquiler->Show();
                $this->moneda->Show();
                $this->fechainicio->Show();
                $this->fechafin->Show();
                $this->porcentajehonorarios->Show();
                $this->vto->Show();
                $this->acuerdo->Show();
                $this->idpropiedad->Show();
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

//GetErrors Method @86-BB72C2BD
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $errors = ComposeStrings($errors, $this->moneda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajehonorarios->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->acuerdo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idpropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End contratos Class @86-FCB6E20C

class clscontratosDataSource extends clsDBConnection1 {  //contratosDataSource Class @86-CD08AC72

//DataSource Variables @86-A072885E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idalquiler;
    var $moneda;
    var $fechainicio;
    var $fechafin;
    var $porcentajehonorarios;
    var $vto;
    var $acuerdo;
    var $idpropiedad;
//End DataSource Variables

//DataSourceClass_Initialize Event @86-E0E2CA6C
    function clscontratosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid contratos";
        $this->Initialize();
        $this->idalquiler = new clsField("idalquiler", ccsInteger, "");
        
        $this->moneda = new clsField("moneda", ccsInteger, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, $this->DateFormat);
        
        $this->fechafin = new clsField("fechafin", ccsDate, $this->DateFormat);
        
        $this->porcentajehonorarios = new clsField("porcentajehonorarios", ccsFloat, "");
        
        $this->vto = new clsField("vto", ccsInteger, "");
        
        $this->acuerdo = new clsField("acuerdo", ccsText, "");
        
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @86-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @86-F3394EAD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidpropiedad", ccsInteger, "", "", $this->Parameters["urlidpropiedad"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "alquileres.idpropiedad", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @86-CFC7C09D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM alquileres INNER JOIN Monedas ON\n\n" .
        "alquileres.idmoneda = Monedas.idmoneda";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM alquileres INNER JOIN Monedas ON\n\n" .
        "alquileres.idmoneda = Monedas.idmoneda {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @86-A73027B4
    function SetValues()
    {
        $this->idalquiler->SetDBValue(trim($this->f("idalquiler")));
        $this->moneda->SetDBValue(trim($this->f("simbolo")));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->porcentajehonorarios->SetDBValue(trim($this->f("porcentajehonorarios")));
        $this->vto->SetDBValue(trim($this->f("vto")));
        $this->acuerdo->SetDBValue($this->f("acuerdo"));
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
    }
//End SetValues Method

} //End contratosDataSource Class @86-FCB6E20C



//Initialize Page @1-94716A52
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
$TemplateFileName = "propiedades_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-9033100D
include_once("./propiedades_maint_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3C808744
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$propiedades = & new clsRecordpropiedades("", $MainPage);
$fichaspropiedades = & new clsEditableGridfichaspropiedades("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Parameters = CCAddParam($Link1->Parameters, "idpropiedad", CCGetFromGet("idpropiedad", NULL));
$Link1->Page = "../contrato/contrato.php";
$Link2 = & new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $MainPage);
$Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link2->Parameters = CCAddParam($Link2->Parameters, "idpropiedad", CCGetFromGet("idpropiedad", NULL));
$Link2->Page = "../hipotecas/hipotecas_maint.php";
$contratos = & new clsGridcontratos("", $MainPage);
$MainPage->propiedades = & $propiedades;
$MainPage->fichaspropiedades = & $fichaspropiedades;
$MainPage->Header = & $Header;
$MainPage->Link1 = & $Link1;
$MainPage->Link2 = & $Link2;
$MainPage->contratos = & $contratos;
$propiedades->Initialize();
$fichaspropiedades->Initialize();
$contratos->Initialize();

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

//Execute Components @1-5D1DA2D6
$propiedades->Operation();
$fichaspropiedades->Operation();
$Header->Operations();
//End Execute Components

//Go to destination page @1-38ADCFFD
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($propiedades);
    unset($fichaspropiedades);
    $Header->Class_Terminate();
    unset($Header);
    unset($contratos);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1411AB3B
$propiedades->Show();
$fichaspropiedades->Show();
$Header->Show();
$contratos->Show();
$Link1->Show();
$Link2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E1B8BAD6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($propiedades);
unset($fichaspropiedades);
$Header->Class_Terminate();
unset($Header);
unset($contratos);
unset($Tpl);
//End Unload Page


?>
