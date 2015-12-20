<?php
//Include Common Files @1-1A65013C
define("RelativePath", "..");
define("PathToCurrentPage", "/mantenimiento/");
define("FileName", "nupcias_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridnupcias { //nupcias class @2-93C6FD61

//Variables @2-971B9B12

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
    var $Sorter_idnupcias;
    var $Sorter_desnupcias;
//End Variables

//Class_Initialize Event @2-A1383B3C
    function clsGridnupcias($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "nupcias";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid nupcias";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsnupciasDataSource($this);
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
        $this->SorterName = CCGetParam("nupciasOrder", "");
        $this->SorterDirection = CCGetParam("nupciasDir", "");

        $this->idnupcias = & new clsControl(ccsLink, "idnupcias", "idnupcias", ccsText, "", CCGetRequestParam("idnupcias", ccsGet, NULL), $this);
        $this->idnupcias->Page = "nupcias_maint.php";
        $this->desnupcias = & new clsControl(ccsLabel, "desnupcias", "desnupcias", ccsText, "", CCGetRequestParam("desnupcias", ccsGet, NULL), $this);
        $this->nupcias_Insert = & new clsControl(ccsLink, "nupcias_Insert", "nupcias_Insert", ccsText, "", CCGetRequestParam("nupcias_Insert", ccsGet, NULL), $this);
        $this->nupcias_Insert->Parameters = CCGetQueryString("QueryString", array("idnupcias", "ccsForm"));
        $this->nupcias_Insert->Page = "nupcias_maint.php";
        $this->Sorter_idnupcias = & new clsSorter($this->ComponentName, "Sorter_idnupcias", $FileName, $this);
        $this->Sorter_desnupcias = & new clsSorter($this->ComponentName, "Sorter_desnupcias", $FileName, $this);
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

//Show Method @2-5A0EFC76
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
            $this->ControlsVisible["idnupcias"] = $this->idnupcias->Visible;
            $this->ControlsVisible["desnupcias"] = $this->desnupcias->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idnupcias->SetValue($this->DataSource->idnupcias->GetValue());
                $this->idnupcias->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idnupcias->Parameters = CCAddParam($this->idnupcias->Parameters, "idnupcias", $this->DataSource->f("idnupcias"));
                $this->desnupcias->SetValue($this->DataSource->desnupcias->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idnupcias->Show();
                $this->desnupcias->Show();
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
        $this->nupcias_Insert->Show();
        $this->Sorter_idnupcias->Show();
        $this->Sorter_desnupcias->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-5444F8A9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idnupcias->Errors->ToString());
        $errors = ComposeStrings($errors, $this->desnupcias->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End nupcias Class @2-FCB6E20C

class clsnupciasDataSource extends clsDBConnection1 {  //nupciasDataSource Class @2-E4408F13

//DataSource Variables @2-8F93328B
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idnupcias;
    var $desnupcias;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-928E1D36
    function clsnupciasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid nupcias";
        $this->Initialize();
        $this->idnupcias = new clsField("idnupcias", ccsText, "");
        
        $this->desnupcias = new clsField("desnupcias", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-7561FDC4
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idnupcias" => array("idnupcias", ""), 
            "Sorter_desnupcias" => array("desnupcias", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-67E47D16
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM nupcias";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} idnupcias, desnupcias \n\n" .
        "FROM nupcias {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-32EDCBD4
    function SetValues()
    {
        $this->idnupcias->SetDBValue($this->f("idnupcias"));
        $this->desnupcias->SetDBValue($this->f("desnupcias"));
    }
//End SetValues Method

} //End nupciasDataSource Class @2-FCB6E20C

//Include Page implementation @13-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-F22E1752
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
$TemplateFileName = "nupcias_list.html";
$BlockToParse = "main";
$TemplateEncoding = "UTF-8";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "utf-8";
//End Initialize Page

//Authenticate User @1-2B4DC208
CCSecurityRedirect("1", "../accesodenegado/accesodenegado.php");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-554B99FD
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$nupcias = & new clsGridnupcias("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$MainPage->nupcias = & $nupcias;
$MainPage->Header = & $Header;
$nupcias->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-C0025321
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "UTF-8");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-47111282
$Header->Operations();
//End Execute Components

//Go to destination page @1-67BB16B5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($nupcias);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2369729C
$nupcias->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DC1DA59C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($nupcias);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
