<?php
//Include Common Files @1-5A906AAF
define("RelativePath", "..");
define("PathToCurrentPage", "/fichas/");
define("FileName", "fichasalquilere_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @31-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordfichasalquileresSearch { //fichasalquileresSearch Class @2-2942D0C1

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

//Class_Initialize Event @2-B4CC7C55
    function clsRecordfichasalquileresSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record fichasalquileresSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "fichasalquileresSearch";
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

//Operation Method @2-8C392A3C
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
        $Redirect = "./fichasalquilere_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "./fichasalquilere_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End fichasalquileresSearch Class @2-FCB6E20C

class clsGridfichasalquileres { //fichasalquileres class @5-B6F7F01D

//Variables @5-DD4F904C

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
    var $Sorter_idtipodocumento;
    var $Sorter_fechainicio;
    var $Sorter_porcentajealq;
    var $Sorter_inquilino;
    var $Sorter_propietario;
//End Variables

//Class_Initialize Event @5-40C1B565
    function clsGridfichasalquileres($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichasalquileres";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichasalquileres";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichasalquileresDataSource($this);
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
        $this->SorterName = CCGetParam("fichasalquileresOrder", "");
        $this->SorterDirection = CCGetParam("fichasalquileresDir", "");

        $this->idtipodocumento = & new clsControl(ccsLink, "idtipodocumento", "idtipodocumento", ccsText, "", CCGetRequestParam("idtipodocumento", ccsGet, NULL), $this);
        $this->idtipodocumento->Page = "./fichasalquilere_maint.php";
        $this->fechainicio = & new clsControl(ccsLabel, "fechainicio", "fechainicio", ccsText, "", CCGetRequestParam("fechainicio", ccsGet, NULL), $this);
        $this->porcentajealq = & new clsControl(ccsLabel, "porcentajealq", "porcentajealq", ccsFloat, "", CCGetRequestParam("porcentajealq", ccsGet, NULL), $this);
        $this->inquilino = & new clsControl(ccsLabel, "inquilino", "inquilino", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("inquilino", ccsGet, NULL), $this);
        $this->propietario = & new clsControl(ccsLabel, "propietario", "propietario", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("propietario", ccsGet, NULL), $this);
        $this->Sorter_idtipodocumento = & new clsSorter($this->ComponentName, "Sorter_idtipodocumento", $FileName, $this);
        $this->Sorter_fechainicio = & new clsSorter($this->ComponentName, "Sorter_fechainicio", $FileName, $this);
        $this->Sorter_porcentajealq = & new clsSorter($this->ComponentName, "Sorter_porcentajealq", $FileName, $this);
        $this->Sorter_inquilino = & new clsSorter($this->ComponentName, "Sorter_inquilino", $FileName, $this);
        $this->Sorter_propietario = & new clsSorter($this->ComponentName, "Sorter_propietario", $FileName, $this);
        $this->fichasalquileres_Insert = & new clsControl(ccsLink, "fichasalquileres_Insert", "fichasalquileres_Insert", ccsText, "", CCGetRequestParam("fichasalquileres_Insert", ccsGet, NULL), $this);
        $this->fichasalquileres_Insert->Parameters = CCGetQueryString("QueryString", array("idalquiler", "ccsForm"));
        $this->fichasalquileres_Insert->Page = "./fichasalquilere_maint.php";
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

//Show Method @5-68E7F9CD
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
            $this->ControlsVisible["idtipodocumento"] = $this->idtipodocumento->Visible;
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["porcentajealq"] = $this->porcentajealq->Visible;
            $this->ControlsVisible["inquilino"] = $this->inquilino->Visible;
            $this->ControlsVisible["propietario"] = $this->propietario->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idtipodocumento->SetValue($this->DataSource->idtipodocumento->GetValue());
                $this->idtipodocumento->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idtipodocumento->Parameters = CCAddParam($this->idtipodocumento->Parameters, "idalquiler", $this->DataSource->f("fichasalquileres_idalquiler"));
                $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                $this->porcentajealq->SetValue($this->DataSource->porcentajealq->GetValue());
                $this->inquilino->SetValue($this->DataSource->inquilino->GetValue());
                $this->propietario->SetValue($this->DataSource->propietario->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idtipodocumento->Show();
                $this->fechainicio->Show();
                $this->porcentajealq->Show();
                $this->inquilino->Show();
                $this->propietario->Show();
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
        $this->Sorter_idtipodocumento->Show();
        $this->Sorter_fechainicio->Show();
        $this->Sorter_porcentajealq->Show();
        $this->Sorter_inquilino->Show();
        $this->Sorter_propietario->Show();
        $this->fichasalquileres_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-AEEB4E53
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idtipodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajealq->Errors->ToString());
        $errors = ComposeStrings($errors, $this->inquilino->Errors->ToString());
        $errors = ComposeStrings($errors, $this->propietario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichasalquileres Class @5-FCB6E20C

class clsfichasalquileresDataSource extends clsDBConnection1 {  //fichasalquileresDataSource Class @5-AEA717FB

//DataSource Variables @5-B1317E78
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idtipodocumento;
    var $fechainicio;
    var $porcentajealq;
    var $inquilino;
    var $propietario;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-EDCA0E42
    function clsfichasalquileresDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichasalquileres";
        $this->Initialize();
        $this->idtipodocumento = new clsField("idtipodocumento", ccsText, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsText, "");
        
        $this->porcentajealq = new clsField("porcentajealq", ccsFloat, "");
        
        $this->inquilino = new clsField("inquilino", ccsBoolean, $this->BooleanFormat);
        
        $this->propietario = new clsField("propietario", ccsBoolean, $this->BooleanFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-FB518E39
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idtipodocumento" => array("idtipodocumento", ""), 
            "Sorter_fechainicio" => array("fechainicio", ""), 
            "Sorter_porcentajealq" => array("porcentajealq", ""), 
            "Sorter_inquilino" => array("inquilino", ""), 
            "Sorter_propietario" => array("propietario", "")));
    }
//End SetOrder Method

//Prepare Method @5-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @5-AC4BFB05
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (fichasalquileres LEFT JOIN fichas ON\n\n" .
        "fichasalquileres.idficha = fichas.idficha) LEFT JOIN alquileres ON\n\n" .
        "fichasalquileres.idalquiler = alquileres.idalquiler";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} fichasalquileres.idalquiler AS fichasalquileres_idalquiler, fichas.idtipodocumento, alquileres.fechainicio, fichasalquileres.porcentajealq,\n\n" .
        "fichasalquileres.inquilino, fichasalquileres.propietario \n\n" .
        "FROM (fichasalquileres LEFT JOIN fichas ON\n\n" .
        "fichasalquileres.idficha = fichas.idficha) LEFT JOIN alquileres ON\n\n" .
        "fichasalquileres.idalquiler = alquileres.idalquiler {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @5-407868DD
    function SetValues()
    {
        $this->idtipodocumento->SetDBValue($this->f("idtipodocumento"));
        $this->fechainicio->SetDBValue($this->f("fechainicio"));
        $this->porcentajealq->SetDBValue(trim($this->f("porcentajealq")));
        $this->inquilino->SetDBValue(trim($this->f("inquilino")));
        $this->propietario->SetDBValue(trim($this->f("propietario")));
    }
//End SetValues Method

} //End fichasalquileresDataSource Class @5-FCB6E20C

//Include Page implementation @32-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-44FF5A54
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
$TemplateFileName = "fichasalquilere_list.html";
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

//Initialize Objects @1-71E27F9E
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$fichasalquileresSearch = & new clsRecordfichasalquileresSearch("", $MainPage);
$fichasalquileres = & new clsGridfichasalquileres("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->Header = & $Header;
$MainPage->fichasalquileresSearch = & $fichasalquileresSearch;
$MainPage->fichasalquileres = & $fichasalquileres;
$MainPage->Footer = & $Footer;
$fichasalquileres->Initialize();

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

//Execute Components @1-B9096A4D
$Header->Operations();
$fichasalquileresSearch->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-1F8255B5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($fichasalquileresSearch);
    unset($fichasalquileres);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-057905D2
$Header->Show();
$fichasalquileresSearch->Show();
$fichasalquileres->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3EE2C781
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($fichasalquileresSearch);
unset($fichasalquileres);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
