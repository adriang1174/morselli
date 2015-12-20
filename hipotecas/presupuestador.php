<?php
//Include Common Files @1-9B13278D
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "presupuestador.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation



class clsRecordgastosescribaniaSearch { //gastosescribaniaSearch Class @4-C927706C

//Variables @4-D6FF3E86

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

//Class_Initialize Event @4-35C59726
    function clsRecordgastosescribaniaSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record gastosescribaniaSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "gastosescribaniaSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_jurisdiccion = & new clsControl(ccsListBox, "s_jurisdiccion", "s_jurisdiccion", ccsText, "", CCGetRequestParam("s_jurisdiccion", $Method, NULL), $this);
            $this->s_jurisdiccion->DSType = dsListOfValues;
            $this->s_jurisdiccion->Values = array(array("Capital", "Capital"), array("Provincia", "Provincia"));
            $this->s_jurisdiccion->Required = true;
            $this->operacion = & new clsControl(ccsTextBox, "operacion", "operacion", ccsText, "", CCGetRequestParam("operacion", $Method, NULL), $this);
            $this->operacion->Required = true;
        }
    }
//End Class_Initialize Event

//Validate Method @4-55888C5C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_jurisdiccion->Validate() && $Validation);
        $Validation = ($this->operacion->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_jurisdiccion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->operacion->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @4-9C87A4F6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_jurisdiccion->Errors->Count());
        $errors = ($errors || $this->operacion->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @4-ED598703
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

//Operation Method @4-70B97AD2
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
        $Redirect = "presupuestador.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "presupuestador.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @4-CC928DCD
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

        $this->s_jurisdiccion->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_jurisdiccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->operacion->Errors->ToString());
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
        $this->s_jurisdiccion->Show();
        $this->operacion->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End gastosescribaniaSearch Class @4-FCB6E20C

//Report1 ReportGroup class @15-6ECD2D7F
class clsReportGroupReport1 {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $descripcion, $_descripcionAttributes;
    var $importevend, $_importevendAttributes;
    var $porcentajevend, $_porcentajevendAttributes;
    var $importecomp, $_importecompAttributes;
    var $porcentajecomp, $_porcentajecompAttributes;
    var $TotalSum_importevend, $_TotalSum_importevendAttributes;
    var $TotalSum_importecomp, $_TotalSum_importecompAttributes;
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
        $this->descripcion = $this->Parent->descripcion->Value;
        $this->importevend = $this->Parent->importevend->Value;
        $this->porcentajevend = $this->Parent->porcentajevend->Value;
        $this->importecomp = $this->Parent->importecomp->Value;
        $this->porcentajecomp = $this->Parent->porcentajecomp->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->TotalSum_importevend = $this->Parent->TotalSum_importevend->GetTotalValue($mode);
        $this->TotalSum_importecomp = $this->Parent->TotalSum_importecomp->GetTotalValue($mode);
        $this->_descripcionAttributes = $this->Parent->descripcion->Attributes->GetAsArray();
        $this->_importevendAttributes = $this->Parent->importevend->Attributes->GetAsArray();
        $this->_porcentajevendAttributes = $this->Parent->porcentajevend->Attributes->GetAsArray();
        $this->_importecompAttributes = $this->Parent->importecomp->Attributes->GetAsArray();
        $this->_porcentajecompAttributes = $this->Parent->porcentajecomp->Attributes->GetAsArray();
        $this->_TotalSum_importevendAttributes = $this->Parent->TotalSum_importevend->Attributes->GetAsArray();
        $this->_TotalSum_importecompAttributes = $this->Parent->TotalSum_importecomp->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->TotalSum_importevend = $this->TotalSum_importevend;
        $Header->_TotalSum_importevendAttributes = $this->_TotalSum_importevendAttributes;
        $Header->TotalSum_importecomp = $this->TotalSum_importecomp;
        $Header->_TotalSum_importecompAttributes = $this->_TotalSum_importecompAttributes;
        $this->descripcion = $Header->descripcion;
        $Header->_descripcionAttributes = $this->_descripcionAttributes;
        $this->Parent->descripcion->Value = $Header->descripcion;
        $this->Parent->descripcion->Attributes->RestoreFromArray($Header->_descripcionAttributes);
        $this->importevend = $Header->importevend;
        $Header->_importevendAttributes = $this->_importevendAttributes;
        $this->Parent->importevend->Value = $Header->importevend;
        $this->Parent->importevend->Attributes->RestoreFromArray($Header->_importevendAttributes);
        $this->porcentajevend = $Header->porcentajevend;
        $Header->_porcentajevendAttributes = $this->_porcentajevendAttributes;
        $this->Parent->porcentajevend->Value = $Header->porcentajevend;
        $this->Parent->porcentajevend->Attributes->RestoreFromArray($Header->_porcentajevendAttributes);
        $this->importecomp = $Header->importecomp;
        $Header->_importecompAttributes = $this->_importecompAttributes;
        $this->Parent->importecomp->Value = $Header->importecomp;
        $this->Parent->importecomp->Attributes->RestoreFromArray($Header->_importecompAttributes);
        $this->porcentajecomp = $Header->porcentajecomp;
        $Header->_porcentajecompAttributes = $this->_porcentajecompAttributes;
        $this->Parent->porcentajecomp->Value = $Header->porcentajecomp;
        $this->Parent->porcentajecomp->Attributes->RestoreFromArray($Header->_porcentajecompAttributes);
    }
    function ChangeTotalControls() {
        $this->TotalSum_importevend = $this->Parent->TotalSum_importevend->GetValue();
        $this->TotalSum_importecomp = $this->Parent->TotalSum_importecomp->GetValue();
    }
}
//End Report1 ReportGroup class

