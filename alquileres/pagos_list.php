<?php
//Include Common Files @1-DD430855
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
define("FileName", "pagos_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridfichas_fichaspropiedades1 { //fichas_fichaspropiedades1 class @2-55CC2CBF

//Variables @2-ABE8905A

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
    var $Sorter_fichas_idficha;
    var $Sorter_nombre;
    var $Sorter_propiedades_direccion;
    var $Sorter_propiedades_localidad;
    var $Sorter_propiedades_telefono;
//End Variables

//Class_Initialize Event @2-AA9E39FA
    function clsGridfichas_fichaspropiedades1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichas_fichaspropiedades1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichas_fichaspropiedades1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichas_fichaspropiedades1DataSource($this);
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
        $this->SorterName = CCGetParam("fichas_fichaspropiedades1Order", "");
        $this->SorterDirection = CCGetParam("fichas_fichaspropiedades1Dir", "");

        $this->fichas_idficha = & new clsControl(ccsLabel, "fichas_idficha", "fichas_idficha", ccsInteger, "", CCGetRequestParam("fichas_idficha", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLink, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->nombre->Page = "pagos.php";
        $this->propiedades_direccion = & new clsControl(ccsLabel, "propiedades_direccion", "propiedades_direccion", ccsText, "", CCGetRequestParam("propiedades_direccion", ccsGet, NULL), $this);
        $this->propiedades_localidad = & new clsControl(ccsLabel, "propiedades_localidad", "propiedades_localidad", ccsText, "", CCGetRequestParam("propiedades_localidad", ccsGet, NULL), $this);
        $this->propiedades_telefono = & new clsControl(ccsLabel, "propiedades_telefono", "propiedades_telefono", ccsText, "", CCGetRequestParam("propiedades_telefono", ccsGet, NULL), $this);
        $this->Sorter_fichas_idficha = & new clsSorter($this->ComponentName, "Sorter_fichas_idficha", $FileName, $this);
        $this->Sorter_nombre = & new clsSorter($this->ComponentName, "Sorter_nombre", $FileName, $this);
        $this->Sorter_propiedades_direccion = & new clsSorter($this->ComponentName, "Sorter_propiedades_direccion", $FileName, $this);
        $this->Sorter_propiedades_localidad = & new clsSorter($this->ComponentName, "Sorter_propiedades_localidad", $FileName, $this);
        $this->Sorter_propiedades_telefono = & new clsSorter($this->ComponentName, "Sorter_propiedades_telefono", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-237086BB
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_idalquiler"] = CCGetFromGet("s_idalquiler", NULL);
        $this->DataSource->Parameters["urls_fichas_idficha"] = CCGetFromGet("s_fichas_idficha", NULL);
        $this->DataSource->Parameters["urls_nombre"] = CCGetFromGet("s_nombre", NULL);
        $this->DataSource->Parameters["urls_propiedades_direccion"] = CCGetFromGet("s_propiedades_direccion", NULL);

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
            $this->ControlsVisible["fichas_idficha"] = $this->fichas_idficha->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["propiedades_direccion"] = $this->propiedades_direccion->Visible;
            $this->ControlsVisible["propiedades_localidad"] = $this->propiedades_localidad->Visible;
            $this->ControlsVisible["propiedades_telefono"] = $this->propiedades_telefono->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->fichas_idficha->SetValue($this->DataSource->fichas_idficha->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->nombre->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->nombre->Parameters = CCAddParam($this->nombre->Parameters, "idpropiedad", $this->DataSource->f("propiedades_idpropiedad"));
                $this->nombre->Parameters = CCAddParam($this->nombre->Parameters, "idalquiler", $this->DataSource->f("idalquiler"));
                $this->propiedades_direccion->SetValue($this->DataSource->propiedades_direccion->GetValue());
                $this->propiedades_localidad->SetValue($this->DataSource->propiedades_localidad->GetValue());
                $this->propiedades_telefono->SetValue($this->DataSource->propiedades_telefono->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->fichas_idficha->Show();
                $this->nombre->Show();
                $this->propiedades_direccion->Show();
                $this->propiedades_localidad->Show();
                $this->propiedades_telefono->Show();
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
        $this->Sorter_fichas_idficha->Show();
        $this->Sorter_nombre->Show();
        $this->Sorter_propiedades_direccion->Show();
        $this->Sorter_propiedades_localidad->Show();
        $this->Sorter_propiedades_telefono->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-BF3D7408
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->fichas_idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->propiedades_direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->propiedades_localidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->propiedades_telefono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichas_fichaspropiedades1 Class @2-FCB6E20C

class clsfichas_fichaspropiedades1DataSource extends clsDBConnection1 {  //fichas_fichaspropiedades1DataSource Class @2-3CA3B1F6

//DataSource Variables @2-810A2798
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $fichas_idficha;
    var $nombre;
    var $propiedades_direccion;
    var $propiedades_localidad;
    var $propiedades_telefono;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-39C903D6
    function clsfichas_fichaspropiedades1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichas_fichaspropiedades1";
        $this->Initialize();
        $this->fichas_idficha = new clsField("fichas_idficha", ccsInteger, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->propiedades_direccion = new clsField("propiedades_direccion", ccsText, "");
        
        $this->propiedades_localidad = new clsField("propiedades_localidad", ccsText, "");
        
        $this->propiedades_telefono = new clsField("propiedades_telefono", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-CE2B239C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_fichas_idficha" => array("fichas.idficha", ""), 
            "Sorter_nombre" => array("nombre", ""), 
            "Sorter_propiedades_direccion" => array("propiedades.direccion", ""), 
            "Sorter_propiedades_localidad" => array("propiedades.localidad", ""), 
            "Sorter_propiedades_telefono" => array("propiedades.telefono", "")));
    }
//End SetOrder Method

//Prepare Method @2-E7A609FE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_idalquiler", ccsInteger, "", "", $this->Parameters["urls_idalquiler"], "", true);
        $this->wp->AddParameter("2", "urls_fichas_idficha", ccsInteger, "", "", $this->Parameters["urls_fichas_idficha"], "", false);
        $this->wp->AddParameter("3", "urls_nombre", ccsText, "", "", $this->Parameters["urls_nombre"], "", false);
        $this->wp->AddParameter("4", "urls_propiedades_direccion", ccsText, "", "", $this->Parameters["urls_propiedades_direccion"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "alquileres.idalquiler", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),true);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "fichas.idficha", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "fichas.nombre", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "propiedades.direccion", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], $this->wp->opAND(
             true, $this->wp->opAND(
             false, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]));
    }
//End Prepare Method

//Open Method @2-11FE4024
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichas INNER JOIN (propiedades INNER JOIN (alquileres INNER JOIN fichasalquileres ON\n\n" .
        "alquileres.idalquiler = fichasalquileres.idalquiler) ON\n\n" .
        "propiedades.idpropiedad = alquileres.idpropiedad) ON\n\n" .
        "fichas.idficha = fichasalquileres.idficha";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} nombre, propiedades.direccion AS propiedades_direccion, propiedades.telefono AS propiedades_telefono, propiedades.localidad AS propiedades_localidad,\n\n" .
        "fichas.idficha AS fichas_idficha, propiedades.idpropiedad AS propiedades_idpropiedad, alquileres.idalquiler AS alquileres_idalquiler,\n\n" .
        "fichasalquileres.* \n\n" .
        "FROM fichas INNER JOIN (propiedades INNER JOIN (alquileres INNER JOIN fichasalquileres ON\n\n" .
        "alquileres.idalquiler = fichasalquileres.idalquiler) ON\n\n" .
        "propiedades.idpropiedad = alquileres.idpropiedad) ON\n\n" .
        "fichas.idficha = fichasalquileres.idficha {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-AE981184
    function SetValues()
    {
        $this->fichas_idficha->SetDBValue(trim($this->f("fichas_idficha")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->propiedades_direccion->SetDBValue($this->f("propiedades_direccion"));
        $this->propiedades_localidad->SetDBValue($this->f("propiedades_localidad"));
        $this->propiedades_telefono->SetDBValue($this->f("propiedades_telefono"));
    }
//End SetValues Method

} //End fichas_fichaspropiedades1DataSource Class @2-FCB6E20C

class clsRecordfichas_fichaspropiedades { //fichas_fichaspropiedades Class @19-86DD6262

//Variables @19-D6FF3E86

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

//Class_Initialize Event @19-7E86B5EB
    function clsRecordfichas_fichaspropiedades($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record fichas_fichaspropiedades/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "fichas_fichaspropiedades";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_fichas_idficha = & new clsControl(ccsTextBox, "s_fichas_idficha", "s_fichas_idficha", ccsInteger, "", CCGetRequestParam("s_fichas_idficha", $Method, NULL), $this);
            $this->s_propiedades_direccion = & new clsControl(ccsTextBox, "s_propiedades_direccion", "s_propiedades_direccion", ccsText, "", CCGetRequestParam("s_propiedades_direccion", $Method, NULL), $this);
            $this->s_nombre = & new clsControl(ccsTextBox, "s_nombre", "s_nombre", ccsText, "", CCGetRequestParam("s_nombre", $Method, NULL), $this);
            $this->s_idalquiler = & new clsControl(ccsTextBox, "s_idalquiler", "s_idalquiler", ccsInteger, "", CCGetRequestParam("s_idalquiler", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @19-34D26DF1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_fichas_idficha->Validate() && $Validation);
        $Validation = ($this->s_propiedades_direccion->Validate() && $Validation);
        $Validation = ($this->s_nombre->Validate() && $Validation);
        $Validation = ($this->s_idalquiler->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_fichas_idficha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_propiedades_direccion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_idalquiler->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @19-742013C3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_fichas_idficha->Errors->Count());
        $errors = ($errors || $this->s_propiedades_direccion->Errors->Count());
        $errors = ($errors || $this->s_nombre->Errors->Count());
        $errors = ($errors || $this->s_idalquiler->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @19-ED598703
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

//Operation Method @19-D312FB5D
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
        $Redirect = "pagos_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "pagos_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @19-2AD4A711
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
            $Error = ComposeStrings($Error, $this->s_fichas_idficha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_propiedades_direccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_idalquiler->Errors->ToString());
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
        $this->s_fichas_idficha->Show();
        $this->s_propiedades_direccion->Show();
        $this->s_nombre->Show();
        $this->s_idalquiler->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End fichas_fichaspropiedades Class @19-FCB6E20C

//Include Page implementation @50-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-17DD2D1F
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
$TemplateFileName = "pagos_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E24D927F
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$fichas_fichaspropiedades1 = & new clsGridfichas_fichaspropiedades1("", $MainPage);
$fichas_fichaspropiedades = & new clsRecordfichas_fichaspropiedades("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$MainPage->fichas_fichaspropiedades1 = & $fichas_fichaspropiedades1;
$MainPage->fichas_fichaspropiedades = & $fichas_fichaspropiedades;
$MainPage->Header = & $Header;
$fichas_fichaspropiedades1->Initialize();

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

//Execute Components @1-649B9A0E
$fichas_fichaspropiedades->Operation();
$Header->Operations();
//End Execute Components

//Go to destination page @1-5578D18F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($fichas_fichaspropiedades1);
    unset($fichas_fichaspropiedades);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0C82BA1B
$fichas_fichaspropiedades1->Show();
$fichas_fichaspropiedades->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C5B1AE43
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($fichas_fichaspropiedades1);
unset($fichas_fichaspropiedades);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
