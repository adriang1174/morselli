<?php
//Include Common Files @1-D3DCE390
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
define("FileName", "mostrar_impuestos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid1 { //Grid1 class @2-E857A572

//Variables @2-47601EFD

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
    var $Sorter_ano;
    var $Sorter_mes;
//End Variables

//Class_Initialize Event @2-A71AAC19
    function clsGridGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGrid1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 12;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("Grid1Order", "");
        $this->SorterDirection = CCGetParam("Grid1Dir", "");

        $this->idalquiler = & new clsControl(ccsLabel, "idalquiler", "idalquiler", ccsInteger, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->ano = & new clsControl(ccsLabel, "ano", "ano", ccsInteger, "", CCGetRequestParam("ano", ccsGet, NULL), $this);
        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsInteger, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->ti1 = & new clsControl(ccsLabel, "ti1", "ti1", ccsText, "", CCGetRequestParam("ti1", ccsGet, NULL), $this);
        $this->ti2 = & new clsControl(ccsLabel, "ti2", "ti2", ccsText, "", CCGetRequestParam("ti2", ccsGet, NULL), $this);
        $this->ti3 = & new clsControl(ccsLabel, "ti3", "ti3", ccsText, "", CCGetRequestParam("ti3", ccsGet, NULL), $this);
        $this->ti4 = & new clsControl(ccsLabel, "ti4", "ti4", ccsText, "", CCGetRequestParam("ti4", ccsGet, NULL), $this);
        $this->ti5 = & new clsControl(ccsLabel, "ti5", "ti5", ccsText, "", CCGetRequestParam("ti5", ccsGet, NULL), $this);
        $this->ti6 = & new clsControl(ccsLabel, "ti6", "ti6", ccsText, "", CCGetRequestParam("ti6", ccsGet, NULL), $this);
        $this->ti7 = & new clsControl(ccsLabel, "ti7", "ti7", ccsText, "", CCGetRequestParam("ti7", ccsGet, NULL), $this);
        $this->ti8 = & new clsControl(ccsLabel, "ti8", "ti8", ccsText, "", CCGetRequestParam("ti8", ccsGet, NULL), $this);
        $this->ti9 = & new clsControl(ccsLabel, "ti9", "ti9", ccsText, "", CCGetRequestParam("ti9", ccsGet, NULL), $this);
        $this->Sorter_idalquiler = & new clsSorter($this->ComponentName, "Sorter_idalquiler", $FileName, $this);
        $this->Sorter_ano = & new clsSorter($this->ComponentName, "Sorter_ano", $FileName, $this);
        $this->Sorter_mes = & new clsSorter($this->ComponentName, "Sorter_mes", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->i1 = & new clsControl(ccsLabel, "i1", "i1", ccsInteger, "", CCGetRequestParam("i1", ccsGet, NULL), $this);
        $this->i2 = & new clsControl(ccsLabel, "i2", "i2", ccsInteger, "", CCGetRequestParam("i2", ccsGet, NULL), $this);
        $this->i3 = & new clsControl(ccsLabel, "i3", "i3", ccsInteger, "", CCGetRequestParam("i3", ccsGet, NULL), $this);
        $this->i4 = & new clsControl(ccsLabel, "i4", "i4", ccsInteger, "", CCGetRequestParam("i4", ccsGet, NULL), $this);
        $this->i5 = & new clsControl(ccsLabel, "i5", "i5", ccsInteger, "", CCGetRequestParam("i5", ccsGet, NULL), $this);
        $this->i6 = & new clsControl(ccsLabel, "i6", "i6", ccsInteger, "", CCGetRequestParam("i6", ccsGet, NULL), $this);
        $this->i7 = & new clsControl(ccsLabel, "i7", "i7", ccsInteger, "", CCGetRequestParam("i7", ccsGet, NULL), $this);
        $this->i8 = & new clsControl(ccsLabel, "i8", "i8", ccsInteger, "", CCGetRequestParam("i8", ccsGet, NULL), $this);
        $this->i9 = & new clsControl(ccsLabel, "i9", "i9", ccsInteger, "", CCGetRequestParam("i9", ccsGet, NULL), $this);
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

//Show Method @2-1796DD54
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);

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
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["ti1"] = $this->ti1->Visible;
            $this->ControlsVisible["ti2"] = $this->ti2->Visible;
            $this->ControlsVisible["ti3"] = $this->ti3->Visible;
            $this->ControlsVisible["ti4"] = $this->ti4->Visible;
            $this->ControlsVisible["ti5"] = $this->ti5->Visible;
            $this->ControlsVisible["ti6"] = $this->ti6->Visible;
            $this->ControlsVisible["ti7"] = $this->ti7->Visible;
            $this->ControlsVisible["ti8"] = $this->ti8->Visible;
            $this->ControlsVisible["ti9"] = $this->ti9->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                $this->ano->SetValue($this->DataSource->ano->GetValue());
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->ti1->SetValue($this->DataSource->ti1->GetValue());
                $this->ti2->SetValue($this->DataSource->ti2->GetValue());
                $this->ti3->SetValue($this->DataSource->ti3->GetValue());
                $this->ti4->SetValue($this->DataSource->ti4->GetValue());
                $this->ti5->SetValue($this->DataSource->ti5->GetValue());
                $this->ti6->SetValue($this->DataSource->ti6->GetValue());
                $this->ti7->SetValue($this->DataSource->ti7->GetValue());
                $this->ti8->SetValue($this->DataSource->ti8->GetValue());
                $this->ti9->SetValue($this->DataSource->ti9->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idalquiler->Show();
                $this->ano->Show();
                $this->mes->Show();
                $this->ti1->Show();
                $this->ti2->Show();
                $this->ti3->Show();
                $this->ti4->Show();
                $this->ti5->Show();
                $this->ti6->Show();
                $this->ti7->Show();
                $this->ti8->Show();
                $this->ti9->Show();
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
        $this->Sorter_ano->Show();
        $this->Sorter_mes->Show();
        $this->Navigator->Show();
        $this->i1->Show();
        $this->i2->Show();
        $this->i3->Show();
        $this->i4->Show();
        $this->i5->Show();
        $this->i6->Show();
        $this->i7->Show();
        $this->i8->Show();
        $this->i9->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E3CD8EB0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti6->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti7->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti8->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ti9->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid1 Class @2-FCB6E20C

class clsGrid1DataSource extends clsDBConnection1 {  //Grid1DataSource Class @2-A1EC48BA

//DataSource Variables @2-622AFB39
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idalquiler;
    var $ano;
    var $mes;
    var $ti1;
    var $ti2;
    var $ti3;
    var $ti4;
    var $ti5;
    var $ti6;
    var $ti7;
    var $ti8;
    var $ti9;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-45651249
    function clsGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid1";
        $this->Initialize();
        $this->idalquiler = new clsField("idalquiler", ccsInteger, "");
        
        $this->ano = new clsField("ano", ccsInteger, "");
        
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->ti1 = new clsField("ti1", ccsText, "");
        
        $this->ti2 = new clsField("ti2", ccsText, "");
        
        $this->ti3 = new clsField("ti3", ccsText, "");
        
        $this->ti4 = new clsField("ti4", ccsText, "");
        
        $this->ti5 = new clsField("ti5", ccsText, "");
        
        $this->ti6 = new clsField("ti6", ccsText, "");
        
        $this->ti7 = new clsField("ti7", ccsText, "");
        
        $this->ti8 = new clsField("ti8", ccsText, "");
        
        $this->ti9 = new clsField("ti9", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-92B937EE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "c.ano, c.mes";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idalquiler" => array("idalquiler", ""), 
            "Sorter_ano" => array("ano", ""), 
            "Sorter_mes" => array("mes", "")));
    }
//End SetOrder Method

//Prepare Method @2-879A04A9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], 0, false);
    }
//End Prepare Method

//Open Method @2-289B9192
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select distinct c.idalquiler,c.ano,c.mes,\n" .
        "i.txtimpuesto  ti1,\n" .
        "i2.txtimpuesto ti2,\n" .
        "i3.txtimpuesto ti3,\n" .
        "i4.txtimpuesto ti4,\n" .
        "i5.txtimpuesto ti5,\n" .
        "i6.txtimpuesto ti6,\n" .
        "i7.txtimpuesto ti7,\n" .
        "i8.txtimpuesto ti8,\n" .
        "i9.txtimpuesto ti9\n" .
        "from \n" .
        "cuotas c\n" .
        "join impuestosalquileridcuota i0 on(c.idcuota = i0.idcuota and i0.idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ")\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 1 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i  on (c.idcuota = i.idcuota)	\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 2 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i2 on (c.idcuota = i2.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 3 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i3 on (c.idcuota = i3.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 4 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i4 on (c.idcuota = i4.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 5 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i5 on (c.idcuota = i5.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 6 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i6 on (c.idcuota = i6.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 7 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i7 on (c.idcuota = i7.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 8 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i8 on (c.idcuota = i8.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 9 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i9 on (c.idcuota = i9.idcuota)\n" .
        "where \n" .
        "c.idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") cnt";
        $this->SQL = "select distinct TOP {SqlParam_endRecord} c.idalquiler,c.ano,c.mes,\n" .
        "i.txtimpuesto  ti1,\n" .
        "i2.txtimpuesto ti2,\n" .
        "i3.txtimpuesto ti3,\n" .
        "i4.txtimpuesto ti4,\n" .
        "i5.txtimpuesto ti5,\n" .
        "i6.txtimpuesto ti6,\n" .
        "i7.txtimpuesto ti7,\n" .
        "i8.txtimpuesto ti8,\n" .
        "i9.txtimpuesto ti9\n" .
        "from \n" .
        "cuotas c\n" .
        "join impuestosalquileridcuota i0 on(c.idcuota = i0.idcuota and i0.idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ")\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 1 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i  on (c.idcuota = i.idcuota)	\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 2 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i2 on (c.idcuota = i2.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 3 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i3 on (c.idcuota = i3.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 4 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i4 on (c.idcuota = i4.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 5 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i5 on (c.idcuota = i5.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 6 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i6 on (c.idcuota = i6.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 7 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i7 on (c.idcuota = i7.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 8 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i8 on (c.idcuota = i8.idcuota)\n" .
        "left join (select * from impuestosalquileridcuota where idimpuesto = 9 and idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") as i9 on (c.idcuota = i9.idcuota)\n" .
        "where \n" .
        "c.idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " {SQL_OrderBy}";
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

//SetValues Method @2-F29E5A9F
    function SetValues()
    {
        $this->idalquiler->SetDBValue(trim($this->f("idalquiler")));
        $this->ano->SetDBValue(trim($this->f("ano")));
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->ti1->SetDBValue($this->f("ti1"));
        $this->ti2->SetDBValue($this->f("ti2"));
        $this->ti3->SetDBValue($this->f("ti3"));
        $this->ti4->SetDBValue($this->f("ti4"));
        $this->ti5->SetDBValue($this->f("ti5"));
        $this->ti6->SetDBValue($this->f("ti6"));
        $this->ti7->SetDBValue($this->f("ti7"));
        $this->ti8->SetDBValue($this->f("ti8"));
        $this->ti9->SetDBValue($this->f("ti9"));
    }
//End SetValues Method

} //End Grid1DataSource Class @2-FCB6E20C

//Include Page implementation @56-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-7B4BB720
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
$TemplateFileName = "mostrar_impuestos.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-131BB3C7
include_once("./mostrar_impuestos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8B99BA46
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid1 = & new clsGridGrid1("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Page = "";
$MainPage->Grid1 = & $Grid1;
$MainPage->Header = & $Header;
$MainPage->Link1 = & $Link1;
$Grid1->Initialize();

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

//Go to destination page @1-3C2B3DA8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($Grid1);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B6F51B76
$Grid1->Show();
$Header->Show();
$Link1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C5DF6014
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($Grid1);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
