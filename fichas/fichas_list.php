<?php
//Include Common Files @1-E6B3253E
define("RelativePath", "..");
define("PathToCurrentPage", "/fichas/");
define("FileName", "fichas_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @101-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordfichasSearch { //fichasSearch Class @2-1E27CA61

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

//Class_Initialize Event @2-B2A532CF
    function clsRecordfichasSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record fichasSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "fichasSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-A144A629
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
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

//Operation Method @2-31786C01
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
        $Redirect = "./fichas_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "./fichas_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-7913FA87
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
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
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

        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End fichasSearch Class @2-FCB6E20C

class clsGridfichas { //fichas class @6-0FEEC35D

//Variables @6-A1574A11

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
    var $Sorter_idficha;
    var $Sorter_nombre;
    var $Sorter_telefono;
    var $Sorter_celular;
    var $Sorter_direccion;
    var $Sorter_localidad;
    var $Sorter_email;
    var $Sorter_nrodocumento;
    var $Sorter_cuit;
//End Variables

//Class_Initialize Event @6-3C8E8783
    function clsGridfichas($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichas";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichas";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichasDataSource($this);
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
        $this->SorterName = CCGetParam("fichasOrder", "");
        $this->SorterDirection = CCGetParam("fichasDir", "");

        $this->idficha = & new clsControl(ccsLink, "idficha", "idficha", ccsInteger, "", CCGetRequestParam("idficha", ccsGet, NULL), $this);
        $this->idficha->Page = "fichas_maint.php";
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->telefono = & new clsControl(ccsLabel, "telefono", "telefono", ccsText, "", CCGetRequestParam("telefono", ccsGet, NULL), $this);
        $this->celular = & new clsControl(ccsLabel, "celular", "celular", ccsText, "", CCGetRequestParam("celular", ccsGet, NULL), $this);
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->localidad = & new clsControl(ccsLabel, "localidad", "localidad", ccsText, "", CCGetRequestParam("localidad", ccsGet, NULL), $this);
        $this->email = & new clsControl(ccsLabel, "email", "email", ccsText, "", CCGetRequestParam("email", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
        $this->cuit = & new clsControl(ccsLabel, "cuit", "cuit", ccsText, "", CCGetRequestParam("cuit", ccsGet, NULL), $this);
        $this->Sorter_idficha = & new clsSorter($this->ComponentName, "Sorter_idficha", $FileName, $this);
        $this->Sorter_nombre = & new clsSorter($this->ComponentName, "Sorter_nombre", $FileName, $this);
        $this->Sorter_telefono = & new clsSorter($this->ComponentName, "Sorter_telefono", $FileName, $this);
        $this->Sorter_celular = & new clsSorter($this->ComponentName, "Sorter_celular", $FileName, $this);
        $this->Sorter_direccion = & new clsSorter($this->ComponentName, "Sorter_direccion", $FileName, $this);
        $this->Sorter_localidad = & new clsSorter($this->ComponentName, "Sorter_localidad", $FileName, $this);
        $this->Sorter_email = & new clsSorter($this->ComponentName, "Sorter_email", $FileName, $this);
        $this->Sorter_nrodocumento = & new clsSorter($this->ComponentName, "Sorter_nrodocumento", $FileName, $this);
        $this->Sorter_cuit = & new clsSorter($this->ComponentName, "Sorter_cuit", $FileName, $this);
        $this->fichas_Insert = & new clsControl(ccsLink, "fichas_Insert", "fichas_Insert", ccsText, "", CCGetRequestParam("fichas_Insert", ccsGet, NULL), $this);
        $this->fichas_Insert->Parameters = CCGetQueryString("QueryString", array("idficha", "ccsForm"));
        $this->fichas_Insert->Page = "./fichas_maint.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @6-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @6-CEDC4CA3
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);

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
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["telefono"] = $this->telefono->Visible;
            $this->ControlsVisible["celular"] = $this->celular->Visible;
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["localidad"] = $this->localidad->Visible;
            $this->ControlsVisible["email"] = $this->email->Visible;
            $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
            $this->ControlsVisible["cuit"] = $this->cuit->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                $this->idficha->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idficha->Parameters = CCAddParam($this->idficha->Parameters, "idficha", $this->DataSource->f("idficha"));
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                $this->celular->SetValue($this->DataSource->celular->GetValue());
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->localidad->SetValue($this->DataSource->localidad->GetValue());
                $this->email->SetValue($this->DataSource->email->GetValue());
                $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                $this->cuit->SetValue($this->DataSource->cuit->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show();
                $this->nombre->Show();
                $this->telefono->Show();
                $this->celular->Show();
                $this->direccion->Show();
                $this->localidad->Show();
                $this->email->Show();
                $this->nrodocumento->Show();
                $this->cuit->Show();
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
        $this->Sorter_idficha->Show();
        $this->Sorter_nombre->Show();
        $this->Sorter_telefono->Show();
        $this->Sorter_celular->Show();
        $this->Sorter_direccion->Show();
        $this->Sorter_localidad->Show();
        $this->Sorter_email->Show();
        $this->Sorter_nrodocumento->Show();
        $this->Sorter_cuit->Show();
        $this->fichas_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-8D7FBAC7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->telefono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->celular->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->localidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cuit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichas Class @6-FCB6E20C

class clsfichasDataSource extends clsDBConnection1 {  //fichasDataSource Class @6-05DD9D51

//DataSource Variables @6-AF115BB5
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idficha;
    var $nombre;
    var $telefono;
    var $celular;
    var $direccion;
    var $localidad;
    var $email;
    var $nrodocumento;
    var $cuit;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-42AB7C7C
    function clsfichasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichas";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->celular = new clsField("celular", ccsText, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->localidad = new clsField("localidad", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->cuit = new clsField("cuit", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-487C85A5
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idficha" => array("idficha", ""), 
            "Sorter_nombre" => array("nombre", ""), 
            "Sorter_telefono" => array("telefono", ""), 
            "Sorter_celular" => array("celular", ""), 
            "Sorter_direccion" => array("direccion", ""), 
            "Sorter_localidad" => array("localidad", ""), 
            "Sorter_email" => array("email", ""), 
            "Sorter_nrodocumento" => array("nrodocumento", ""), 
            "Sorter_cuit" => array("cuit", "")));
    }
//End SetOrder Method

//Prepare Method @6-25AA94A2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @6-1BFDF2C6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT fichas.idficha, tipodocumentos.idtipodocumento AS tipodocumentos_idtipodocumento, estadocivil.desestadocivil, fichas.nombre,\n" .
        "fichas.direccion, fichas.localidad, fichas.codigopostal, fichas.telefono, fichas.celular, fichas.fechanac, fichas.provincia,\n" .
        "fichas.email, idtipocontribuyente, fichas.actividad, fichas.observaciones, fichas.cuit, fichas.nrodocumento, fichas.nacionalidad,\n" .
        "fichas.nupcias, fichas.conyuge, fichas.padre, fichas.madre \n" .
        "FROM (fichas LEFT JOIN tipodocumentos ON\n" .
        "fichas.idtipodocumento = tipodocumentos.idtipodocumento) LEFT JOIN estadocivil ON\n" .
        "fichas.idestadocivil = estadocivil.idestadocivil\n" .
        "WHERE ( fichas.idtipodocumento LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nombre LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.direccion LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.localidad LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.codigopostal LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.telefono LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.celular LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.provincia LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.email LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.actividad LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.observaciones LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.cuit LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nrodocumento LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nacionalidad LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nupcias LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.conyuge LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.padre LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.madre LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR cast(fichas.idficha as varchar) like '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')  ) cnt";
        $this->SQL = "SELECT fichas.idficha, tipodocumentos.idtipodocumento AS tipodocumentos_idtipodocumento, estadocivil.desestadocivil, fichas.nombre,\n" .
        "fichas.direccion, fichas.localidad, fichas.codigopostal, fichas.telefono, fichas.celular, fichas.fechanac, fichas.provincia,\n" .
        "fichas.email, idtipocontribuyente, fichas.actividad, fichas.observaciones, fichas.cuit, fichas.nrodocumento, fichas.nacionalidad,\n" .
        "fichas.nupcias, fichas.conyuge, fichas.padre, fichas.madre \n" .
        "FROM (fichas LEFT JOIN tipodocumentos ON\n" .
        "fichas.idtipodocumento = tipodocumentos.idtipodocumento) LEFT JOIN estadocivil ON\n" .
        "fichas.idestadocivil = estadocivil.idestadocivil\n" .
        "WHERE ( fichas.idtipodocumento LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nombre LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.direccion LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.localidad LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.codigopostal LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.telefono LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.celular LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.provincia LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.email LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.actividad LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.observaciones LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.cuit LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nrodocumento LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nacionalidad LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.nupcias LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.conyuge LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.padre LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR fichas.madre LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR cast(fichas.idficha as varchar) like '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')  ";
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

//SetValues Method @6-522ABE3E
    function SetValues()
    {
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->celular->SetDBValue($this->f("celular"));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->localidad->SetDBValue($this->f("localidad"));
        $this->email->SetDBValue($this->f("email"));
        $this->nrodocumento->SetDBValue($this->f("nrodocumento"));
        $this->cuit->SetDBValue($this->f("cuit"));
    }
//End SetValues Method

} //End fichasDataSource Class @6-FCB6E20C

//Include Page implementation @102-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-56AEC0D6
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
$TemplateFileName = "fichas_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-5C0EEF38
CCSecurityRedirect("1;2", "../accesodenegado/accesodenegado.php");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E051539D
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$fichasSearch = & new clsRecordfichasSearch("", $MainPage);
$fichas = & new clsGridfichas("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->Header = & $Header;
$MainPage->fichasSearch = & $fichasSearch;
$MainPage->fichas = & $fichas;
$MainPage->Footer = & $Footer;
$fichas->Initialize();

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

//Execute Components @1-7B316104
$Header->Operations();
$fichasSearch->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-227EB05E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($fichasSearch);
    unset($fichas);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-942D84DD
$Header->Show();
$fichasSearch->Show();
$fichas->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-51708E87
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($fichasSearch);
unset($fichas);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
