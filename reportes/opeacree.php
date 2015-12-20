<?php
//Include Common Files @1-FAD43398
define("RelativePath", "..");
define("PathToCurrentPage", "/reportes/");
define("FileName", "opeacree.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordfichas { //fichas Class @3-5BA7C2BC

//Variables @3-D6FF3E86

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

//Class_Initialize Event @3-3B0FD49C
    function clsRecordfichas($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record fichas/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "fichas";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_idficha = & new clsControl(ccsTextBox, "s_idficha", "s_idficha", ccsInteger, "", CCGetRequestParam("s_idficha", $Method, NULL), $this);
            $this->s_nombre = & new clsControl(ccsTextBox, "s_nombre", "s_nombre", ccsText, "", CCGetRequestParam("s_nombre", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-C0263FF8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_idficha->Validate() && $Validation);
        $Validation = ($this->s_nombre->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_idficha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-8944A74A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_idficha->Errors->Count());
        $errors = ($errors || $this->s_nombre->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-4A789C07
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
        $Redirect = "opeacree.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "opeacree.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-D524F7FA
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
            $Error = ComposeStrings($Error, $this->s_idficha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombre->Errors->ToString());
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
        $this->s_idficha->Show();
        $this->s_nombre->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End fichas Class @3-FCB6E20C

//Report1 ReportGroup class @7-A2254DEB
class clsReportGroupReport1 {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $idhipoteca, $_idhipotecaAttributes;
    var $fechainicio, $_fechainicioAttributes;
    var $fechafin, $_fechafinAttributes;
    var $deudor, $_deudorAttributes;
    var $tipooperacion, $_tipooperacionAttributes;
    var $montohipoteca, $_montohipotecaAttributes;
    var $simbolo, $_simboloAttributes;
    var $importe, $_importeAttributes;
    var $TotalCount_idhipoteca, $_TotalCount_idhipotecaAttributes;
    var $TotalSum_montohipoteca, $_TotalSum_montohipotecaAttributes;
    var $TotalMin_montohipoteca, $_TotalMin_montohipotecaAttributes;
    var $TotalMax_montohipoteca, $_TotalMax_montohipotecaAttributes;
    var $TotalAvg_montohipoteca, $_TotalAvg_montohipotecaAttributes;
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
        $this->idhipoteca = $this->Parent->idhipoteca->Value;
        $this->fechainicio = $this->Parent->fechainicio->Value;
        $this->fechafin = $this->Parent->fechafin->Value;
        $this->deudor = $this->Parent->deudor->Value;
        $this->tipooperacion = $this->Parent->tipooperacion->Value;
        $this->montohipoteca = $this->Parent->montohipoteca->Value;
        $this->simbolo = $this->Parent->simbolo->Value;
        $this->importe = $this->Parent->importe->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->TotalCount_idhipoteca = $this->Parent->TotalCount_idhipoteca->GetTotalValue($mode);
        $this->TotalSum_montohipoteca = $this->Parent->TotalSum_montohipoteca->GetTotalValue($mode);
        $this->TotalMin_montohipoteca = $this->Parent->TotalMin_montohipoteca->GetTotalValue($mode);
        $this->TotalMax_montohipoteca = $this->Parent->TotalMax_montohipoteca->GetTotalValue($mode);
        $this->TotalAvg_montohipoteca = $this->Parent->TotalAvg_montohipoteca->GetTotalValue($mode);
        $this->_Sorter_idhipotecaAttributes = $this->Parent->Sorter_idhipoteca->Attributes->GetAsArray();
        $this->_Sorter_fechainicioAttributes = $this->Parent->Sorter_fechainicio->Attributes->GetAsArray();
        $this->_Sorter_fechafinAttributes = $this->Parent->Sorter_fechafin->Attributes->GetAsArray();
        $this->_Sorter_deudorAttributes = $this->Parent->Sorter_deudor->Attributes->GetAsArray();
        $this->_Sorter_tipooperacionAttributes = $this->Parent->Sorter_tipooperacion->Attributes->GetAsArray();
        $this->_Sorter_montohipotecaAttributes = $this->Parent->Sorter_montohipoteca->Attributes->GetAsArray();
        $this->_idhipotecaAttributes = $this->Parent->idhipoteca->Attributes->GetAsArray();
        $this->_fechainicioAttributes = $this->Parent->fechainicio->Attributes->GetAsArray();
        $this->_fechafinAttributes = $this->Parent->fechafin->Attributes->GetAsArray();
        $this->_deudorAttributes = $this->Parent->deudor->Attributes->GetAsArray();
        $this->_tipooperacionAttributes = $this->Parent->tipooperacion->Attributes->GetAsArray();
        $this->_montohipotecaAttributes = $this->Parent->montohipoteca->Attributes->GetAsArray();
        $this->_simboloAttributes = $this->Parent->simbolo->Attributes->GetAsArray();
        $this->_importeAttributes = $this->Parent->importe->Attributes->GetAsArray();
        $this->_TotalCount_idhipotecaAttributes = $this->Parent->TotalCount_idhipoteca->Attributes->GetAsArray();
        $this->_TotalSum_montohipotecaAttributes = $this->Parent->TotalSum_montohipoteca->Attributes->GetAsArray();
        $this->_TotalMin_montohipotecaAttributes = $this->Parent->TotalMin_montohipoteca->Attributes->GetAsArray();
        $this->_TotalMax_montohipotecaAttributes = $this->Parent->TotalMax_montohipoteca->Attributes->GetAsArray();
        $this->_TotalAvg_montohipotecaAttributes = $this->Parent->TotalAvg_montohipoteca->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->TotalCount_idhipoteca = $this->TotalCount_idhipoteca;
        $Header->_TotalCount_idhipotecaAttributes = $this->_TotalCount_idhipotecaAttributes;
        $Header->TotalSum_montohipoteca = $this->TotalSum_montohipoteca;
        $Header->_TotalSum_montohipotecaAttributes = $this->_TotalSum_montohipotecaAttributes;
        $Header->TotalMin_montohipoteca = $this->TotalMin_montohipoteca;
        $Header->_TotalMin_montohipotecaAttributes = $this->_TotalMin_montohipotecaAttributes;
        $Header->TotalMax_montohipoteca = $this->TotalMax_montohipoteca;
        $Header->_TotalMax_montohipotecaAttributes = $this->_TotalMax_montohipotecaAttributes;
        $Header->TotalAvg_montohipoteca = $this->TotalAvg_montohipoteca;
        $Header->_TotalAvg_montohipotecaAttributes = $this->_TotalAvg_montohipotecaAttributes;
        $this->idhipoteca = $Header->idhipoteca;
        $Header->_idhipotecaAttributes = $this->_idhipotecaAttributes;
        $this->Parent->idhipoteca->Value = $Header->idhipoteca;
        $this->Parent->idhipoteca->Attributes->RestoreFromArray($Header->_idhipotecaAttributes);
        $this->fechainicio = $Header->fechainicio;
        $Header->_fechainicioAttributes = $this->_fechainicioAttributes;
        $this->Parent->fechainicio->Value = $Header->fechainicio;
        $this->Parent->fechainicio->Attributes->RestoreFromArray($Header->_fechainicioAttributes);
        $this->fechafin = $Header->fechafin;
        $Header->_fechafinAttributes = $this->_fechafinAttributes;
        $this->Parent->fechafin->Value = $Header->fechafin;
        $this->Parent->fechafin->Attributes->RestoreFromArray($Header->_fechafinAttributes);
        $this->deudor = $Header->deudor;
        $Header->_deudorAttributes = $this->_deudorAttributes;
        $this->Parent->deudor->Value = $Header->deudor;
        $this->Parent->deudor->Attributes->RestoreFromArray($Header->_deudorAttributes);
        $this->tipooperacion = $Header->tipooperacion;
        $Header->_tipooperacionAttributes = $this->_tipooperacionAttributes;
        $this->Parent->tipooperacion->Value = $Header->tipooperacion;
        $this->Parent->tipooperacion->Attributes->RestoreFromArray($Header->_tipooperacionAttributes);
        $this->montohipoteca = $Header->montohipoteca;
        $Header->_montohipotecaAttributes = $this->_montohipotecaAttributes;
        $this->Parent->montohipoteca->Value = $Header->montohipoteca;
        $this->Parent->montohipoteca->Attributes->RestoreFromArray($Header->_montohipotecaAttributes);
        $this->simbolo = $Header->simbolo;
        $Header->_simboloAttributes = $this->_simboloAttributes;
        $this->Parent->simbolo->Value = $Header->simbolo;
        $this->Parent->simbolo->Attributes->RestoreFromArray($Header->_simboloAttributes);
        $this->importe = $Header->importe;
        $Header->_importeAttributes = $this->_importeAttributes;
        $this->Parent->importe->Value = $Header->importe;
        $this->Parent->importe->Attributes->RestoreFromArray($Header->_importeAttributes);
    }
    function ChangeTotalControls() {
        $this->TotalCount_idhipoteca = $this->Parent->TotalCount_idhipoteca->GetValue();
        $this->TotalSum_montohipoteca = $this->Parent->TotalSum_montohipoteca->GetValue();
        $this->TotalMin_montohipoteca = $this->Parent->TotalMin_montohipoteca->GetValue();
        $this->TotalMax_montohipoteca = $this->Parent->TotalMax_montohipoteca->GetValue();
        $this->TotalAvg_montohipoteca = $this->Parent->TotalAvg_montohipoteca->GetValue();
    }
}
//End Report1 ReportGroup class

//Report1 GroupsCollection class @7-3E9591F3
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
        $this->Parent->idhipoteca->Value = $this->Parent->idhipoteca->initialValue;
        $this->Parent->fechainicio->Value = $this->Parent->fechainicio->initialValue;
        $this->Parent->fechafin->Value = $this->Parent->fechafin->initialValue;
        $this->Parent->deudor->Value = $this->Parent->deudor->initialValue;
        $this->Parent->tipooperacion->Value = $this->Parent->tipooperacion->initialValue;
        $this->Parent->montohipoteca->Value = $this->Parent->montohipoteca->initialValue;
        $this->Parent->simbolo->Value = $this->Parent->simbolo->initialValue;
        $this->Parent->importe->Value = $this->Parent->importe->initialValue;
        $this->Parent->TotalCount_idhipoteca->Value = $this->Parent->TotalCount_idhipoteca->initialValue;
        $this->Parent->TotalSum_montohipoteca->Value = $this->Parent->TotalSum_montohipoteca->initialValue;
        $this->Parent->TotalMin_montohipoteca->Value = $this->Parent->TotalMin_montohipoteca->initialValue;
        $this->Parent->TotalMax_montohipoteca->Value = $this->Parent->TotalMax_montohipoteca->initialValue;
        $this->Parent->TotalAvg_montohipoteca->Value = $this->Parent->TotalAvg_montohipoteca->initialValue;
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

class clsReportReport1 { //Report1 Class @7-BC2FB08C

//Report1 Variables @7-C8AEDBC1

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
    var $Sorter_idhipoteca;
    var $Sorter_fechainicio;
    var $Sorter_fechafin;
    var $Sorter_deudor;
    var $Sorter_tipooperacion;
    var $Sorter_montohipoteca;
//End Report1 Variables

//Class_Initialize Event @7-7434B510
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

        $this->Sorter_idhipoteca = & new clsSorter($this->ComponentName, "Sorter_idhipoteca", $FileName, $this);
        $this->Sorter_fechainicio = & new clsSorter($this->ComponentName, "Sorter_fechainicio", $FileName, $this);
        $this->Sorter_fechafin = & new clsSorter($this->ComponentName, "Sorter_fechafin", $FileName, $this);
        $this->Sorter_deudor = & new clsSorter($this->ComponentName, "Sorter_deudor", $FileName, $this);
        $this->Sorter_tipooperacion = & new clsSorter($this->ComponentName, "Sorter_tipooperacion", $FileName, $this);
        $this->Sorter_montohipoteca = & new clsSorter($this->ComponentName, "Sorter_montohipoteca", $FileName, $this);
        $this->idhipoteca = & new clsControl(ccsReportLabel, "idhipoteca", "idhipoteca", ccsInteger, "", "", $this);
        $this->fechainicio = & new clsControl(ccsReportLabel, "fechainicio", "fechainicio", ccsDate, $DefaultDateFormat, "", $this);
        $this->fechafin = & new clsControl(ccsReportLabel, "fechafin", "fechafin", ccsDate, $DefaultDateFormat, "", $this);
        $this->deudor = & new clsControl(ccsReportLabel, "deudor", "deudor", ccsText, "", "", $this);
        $this->tipooperacion = & new clsControl(ccsReportLabel, "tipooperacion", "tipooperacion", ccsText, "", "", $this);
        $this->montohipoteca = & new clsControl(ccsReportLabel, "montohipoteca", "montohipoteca", ccsFloat, "", "", $this);
        $this->simbolo = & new clsControl(ccsReportLabel, "simbolo", "simbolo", ccsText, "", "", $this);
        $this->importe = & new clsControl(ccsReportLabel, "importe", "importe", ccsText, "", "", $this);
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->TotalCount_idhipoteca = & new clsControl(ccsReportLabel, "TotalCount_idhipoteca", "TotalCount_idhipoteca", ccsInteger, "", 0, $this);
        $this->TotalCount_idhipoteca->TotalFunction = "Count";
        $this->TotalCount_idhipoteca->IsEmptySource = true;
        $this->TotalSum_montohipoteca = & new clsControl(ccsReportLabel, "TotalSum_montohipoteca", "TotalSum_montohipoteca", ccsFloat, "", "", $this);
        $this->TotalSum_montohipoteca->TotalFunction = "Sum";
        $this->TotalMin_montohipoteca = & new clsControl(ccsReportLabel, "TotalMin_montohipoteca", "TotalMin_montohipoteca", ccsFloat, array(True, 2, Null, "", False, array("#"), array("0", "0"), 1, True, ""), "", $this);
        $this->TotalMin_montohipoteca->TotalFunction = "Min";
        $this->TotalMax_montohipoteca = & new clsControl(ccsReportLabel, "TotalMax_montohipoteca", "TotalMax_montohipoteca", ccsFloat, array(True, 2, Null, "", False, array("#"), array("0", "0"), 1, True, ""), "", $this);
        $this->TotalMax_montohipoteca->TotalFunction = "Max";
        $this->TotalAvg_montohipoteca = & new clsControl(ccsReportLabel, "TotalAvg_montohipoteca", "TotalAvg_montohipoteca", ccsFloat, "", "", $this);
        $this->TotalAvg_montohipoteca->TotalFunction = "Avg";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @7-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @7-5B80B0E3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->fechainicio->Errors->Count());
        $errors = ($errors || $this->fechafin->Errors->Count());
        $errors = ($errors || $this->deudor->Errors->Count());
        $errors = ($errors || $this->tipooperacion->Errors->Count());
        $errors = ($errors || $this->montohipoteca->Errors->Count());
        $errors = ($errors || $this->simbolo->Errors->Count());
        $errors = ($errors || $this->importe->Errors->Count());
        $errors = ($errors || $this->TotalCount_idhipoteca->Errors->Count());
        $errors = ($errors || $this->TotalSum_montohipoteca->Errors->Count());
        $errors = ($errors || $this->TotalMin_montohipoteca->Errors->Count());
        $errors = ($errors || $this->TotalMax_montohipoteca->Errors->Count());
        $errors = ($errors || $this->TotalAvg_montohipoteca->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @7-EC802E11
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->deudor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipooperacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalCount_idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalMin_montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalMax_montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalAvg_montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @7-1137F442
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_idficha"] = CCGetFromGet("s_idficha", NULL);
        $this->DataSource->Parameters["urls_nombre"] = CCGetFromGet("s_nombre", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionReport1($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->idhipoteca->SetValue($this->DataSource->idhipoteca->GetValue());
            $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
            $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
            $this->deudor->SetValue($this->DataSource->deudor->GetValue());
            $this->tipooperacion->SetValue($this->DataSource->tipooperacion->GetValue());
            $this->montohipoteca->SetValue($this->DataSource->montohipoteca->GetValue());
            $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
            $this->importe->SetValue($this->DataSource->importe->GetValue());
            $this->TotalSum_montohipoteca->SetValue($this->DataSource->TotalSum_montohipoteca->GetValue());
            $this->TotalMin_montohipoteca->SetValue($this->DataSource->TotalMin_montohipoteca->GetValue());
            $this->TotalMax_montohipoteca->SetValue($this->DataSource->TotalMax_montohipoteca->GetValue());
            $this->TotalAvg_montohipoteca->SetValue($this->DataSource->TotalAvg_montohipoteca->GetValue());
            $this->TotalCount_idhipoteca->SetValue(1);
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
            $this->ControlsVisible["idhipoteca"] = $this->idhipoteca->Visible;
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["fechafin"] = $this->fechafin->Visible;
            $this->ControlsVisible["deudor"] = $this->deudor->Visible;
            $this->ControlsVisible["tipooperacion"] = $this->tipooperacion->Visible;
            $this->ControlsVisible["montohipoteca"] = $this->montohipoteca->Visible;
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->idhipoteca->SetValue($items[$i]->idhipoteca);
                        $this->idhipoteca->Attributes->RestoreFromArray($items[$i]->_idhipotecaAttributes);
                        $this->fechainicio->SetValue($items[$i]->fechainicio);
                        $this->fechainicio->Attributes->RestoreFromArray($items[$i]->_fechainicioAttributes);
                        $this->fechafin->SetValue($items[$i]->fechafin);
                        $this->fechafin->Attributes->RestoreFromArray($items[$i]->_fechafinAttributes);
                        $this->deudor->SetValue($items[$i]->deudor);
                        $this->deudor->Attributes->RestoreFromArray($items[$i]->_deudorAttributes);
                        $this->tipooperacion->SetValue($items[$i]->tipooperacion);
                        $this->tipooperacion->Attributes->RestoreFromArray($items[$i]->_tipooperacionAttributes);
                        $this->montohipoteca->SetValue($items[$i]->montohipoteca);
                        $this->montohipoteca->Attributes->RestoreFromArray($items[$i]->_montohipotecaAttributes);
                        $this->simbolo->SetValue($items[$i]->simbolo);
                        $this->simbolo->Attributes->RestoreFromArray($items[$i]->_simboloAttributes);
                        $this->importe->SetValue($items[$i]->importe);
                        $this->importe->Attributes->RestoreFromArray($items[$i]->_importeAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->idhipoteca->Show();
                        $this->fechainicio->Show();
                        $this->fechafin->Show();
                        $this->deudor->Show();
                        $this->tipooperacion->Show();
                        $this->montohipoteca->Show();
                        $this->simbolo->Show();
                        $this->importe->Show();
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
                            $this->TotalCount_idhipoteca->SetValue($items[$i]->TotalCount_idhipoteca);
                            $this->TotalCount_idhipoteca->Attributes->RestoreFromArray($items[$i]->_TotalCount_idhipotecaAttributes);
                            $this->TotalSum_montohipoteca->SetValue($items[$i]->TotalSum_montohipoteca);
                            $this->TotalSum_montohipoteca->Attributes->RestoreFromArray($items[$i]->_TotalSum_montohipotecaAttributes);
                            $this->TotalMin_montohipoteca->SetText(CCFormatNumber($items[$i]->TotalMin_montohipoteca, array(True, 2, Null, "", False, array("#"), array("0", "0"), 1, True, "")), ccsFloat);
                            $this->TotalMin_montohipoteca->Attributes->RestoreFromArray($items[$i]->_TotalMin_montohipotecaAttributes);
                            $this->TotalMax_montohipoteca->SetText(CCFormatNumber($items[$i]->TotalMax_montohipoteca, array(True, 2, Null, "", False, array("#"), array("0", "0"), 1, True, "")), ccsFloat);
                            $this->TotalMax_montohipoteca->Attributes->RestoreFromArray($items[$i]->_TotalMax_montohipotecaAttributes);
                            $this->TotalAvg_montohipoteca->SetValue($items[$i]->TotalAvg_montohipoteca);
                            $this->TotalAvg_montohipoteca->Attributes->RestoreFromArray($items[$i]->_TotalAvg_montohipotecaAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalCount_idhipoteca->Show();
                                $this->TotalSum_montohipoteca->Show();
                                $this->TotalMin_montohipoteca->Show();
                                $this->TotalMax_montohipoteca->Show();
                                $this->TotalAvg_montohipoteca->Show();
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
                                $this->Sorter_idhipoteca->Show();
                                $this->Sorter_fechainicio->Show();
                                $this->Sorter_fechafin->Show();
                                $this->Sorter_deudor->Show();
                                $this->Sorter_tipooperacion->Show();
                                $this->Sorter_montohipoteca->Show();
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

} //End Report1 Class @7-FCB6E20C

class clsReport1DataSource extends clsDBConnection1 {  //Report1DataSource Class @7-20EE0F53

//DataSource Variables @7-6A77E256
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $idhipoteca;
    var $fechainicio;
    var $fechafin;
    var $deudor;
    var $tipooperacion;
    var $montohipoteca;
    var $simbolo;
    var $importe;
    var $TotalSum_montohipoteca;
    var $TotalMin_montohipoteca;
    var $TotalMax_montohipoteca;
    var $TotalAvg_montohipoteca;
//End DataSource Variables

//DataSourceClass_Initialize Event @7-4A245622
    function clsReport1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Report1";
        $this->Initialize();
        $this->idhipoteca = new clsField("idhipoteca", ccsInteger, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, $this->DateFormat);
        
        $this->fechafin = new clsField("fechafin", ccsDate, $this->DateFormat);
        
        $this->deudor = new clsField("deudor", ccsText, "");
        
        $this->tipooperacion = new clsField("tipooperacion", ccsText, "");
        
        $this->montohipoteca = new clsField("montohipoteca", ccsFloat, "");
        
        $this->simbolo = new clsField("simbolo", ccsText, "");
        
        $this->importe = new clsField("importe", ccsText, "");
        
        $this->TotalSum_montohipoteca = new clsField("TotalSum_montohipoteca", ccsFloat, "");
        
        $this->TotalMin_montohipoteca = new clsField("TotalMin_montohipoteca", ccsFloat, "");
        
        $this->TotalMax_montohipoteca = new clsField("TotalMax_montohipoteca", ccsFloat, "");
        
        $this->TotalAvg_montohipoteca = new clsField("TotalAvg_montohipoteca", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @7-3DD87D57
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "h.fechafin desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idhipoteca" => array("idhipoteca", ""), 
            "Sorter_fechainicio" => array("fechainicio", ""), 
            "Sorter_fechafin" => array("fechafin", ""), 
            "Sorter_deudor" => array("deudor", ""), 
            "Sorter_tipooperacion" => array("tipooperacion", ""), 
            "Sorter_montohipoteca" => array("montohipoteca", "")));
    }
//End SetOrder Method

//Prepare Method @7-FCE3CA74
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_idficha", ccsInteger, "", "", $this->Parameters["urls_idficha"], 0, false);
        $this->wp->AddParameter("2", "urls_nombre", ccsText, "", "", $this->Parameters["urls_nombre"], ZZZZZ, false);
    }
//End Prepare Method

//Open Method @7-0AA4E906
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select h.idhipoteca,h.fechainicio,h.fechafin,f2.nombre as deudor, \n" .
        "	case when h.fechafin < getdate() then\n" .
        "		'Histórico'\n" .
        "	else\n" .
        "		'Vigente'\n" .
        "	end as tipooperacion, m.simbolo,\n" .
        "	h.montohipoteca	,\n" .
        "	sum(importe) as importe\n" .
        "	from hipotecas h \n" .
        "	join cuotas c on(h.idhipoteca = c.idhipoteca)\n" .
        "	join fichaspropiedades fp on(h.idpropiedad = fp.idpropiedad)\n" .
        "	join fichashipotecas fh on(h.idhipoteca = h.idhipoteca)\n" .
        "	join monedas m on(h.idmoneda = m.idmoneda)\n" .
        "	left join fichas f on(fh.idficha = f.idficha)\n" .
        "	left join fichas f2 on(fp.idficha = f2.idficha)\n" .
        "where (fh.idficha = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and f.nombre like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%')\n" .
        "group by h.idhipoteca,h.fechainicio,h.fechafin,f2.nombre ,\n" .
        "	case when h.fechafin < getdate() then\n" .
        "		'Histórico'\n" .
        "	else\n" .
        "		'Vigente'\n" .
        "	end ,m.simbolo,\n" .
        "	h.montohipoteca {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @7-25FED595
    function SetValues()
    {
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->deudor->SetDBValue($this->f("deudor"));
        $this->tipooperacion->SetDBValue($this->f("tipooperacion"));
        $this->montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->simbolo->SetDBValue($this->f("simbolo"));
        $this->importe->SetDBValue($this->f("importe"));
        $this->TotalSum_montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->TotalMin_montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->TotalMax_montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->TotalAvg_montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
    }
//End SetValues Method

} //End Report1DataSource Class @7-FCB6E20C

//Initialize Page @1-54FC2739
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
$TemplateFileName = "opeacree.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-1C592903
include_once("./opeacree_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-475377E9
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$fichas = & new clsRecordfichas("", $MainPage);
$Report1 = & new clsReportReport1("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->fichas = & $fichas;
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

//Execute Components @1-5B4B133C
$Header->Operations();
$fichas->Operation();
//End Execute Components

//Go to destination page @1-B5821620
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($fichas);
    unset($Report1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C37130A0
$Header->Show();
$fichas->Show();
$Report1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-77FF771C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($fichas);
unset($Report1);
unset($Tpl);
//End Unload Page


?>
