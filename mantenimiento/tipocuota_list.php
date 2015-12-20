<?php
//Include Common Files @1-34570F79
define("RelativePath", "..");
define("PathToCurrentPage", "/mantenimiento/");
define("FileName", "tipocuota_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridtipocuota { //tipocuota class @2-DDB2D022

//Variables @2-D10C6482

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
    var $Sorter_idtipocuota;
    var $Sorter_descripcion;
    var $Sorter_tipomovimientoliq;
    var $Sorter_tipomovimientopag;
    var $Sorter_porcentaje;
//End Variables

//Class_Initialize Event @2-1287D3F1
    function clsGridtipocuota($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tipocuota";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tipocuota";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstipocuotaDataSource($this);
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
        $this->SorterName = CCGetParam("tipocuotaOrder", "");
        $this->SorterDirection = CCGetParam("tipocuotaDir", "");

        $this->idtipocuota = & new clsControl(ccsLink, "idtipocuota", "idtipocuota", ccsInteger, "", CCGetRequestParam("idtipocuota", ccsGet, NULL), $this);
        $this->idtipocuota->Page = "tipocuota_maint.php";
        $this->descripcion = & new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->tipomovimientoliq = & new clsControl(ccsLabel, "tipomovimientoliq", "tipomovimientoliq", ccsText, "", CCGetRequestParam("tipomovimientoliq", ccsGet, NULL), $this);
        $this->tipomovimientopag = & new clsControl(ccsLabel, "tipomovimientopag", "tipomovimientopag", ccsText, "", CCGetRequestParam("tipomovimientopag", ccsGet, NULL), $this);
        $this->porcentaje = & new clsControl(ccsLabel, "porcentaje", "porcentaje", ccsFloat, "", CCGetRequestParam("porcentaje", ccsGet, NULL), $this);
        $this->tipocuota_Insert = & new clsControl(ccsLink, "tipocuota_Insert", "tipocuota_Insert", ccsText, "", CCGetRequestParam("tipocuota_Insert", ccsGet, NULL), $this);
        $this->tipocuota_Insert->Parameters = CCGetQueryString("QueryString", array("idtipocuota", "ccsForm"));
        $this->tipocuota_Insert->Page = "tipocuota_maint.php";
        $this->Sorter_idtipocuota = & new clsSorter($this->ComponentName, "Sorter_idtipocuota", $FileName, $this);
        $this->Sorter_descripcion = & new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_tipomovimientoliq = & new clsSorter($this->ComponentName, "Sorter_tipomovimientoliq", $FileName, $this);
        $this->Sorter_tipomovimientopag = & new clsSorter($this->ComponentName, "Sorter_tipomovimientopag", $FileName, $this);
        $this->Sorter_porcentaje = & new clsSorter($this->ComponentName, "Sorter_porcentaje", $FileName, $this);
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

//Show Method @2-75267CF6
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
            $this->ControlsVisible["idtipocuota"] = $this->idtipocuota->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["tipomovimientoliq"] = $this->tipomovimientoliq->Visible;
            $this->ControlsVisible["tipomovimientopag"] = $this->tipomovimientopag->Visible;
            $this->ControlsVisible["porcentaje"] = $this->porcentaje->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idtipocuota->SetValue($this->DataSource->idtipocuota->GetValue());
                $this->idtipocuota->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idtipocuota->Parameters = CCAddParam($this->idtipocuota->Parameters, "idtipocuota", $this->DataSource->f("idtipocuota"));
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->tipomovimientoliq->SetValue($this->DataSource->tipomovimientoliq->GetValue());
                $this->tipomovimientopag->SetValue($this->DataSource->tipomovimientopag->GetValue());
                $this->porcentaje->SetValue($this->DataSource->porcentaje->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idtipocuota->Show();
                $this->descripcion->Show();
                $this->tipomovimientoliq->Show();
                $this->tipomovimientopag->Show();
                $this->porcentaje->Show();
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
        $this->tipocuota_Insert->Show();
        $this->Sorter_idtipocuota->Show();
        $this->Sorter_descripcion->Show();
        $this->Sorter_tipomovimientoliq->Show();
        $this->Sorter_tipomovimientopag->Show();
        $this->Sorter_porcentaje->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-EBA66417
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idtipocuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipomovimientoliq->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipomovimientopag->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentaje->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tipocuota Class @2-FCB6E20C

class clstipocuotaDataSource extends clsDBConnection1 {  //tipocuotaDataSource Class @2-5E5F58B6

//DataSource Variables @2-708C2CC4
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idtipocuota;
    var $descripcion;
    var $tipomovimientoliq;
    var $tipomovimientopag;
    var $porcentaje;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3FD5D698
    function clstipocuotaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tipocuota";
        $this->Initialize();
        $this->idtipocuota = new clsField("idtipocuota", ccsInteger, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->tipomovimientoliq = new clsField("tipomovimientoliq", ccsText, "");
        
        $this->tipomovimientopag = new clsField("tipomovimientopag", ccsText, "");
        
        $this->porcentaje = new clsField("porcentaje", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-45D8408D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idtipocuota" => array("idtipocuota", ""), 
            "Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_tipomovimientoliq" => array("tipomovimientoliq", ""), 
            "Sorter_tipomovimientopag" => array("tipomovimientopag", ""), 
            "Sorter_porcentaje" => array("porcentaje", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-740E1FAD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tipocuota";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} idtipocuota, descripcion, tipomovimientoliq, tipomovimientopag, porcentaje \n\n" .
        "FROM tipocuota {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-14376A50
    function SetValues()
    {
        $this->idtipocuota->SetDBValue(trim($this->f("idtipocuota")));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->tipomovimientoliq->SetDBValue($this->f("tipomovimientoliq"));
        $this->tipomovimientopag->SetDBValue($this->f("tipomovimientopag"));
        $this->porcentaje->SetDBValue(trim($this->f("porcentaje")));
    }
//End SetValues Method

} //End tipocuotaDataSource Class @2-FCB6E20C

//Include Page implementation @24-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-CC51FD30
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
$TemplateFileName = "tipocuota_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-11BF4AD1
include_once("./tipocuota_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6769FC4A
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tipocuota = & new clsGridtipocuota("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$MainPage->tipocuota = & $tipocuota;
$MainPage->Header = & $Header;
$tipocuota->Initialize();

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

//Go to destination page @1-4615C362
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($tipocuota);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4CA42342
$tipocuota->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-218AE099
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($tipocuota);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
