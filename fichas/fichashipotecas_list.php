<?php
//Include Common Files @1-9E957121
define("RelativePath", "..");
define("PathToCurrentPage", "/fichas/");
define("FileName", "fichashipotecas_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @31-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordfichashipotecasSearch { //fichashipotecasSearch Class @2-72B98EFC

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

//Class_Initialize Event @2-E5FF5926
    function clsRecordfichashipotecasSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record fichashipotecasSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "fichashipotecasSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-E8CE9E37
    function CheckErrors()
    {
        $errors = false;
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

//Operation Method @2-5189F180
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
        $Redirect = "./fichashipotecas_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "./fichashipotecas_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-25F37D65
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

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End fichashipotecasSearch Class @2-FCB6E20C

class clsGridfichashipotecas { //fichashipotecas class @5-BC21F1DD

//Variables @5-0C5C15FD

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
    var $Sorter_montohipoteca;
    var $Sorter_idtipodocumento;
    var $Sorter_porcentajehip;
    var $Sorter_acreedor;
    var $Sorter_deudor;
//End Variables

//Class_Initialize Event @5-8852B8B7
    function clsGridfichashipotecas($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichashipotecas";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichashipotecas";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichashipotecasDataSource($this);
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
        $this->SorterName = CCGetParam("fichashipotecasOrder", "");
        $this->SorterDirection = CCGetParam("fichashipotecasDir", "");

        $this->montohipoteca = & new clsControl(ccsLink, "montohipoteca", "montohipoteca", ccsText, "", CCGetRequestParam("montohipoteca", ccsGet, NULL), $this);
        $this->montohipoteca->Page = "./fichashipotecas_maint.php";
        $this->idtipodocumento = & new clsControl(ccsLabel, "idtipodocumento", "idtipodocumento", ccsText, "", CCGetRequestParam("idtipodocumento", ccsGet, NULL), $this);
        $this->porcentajehip = & new clsControl(ccsLabel, "porcentajehip", "porcentajehip", ccsFloat, "", CCGetRequestParam("porcentajehip", ccsGet, NULL), $this);
        $this->acreedor = & new clsControl(ccsLabel, "acreedor", "acreedor", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("acreedor", ccsGet, NULL), $this);
        $this->deudor = & new clsControl(ccsLabel, "deudor", "deudor", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("deudor", ccsGet, NULL), $this);
        $this->Sorter_montohipoteca = & new clsSorter($this->ComponentName, "Sorter_montohipoteca", $FileName, $this);
        $this->Sorter_idtipodocumento = & new clsSorter($this->ComponentName, "Sorter_idtipodocumento", $FileName, $this);
        $this->Sorter_porcentajehip = & new clsSorter($this->ComponentName, "Sorter_porcentajehip", $FileName, $this);
        $this->Sorter_acreedor = & new clsSorter($this->ComponentName, "Sorter_acreedor", $FileName, $this);
        $this->Sorter_deudor = & new clsSorter($this->ComponentName, "Sorter_deudor", $FileName, $this);
        $this->fichashipotecas_Insert = & new clsControl(ccsLink, "fichashipotecas_Insert", "fichashipotecas_Insert", ccsText, "", CCGetRequestParam("fichashipotecas_Insert", ccsGet, NULL), $this);
        $this->fichashipotecas_Insert->Parameters = CCGetQueryString("QueryString", array("idficha", "ccsForm"));
        $this->fichashipotecas_Insert->Page = "./fichashipotecas_maint.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-0A7CF9B4
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
            $this->ControlsVisible["montohipoteca"] = $this->montohipoteca->Visible;
            $this->ControlsVisible["idtipodocumento"] = $this->idtipodocumento->Visible;
            $this->ControlsVisible["porcentajehip"] = $this->porcentajehip->Visible;
            $this->ControlsVisible["acreedor"] = $this->acreedor->Visible;
            $this->ControlsVisible["deudor"] = $this->deudor->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->montohipoteca->SetValue($this->DataSource->montohipoteca->GetValue());
                $this->montohipoteca->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->montohipoteca->Parameters = CCAddParam($this->montohipoteca->Parameters, "idficha", $this->DataSource->f("fichashipotecas_idficha"));
                $this->idtipodocumento->SetValue($this->DataSource->idtipodocumento->GetValue());
                $this->porcentajehip->SetValue($this->DataSource->porcentajehip->GetValue());
                $this->acreedor->SetValue($this->DataSource->acreedor->GetValue());
                $this->deudor->SetValue($this->DataSource->deudor->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->montohipoteca->Show();
                $this->idtipodocumento->Show();
                $this->porcentajehip->Show();
                $this->acreedor->Show();
                $this->deudor->Show();
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
        $this->Sorter_montohipoteca->Show();
        $this->Sorter_idtipodocumento->Show();
        $this->Sorter_porcentajehip->Show();
        $this->Sorter_acreedor->Show();
        $this->Sorter_deudor->Show();
        $this->fichashipotecas_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-61161CFF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idtipodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajehip->Errors->ToString());
        $errors = ComposeStrings($errors, $this->acreedor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->deudor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichashipotecas Class @5-FCB6E20C

class clsfichashipotecasDataSource extends clsDBConnection1 {  //fichashipotecasDataSource Class @5-3D1FBBF7

//DataSource Variables @5-1BC314A6
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $montohipoteca;
    var $idtipodocumento;
    var $porcentajehip;
    var $acreedor;
    var $deudor;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-D25DA09F
    function clsfichashipotecasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichashipotecas";
        $this->Initialize();
        $this->montohipoteca = new clsField("montohipoteca", ccsText, "");
        
        $this->idtipodocumento = new clsField("idtipodocumento", ccsText, "");
        
        $this->porcentajehip = new clsField("porcentajehip", ccsFloat, "");
        
        $this->acreedor = new clsField("acreedor", ccsBoolean, $this->BooleanFormat);
        
        $this->deudor = new clsField("deudor", ccsBoolean, $this->BooleanFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-40E60A44
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_montohipoteca" => array("montohipoteca", ""), 
            "Sorter_idtipodocumento" => array("idtipodocumento", ""), 
            "Sorter_porcentajehip" => array("porcentajehip", ""), 
            "Sorter_acreedor" => array("acreedor", ""), 
            "Sorter_deudor" => array("deudor", "")));
    }
//End SetOrder Method

//Prepare Method @5-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @5-9BB62835
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (fichashipotecas LEFT JOIN hipotecas ON\n\n" .
        "fichashipotecas.idhipoteca = hipotecas.idhipoteca) LEFT JOIN fichas ON\n\n" .
        "fichashipotecas.idficha = fichas.idficha";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} fichashipotecas.idficha AS fichashipotecas_idficha, hipotecas.montohipoteca, fichas.idtipodocumento, fichashipotecas.porcentajehip,\n\n" .
        "fichashipotecas.acreedor, fichashipotecas.deudor \n\n" .
        "FROM (fichashipotecas LEFT JOIN hipotecas ON\n\n" .
        "fichashipotecas.idhipoteca = hipotecas.idhipoteca) LEFT JOIN fichas ON\n\n" .
        "fichashipotecas.idficha = fichas.idficha {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @5-DD660D2B
    function SetValues()
    {
        $this->montohipoteca->SetDBValue($this->f("montohipoteca"));
        $this->idtipodocumento->SetDBValue($this->f("idtipodocumento"));
        $this->porcentajehip->SetDBValue(trim($this->f("porcentajehip")));
        $this->acreedor->SetDBValue(trim($this->f("acreedor")));
        $this->deudor->SetDBValue(trim($this->f("deudor")));
    }
//End SetValues Method

} //End fichashipotecasDataSource Class @5-FCB6E20C

//Include Page implementation @32-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-F5A1BFDD
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
$TemplateFileName = "fichashipotecas_list.html";
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

//Initialize Objects @1-483089DC
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$fichashipotecasSearch = & new clsRecordfichashipotecasSearch("", $MainPage);
$fichashipotecas = & new clsGridfichashipotecas("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->Header = & $Header;
$MainPage->fichashipotecasSearch = & $fichashipotecasSearch;
$MainPage->fichashipotecas = & $fichashipotecas;
$MainPage->Footer = & $Footer;
$fichashipotecas->Initialize();

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

//Execute Components @1-96BBC160
$Header->Operations();
$fichashipotecasSearch->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-E521F3CB
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($fichashipotecasSearch);
    unset($fichashipotecas);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-62A15DEA
$Header->Show();
$fichashipotecasSearch->Show();
$fichashipotecas->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2ED1F26C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($fichashipotecasSearch);
unset($fichashipotecas);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
