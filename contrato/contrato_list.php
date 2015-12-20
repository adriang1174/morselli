<?php
//Include Common Files @1-AAA8979B
define("RelativePath", "..");
define("PathToCurrentPage", "/contrato/");
define("FileName", "contrato_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridalquileres_propiedades_ti1 { //alquileres_propiedades_ti1 class @2-007A1712

//Variables @2-DF5817FE

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
    var $Sorter_idalquiler;
    var $Sorter_fechainicio;
    var $Sorter_fechafin;
    var $Sorter_direccion;
    var $Sorter_localidad;
    var $Sorter_destipopropiedad;
//End Variables

//Class_Initialize Event @2-9DE092C1
    function clsGridalquileres_propiedades_ti1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "alquileres_propiedades_ti1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid alquileres_propiedades_ti1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsalquileres_propiedades_ti1DataSource($this);
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
        $this->SorterName = CCGetParam("alquileres_propiedades_ti1Order", "");
        $this->SorterDirection = CCGetParam("alquileres_propiedades_ti1Dir", "");

        $this->idalquiler = & new clsControl(ccsLabel, "idalquiler", "idalquiler", ccsInteger, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->fechainicio = & new clsControl(ccsLabel, "fechainicio", "fechainicio", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechainicio", ccsGet, NULL), $this);
        $this->fechafin = & new clsControl(ccsLabel, "fechafin", "fechafin", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechafin", ccsGet, NULL), $this);
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->localidad = & new clsControl(ccsLabel, "localidad", "localidad", ccsText, "", CCGetRequestParam("localidad", ccsGet, NULL), $this);
        $this->destipopropiedad = & new clsControl(ccsLabel, "destipopropiedad", "destipopropiedad", ccsText, "", CCGetRequestParam("destipopropiedad", ccsGet, NULL), $this);
        $this->propiedades_idpropiedad = & new clsControl(ccsHidden, "propiedades_idpropiedad", "propiedades_idpropiedad", ccsInteger, "", CCGetRequestParam("propiedades_idpropiedad", ccsGet, NULL), $this);
        $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "contrato.php";
        $this->Sorter_idalquiler = & new clsSorter($this->ComponentName, "Sorter_idalquiler", $FileName, $this);
        $this->Sorter_fechainicio = & new clsSorter($this->ComponentName, "Sorter_fechainicio", $FileName, $this);
        $this->Sorter_fechafin = & new clsSorter($this->ComponentName, "Sorter_fechafin", $FileName, $this);
        $this->Sorter_direccion = & new clsSorter($this->ComponentName, "Sorter_direccion", $FileName, $this);
        $this->Sorter_localidad = & new clsSorter($this->ComponentName, "Sorter_localidad", $FileName, $this);
        $this->Sorter_destipopropiedad = & new clsSorter($this->ComponentName, "Sorter_destipopropiedad", $FileName, $this);
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

//Show Method @2-CBEBC2E4
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_idalquiler"] = CCGetFromGet("s_idalquiler", NULL);
        $this->DataSource->Parameters["urls_direccion"] = CCGetFromGet("s_direccion", NULL);

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
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["fechafin"] = $this->fechafin->Visible;
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["localidad"] = $this->localidad->Visible;
            $this->ControlsVisible["destipopropiedad"] = $this->destipopropiedad->Visible;
            $this->ControlsVisible["propiedades_idpropiedad"] = $this->propiedades_idpropiedad->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->localidad->SetValue($this->DataSource->localidad->GetValue());
                $this->destipopropiedad->SetValue($this->DataSource->destipopropiedad->GetValue());
                $this->propiedades_idpropiedad->SetValue($this->DataSource->propiedades_idpropiedad->GetValue());
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "idalquiler", $this->DataSource->f("idalquiler"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "idpropiedad", $this->DataSource->f("propiedades_idpropiedad"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idalquiler->Show();
                $this->fechainicio->Show();
                $this->fechafin->Show();
                $this->direccion->Show();
                $this->localidad->Show();
                $this->destipopropiedad->Show();
                $this->propiedades_idpropiedad->Show();
                $this->Link1->Show();
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
        $this->Sorter_idalquiler->Show();
        $this->Sorter_fechainicio->Show();
        $this->Sorter_fechafin->Show();
        $this->Sorter_direccion->Show();
        $this->Sorter_localidad->Show();
        $this->Sorter_destipopropiedad->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-B41C5D6F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->localidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->destipopropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->propiedades_idpropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End alquileres_propiedades_ti1 Class @2-FCB6E20C

class clsalquileres_propiedades_ti1DataSource extends clsDBConnection1 {  //alquileres_propiedades_ti1DataSource Class @2-91331208

//DataSource Variables @2-AC493A18
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idalquiler;
    var $fechainicio;
    var $fechafin;
    var $direccion;
    var $localidad;
    var $destipopropiedad;
    var $propiedades_idpropiedad;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-606D1670
    function clsalquileres_propiedades_ti1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid alquileres_propiedades_ti1";
        $this->Initialize();
        $this->idalquiler = new clsField("idalquiler", ccsInteger, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, $this->DateFormat);
        
        $this->fechafin = new clsField("fechafin", ccsDate, $this->DateFormat);
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->localidad = new clsField("localidad", ccsText, "");
        
        $this->destipopropiedad = new clsField("destipopropiedad", ccsText, "");
        
        $this->propiedades_idpropiedad = new clsField("propiedades_idpropiedad", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B24B5E4A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "idalquiler";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idalquiler" => array("idalquiler", ""), 
            "Sorter_fechainicio" => array("fechainicio", ""), 
            "Sorter_fechafin" => array("fechafin", ""), 
            "Sorter_direccion" => array("direccion", ""), 
            "Sorter_localidad" => array("localidad", ""), 
            "Sorter_destipopropiedad" => array("destipopropiedad", "")));
    }
//End SetOrder Method

//Prepare Method @2-9F238D71
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_idalquiler", ccsInteger, "", "", $this->Parameters["urls_idalquiler"], "", false);
        $this->wp->AddParameter("2", "urls_direccion", ccsText, "", "", $this->Parameters["urls_direccion"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "alquileres.idalquiler", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "propiedades.direccion", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-3C0CC686
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM alquileres INNER JOIN (propiedades INNER JOIN tipopropiedades ON\n\n" .
        "propiedades.idtipopropiedad = tipopropiedades.idtipopropiedad) ON\n\n" .
        "alquileres.idpropiedad = propiedades.idpropiedad";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} destipopropiedad, direccion, localidad, fechainicio, fechafin, idalquiler, propiedades.idpropiedad AS propiedades_idpropiedad \n\n" .
        "FROM alquileres INNER JOIN (propiedades INNER JOIN tipopropiedades ON\n\n" .
        "propiedades.idtipopropiedad = tipopropiedades.idtipopropiedad) ON\n\n" .
        "alquileres.idpropiedad = propiedades.idpropiedad {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-A7D63D6A
    function SetValues()
    {
        $this->idalquiler->SetDBValue(trim($this->f("idalquiler")));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->localidad->SetDBValue($this->f("localidad"));
        $this->destipopropiedad->SetDBValue($this->f("destipopropiedad"));
        $this->propiedades_idpropiedad->SetDBValue(trim($this->f("propiedades_idpropiedad")));
    }
//End SetValues Method

} //End alquileres_propiedades_ti1DataSource Class @2-FCB6E20C

class clsRecordalquileres_propiedades_ti { //alquileres_propiedades_ti Class @17-0AC1DBCC

//Variables @17-D6FF3E86

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

//Class_Initialize Event @17-4B29269B
    function clsRecordalquileres_propiedades_ti($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record alquileres_propiedades_ti/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "alquileres_propiedades_ti";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_idalquiler = & new clsControl(ccsTextBox, "s_idalquiler", "s_idalquiler", ccsInteger, "", CCGetRequestParam("s_idalquiler", $Method, NULL), $this);
            $this->s_direccion = & new clsControl(ccsTextBox, "s_direccion", "s_direccion", ccsText, "", CCGetRequestParam("s_direccion", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @17-0C8A09A2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_idalquiler->Validate() && $Validation);
        $Validation = ($this->s_direccion->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_idalquiler->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_direccion->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @17-0EB439B5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_idalquiler->Errors->Count());
        $errors = ($errors || $this->s_direccion->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @17-ED598703
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

//Operation Method @17-4A469867
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
        $Redirect = "contrato_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "contrato_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @17-496610CC
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
            $Error = ComposeStrings($Error, $this->s_idalquiler->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_direccion->Errors->ToString());
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
        $this->s_idalquiler->Show();
        $this->s_direccion->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End alquileres_propiedades_ti Class @17-FCB6E20C

//Include Page implementation @39-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-39E3AB4B
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
$TemplateFileName = "contrato_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-872FD3D7
CCSecurityRedirect("", "");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9437D75B
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$alquileres_propiedades_ti1 = & new clsGridalquileres_propiedades_ti1("", $MainPage);
$alquileres_propiedades_ti = & new clsRecordalquileres_propiedades_ti("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$MainPage->alquileres_propiedades_ti1 = & $alquileres_propiedades_ti1;
$MainPage->alquileres_propiedades_ti = & $alquileres_propiedades_ti;
$MainPage->Header = & $Header;
$alquileres_propiedades_ti1->Initialize();

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

//Execute Components @1-7A5C21BD
$alquileres_propiedades_ti->Operation();
$Header->Operations();
//End Execute Components

//Go to destination page @1-33A29B9A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($alquileres_propiedades_ti1);
    unset($alquileres_propiedades_ti);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-DEDB3CFC
$alquileres_propiedades_ti1->Show();
$alquileres_propiedades_ti->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-559C34BF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($alquileres_propiedades_ti1);
unset($alquileres_propiedades_ti);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
