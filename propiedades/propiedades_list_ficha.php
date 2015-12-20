<?php
//Include Common Files @1-D21C128C
define("RelativePath", "..");
define("PathToCurrentPage", "/propiedades/");
define("FileName", "propiedades_list_ficha.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsGridfichaspropiedades_propied { //fichaspropiedades_propied class @3-70D04421

//Variables @3-142E64E3

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
    var $Sorter_duenoporcentaje;
    var $Sorter_propiedades_idpropiedad;
    var $Sorter_direccion;
    var $Sorter_localidad;
    var $Sorter_telefono;
    var $Sorter_destipopropiedad;
//End Variables

//Class_Initialize Event @3-FC283ADF
    function clsGridfichaspropiedades_propied($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichaspropiedades_propied";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichaspropiedades_propied";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichaspropiedades_propiedDataSource($this);
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
        $this->SorterName = CCGetParam("fichaspropiedades_propiedOrder", "");
        $this->SorterDirection = CCGetParam("fichaspropiedades_propiedDir", "");

        $this->duenoporcentaje = & new clsControl(ccsLabel, "duenoporcentaje", "duenoporcentaje", ccsFloat, "", CCGetRequestParam("duenoporcentaje", ccsGet, NULL), $this);
        $this->propiedades_idpropiedad = & new clsControl(ccsLink, "propiedades_idpropiedad", "propiedades_idpropiedad", ccsInteger, "", CCGetRequestParam("propiedades_idpropiedad", ccsGet, NULL), $this);
        $this->propiedades_idpropiedad->Page = "propiedades_maint.php";
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->localidad = & new clsControl(ccsLabel, "localidad", "localidad", ccsText, "", CCGetRequestParam("localidad", ccsGet, NULL), $this);
        $this->telefono = & new clsControl(ccsLabel, "telefono", "telefono", ccsText, "", CCGetRequestParam("telefono", ccsGet, NULL), $this);
        $this->destipopropiedad = & new clsControl(ccsLabel, "destipopropiedad", "destipopropiedad", ccsText, "", CCGetRequestParam("destipopropiedad", ccsGet, NULL), $this);
        $this->Sorter_duenoporcentaje = & new clsSorter($this->ComponentName, "Sorter_duenoporcentaje", $FileName, $this);
        $this->Sorter_propiedades_idpropiedad = & new clsSorter($this->ComponentName, "Sorter_propiedades_idpropiedad", $FileName, $this);
        $this->Sorter_direccion = & new clsSorter($this->ComponentName, "Sorter_direccion", $FileName, $this);
        $this->Sorter_localidad = & new clsSorter($this->ComponentName, "Sorter_localidad", $FileName, $this);
        $this->Sorter_telefono = & new clsSorter($this->ComponentName, "Sorter_telefono", $FileName, $this);
        $this->Sorter_destipopropiedad = & new clsSorter($this->ComponentName, "Sorter_destipopropiedad", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "idficha", CCGetFromGet("idficha", NULL));
        $this->Link1->Page = "propiedades_maint.php";
        $this->Link2 = & new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "idficha", CCGetFromGet("idficha", NULL));
        $this->Link2->Page = "../fichas/fichas_list.php";
    }
//End Class_Initialize Event

