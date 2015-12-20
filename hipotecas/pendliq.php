<?php
//Include Common Files @1-D183E712
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "pendliq.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsGridGrid1 { //Grid1 class @3-E857A572

//Variables @3-6CA3392E

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
    var $Sorter_idhipoteca;
    var $Sorter_montohipoteca;
    var $Sorter_idcuota;
    var $Sorter_ano;
    var $Sorter_mes;
    var $Sorter_importe;
//End Variables

//Class_Initialize Event @3-C9015A1D
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
            $this->PageSize = 10;
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

        $this->idficha = & new clsControl(ccsLabel, "idficha", "idficha", ccsInteger, "", CCGetRequestParam("idficha", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->idhipoteca = & new clsControl(ccsLabel, "idhipoteca", "idhipoteca", ccsInteger, "", CCGetRequestParam("idhipoteca", ccsGet, NULL), $this);
        $this->montohipoteca = & new clsControl(ccsLabel, "montohipoteca", "montohipoteca", ccsFloat, "", CCGetRequestParam("montohipoteca", ccsGet, NULL), $this);
        $this->idcuota = & new clsControl(ccsLabel, "idcuota", "idcuota", ccsInteger, "", CCGetRequestParam("idcuota", ccsGet, NULL), $this);
        $this->ano = & new clsControl(ccsLabel, "ano", "ano", ccsInteger, "", CCGetRequestParam("ano", ccsGet, NULL), $this);
        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsInteger, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsLabel, "importe", "importe", ccsFloat, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->fechaaviso = & new clsControl(ccsLabel, "fechaaviso", "fechaaviso", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechaaviso", ccsGet, NULL), $this);
        $this->fechapago = & new clsControl(ccsLabel, "fechapago", "fechapago", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechapago", ccsGet, NULL), $this);
        $this->simbolo = & new clsControl(ccsLabel, "simbolo", "simbolo", ccsText, "", CCGetRequestParam("simbolo", ccsGet, NULL), $this);
        $this->Sorter_idficha = & new clsSorter($this->ComponentName, "Sorter_idficha", $FileName, $this);
        $this->Sorter_nombre = & new clsSorter($this->ComponentName, "Sorter_nombre", $FileName, $this);
        $this->Sorter_idhipoteca = & new clsSorter($this->ComponentName, "Sorter_idhipoteca", $FileName, $this);
        $this->Sorter_montohipoteca = & new clsSorter($this->ComponentName, "Sorter_montohipoteca", $FileName, $this);
        $this->Sorter_idcuota = & new clsSorter($this->ComponentName, "Sorter_idcuota", $FileName, $this);
        $this->Sorter_ano = & new clsSorter($this->ComponentName, "Sorter_ano", $FileName, $this);
        $this->Sorter_mes = & new clsSorter($this->ComponentName, "Sorter_mes", $FileName, $this);
        $this->Sorter_importe = & new clsSorter($this->ComponentName, "Sorter_importe", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @3-1755DBE0
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
            $this->ControlsVisible["idficha"] = $this->idficha->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["idhipoteca"] = $this->idhipoteca->Visible;
            $this->ControlsVisible["montohipoteca"] = $this->montohipoteca->Visible;
            $this->ControlsVisible["idcuota"] = $this->idcuota->Visible;
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["fechaaviso"] = $this->fechaaviso->Visible;
            $this->ControlsVisible["fechapago"] = $this->fechapago->Visible;
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->idhipoteca->SetValue($this->DataSource->idhipoteca->GetValue());
                $this->montohipoteca->SetValue($this->DataSource->montohipoteca->GetValue());
                $this->idcuota->SetValue($this->DataSource->idcuota->GetValue());
                $this->ano->SetValue($this->DataSource->ano->GetValue());
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->fechaaviso->SetValue($this->DataSource->fechaaviso->GetValue());
                $this->fechapago->SetValue($this->DataSource->fechapago->GetValue());
                $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show();
                $this->nombre->Show();
                $this->idhipoteca->Show();
                $this->montohipoteca->Show();
                $this->idcuota->Show();
                $this->ano->Show();
                $this->mes->Show();
                $this->importe->Show();
                $this->fechaaviso->Show();
                $this->fechapago->Show();
                $this->simbolo->Show();
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
        $this->Sorter_idhipoteca->Show();
        $this->Sorter_montohipoteca->Show();
        $this->Sorter_idcuota->Show();
        $this->Sorter_ano->Show();
        $this->Sorter_mes->Show();
        $this->Sorter_importe->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @3-68510EF6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechaaviso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechapago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid1 Class @3-FCB6E20C

class clsGrid1DataSource extends clsDBConnection1 {  //Grid1DataSource Class @3-A1EC48BA

//DataSource Variables @3-8ACB687E
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
    var $idhipoteca;
    var $montohipoteca;
    var $idcuota;
    var $ano;
    var $mes;
    var $importe;
    var $fechaaviso;
    var $fechapago;
    var $simbolo;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-DFBBFB5A
    function clsGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid1";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->idhipoteca = new clsField("idhipoteca", ccsInteger, "");
        
        $this->montohipoteca = new clsField("montohipoteca", ccsFloat, "");
        
        $this->idcuota = new clsField("idcuota", ccsInteger, "");
        
        $this->ano = new clsField("ano", ccsInteger, "");
        
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->fechaaviso = new clsField("fechaaviso", ccsDate, $this->DateFormat);
        
        $this->fechapago = new clsField("fechapago", ccsDate, $this->DateFormat);
        
        $this->simbolo = new clsField("simbolo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @3-70596F83
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idficha" => array("idficha", ""), 
            "Sorter_nombre" => array("nombre", ""), 
            "Sorter_idhipoteca" => array("idhipoteca", ""), 
            "Sorter_montohipoteca" => array("montohipoteca", ""), 
            "Sorter_idcuota" => array("idcuota", ""), 
            "Sorter_ano" => array("ano", ""), 
            "Sorter_mes" => array("mes", ""), 
            "Sorter_importe" => array("importe", "")));
    }
//End SetOrder Method

//Prepare Method @3-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @3-29596B64
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select f.idficha,f.nombre,h.idhipoteca,h.montohipoteca, m.simbolo,c.idcuota,c.ano,c.mes,c.importe,c.fechaaviso,c.fechapago\n" .
        "	from cuotas c\n" .
        "	join hipotecas h on(c.idhipoteca = h.idhipoteca)\n" .
        "	join fichashipotecas fh on(h.idhipoteca = c.idhipoteca)\n" .
        "	join fichas f on(fh.idficha = f.idficha)\n" .
        "	join monedas m on(h.idmoneda = m.idmoneda)\n" .
        "where fechapago is not null\n" .
        "and fechaliquidacion is null\n" .
        "and fechaaviso is not null\n" .
        "and idtipocuota in(2,4)) cnt";
        $this->SQL = "select f.idficha,f.nombre,h.idhipoteca,h.montohipoteca, m.simbolo,c.idcuota,c.ano,c.mes,c.importe,c.fechaaviso,c.fechapago\n" .
        "	from cuotas c\n" .
        "	join hipotecas h on(c.idhipoteca = h.idhipoteca)\n" .
        "	join fichashipotecas fh on(h.idhipoteca = c.idhipoteca)\n" .
        "	join fichas f on(fh.idficha = f.idficha)\n" .
        "	join monedas m on(h.idmoneda = m.idmoneda)\n" .
        "where fechapago is not null\n" .
        "and fechaliquidacion is null\n" .
        "and fechaaviso is not null\n" .
        "and idtipocuota in(2,4)";
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

//SetValues Method @3-ECFB9FF5
    function SetValues()
    {
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->idcuota->SetDBValue(trim($this->f("idcuota")));
        $this->ano->SetDBValue(trim($this->f("ano")));
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->fechaaviso->SetDBValue(trim($this->f("fechaaviso")));
        $this->fechapago->SetDBValue(trim($this->f("fechapago")));
        $this->simbolo->SetDBValue($this->f("simbolo"));
    }
//End SetValues Method

} //End Grid1DataSource Class @3-FCB6E20C

//Initialize Page @1-1C7139EC
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
$TemplateFileName = "pendliq.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9DB0B1C0
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$Grid1 = & new clsGridGrid1("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->Grid1 = & $Grid1;
$Grid1->Initialize();

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

//Go to destination page @1-E514A878
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($Grid1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E4AB4BFA
$Header->Show();
$Grid1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A65A790D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($Grid1);
unset($Tpl);
//End Unload Page


?>
