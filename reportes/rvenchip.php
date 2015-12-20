<?php
//Include Common Files @1-5B52099F
define("RelativePath", "..");
define("PathToCurrentPage", "/reportes/");
define("FileName", "rvenchip.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Report1 ReportGroup class @3-E7AD21CB
class clsReportGroupReport1 {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $deudor, $_deudorAttributes;
    var $idhipoteca, $_idhipotecaAttributes;
    var $montohipoteca, $_montohipotecaAttributes;
    var $idcuota, $_idcuotaAttributes;
    var $ano, $_anoAttributes;
    var $mes, $_mesAttributes;
    var $importe, $_importeAttributes;
    var $simbolo, $_simboloAttributes;
    var $simbolo2, $_simbolo2Attributes;
    var $TotalSum_importe, $_TotalSum_importeAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;

    function clsReportGroupReport1(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->deudor = $this->Parent->deudor->Value;
        $this->idhipoteca = $this->Parent->idhipoteca->Value;
        $this->montohipoteca = $this->Parent->montohipoteca->Value;
        $this->idcuota = $this->Parent->idcuota->Value;
        $this->ano = $this->Parent->ano->Value;
        $this->mes = $this->Parent->mes->Value;
        $this->importe = $this->Parent->importe->Value;
        $this->simbolo = $this->Parent->simbolo->Value;
        $this->simbolo2 = $this->Parent->simbolo2->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->TotalSum_importe = $this->Parent->TotalSum_importe->GetTotalValue($mode);
        $this->_Sorter_deudorAttributes = $this->Parent->Sorter_deudor->Attributes->GetAsArray();
        $this->_Sorter_idhipotecaAttributes = $this->Parent->Sorter_idhipoteca->Attributes->GetAsArray();
        $this->_Sorter_montohipotecaAttributes = $this->Parent->Sorter_montohipoteca->Attributes->GetAsArray();
        $this->_Sorter_idcuotaAttributes = $this->Parent->Sorter_idcuota->Attributes->GetAsArray();
        $this->_Sorter_anoAttributes = $this->Parent->Sorter_ano->Attributes->GetAsArray();
        $this->_Sorter_mesAttributes = $this->Parent->Sorter_mes->Attributes->GetAsArray();
        $this->_Sorter_importeAttributes = $this->Parent->Sorter_importe->Attributes->GetAsArray();
        $this->_deudorAttributes = $this->Parent->deudor->Attributes->GetAsArray();
        $this->_idhipotecaAttributes = $this->Parent->idhipoteca->Attributes->GetAsArray();
        $this->_montohipotecaAttributes = $this->Parent->montohipoteca->Attributes->GetAsArray();
        $this->_idcuotaAttributes = $this->Parent->idcuota->Attributes->GetAsArray();
        $this->_anoAttributes = $this->Parent->ano->Attributes->GetAsArray();
        $this->_mesAttributes = $this->Parent->mes->Attributes->GetAsArray();
        $this->_importeAttributes = $this->Parent->importe->Attributes->GetAsArray();
        $this->_simboloAttributes = $this->Parent->simbolo->Attributes->GetAsArray();
        $this->_simbolo2Attributes = $this->Parent->simbolo2->Attributes->GetAsArray();
        $this->_TotalSum_importeAttributes = $this->Parent->TotalSum_importe->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->TotalSum_importe = $this->TotalSum_importe;
        $Header->_TotalSum_importeAttributes = $this->_TotalSum_importeAttributes;
        $this->deudor = $Header->deudor;
        $Header->_deudorAttributes = $this->_deudorAttributes;
        $this->Parent->deudor->Value = $Header->deudor;
        $this->Parent->deudor->Attributes->RestoreFromArray($Header->_deudorAttributes);
        $this->idhipoteca = $Header->idhipoteca;
        $Header->_idhipotecaAttributes = $this->_idhipotecaAttributes;
        $this->Parent->idhipoteca->Value = $Header->idhipoteca;
        $this->Parent->idhipoteca->Attributes->RestoreFromArray($Header->_idhipotecaAttributes);
        $this->montohipoteca = $Header->montohipoteca;
        $Header->_montohipotecaAttributes = $this->_montohipotecaAttributes;
        $this->Parent->montohipoteca->Value = $Header->montohipoteca;
        $this->Parent->montohipoteca->Attributes->RestoreFromArray($Header->_montohipotecaAttributes);
        $this->idcuota = $Header->idcuota;
        $Header->_idcuotaAttributes = $this->_idcuotaAttributes;
        $this->Parent->idcuota->Value = $Header->idcuota;
        $this->Parent->idcuota->Attributes->RestoreFromArray($Header->_idcuotaAttributes);
        $this->ano = $Header->ano;
        $Header->_anoAttributes = $this->_anoAttributes;
        $this->Parent->ano->Value = $Header->ano;
        $this->Parent->ano->Attributes->RestoreFromArray($Header->_anoAttributes);
        $this->mes = $Header->mes;
        $Header->_mesAttributes = $this->_mesAttributes;
        $this->Parent->mes->Value = $Header->mes;
        $this->Parent->mes->Attributes->RestoreFromArray($Header->_mesAttributes);
        $this->importe = $Header->importe;
        $Header->_importeAttributes = $this->_importeAttributes;
        $this->Parent->importe->Value = $Header->importe;
        $this->Parent->importe->Attributes->RestoreFromArray($Header->_importeAttributes);
        $this->simbolo = $Header->simbolo;
        $Header->_simboloAttributes = $this->_simboloAttributes;
        $this->Parent->simbolo->Value = $Header->simbolo;
        $this->Parent->simbolo->Attributes->RestoreFromArray($Header->_simboloAttributes);
        $this->simbolo2 = $Header->simbolo2;
        $Header->_simbolo2Attributes = $this->_simbolo2Attributes;
        $this->Parent->simbolo2->Value = $Header->simbolo2;
        $this->Parent->simbolo2->Attributes->RestoreFromArray($Header->_simbolo2Attributes);
    }
    function ChangeTotalControls() {
        $this->TotalSum_importe = $this->Parent->TotalSum_importe->GetValue();
    }
}
//End Report1 ReportGroup class

//Report1 GroupsCollection class @3-AF6FC025
class clsGroupsCollectionReport1 {
    var $Groups;
    var $mPageCurrentHeaderIndex;
    var $PageSize;
    var $TotalPages = 0;
    var $TotalRows = 0;
    var $CurrentPageSize = 0;
    var $Pages;
    var $Parent;
    var $LastDetailIndex;

    function clsGroupsCollectionReport1(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupReport1($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->deudor->Value = $this->Parent->deudor->initialValue;
        $this->Parent->idhipoteca->Value = $this->Parent->idhipoteca->initialValue;
        $this->Parent->montohipoteca->Value = $this->Parent->montohipoteca->initialValue;
        $this->Parent->idcuota->Value = $this->Parent->idcuota->initialValue;
        $this->Parent->ano->Value = $this->Parent->ano->initialValue;
        $this->Parent->mes->Value = $this->Parent->mes->initialValue;
        $this->Parent->importe->Value = $this->Parent->importe->initialValue;
        $this->Parent->simbolo->Value = $this->Parent->simbolo->initialValue;
        $this->Parent->simbolo2->Value = $this->Parent->simbolo2->initialValue;
        $this->Parent->TotalSum_importe->Value = $this->Parent->TotalSum_importe->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnInitialize", $this->Parent->Page_Header);
        if ($this->Parent->Page_Header->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Page_Header->Height;
        $Group->SetTotalControls("GetNextValue");
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnCalculate", $this->Parent->Page_Header);
        $Group->SetControls();
        $Group->Mode = 1;
        $Group->GroupType = "Page";
        $Group->PageTotalIndex = count($this->Groups);
        $this->mPageCurrentHeaderIndex = count($this->Groups);
        $this->Groups[] =  & $Group;
        $this->Pages[] =  count($this->Groups) == 2 ? 0 : count($this->Groups) - 1;
    }

    function OpenGroup($groupName) {
        $Group = "";
        $OpenFlag = false;
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnInitialize", $this->Parent->Report_Header);
            if ($this->Parent->Report_Header->Visible) 
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Header->Height;
                $Group->SetTotalControls("GetNextValue");
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnCalculate", $this->Parent->Report_Header);
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnInitialize", $this->Parent->Page_Footer);
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnCalculate", $this->Parent->Page_Footer);
        $Group->SetControls();
        $this->RestoreValues();
        $this->CurrentPageSize = 0;
        $Group->Mode = 2;
        $Group->GroupType = "Page";
        $this->Groups[] = & $Group;
    }

    function CloseGroup($groupName)
    {
        $Group = "";
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnInitialize", $this->Parent->Report_Footer);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->Report_Footer->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->Report_Footer->Height;
            if (($this->PageSize > 0) and $this->Parent->Report_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
            if ($this->Parent->Report_Footer->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Footer->Height;
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnCalculate", $this->Parent->Report_Footer);
            $Group->SetControls();
            $this->RestoreValues();
            $Group->Mode = 2;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->ClosePage();
            return;
        }
    }

    function AddItem()
    {
        $Group = & $this->InitGroup(true);
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnInitialize", $this->Parent->Detail);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->Detail->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->Detail->Height;
        if (($this->PageSize > 0) and $this->Parent->Detail->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $this->TotalRows++;
        if ($this->LastDetailIndex)
            $PrevGroup = & $this->Groups[$this->LastDetailIndex];
        else
            $PrevGroup = "";
        $Group->SetTotalControls("", $PrevGroup);
        if ($this->Parent->Detail->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Detail->Height;
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnCalculate", $this->Parent->Detail);
        $Group->SetControls($PrevGroup);
        $this->LastDetailIndex = count($this->Groups);
        $this->Groups[] = & $Group;
    }
}
//End Report1 GroupsCollection class

class clsReportReport1 { //Report1 Class @3-BC2FB08C

//Report1 Variables @3-071EF516

    var $ComponentType = "Report";
    var $PageSize;
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $CCSEvents = array();
    var $CCSEventResult;
    var $RelativePath = "";
    var $ViewMode = "Web";
    var $TemplateBlock;
    var $PageNumber;
    var $RowNumber;
    var $TotalRows;
    var $TotalPages;
    var $ControlsVisible = array();
    var $IsEmpty;
    var $Attributes;
    var $DetailBlock, $Detail;
    var $Report_FooterBlock, $Report_Footer;
    var $Report_HeaderBlock, $Report_Header;
    var $Page_FooterBlock, $Page_Footer;
    var $Page_HeaderBlock, $Page_Header;
    var $SorterName, $SorterDirection;

    var $ds;
    var $DataSource;
    var $UseClientPaging = false;

    //Report Controls
    var $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    var $Page_FooterControls, $Page_HeaderControls;
    var $Sorter_deudor;
    var $Sorter_idhipoteca;
    var $Sorter_montohipoteca;
    var $Sorter_idcuota;
    var $Sorter_ano;
    var $Sorter_mes;
    var $Sorter_importe;
//End Report1 Variables

//Class_Initialize Event @3-C768792C
    function clsReportReport1($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Report1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Report_Footer->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->Errors = new clsErrors();
        $this->DataSource = new clsReport1DataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 40;
             else if ($PageSize == "0")
                $this->PageSize = 100;
             else 
                $this->PageSize = min(100, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }
        $this->SorterName = CCGetParam("Report1Order", "");
        $this->SorterDirection = CCGetParam("Report1Dir", "");

        $this->Sorter_deudor = & new clsSorter($this->ComponentName, "Sorter_deudor", $FileName, $this);
        $this->Sorter_idhipoteca = & new clsSorter($this->ComponentName, "Sorter_idhipoteca", $FileName, $this);
        $this->Sorter_montohipoteca = & new clsSorter($this->ComponentName, "Sorter_montohipoteca", $FileName, $this);
        $this->Sorter_idcuota = & new clsSorter($this->ComponentName, "Sorter_idcuota", $FileName, $this);
        $this->Sorter_ano = & new clsSorter($this->ComponentName, "Sorter_ano", $FileName, $this);
        $this->Sorter_mes = & new clsSorter($this->ComponentName, "Sorter_mes", $FileName, $this);
        $this->Sorter_importe = & new clsSorter($this->ComponentName, "Sorter_importe", $FileName, $this);
        $this->deudor = & new clsControl(ccsReportLabel, "deudor", "deudor", ccsText, "", "", $this);
        $this->idhipoteca = & new clsControl(ccsReportLabel, "idhipoteca", "idhipoteca", ccsInteger, "", "", $this);
        $this->montohipoteca = & new clsControl(ccsReportLabel, "montohipoteca", "montohipoteca", ccsFloat, "", "", $this);
        $this->idcuota = & new clsControl(ccsReportLabel, "idcuota", "idcuota", ccsInteger, "", "", $this);
        $this->ano = & new clsControl(ccsReportLabel, "ano", "ano", ccsInteger, "", "", $this);
        $this->mes = & new clsControl(ccsReportLabel, "mes", "mes", ccsInteger, "", "", $this);
        $this->importe = & new clsControl(ccsReportLabel, "importe", "importe", ccsFloat, "", "", $this);
        $this->simbolo = & new clsControl(ccsReportLabel, "simbolo", "simbolo", ccsText, "", "", $this);
        $this->simbolo2 = & new clsControl(ccsReportLabel, "simbolo2", "simbolo2", ccsText, "", "", $this);
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->TotalSum_importe = & new clsControl(ccsReportLabel, "TotalSum_importe", "TotalSum_importe", ccsFloat, "", "", $this);
        $this->TotalSum_importe->TotalFunction = "Sum";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @3-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @3-005F4911
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->deudor->Errors->Count());
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->montohipoteca->Errors->Count());
        $errors = ($errors || $this->idcuota->Errors->Count());
        $errors = ($errors || $this->ano->Errors->Count());
        $errors = ($errors || $this->mes->Errors->Count());
        $errors = ($errors || $this->importe->Errors->Count());
        $errors = ($errors || $this->simbolo->Errors->Count());
        $errors = ($errors || $this->simbolo2->Errors->Count());
        $errors = ($errors || $this->TotalSum_importe->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @3-7444E84B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->deudor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @3-E70BEDEE
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urlperiod"] = CCGetFromGet("period", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionReport1($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->deudor->SetValue($this->DataSource->deudor->GetValue());
            $this->idhipoteca->SetValue($this->DataSource->idhipoteca->GetValue());
            $this->montohipoteca->SetValue($this->DataSource->montohipoteca->GetValue());
            $this->idcuota->SetValue($this->DataSource->idcuota->GetValue());
            $this->ano->SetValue($this->DataSource->ano->GetValue());
            $this->mes->SetValue($this->DataSource->mes->GetValue());
            $this->importe->SetValue($this->DataSource->importe->GetValue());
            $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
            $this->simbolo2->SetValue($this->DataSource->simbolo2->GetValue());
            $this->TotalSum_importe->SetValue($this->DataSource->TotalSum_importe->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            $Groups->AddItem();
            $is_next_record = $this->DataSource->next_record();
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
        else
            $this->NoRecords->Visible = false;
        $Groups->CloseGroup("Report");
        $this->TotalPages = $Groups->TotalPages;
        $this->TotalRows = $Groups->TotalRows;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $this->Attributes->Show();
        $ReportBlock = "Report " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;

        if($this->CheckErrors()) {
            $Tpl->replaceblock("", $this->GetErrors());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $items = & $Groups->Groups;
            $i = $Groups->Pages[min($this->PageNumber, $Groups->TotalPages) - 1];
            $this->ControlsVisible["deudor"] = $this->deudor->Visible;
            $this->ControlsVisible["idhipoteca"] = $this->idhipoteca->Visible;
            $this->ControlsVisible["montohipoteca"] = $this->montohipoteca->Visible;
            $this->ControlsVisible["idcuota"] = $this->idcuota->Visible;
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            $this->ControlsVisible["simbolo2"] = $this->simbolo2->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->deudor->SetValue($items[$i]->deudor);
                        $this->deudor->Attributes->RestoreFromArray($items[$i]->_deudorAttributes);
                        $this->idhipoteca->SetValue($items[$i]->idhipoteca);
                        $this->idhipoteca->Attributes->RestoreFromArray($items[$i]->_idhipotecaAttributes);
                        $this->montohipoteca->SetValue($items[$i]->montohipoteca);
                        $this->montohipoteca->Attributes->RestoreFromArray($items[$i]->_montohipotecaAttributes);
                        $this->idcuota->SetValue($items[$i]->idcuota);
                        $this->idcuota->Attributes->RestoreFromArray($items[$i]->_idcuotaAttributes);
                        $this->ano->SetValue($items[$i]->ano);
                        $this->ano->Attributes->RestoreFromArray($items[$i]->_anoAttributes);
                        $this->mes->SetValue($items[$i]->mes);
                        $this->mes->Attributes->RestoreFromArray($items[$i]->_mesAttributes);
                        $this->importe->SetValue($items[$i]->importe);
                        $this->importe->Attributes->RestoreFromArray($items[$i]->_importeAttributes);
                        $this->simbolo->SetValue($items[$i]->simbolo);
                        $this->simbolo->Attributes->RestoreFromArray($items[$i]->_simboloAttributes);
                        $this->simbolo2->SetValue($items[$i]->simbolo2);
                        $this->simbolo2->Attributes->RestoreFromArray($items[$i]->_simbolo2Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->deudor->Show();
                        $this->idhipoteca->Show();
                        $this->montohipoteca->Show();
                        $this->idcuota->Show();
                        $this->ano->Show();
                        $this->mes->Show();
                        $this->importe->Show();
                        $this->simbolo->Show();
                        $this->simbolo2->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->TotalSum_importe->SetValue($items[$i]->TotalSum_importe);
                            $this->TotalSum_importe->Attributes->RestoreFromArray($items[$i]->_TotalSum_importeAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_importe->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "Page":
                        if ($items[$i]->Mode == 1) {
                            $this->Page_Header->CCSEventResult = CCGetEvent($this->Page_Header->CCSEvents, "BeforeShow", $this->Page_Header);
                            if ($this->Page_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Header";
                                $this->Attributes->Show();
                                $this->Sorter_deudor->Show();
                                $this->Sorter_idhipoteca->Show();
                                $this->Sorter_montohipoteca->Show();
                                $this->Sorter_idcuota->Show();
                                $this->Sorter_ano->Show();
                                $this->Sorter_mes->Show();
                                $this->Sorter_importe->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End Report1 Class @3-FCB6E20C

class clsReport1DataSource extends clsDBConnection1 {  //Report1DataSource Class @3-20EE0F53

//DataSource Variables @3-9884A3F4
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $deudor;
    var $idhipoteca;
    var $montohipoteca;
    var $idcuota;
    var $ano;
    var $mes;
    var $importe;
    var $simbolo;
    var $simbolo2;
    var $TotalSum_importe;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-9A29A224
    function clsReport1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Report1";
        $this->Initialize();
        $this->deudor = new clsField("deudor", ccsText, "");
        
        $this->idhipoteca = new clsField("idhipoteca", ccsInteger, "");
        
        $this->montohipoteca = new clsField("montohipoteca", ccsFloat, "");
        
        $this->idcuota = new clsField("idcuota", ccsInteger, "");
        
        $this->ano = new clsField("ano", ccsInteger, "");
        
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->simbolo = new clsField("simbolo", ccsText, "");
        
        $this->simbolo2 = new clsField("simbolo2", ccsText, "");
        
        $this->TotalSum_importe = new clsField("TotalSum_importe", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @3-FB2C80CD
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_deudor" => array("deudor", ""), 
            "Sorter_idhipoteca" => array("idhipoteca", ""), 
            "Sorter_montohipoteca" => array("montohipoteca", ""), 
            "Sorter_idcuota" => array("idcuota", ""), 
            "Sorter_ano" => array("ano", ""), 
            "Sorter_mes" => array("mes", ""), 
            "Sorter_importe" => array("importe", "")));
    }
//End SetOrder Method

//Prepare Method @3-3BC7F6F9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlperiod", ccsInteger, "", "", $this->Parameters["urlperiod"], 30, false);
    }
//End Prepare Method

//Open Method @3-6DC3E57E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select f.idficha,f.nombre as deudor,h.idhipoteca,h.montohipoteca, c.idcuota,c.ano,c.mes,c.importe,m.simbolo\n" .
        "	from cuotas c\n" .
        "	join hipotecas h on(c.idhipoteca = h.idhipoteca)\n" .
        "	join fichaspropiedades fp on(h.idpropiedad = fp.idpropiedad)\n" .
        "	join fichas f on(fp.idficha = f.idficha)\n" .
        "	join monedas m on(h.idmoneda = m.idmoneda)\n" .
        "where fechapago is null\n" .
        "and fechavencimiento between getdate() and getdate() + " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "and idtipocuota in(2,4)\n" .
        "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-44D7A0E6
    function SetValues()
    {
        $this->deudor->SetDBValue($this->f("deudor"));
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->idcuota->SetDBValue(trim($this->f("idcuota")));
        $this->ano->SetDBValue(trim($this->f("ano")));
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->simbolo->SetDBValue($this->f("simbolo"));
        $this->simbolo2->SetDBValue($this->f("simbolo"));
        $this->TotalSum_importe->SetDBValue(trim($this->f("importe")));
    }
//End SetValues Method

} //End Report1DataSource Class @3-FCB6E20C

//Initialize Page @1-60B9F17C
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
$TemplateFileName = "rvenchip.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-077C95A2
include_once("./rvenchip_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6A50F327
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$Report1 = & new clsReportReport1("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->Report1 = & $Report1;
$Report1->Initialize();

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

//Go to destination page @1-0F550FCC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($Report1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-01FE0558
$Header->Show();
$Report1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C8A07A5F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($Report1);
unset($Tpl);
//End Unload Page


?>