//Initialize Method @3-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @3-83465643
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidficha"] = CCGetFromGet("idficha", NULL);

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
            $this->ControlsVisible["duenoporcentaje"] = $this->duenoporcentaje->Visible;
            $this->ControlsVisible["propiedades_idpropiedad"] = $this->propiedades_idpropiedad->Visible;
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["localidad"] = $this->localidad->Visible;
            $this->ControlsVisible["telefono"] = $this->telefono->Visible;
            $this->ControlsVisible["destipopropiedad"] = $this->destipopropiedad->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->duenoporcentaje->SetValue($this->DataSource->duenoporcentaje->GetValue());
                $this->propiedades_idpropiedad->SetValue($this->DataSource->propiedades_idpropiedad->GetValue());
                $this->propiedades_idpropiedad->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->propiedades_idpropiedad->Parameters = CCAddParam($this->propiedades_idpropiedad->Parameters, "idpropiedad", $this->DataSource->f("propiedades_idpropiedad"));
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->localidad->SetValue($this->DataSource->localidad->GetValue());
                $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                $this->destipopropiedad->SetValue($this->DataSource->destipopropiedad->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->duenoporcentaje->Show();
                $this->propiedades_idpropiedad->Show();
                $this->direccion->Show();
                $this->localidad->Show();
                $this->telefono->Show();
                $this->destipopropiedad->Show();
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
        $this->Sorter_duenoporcentaje->Show();
        $this->Sorter_propiedades_idpropiedad->Show();
        $this->Sorter_direccion->Show();
        $this->Sorter_localidad->Show();
        $this->Sorter_telefono->Show();
        $this->Sorter_destipopropiedad->Show();
        $this->Navigator->Show();
        $this->Label1->Show();
        $this->Link1->Show();
        $this->Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @3-71EE3293
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->duenoporcentaje->Errors->ToString());
        $errors = ComposeStrings($errors, $this->propiedades_idpropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->localidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->telefono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->destipopropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichaspropiedades_propied Class @3-FCB6E20C

class clsfichaspropiedades_propiedDataSource extends clsDBConnection1 {  //fichaspropiedades_propiedDataSource Class @3-65697EB0

//DataSource Variables @3-2051AA71
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $duenoporcentaje;
    var $propiedades_idpropiedad;
    var $direccion;
    var $localidad;
    var $telefono;
    var $destipopropiedad;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-3A2E1824
    function clsfichaspropiedades_propiedDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichaspropiedades_propied";
        $this->Initialize();
        $this->duenoporcentaje = new clsField("duenoporcentaje", ccsFloat, "");
        
        $this->propiedades_idpropiedad = new clsField("propiedades_idpropiedad", ccsInteger, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->localidad = new clsField("localidad", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->destipopropiedad = new clsField("destipopropiedad", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @3-20F7C69E
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "fichaspropiedades.idpropiedad";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_duenoporcentaje" => array("duenoporcentaje", ""), 
            "Sorter_propiedades_idpropiedad" => array("propiedades.idpropiedad", ""), 
            "Sorter_direccion" => array("direccion", ""), 
            "Sorter_localidad" => array("localidad", ""), 
            "Sorter_telefono" => array("telefono", ""), 
            "Sorter_destipopropiedad" => array("destipopropiedad", "")));
    }
//End SetOrder Method

//Prepare Method @3-519848FA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidficha", ccsInteger, "", "", $this->Parameters["urlidficha"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "fichaspropiedades.idficha", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @3-D99B3EEC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (propiedades INNER JOIN fichaspropiedades ON\n\n" .
        "propiedades.idpropiedad = fichaspropiedades.idpropiedad) INNER JOIN tipopropiedades ON\n\n" .
        "propiedades.idtipopropiedad = tipopropiedades.idtipopropiedad";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} propiedades.idpropiedad AS propiedades_idpropiedad, direccion, destipopropiedad, localidad, telefono, duenoporcentaje \n\n" .
        "FROM (propiedades INNER JOIN fichaspropiedades ON\n\n" .
        "propiedades.idpropiedad = fichaspropiedades.idpropiedad) INNER JOIN tipopropiedades ON\n\n" .
        "propiedades.idtipopropiedad = tipopropiedades.idtipopropiedad {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @3-B59232C3
    function SetValues()
    {
        $this->duenoporcentaje->SetDBValue(trim($this->f("duenoporcentaje")));
        $this->propiedades_idpropiedad->SetDBValue(trim($this->f("propiedades_idpropiedad")));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->localidad->SetDBValue($this->f("localidad"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->destipopropiedad->SetDBValue($this->f("destipopropiedad"));
    }
//End SetValues Method

} //End fichaspropiedades_propiedDataSource Class @3-FCB6E20C

//Initialize Page @1-3D0696B9
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
$TemplateFileName = "propiedades_list_ficha.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-7B75AA62
include_once("./propiedades_list_ficha_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7BCB1FAA
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$fichaspropiedades_propied = & new clsGridfichaspropiedades_propied("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->fichaspropiedades_propied = & $fichaspropiedades_propied;
$fichaspropiedades_propied->Initialize();

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

//Go to destination page @1-2B61483E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($fichaspropiedades_propied);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FC3E9DB8
$Header->Show();
$fichaspropiedades_propied->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F9F3978A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($fichaspropiedades_propied);
unset($Tpl);
//End Unload Page


?>
