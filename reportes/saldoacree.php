<?php
//Include Common Files @1-1C5EF978
define("RelativePath", "..");
define("PathToCurrentPage", "/reportes/");
define("FileName", "saldoacree.php");
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

//Operation Method @3-91B341C5
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
        $Redirect = "saldoacree.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "saldoacree.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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



//Report2 ReportGroup class @34-E7FD1518
class clsReportGroupReport2 {
    var $GroupType;
    var $mode; //1 - open, 2 - close
    var $simbolo, $simboloDup, $_simboloAttributes;
    var $idhipoteca, $idhipotecaDup, $_idhipotecaAttributes;
    var $idcuota, $_idcuotaAttributes;
    var $importe, $_importeAttributes;
    var $Count_idcuota1, $_Count_idcuota1Attributes;
    var $Sum_importe1, $_Sum_importe1Attributes;
    var $gope, $_gopeAttributes;
    var $Sum_importe, $_Sum_importeAttributes;
    var $gsimbolo, $_gsimboloAttributes;
    var $Attributes;
    var $ReportTotalIndex = 0;
    var $PageTotalIndex;
    var $PageNumber;
    var $RowNumber;
    var $Parent;
    var $simboloTotalIndex;
    var $idhipotecaTotalIndex;

    function clsReportGroupReport2(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->simbolo = $this->Parent->simbolo->Value;
        $this->idhipoteca = $this->Parent->idhipoteca->Value;
        $this->idcuota = $this->Parent->idcuota->Value;
        $this->importe = $this->Parent->importe->Value;
        $this->gope = $this->Parent->gope->Value;
        $this->gsimbolo = $this->Parent->gsimbolo->Value;
        if ($PrevGroup) {
            $this->simboloDup =  CCCompareValues($this->simbolo, $PrevGroup->simbolo, $this->Parent->simbolo->DataType) == 0;
            $this->idhipotecaDup =  CCCompareValues($this->idhipoteca, $PrevGroup->idhipoteca, $this->Parent->idhipoteca->DataType) == 0;
        }
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Count_idcuota1 = $this->Parent->Count_idcuota1->GetTotalValue($mode);
        $this->Sum_importe1 = $this->Parent->Sum_importe1->GetTotalValue($mode);
        $this->Sum_importe = $this->Parent->Sum_importe->GetTotalValue($mode);
        $this->_Sorter_idcuotaAttributes = $this->Parent->Sorter_idcuota->Attributes->GetAsArray();
        $this->_Sorter_importeAttributes = $this->Parent->Sorter_importe->Attributes->GetAsArray();
        $this->_simboloAttributes = $this->Parent->simbolo->Attributes->GetAsArray();
        $this->_idhipotecaAttributes = $this->Parent->idhipoteca->Attributes->GetAsArray();
        $this->_idcuotaAttributes = $this->Parent->idcuota->Attributes->GetAsArray();
        $this->_importeAttributes = $this->Parent->importe->Attributes->GetAsArray();
        $this->_Count_idcuota1Attributes = $this->Parent->Count_idcuota1->Attributes->GetAsArray();
        $this->_Sum_importe1Attributes = $this->Parent->Sum_importe1->Attributes->GetAsArray();
        $this->_gopeAttributes = $this->Parent->gope->Attributes->GetAsArray();
        $this->_Sum_importeAttributes = $this->Parent->Sum_importe->Attributes->GetAsArray();
        $this->_gsimboloAttributes = $this->Parent->gsimbolo->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Count_idcuota1 = $this->Count_idcuota1;
        $Header->_Count_idcuota1Attributes = $this->_Count_idcuota1Attributes;
        $Header->Sum_importe1 = $this->Sum_importe1;
        $Header->_Sum_importe1Attributes = $this->_Sum_importe1Attributes;
        $Header->Sum_importe = $this->Sum_importe;
        $Header->_Sum_importeAttributes = $this->_Sum_importeAttributes;
        $this->simbolo = $Header->simbolo;
        $Header->_simboloAttributes = $this->_simboloAttributes;
        $this->Parent->simbolo->Value = $Header->simbolo;
        $this->Parent->simbolo->Attributes->RestoreFromArray($Header->_simboloAttributes);
        $this->idhipoteca = $Header->idhipoteca;
        $Header->_idhipotecaAttributes = $this->_idhipotecaAttributes;
        $this->Parent->idhipoteca->Value = $Header->idhipoteca;
        $this->Parent->idhipoteca->Attributes->RestoreFromArray($Header->_idhipotecaAttributes);
        $this->idcuota = $Header->idcuota;
        $Header->_idcuotaAttributes = $this->_idcuotaAttributes;
        $this->Parent->idcuota->Value = $Header->idcuota;
        $this->Parent->idcuota->Attributes->RestoreFromArray($Header->_idcuotaAttributes);
        $this->importe = $Header->importe;
        $Header->_importeAttributes = $this->_importeAttributes;
        $this->Parent->importe->Value = $Header->importe;
        $this->Parent->importe->Attributes->RestoreFromArray($Header->_importeAttributes);
        $this->gope = $Header->gope;
        $Header->_gopeAttributes = $this->_gopeAttributes;
        $this->Parent->gope->Value = $Header->gope;
        $this->Parent->gope->Attributes->RestoreFromArray($Header->_gopeAttributes);
        $this->gsimbolo = $Header->gsimbolo;
        $Header->_gsimboloAttributes = $this->_gsimboloAttributes;
        $this->Parent->gsimbolo->Value = $Header->gsimbolo;
        $this->Parent->gsimbolo->Attributes->RestoreFromArray($Header->_gsimboloAttributes);
    }
    function ChangeTotalControls() {
        $this->Count_idcuota1 = $this->Parent->Count_idcuota1->GetValue();
        $this->Sum_importe1 = $this->Parent->Sum_importe1->GetValue();
        $this->Sum_importe = $this->Parent->Sum_importe->GetValue();
    }
}
//End Report2 ReportGroup class