//Report1 GroupsCollection class @15-494F4BB3
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
        $this->Parent->descripcion->Value = $this->Parent->descripcion->initialValue;
        $this->Parent->importevend->Value = $this->Parent->importevend->initialValue;
        $this->Parent->porcentajevend->Value = $this->Parent->porcentajevend->initialValue;
        $this->Parent->importecomp->Value = $this->Parent->importecomp->initialValue;
        $this->Parent->porcentajecomp->Value = $this->Parent->porcentajecomp->initialValue;
        $this->Parent->TotalSum_importevend->Value = $this->Parent->TotalSum_importevend->initialValue;
        $this->Parent->TotalSum_importecomp->Value = $this->Parent->TotalSum_importecomp->initialValue;
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

class clsReportReport1 { //Report1 Class @15-BC2FB08C

//Report1 Variables @15-87F7EA53

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
//End Report1 Variables

//Class_Initialize Event @15-20FDC0C0
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

        $this->descripcion = & new clsControl(ccsReportLabel, "descripcion", "descripcion", ccsText, "", "", $this);
        $this->importevend = & new clsControl(ccsReportLabel, "importevend", "importevend", ccsFloat, array(False, 2, Null, "", False, "\$", "", 1, True, ""), "", $this);
        $this->porcentajevend = & new clsControl(ccsReportLabel, "porcentajevend", "porcentajevend", ccsFloat, array(False, 2, Null, "", False, "", "%", 100, True, ""), "", $this);
        $this->porcentajevend->EmptyText = " ";
        $this->importecomp = & new clsControl(ccsReportLabel, "importecomp", "importecomp", ccsFloat, array(False, 2, Null, "", False, "\$", "", 1, True, ""), "", $this);
        $this->porcentajecomp = & new clsControl(ccsReportLabel, "porcentajecomp", "porcentajecomp", ccsFloat, array(False, 2, Null, "", False, "", "%", 100, True, ""), "", $this);
        $this->porcentajecomp->EmptyText = " ";
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->TotalSum_importevend = & new clsControl(ccsReportLabel, "TotalSum_importevend", "TotalSum_importevend", ccsFloat, array(False, 2, Null, "", False, "\$", "", 1, True, ""), "", $this);
        $this->TotalSum_importevend->TotalFunction = "Sum";
        $this->TotalSum_importecomp = & new clsControl(ccsReportLabel, "TotalSum_importecomp", "TotalSum_importecomp", ccsFloat, array(False, 2, Null, "", False, "\$", "", 1, True, ""), "", $this);
        $this->TotalSum_importecomp->TotalFunction = "Sum";
    }
