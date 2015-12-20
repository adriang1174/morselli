<?php
//Include Common Files @1-1EE83943
define("RelativePath", "..");
define("PathToCurrentPage", "/mantenimiento/");
define("FileName", "gastosescribani_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridgastosescribania { //gastosescribania class @7-FAA5F686

//Variables @7-AD88CFF3

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
    var $Sorter_descripcion;
    var $Sorter_importecomp;
    var $Sorter_importevend;
    var $Sorter_jurisdiccion;
//End Variables

//Class_Initialize Event @7-33FAB85D
    function clsGridgastosescribania($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "gastosescribania";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid gastosescribania";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsgastosescribaniaDataSource($this);
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
        $this->SorterName = CCGetParam("gastosescribaniaOrder", "");
        $this->SorterDirection = CCGetParam("gastosescribaniaDir", "");

        $this->descripcion = & new clsControl(ccsLink, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->descripcion->Page = "gastosescribani_maint.php";
        $this->importecomp = & new clsControl(ccsLabel, "importecomp", "importecomp", ccsFloat, "", CCGetRequestParam("importecomp", ccsGet, NULL), $this);
        $this->importevend = & new clsControl(ccsLabel, "importevend", "importevend", ccsFloat, "", CCGetRequestParam("importevend", ccsGet, NULL), $this);
        $this->jurisdiccion = & new clsControl(ccsLabel, "jurisdiccion", "jurisdiccion", ccsText, "", CCGetRequestParam("jurisdiccion", ccsGet, NULL), $this);
        $this->idgastoescribania = & new clsControl(ccsHidden, "idgastoescribania", "idgastoescribania", ccsInteger, "", CCGetRequestParam("idgastoescribania", ccsGet, NULL), $this);
        $this->gastosescribania_Insert = & new clsControl(ccsLink, "gastosescribania_Insert", "gastosescribania_Insert", ccsText, "", CCGetRequestParam("gastosescribania_Insert", ccsGet, NULL), $this);
        $this->gastosescribania_Insert->Parameters = CCGetQueryString("QueryString", array("idgastoescribania", "ccsForm"));
        $this->gastosescribania_Insert->Page = "gastosescribani_maint.php";
        $this->Sorter_descripcion = & new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_importecomp = & new clsSorter($this->ComponentName, "Sorter_importecomp", $FileName, $this);
        $this->Sorter_importevend = & new clsSorter($this->ComponentName, "Sorter_importevend", $FileName, $this);
        $this->Sorter_jurisdiccion = & new clsSorter($this->ComponentName, "Sorter_jurisdiccion", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @7-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @7-A0EA1618
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_descripcion"] = CCGetFromGet("s_descripcion", NULL);
        $this->DataSource->Parameters["urls_jurisdiccion"] = CCGetFromGet("s_jurisdiccion", NULL);

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
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["importecomp"] = $this->importecomp->Visible;
            $this->ControlsVisible["importevend"] = $this->importevend->Visible;
            $this->ControlsVisible["jurisdiccion"] = $this->jurisdiccion->Visible;
            $this->ControlsVisible["idgastoescribania"] = $this->idgastoescribania->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->descripcion->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->descripcion->Parameters = CCAddParam($this->descripcion->Parameters, "idgastoescribania", $this->DataSource->f("idgastoescribania"));
                $this->importecomp->SetValue($this->DataSource->importecomp->GetValue());
                $this->importevend->SetValue($this->DataSource->importevend->GetValue());
                $this->jurisdiccion->SetValue($this->DataSource->jurisdiccion->GetValue());
                $this->idgastoescribania->SetValue($this->DataSource->idgastoescribania->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->descripcion->Show();
                $this->importecomp->Show();
                $this->importevend->Show();
                $this->jurisdiccion->Show();
                $this->idgastoescribania->Show();
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
        $this->gastosescribania_Insert->Show();
        $this->Sorter_descripcion->Show();
        $this->Sorter_importecomp->Show();
        $this->Sorter_importevend->Show();
        $this->Sorter_jurisdiccion->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @7-0DCE1BD5
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importecomp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importevend->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jurisdiccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idgastoescribania->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End gastosescribania Class @7-FCB6E20C

class clsgastosescribaniaDataSource extends clsDBConnection1 {  //gastosescribaniaDataSource Class @7-5CA13177

//DataSource Variables @7-A46EB59F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $descripcion;
    var $importecomp;
    var $importevend;
    var $jurisdiccion;
    var $idgastoescribania;
//End DataSource Variables

//DataSourceClass_Initialize Event @7-8655DEE8
    function clsgastosescribaniaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid gastosescribania";
        $this->Initialize();
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->importecomp = new clsField("importecomp", ccsFloat, "");
        
        $this->importevend = new clsField("importevend", ccsFloat, "");
        
        $this->jurisdiccion = new clsField("jurisdiccion", ccsText, "");
        
        $this->idgastoescribania = new clsField("idgastoescribania", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @7-FAF08B31
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_importecomp" => array("importecomp", ""), 
            "Sorter_importevend" => array("importevend", ""), 
            "Sorter_jurisdiccion" => array("jurisdiccion", "")));
    }
//End SetOrder Method

//Prepare Method @7-D41FB945
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_descripcion", ccsText, "", "", $this->Parameters["urls_descripcion"], "", false);
        $this->wp->AddParameter("2", "urls_jurisdiccion", ccsText, "", "", $this->Parameters["urls_jurisdiccion"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "descripcion", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "jurisdiccion", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @7-6D905E4D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM gastosescribania";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} idgastoescribania, descripcion, importecomp, importevend, jurisdiccion \n\n" .
        "FROM gastosescribania {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @7-0408F95D
    function SetValues()
    {
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->importecomp->SetDBValue(trim($this->f("importecomp")));
        $this->importevend->SetDBValue(trim($this->f("importevend")));
        $this->jurisdiccion->SetDBValue($this->f("jurisdiccion"));
        $this->idgastoescribania->SetDBValue(trim($this->f("idgastoescribania")));
    }
//End SetValues Method

} //End gastosescribaniaDataSource Class @7-FCB6E20C

//Include Page implementation @31-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-C1CCE8CA
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
$TemplateFileName = "gastosescribani_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-D9DBF8C9
CCSecurityRedirect("1;2", "");
//End Authenticate User

//Include events file @1-A27258BC
include_once("./gastosescribani_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9D69B0E8
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$gastosescribania = & new clsGridgastosescribania("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$MainPage->gastosescribania = & $gastosescribania;
$MainPage->Header = & $Header;
$gastosescribania->Initialize();

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

//Execute Components @1-47111282
$Header->Operations();
//End Execute Components

//Go to destination page @1-FC7048A9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($gastosescribania);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D812ADFA
$gastosescribania->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6014DD8D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($gastosescribania);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