//Report2 GroupsCollection class @34-A9DA5FB1
class clsGroupsCollectionReport2 {
    var $Groups;
    var $mPageCurrentHeaderIndex;
    var $msimboloCurrentHeaderIndex;
    var $midhipotecaCurrentHeaderIndex;
    var $PageSize;
    var $TotalPages = 0;
    var $TotalRows = 0;
    var $CurrentPageSize = 0;
    var $Pages;
    var $Parent;
    var $LastDetailIndex;

    function clsGroupsCollectionReport2(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->msimboloCurrentHeaderIndex = 1;
        $this->midhipotecaCurrentHeaderIndex = 2;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupReport2($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->simboloTotalIndex = $this->msimboloCurrentHeaderIndex;
        $group->idhipotecaTotalIndex = $this->midhipotecaCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->simbolo->Value = $this->Parent->simbolo->initialValue;
        $this->Parent->idhipoteca->Value = $this->Parent->idhipoteca->initialValue;
        $this->Parent->idcuota->Value = $this->Parent->idcuota->initialValue;
        $this->Parent->importe->Value = $this->Parent->importe->initialValue;
        $this->Parent->Count_idcuota1->Value = $this->Parent->Count_idcuota1->initialValue;
        $this->Parent->Sum_importe1->Value = $this->Parent->Sum_importe1->initialValue;
        $this->Parent->gope->Value = $this->Parent->gope->initialValue;
        $this->Parent->Sum_importe->Value = $this->Parent->Sum_importe->initialValue;
        $this->Parent->gsimbolo->Value = $this->Parent->gsimbolo->initialValue;
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
        if ($groupName == "simbolo") {
            $Groupsimbolo = & $this->InitGroup(true);
            $this->Parent->simbolo_Header->CCSEventResult = CCGetEvent($this->Parent->simbolo_Header->CCSEvents, "OnInitialize", $this->Parent->simbolo_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->simbolo_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->simbolo_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->simbolo_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->simbolo_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->simbolo_Header->Height;
                $Groupsimbolo->SetTotalControls("GetNextValue");
            $this->Parent->simbolo_Header->CCSEventResult = CCGetEvent($this->Parent->simbolo_Header->CCSEvents, "OnCalculate", $this->Parent->simbolo_Header);
            $Groupsimbolo->SetControls();
            $Groupsimbolo->Mode = 1;
            $OpenFlag = true;
            $Groupsimbolo->GroupType = "simbolo";
            $this->msimboloCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupsimbolo;
            $this->Parent->Sum_importe->Reset();
        }
        if ($groupName == "idhipoteca" or $OpenFlag) {
            $Groupidhipoteca = & $this->InitGroup(true);
            $this->Parent->idhipoteca_Header->CCSEventResult = CCGetEvent($this->Parent->idhipoteca_Header->CCSEvents, "OnInitialize", $this->Parent->idhipoteca_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->idhipoteca_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->idhipoteca_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->idhipoteca_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->idhipoteca_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->idhipoteca_Header->Height;
                $Groupidhipoteca->SetTotalControls("GetNextValue");
            $this->Parent->idhipoteca_Header->CCSEventResult = CCGetEvent($this->Parent->idhipoteca_Header->CCSEvents, "OnCalculate", $this->Parent->idhipoteca_Header);
            $Groupidhipoteca->SetControls();
            $Groupidhipoteca->Mode = 1;
            $Groupidhipoteca->GroupType = "idhipoteca";
            $this->midhipotecaCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupidhipoteca;
            $this->Parent->Count_idcuota1->Reset();
            $this->Parent->Sum_importe1->Reset();
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
        $Groupidhipoteca = & $this->InitGroup(true);
        $this->Parent->idhipoteca_Footer->CCSEventResult = CCGetEvent($this->Parent->idhipoteca_Footer->CCSEvents, "OnInitialize", $this->Parent->idhipoteca_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->idhipoteca_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->idhipoteca_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->idhipoteca_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupidhipoteca->SetTotalControls("GetPrevValue");
        $Groupidhipoteca->SyncWithHeader($this->Groups[$this->midhipotecaCurrentHeaderIndex]);
        if ($this->Parent->idhipoteca_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->idhipoteca_Footer->Height;
        $this->Parent->idhipoteca_Footer->CCSEventResult = CCGetEvent($this->Parent->idhipoteca_Footer->CCSEvents, "OnCalculate", $this->Parent->idhipoteca_Footer);
        $Groupidhipoteca->SetControls();
        $this->Parent->Count_idcuota1->Reset();
        $this->Parent->Sum_importe1->Reset();
        $this->RestoreValues();
        $Groupidhipoteca->Mode = 2;
        $Groupidhipoteca->GroupType ="idhipoteca";
        $this->Groups[] = & $Groupidhipoteca;
        if ($groupName == "idhipoteca") return;
        $Groupsimbolo = & $this->InitGroup(true);
        $this->Parent->simbolo_Footer->CCSEventResult = CCGetEvent($this->Parent->simbolo_Footer->CCSEvents, "OnInitialize", $this->Parent->simbolo_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->simbolo_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->simbolo_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->simbolo_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupsimbolo->SetTotalControls("GetPrevValue");
        $Groupsimbolo->SyncWithHeader($this->Groups[$this->msimboloCurrentHeaderIndex]);
        if ($this->Parent->simbolo_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->simbolo_Footer->Height;
        $this->Parent->simbolo_Footer->CCSEventResult = CCGetEvent($this->Parent->simbolo_Footer->CCSEvents, "OnCalculate", $this->Parent->simbolo_Footer);
        $Groupsimbolo->SetControls();
        $this->Parent->Sum_importe->Reset();
        $this->RestoreValues();
        $Groupsimbolo->Mode = 2;
        $Groupsimbolo->GroupType ="simbolo";
        $this->Groups[] = & $Groupsimbolo;
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
//End Report2 GroupsCollection class

class clsReportReport2 { //Report2 Class @34-9702E34F

//Report2 Variables @34-18370071

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
    var $simbolo_HeaderBlock, $simbolo_Header;
    var $simbolo_FooterBlock, $simbolo_Footer;
    var $idhipoteca_HeaderBlock, $idhipoteca_Header;
    var $idhipoteca_FooterBlock, $idhipoteca_Footer;
    var $SorterName, $SorterDirection;

    var $ds;
    var $DataSource;
    var $UseClientPaging = false;

    //Report Controls
    var $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    var $Page_FooterControls, $Page_HeaderControls;
    var $simbolo_HeaderControls, $simbolo_FooterControls;
    var $idhipoteca_HeaderControls, $idhipoteca_FooterControls;
    var $Sorter_idcuota;
    var $Sorter_importe;
//End Report2 Variables

//Class_Initialize Event @34-C9FA89CF
    function clsReportReport2($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Report2";
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
        $this->simbolo_Footer = new clsSection($this);
        $this->simbolo_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->simbolo_Footer->Height);
        $this->simbolo_Header = new clsSection($this);
        $this->idhipoteca_Footer = new clsSection($this);
        $this->idhipoteca_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->idhipoteca_Footer->Height);
        $this->idhipoteca_Header = new clsSection($this);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsReport2DataSource($this);
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
        $this->SorterName = CCGetParam("Report2Order", "");
        $this->SorterDirection = CCGetParam("Report2Dir", "");

        $this->Sorter_idcuota = & new clsSorter($this->ComponentName, "Sorter_idcuota", $FileName, $this);
        $this->Sorter_importe = & new clsSorter($this->ComponentName, "Sorter_importe", $FileName, $this);
        $this->simbolo = & new clsControl(ccsReportLabel, "simbolo", "simbolo", ccsText, "", "", $this);
        $this->idhipoteca = & new clsControl(ccsReportLabel, "idhipoteca", "idhipoteca", ccsInteger, "", "", $this);
        $this->idcuota = & new clsControl(ccsReportLabel, "idcuota", "idcuota", ccsInteger, "", "", $this);
        $this->importe = & new clsControl(ccsReportLabel, "importe", "importe", ccsFloat, "", "", $this);
        $this->Count_idcuota1 = & new clsControl(ccsReportLabel, "Count_idcuota1", "Count_idcuota1", ccsInteger, "", 0, $this);
        $this->Count_idcuota1->TotalFunction = "Count";
        $this->Count_idcuota1->IsEmptySource = true;
        $this->Sum_importe1 = & new clsControl(ccsReportLabel, "Sum_importe1", "Sum_importe1", ccsFloat, "", "", $this);
        $this->Sum_importe1->TotalFunction = "Sum";
        $this->gope = & new clsControl(ccsReportLabel, "gope", "gope", ccsText, "", "", $this);
        $this->Sum_importe = & new clsControl(ccsReportLabel, "Sum_importe", "Sum_importe", ccsFloat, "", "", $this);
        $this->Sum_importe->TotalFunction = "Sum";
        $this->gsimbolo = & new clsControl(ccsReportLabel, "gsimbolo", "gsimbolo", ccsText, "", "", $this);
        $this->NoRecords = & new clsPanel("NoRecords", $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @34-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @34-7D66635A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->simbolo->Errors->Count());
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->idcuota->Errors->Count());
        $errors = ($errors || $this->importe->Errors->Count());
        $errors = ($errors || $this->Count_idcuota1->Errors->Count());
        $errors = ($errors || $this->Sum_importe1->Errors->Count());
        $errors = ($errors || $this->gope->Errors->Count());
        $errors = ($errors || $this->Sum_importe->Errors->Count());
        $errors = ($errors || $this->gsimbolo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @34-DDA7B4D2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Count_idcuota1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_importe1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gope->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gsimbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @34-2FC59B15
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

        $simboloKey = "";
        $idhipotecaKey = "";
        $Groups = new clsGroupsCollectionReport2($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
            $this->idhipoteca->SetValue($this->DataSource->idhipoteca->GetValue());
            $this->idcuota->SetValue($this->DataSource->idcuota->GetValue());
            $this->importe->SetValue($this->DataSource->importe->GetValue());
            $this->Sum_importe1->SetValue($this->DataSource->Sum_importe1->GetValue());
            $this->gope->SetValue($this->DataSource->gope->GetValue());
            $this->Sum_importe->SetValue($this->DataSource->Sum_importe->GetValue());
            $this->gsimbolo->SetValue($this->DataSource->gsimbolo->GetValue());
            $this->Count_idcuota1->SetValue(1);
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $simboloKey != $this->DataSource->f("simbolo")) {
                $Groups->OpenGroup("simbolo");
            } elseif ($idhipotecaKey != $this->DataSource->f("h.idhipoteca")) {
                $Groups->OpenGroup("idhipoteca");
            }
            $Groups->AddItem();
            $simboloKey = $this->DataSource->f("simbolo");
            $idhipotecaKey = $this->DataSource->f("h.idhipoteca");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $simboloKey != $this->DataSource->f("simbolo")) {
                $Groups->CloseGroup("simbolo");
            } elseif ($idhipotecaKey != $this->DataSource->f("h.idhipoteca")) {
                $Groups->CloseGroup("idhipoteca");
            }
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
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            $this->ControlsVisible["idhipoteca"] = $this->idhipoteca->Visible;
            $this->ControlsVisible["idcuota"] = $this->idcuota->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["Count_idcuota1"] = $this->Count_idcuota1->Visible;
            $this->ControlsVisible["Sum_importe1"] = $this->Sum_importe1->Visible;
            $this->ControlsVisible["gope"] = $this->gope->Visible;
            $this->ControlsVisible["Sum_importe"] = $this->Sum_importe->Visible;
            $this->ControlsVisible["gsimbolo"] = $this->gsimbolo->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->simbolo->Visible = $this->ControlsVisible["simbolo"] && !$items[$i]->simboloDup;
                        $this->simbolo->SetValue($items[$i]->simbolo);
                        $this->simbolo->Attributes->RestoreFromArray($items[$i]->_simboloAttributes);
                        $this->idhipoteca->Visible = $this->ControlsVisible["idhipoteca"] && !$items[$i]->idhipotecaDup;
                        $this->idhipoteca->SetValue($items[$i]->idhipoteca);
                        $this->idhipoteca->Attributes->RestoreFromArray($items[$i]->_idhipotecaAttributes);
                        $this->idcuota->SetValue($items[$i]->idcuota);
                        $this->idcuota->Attributes->RestoreFromArray($items[$i]->_idcuotaAttributes);
                        $this->importe->SetValue($items[$i]->importe);
                        $this->importe->Attributes->RestoreFromArray($items[$i]->_importeAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->simbolo->Show();
                        $this->idhipoteca->Show();
                        $this->idcuota->Show();
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
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
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
                                $this->Sorter_idcuota->Show();
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
                    case "simbolo":
                        if ($items[$i]->Mode == 1) {
                            $this->simbolo_Header->CCSEventResult = CCGetEvent($this->simbolo_Header->CCSEvents, "BeforeShow", $this->simbolo_Header);
                            if ($this->simbolo_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section simbolo_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section simbolo_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_importe->SetValue($items[$i]->Sum_importe);
                            $this->Sum_importe->Attributes->RestoreFromArray($items[$i]->_Sum_importeAttributes);
                            $this->gsimbolo->SetValue($items[$i]->gsimbolo);
                            $this->gsimbolo->Attributes->RestoreFromArray($items[$i]->_gsimboloAttributes);
                            $this->simbolo_Footer->CCSEventResult = CCGetEvent($this->simbolo_Footer->CCSEvents, "BeforeShow", $this->simbolo_Footer);
                            if ($this->simbolo_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section simbolo_Footer";
                                $this->Sum_importe->Show();
                                $this->gsimbolo->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section simbolo_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "idhipoteca":
                        if ($items[$i]->Mode == 1) {
                            $this->idhipoteca_Header->CCSEventResult = CCGetEvent($this->idhipoteca_Header->CCSEvents, "BeforeShow", $this->idhipoteca_Header);
                            if ($this->idhipoteca_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section idhipoteca_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section idhipoteca_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Count_idcuota1->SetValue($items[$i]->Count_idcuota1);
                            $this->Count_idcuota1->Attributes->RestoreFromArray($items[$i]->_Count_idcuota1Attributes);
                            $this->Sum_importe1->SetValue($items[$i]->Sum_importe1);
                            $this->Sum_importe1->Attributes->RestoreFromArray($items[$i]->_Sum_importe1Attributes);
                            $this->gope->SetValue($items[$i]->gope);
                            $this->gope->Attributes->RestoreFromArray($items[$i]->_gopeAttributes);
                            $this->idhipoteca_Footer->CCSEventResult = CCGetEvent($this->idhipoteca_Footer->CCSEvents, "BeforeShow", $this->idhipoteca_Footer);
                            if ($this->idhipoteca_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section idhipoteca_Footer";
                                $this->Count_idcuota1->Show();
                                $this->Sum_importe1->Show();
                                $this->gope->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section idhipoteca_Footer", true, "Section Detail");
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

} //End Report2 Class @34-FCB6E20C

class clsReport2DataSource extends clsDBConnection1 {  //Report2DataSource Class @34-AB3D314A

//DataSource Variables @34-21ACA42D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;


    // Datasource fields
    var $simbolo;
    var $idhipoteca;
    var $idcuota;
    var $importe;
    var $Sum_importe1;
    var $gope;
    var $Sum_importe;
    var $gsimbolo;
//End DataSource Variables

//DataSourceClass_Initialize Event @34-80F82568
    function clsReport2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Report2";
        $this->Initialize();
        $this->simbolo = new clsField("simbolo", ccsText, "");
        
        $this->idhipoteca = new clsField("idhipoteca", ccsInteger, "");
        
        $this->idcuota = new clsField("idcuota", ccsInteger, "");
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->Sum_importe1 = new clsField("Sum_importe1", ccsFloat, "");
        
        $this->gope = new clsField("gope", ccsText, "");
        
        $this->Sum_importe = new clsField("Sum_importe", ccsFloat, "");
        
        $this->gsimbolo = new clsField("gsimbolo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @34-1A93C445
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idcuota" => array("idcuota", ""), 
            "Sorter_importe" => array("importe", "")));
    }
//End SetOrder Method

//Prepare Method @34-FCE3CA74
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_idficha", ccsInteger, "", "", $this->Parameters["urls_idficha"], 0, false);
        $this->wp->AddParameter("2", "urls_nombre", ccsText, "", "", $this->Parameters["urls_nombre"], ZZZZZ, false);
    }
//End Prepare Method

//Open Method @34-FC90A162
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select h.idhipoteca,m.simbolo,c.importe,c.idcuota \n" .
        "	from cuotas c\n" .
        "	join hipotecas h on(c.idhipoteca = h.idhipoteca)\n" .
        "	join fichashipotecas fh on(h.idhipoteca = c.idhipoteca)\n" .
        "	join fichas f on(fh.idficha = f.idficha)\n" .
        "	join monedas m on(h.idmoneda = m.idmoneda)\n" .
        "where \n" .
        "(fh.idficha = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " or f.nombre like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%')\n" .
        "and fechapago is not null\n" .
        "and fechaliquidacion is null\n" .
        "and idtipocuota in(2,4)\n" .
        "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "simbolo asc,h.idhipoteca asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @34-F7FAD558
    function SetValues()
    {
        $this->simbolo->SetDBValue($this->f("simbolo"));
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->idcuota->SetDBValue(trim($this->f("idcuota")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->Sum_importe1->SetDBValue(trim($this->f("importe")));
        $this->gope->SetDBValue($this->f("idhipoteca"));
        $this->Sum_importe->SetDBValue(trim($this->f("importe")));
        $this->gsimbolo->SetDBValue($this->f("simbolo"));
    }
//End SetValues Method

} //End Report2DataSource Class @34-FCB6E20C

//Initialize Page @1-6D4E734F
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
$TemplateFileName = "saldoacree.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D283F8ED
include_once("./saldoacree_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4C2E5F3D
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$fichas = & new clsRecordfichas("", $MainPage);
$Report2 = & new clsReportReport2("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->fichas = & $fichas;
$MainPage->Report2 = & $Report2;
$Report2->Initialize();

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

//Go to destination page @1-CE9C94C3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($fichas);
    unset($Report2);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-28A17F58
$Header->Show();
$fichas->Show();
$Report2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-66821D65
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($fichas);
unset($Report2);
unset($Tpl);
//End Unload Page


?>