//End Class_Initialize Event

//Initialize Method @15-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @15-3AE90E71
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->descripcion->Errors->Count());
        $errors = ($errors || $this->importevend->Errors->Count());
        $errors = ($errors || $this->porcentajevend->Errors->Count());
        $errors = ($errors || $this->importecomp->Errors->Count());
        $errors = ($errors || $this->porcentajecomp->Errors->Count());
        $errors = ($errors || $this->TotalSum_importevend->Errors->Count());
        $errors = ($errors || $this->TotalSum_importecomp->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @15-96972DE5
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importevend->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajevend->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importecomp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajecomp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_importevend->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_importecomp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @15-A92ADF68
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_jurisdiccion"] = CCGetFromGet("s_jurisdiccion", NULL);
        $this->DataSource->Parameters["urloperacion"] = CCGetFromGet("operacion", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionReport1($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
            $this->importevend->SetValue($this->DataSource->importevend->GetValue());
            $this->porcentajevend->SetValue($this->DataSource->porcentajevend->GetValue());
            $this->importecomp->SetValue($this->DataSource->importecomp->GetValue());
            $this->porcentajecomp->SetValue($this->DataSource->porcentajecomp->GetValue());
            $this->TotalSum_importevend->SetValue($this->DataSource->TotalSum_importevend->GetValue());
            $this->TotalSum_importecomp->SetValue($this->DataSource->TotalSum_importecomp->GetValue());
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
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["importevend"] = $this->importevend->Visible;
            $this->ControlsVisible["porcentajevend"] = $this->porcentajevend->Visible;
            $this->ControlsVisible["importecomp"] = $this->importecomp->Visible;
            $this->ControlsVisible["porcentajecomp"] = $this->porcentajecomp->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->descripcion->SetValue($items[$i]->descripcion);
                        $this->descripcion->Attributes->RestoreFromArray($items[$i]->_descripcionAttributes);
                        $this->importevend->SetValue($items[$i]->importevend);
                        $this->importevend->Attributes->RestoreFromArray($items[$i]->_importevendAttributes);
                        $this->porcentajevend->SetValue($items[$i]->porcentajevend);
                        $this->porcentajevend->Attributes->RestoreFromArray($items[$i]->_porcentajevendAttributes);
                        $this->importecomp->SetValue($items[$i]->importecomp);
                        $this->importecomp->Attributes->RestoreFromArray($items[$i]->_importecompAttributes);
                        $this->porcentajecomp->SetValue($items[$i]->porcentajecomp);
                        $this->porcentajecomp->Attributes->RestoreFromArray($items[$i]->_porcentajecompAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->descripcion->Show();
                        $this->importevend->Show();
                        $this->porcentajevend->Show();
                        $this->importecomp->Show();
                        $this->porcentajecomp->Show();
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
                            $this->TotalSum_importevend->SetText(CCFormatNumber($items[$i]->TotalSum_importevend, array(False, 2, Null, "", False, "\$", "", 1, True, "")), ccsFloat);
                            $this->TotalSum_importevend->Attributes->RestoreFromArray($items[$i]->_TotalSum_importevendAttributes);
                            $this->TotalSum_importecomp->SetText(CCFormatNumber($items[$i]->TotalSum_importecomp, array(False, 2, Null, "", False, "\$", "", 1, True, "")), ccsFloat);
                            $this->TotalSum_importecomp->Attributes->RestoreFromArray($items[$i]->_TotalSum_importecompAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_importevend->Show();
                                $this->TotalSum_importecomp->Show();
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
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
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

} //End Report1 Class @15-FCB6E20C

class clsReport1DataSource extends clsDBConnection1 {  //Report1DataSource Class @15-20EE0F53

//DataSource Variables @15-AFE5E098
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $descripcion;
    var $importevend;
    var $porcentajevend;
    var $importecomp;
    var $porcentajecomp;
    var $TotalSum_importevend;
    var $TotalSum_importecomp;
//End DataSource Variables

//DataSourceClass_Initialize Event @15-F2E0615D
    function clsReport1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Report1";
        $this->Initialize();
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->importevend = new clsField("importevend", ccsFloat, "");
        
        $this->porcentajevend = new clsField("porcentajevend", ccsFloat, "");
        
        $this->importecomp = new clsField("importecomp", ccsFloat, "");
        
        $this->porcentajecomp = new clsField("porcentajecomp", ccsFloat, "");
        
        $this->TotalSum_importevend = new clsField("TotalSum_importevend", ccsFloat, "");
        
        $this->TotalSum_importecomp = new clsField("TotalSum_importecomp", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @15-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @15-B86AEA85
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_jurisdiccion", ccsText, "", "", $this->Parameters["urls_jurisdiccion"], "", false);
        $this->wp->AddParameter("2", "urloperacion", ccsText, "", "", $this->Parameters["urloperacion"], 0, false);
    }
//End Prepare Method

//Open Method @15-8A38D15D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT \n" .
        "idgastoescribania,\n" .
        "descripcion,\n" .
        "case when importecomp > 0 and importecomp < 1 then\n" .
        "	importecomp * " . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "\n" .
        "else\n" .
        "	importecomp\n" .
        "end as importecomp,\n" .
        "case when importecomp > 0 and importecomp < 1 then\n" .
        "	importecomp\n" .
        "else\n" .
        "	0\n" .
        "end as porcentajecomp,\n" .
        "case when importevend > 0 and importevend < 1 then\n" .
        "	importevend * " . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "\n" .
        "else\n" .
        "	importevend\n" .
        "end as importevend,\n" .
        "case when importevend > 0 and importevend < 1 then\n" .
        "	importevend\n" .
        "else\n" .
        "	0\n" .
        "end as porcentajevend,\n" .
        "jurisdiccion\n" .
        "FROM gastosescribania\n" .
        "WHERE jurisdiccion = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @15-D3482371
    function SetValues()
    {
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->importevend->SetDBValue(trim($this->f("importevend")));
        $this->porcentajevend->SetDBValue(trim($this->f("porcentajevend")));
        $this->importecomp->SetDBValue(trim($this->f("importecomp")));
        $this->porcentajecomp->SetDBValue(trim($this->f("porcentajecomp")));
        $this->TotalSum_importevend->SetDBValue(trim($this->f("importevend")));
        $this->TotalSum_importecomp->SetDBValue(trim($this->f("importecomp")));
    }
//End SetValues Method

} //End Report1DataSource Class @15-FCB6E20C

//Initialize Page @1-4F04CC46
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
$TemplateFileName = "presupuestador.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4A424CFF
include_once("./presupuestador_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7DF678E9
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$gastosescribaniaSearch = & new clsRecordgastosescribaniaSearch("", $MainPage);
$Report1 = & new clsReportReport1("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->gastosescribaniaSearch = & $gastosescribaniaSearch;
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

//Execute Components @1-4534F74D
$Header->Operations();
$gastosescribaniaSearch->Operation();
//End Execute Components

//Go to destination page @1-CBF93F85
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($gastosescribaniaSearch);
    unset($Report1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-272F4870
$Header->Show();
$gastosescribaniaSearch->Show();
$Report1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-13073721
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($gastosescribaniaSearch);
unset($Report1);
unset($Tpl);
//End Unload Page


?>
