<?php
//Include Common Files @1-628EB0BC
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
define("FileName", "impuestospresentados.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsEditableGridimpuestos_impuestosanocon { //impuestos_impuestosanocon Class @2-8325C9A6

//Variables @2-F667987F

    // Public variables
    var $ComponentType = "EditableGrid";
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormParameters;
    var $FormState;
    var $FormEnctype;
    var $CachedColumns;
    var $TotalRows;
    var $UpdatedRows;
    var $EmptyRows;
    var $Visible;
    var $RowsErrors;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;
    var $ControlsErrors;
    var $RowNumber;
    var $Attributes;
    var $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @2-AFC3CD18
    function clsEditableGridimpuestos_impuestosanocon($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid impuestos_impuestosanocon/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "impuestos_impuestosanocon";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["idalquiler"][0] = "idalquiler";
        $this->CachedColumns["ano"][0] = "ano";
        $this->CachedColumns["idcuota"][0] = "idcuota";
        $this->CachedColumns["idimpuesto"][0] = "idimpuesto";
        $this->DataSource = new clsimpuestos_impuestosanoconDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 0;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->nombreimpuesto = & new clsControl(ccsLabel, "nombreimpuesto", "Nombreimpuesto", ccsText, "", NULL, $this);
        $this->ene = & new clsControl(ccsCheckBox, "ene", "Ene", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->ene->CheckedValue = true;
        $this->ene->UncheckedValue = false;
        $this->feb = & new clsControl(ccsCheckBox, "feb", "Feb", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->feb->CheckedValue = true;
        $this->feb->UncheckedValue = false;
        $this->mar = & new clsControl(ccsCheckBox, "mar", "Mar", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->mar->CheckedValue = true;
        $this->mar->UncheckedValue = false;
        $this->abr = & new clsControl(ccsCheckBox, "abr", "Abr", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->abr->CheckedValue = true;
        $this->abr->UncheckedValue = false;
        $this->may = & new clsControl(ccsCheckBox, "may", "May", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->may->CheckedValue = true;
        $this->may->UncheckedValue = false;
        $this->jun = & new clsControl(ccsCheckBox, "jun", "Jun", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->jun->CheckedValue = true;
        $this->jun->UncheckedValue = false;
        $this->jul = & new clsControl(ccsCheckBox, "jul", "Jul", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->jul->CheckedValue = true;
        $this->jul->UncheckedValue = false;
        $this->ago = & new clsControl(ccsCheckBox, "ago", "Ago", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->ago->CheckedValue = true;
        $this->ago->UncheckedValue = false;
        $this->sept = & new clsControl(ccsCheckBox, "sept", "Sept", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->sept->CheckedValue = true;
        $this->sept->UncheckedValue = false;
        $this->oct = & new clsControl(ccsCheckBox, "oct", "Oct", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->oct->CheckedValue = true;
        $this->oct->UncheckedValue = false;
        $this->nov = & new clsControl(ccsCheckBox, "nov", "Nov", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->nov->CheckedValue = true;
        $this->nov->UncheckedValue = false;
        $this->dic = & new clsControl(ccsCheckBox, "dic", "Dic", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->dic->CheckedValue = true;
        $this->dic->UncheckedValue = false;
        $this->presene = & new clsControl(ccsTextBox, "presene", "Presene", ccsText, "", NULL, $this);
        $this->presfeb = & new clsControl(ccsTextBox, "presfeb", "Presfeb", ccsText, "", NULL, $this);
        $this->presmar = & new clsControl(ccsTextBox, "presmar", "Presmar", ccsText, "", NULL, $this);
        $this->presabr = & new clsControl(ccsTextBox, "presabr", "Presabr", ccsText, "", NULL, $this);
        $this->presmay = & new clsControl(ccsTextBox, "presmay", "Presmay", ccsText, "", NULL, $this);
        $this->presjun = & new clsControl(ccsTextBox, "presjun", "Presjun", ccsText, "", NULL, $this);
        $this->presago = & new clsControl(ccsTextBox, "presago", "Presago", ccsText, "", NULL, $this);
        $this->presset = & new clsControl(ccsTextBox, "presset", "Presset", ccsText, "", NULL, $this);
        $this->presoct = & new clsControl(ccsTextBox, "presoct", "Presoct", ccsText, "", NULL, $this);
        $this->presnov = & new clsControl(ccsTextBox, "presnov", "Presnov", ccsText, "", NULL, $this);
        $this->presdic = & new clsControl(ccsTextBox, "presdic", "Presdic", ccsText, "", NULL, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = & new clsButton("Cancel", $Method, $this);
        $this->presjul = & new clsControl(ccsTextBox, "presjul", "Presjul", ccsText, "", NULL, $this);
        $this->idalquiler = & new clsControl(ccsHidden, "idalquiler", "Idalquiler", ccsInteger, "", NULL, $this);
        $this->idalquiler->Required = true;
        $this->Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", NULL, $this);
        $this->Label2 = & new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", NULL, $this);
        $this->Label3 = & new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-5DF68DC1
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlRETURN_VALUE"] = CCGetFromGet("RETURN_VALUE", NULL);
        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);
        $this->DataSource->Parameters["urlano"] = CCGetFromGet("ano", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @2-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @2-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @2-F5F5135D
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["ene"][$RowNumber] = CCGetFromPost("ene_" . $RowNumber, NULL);
            $this->FormParameters["feb"][$RowNumber] = CCGetFromPost("feb_" . $RowNumber, NULL);
            $this->FormParameters["mar"][$RowNumber] = CCGetFromPost("mar_" . $RowNumber, NULL);
            $this->FormParameters["abr"][$RowNumber] = CCGetFromPost("abr_" . $RowNumber, NULL);
            $this->FormParameters["may"][$RowNumber] = CCGetFromPost("may_" . $RowNumber, NULL);
            $this->FormParameters["jun"][$RowNumber] = CCGetFromPost("jun_" . $RowNumber, NULL);
            $this->FormParameters["jul"][$RowNumber] = CCGetFromPost("jul_" . $RowNumber, NULL);
            $this->FormParameters["ago"][$RowNumber] = CCGetFromPost("ago_" . $RowNumber, NULL);
            $this->FormParameters["sept"][$RowNumber] = CCGetFromPost("sept_" . $RowNumber, NULL);
            $this->FormParameters["oct"][$RowNumber] = CCGetFromPost("oct_" . $RowNumber, NULL);
            $this->FormParameters["nov"][$RowNumber] = CCGetFromPost("nov_" . $RowNumber, NULL);
            $this->FormParameters["dic"][$RowNumber] = CCGetFromPost("dic_" . $RowNumber, NULL);
            $this->FormParameters["presene"][$RowNumber] = CCGetFromPost("presene_" . $RowNumber, NULL);
            $this->FormParameters["presfeb"][$RowNumber] = CCGetFromPost("presfeb_" . $RowNumber, NULL);
            $this->FormParameters["presmar"][$RowNumber] = CCGetFromPost("presmar_" . $RowNumber, NULL);
            $this->FormParameters["presabr"][$RowNumber] = CCGetFromPost("presabr_" . $RowNumber, NULL);
            $this->FormParameters["presmay"][$RowNumber] = CCGetFromPost("presmay_" . $RowNumber, NULL);
            $this->FormParameters["presjun"][$RowNumber] = CCGetFromPost("presjun_" . $RowNumber, NULL);
            $this->FormParameters["presago"][$RowNumber] = CCGetFromPost("presago_" . $RowNumber, NULL);
            $this->FormParameters["presset"][$RowNumber] = CCGetFromPost("presset_" . $RowNumber, NULL);
            $this->FormParameters["presoct"][$RowNumber] = CCGetFromPost("presoct_" . $RowNumber, NULL);
            $this->FormParameters["presnov"][$RowNumber] = CCGetFromPost("presnov_" . $RowNumber, NULL);
            $this->FormParameters["presdic"][$RowNumber] = CCGetFromPost("presdic_" . $RowNumber, NULL);
            $this->FormParameters["presjul"][$RowNumber] = CCGetFromPost("presjul_" . $RowNumber, NULL);
            $this->FormParameters["idalquiler"][$RowNumber] = CCGetFromPost("idalquiler_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-5428A988
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idalquiler"] = $this->CachedColumns["idalquiler"][$this->RowNumber];
            $this->DataSource->CachedColumns["ano"] = $this->CachedColumns["ano"][$this->RowNumber];
            $this->DataSource->CachedColumns["idcuota"] = $this->CachedColumns["idcuota"][$this->RowNumber];
            $this->DataSource->CachedColumns["idimpuesto"] = $this->CachedColumns["idimpuesto"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->ene->SetText($this->FormParameters["ene"][$this->RowNumber], $this->RowNumber);
            $this->feb->SetText($this->FormParameters["feb"][$this->RowNumber], $this->RowNumber);
            $this->mar->SetText($this->FormParameters["mar"][$this->RowNumber], $this->RowNumber);
            $this->abr->SetText($this->FormParameters["abr"][$this->RowNumber], $this->RowNumber);
            $this->may->SetText($this->FormParameters["may"][$this->RowNumber], $this->RowNumber);
            $this->jun->SetText($this->FormParameters["jun"][$this->RowNumber], $this->RowNumber);
            $this->jul->SetText($this->FormParameters["jul"][$this->RowNumber], $this->RowNumber);
            $this->ago->SetText($this->FormParameters["ago"][$this->RowNumber], $this->RowNumber);
            $this->sept->SetText($this->FormParameters["sept"][$this->RowNumber], $this->RowNumber);
            $this->oct->SetText($this->FormParameters["oct"][$this->RowNumber], $this->RowNumber);
            $this->nov->SetText($this->FormParameters["nov"][$this->RowNumber], $this->RowNumber);
            $this->dic->SetText($this->FormParameters["dic"][$this->RowNumber], $this->RowNumber);
            $this->presene->SetText($this->FormParameters["presene"][$this->RowNumber], $this->RowNumber);
            $this->presfeb->SetText($this->FormParameters["presfeb"][$this->RowNumber], $this->RowNumber);
            $this->presmar->SetText($this->FormParameters["presmar"][$this->RowNumber], $this->RowNumber);
            $this->presabr->SetText($this->FormParameters["presabr"][$this->RowNumber], $this->RowNumber);
            $this->presmay->SetText($this->FormParameters["presmay"][$this->RowNumber], $this->RowNumber);
            $this->presjun->SetText($this->FormParameters["presjun"][$this->RowNumber], $this->RowNumber);
            $this->presago->SetText($this->FormParameters["presago"][$this->RowNumber], $this->RowNumber);
            $this->presset->SetText($this->FormParameters["presset"][$this->RowNumber], $this->RowNumber);
            $this->presoct->SetText($this->FormParameters["presoct"][$this->RowNumber], $this->RowNumber);
            $this->presnov->SetText($this->FormParameters["presnov"][$this->RowNumber], $this->RowNumber);
            $this->presdic->SetText($this->FormParameters["presdic"][$this->RowNumber], $this->RowNumber);
            $this->presjul->SetText($this->FormParameters["presjul"][$this->RowNumber], $this->RowNumber);
            $this->idalquiler->SetText($this->FormParameters["idalquiler"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                $Validation = ($this->ValidateRow($this->RowNumber) && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @2-9262E139
    function ValidateRow()
    {
        global $CCSLocales;
        $this->ene->Validate();
        $this->feb->Validate();
        $this->mar->Validate();
        $this->abr->Validate();
        $this->may->Validate();
        $this->jun->Validate();
        $this->jul->Validate();
        $this->ago->Validate();
        $this->sept->Validate();
        $this->oct->Validate();
        $this->nov->Validate();
        $this->dic->Validate();
        $this->presene->Validate();
        $this->presfeb->Validate();
        $this->presmar->Validate();
        $this->presabr->Validate();
        $this->presmay->Validate();
        $this->presjun->Validate();
        $this->presago->Validate();
        $this->presset->Validate();
        $this->presoct->Validate();
        $this->presnov->Validate();
        $this->presdic->Validate();
        $this->presjul->Validate();
        $this->idalquiler->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->ene->Errors->ToString());
        $errors = ComposeStrings($errors, $this->feb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->abr->Errors->ToString());
        $errors = ComposeStrings($errors, $this->may->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jun->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jul->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sept->Errors->ToString());
        $errors = ComposeStrings($errors, $this->oct->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nov->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presene->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presfeb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presmar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presabr->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presmay->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presjun->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presset->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presoct->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presnov->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presdic->Errors->ToString());
        $errors = ComposeStrings($errors, $this->presjul->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $this->ene->Errors->Clear();
        $this->feb->Errors->Clear();
        $this->mar->Errors->Clear();
        $this->abr->Errors->Clear();
        $this->may->Errors->Clear();
        $this->jun->Errors->Clear();
        $this->jul->Errors->Clear();
        $this->ago->Errors->Clear();
        $this->sept->Errors->Clear();
        $this->oct->Errors->Clear();
        $this->nov->Errors->Clear();
        $this->dic->Errors->Clear();
        $this->presene->Errors->Clear();
        $this->presfeb->Errors->Clear();
        $this->presmar->Errors->Clear();
        $this->presabr->Errors->Clear();
        $this->presmay->Errors->Clear();
        $this->presjun->Errors->Clear();
        $this->presago->Errors->Clear();
        $this->presset->Errors->Clear();
        $this->presoct->Errors->Clear();
        $this->presnov->Errors->Clear();
        $this->presdic->Errors->Clear();
        $this->presjul->Errors->Clear();
        $this->idalquiler->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-9702FE17
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["ene"][$this->RowNumber]) && count($this->FormParameters["ene"][$this->RowNumber])) || strlen($this->FormParameters["ene"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["feb"][$this->RowNumber]) && count($this->FormParameters["feb"][$this->RowNumber])) || strlen($this->FormParameters["feb"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["mar"][$this->RowNumber]) && count($this->FormParameters["mar"][$this->RowNumber])) || strlen($this->FormParameters["mar"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["abr"][$this->RowNumber]) && count($this->FormParameters["abr"][$this->RowNumber])) || strlen($this->FormParameters["abr"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["may"][$this->RowNumber]) && count($this->FormParameters["may"][$this->RowNumber])) || strlen($this->FormParameters["may"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["jun"][$this->RowNumber]) && count($this->FormParameters["jun"][$this->RowNumber])) || strlen($this->FormParameters["jun"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["jul"][$this->RowNumber]) && count($this->FormParameters["jul"][$this->RowNumber])) || strlen($this->FormParameters["jul"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["ago"][$this->RowNumber]) && count($this->FormParameters["ago"][$this->RowNumber])) || strlen($this->FormParameters["ago"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["sept"][$this->RowNumber]) && count($this->FormParameters["sept"][$this->RowNumber])) || strlen($this->FormParameters["sept"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["oct"][$this->RowNumber]) && count($this->FormParameters["oct"][$this->RowNumber])) || strlen($this->FormParameters["oct"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nov"][$this->RowNumber]) && count($this->FormParameters["nov"][$this->RowNumber])) || strlen($this->FormParameters["nov"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["dic"][$this->RowNumber]) && count($this->FormParameters["dic"][$this->RowNumber])) || strlen($this->FormParameters["dic"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presene"][$this->RowNumber]) && count($this->FormParameters["presene"][$this->RowNumber])) || strlen($this->FormParameters["presene"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presfeb"][$this->RowNumber]) && count($this->FormParameters["presfeb"][$this->RowNumber])) || strlen($this->FormParameters["presfeb"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presmar"][$this->RowNumber]) && count($this->FormParameters["presmar"][$this->RowNumber])) || strlen($this->FormParameters["presmar"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presabr"][$this->RowNumber]) && count($this->FormParameters["presabr"][$this->RowNumber])) || strlen($this->FormParameters["presabr"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presmay"][$this->RowNumber]) && count($this->FormParameters["presmay"][$this->RowNumber])) || strlen($this->FormParameters["presmay"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presjun"][$this->RowNumber]) && count($this->FormParameters["presjun"][$this->RowNumber])) || strlen($this->FormParameters["presjun"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presago"][$this->RowNumber]) && count($this->FormParameters["presago"][$this->RowNumber])) || strlen($this->FormParameters["presago"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presset"][$this->RowNumber]) && count($this->FormParameters["presset"][$this->RowNumber])) || strlen($this->FormParameters["presset"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presoct"][$this->RowNumber]) && count($this->FormParameters["presoct"][$this->RowNumber])) || strlen($this->FormParameters["presoct"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presnov"][$this->RowNumber]) && count($this->FormParameters["presnov"][$this->RowNumber])) || strlen($this->FormParameters["presnov"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presdic"][$this->RowNumber]) && count($this->FormParameters["presdic"][$this->RowNumber])) || strlen($this->FormParameters["presdic"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["presjul"][$this->RowNumber]) && count($this->FormParameters["presjul"][$this->RowNumber])) || strlen($this->FormParameters["presjul"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["idalquiler"][$this->RowNumber]) && count($this->FormParameters["idalquiler"][$this->RowNumber])) || strlen($this->FormParameters["idalquiler"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @2-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-6B923CC2
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-65B71969
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idalquiler"] = $this->CachedColumns["idalquiler"][$this->RowNumber];
            $this->DataSource->CachedColumns["ano"] = $this->CachedColumns["ano"][$this->RowNumber];
            $this->DataSource->CachedColumns["idcuota"] = $this->CachedColumns["idcuota"][$this->RowNumber];
            $this->DataSource->CachedColumns["idimpuesto"] = $this->CachedColumns["idimpuesto"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->ene->SetText($this->FormParameters["ene"][$this->RowNumber], $this->RowNumber);
            $this->feb->SetText($this->FormParameters["feb"][$this->RowNumber], $this->RowNumber);
            $this->mar->SetText($this->FormParameters["mar"][$this->RowNumber], $this->RowNumber);
            $this->abr->SetText($this->FormParameters["abr"][$this->RowNumber], $this->RowNumber);
            $this->may->SetText($this->FormParameters["may"][$this->RowNumber], $this->RowNumber);
            $this->jun->SetText($this->FormParameters["jun"][$this->RowNumber], $this->RowNumber);
            $this->jul->SetText($this->FormParameters["jul"][$this->RowNumber], $this->RowNumber);
            $this->ago->SetText($this->FormParameters["ago"][$this->RowNumber], $this->RowNumber);
            $this->sept->SetText($this->FormParameters["sept"][$this->RowNumber], $this->RowNumber);
            $this->oct->SetText($this->FormParameters["oct"][$this->RowNumber], $this->RowNumber);
            $this->nov->SetText($this->FormParameters["nov"][$this->RowNumber], $this->RowNumber);
            $this->dic->SetText($this->FormParameters["dic"][$this->RowNumber], $this->RowNumber);
            $this->presene->SetText($this->FormParameters["presene"][$this->RowNumber], $this->RowNumber);
            $this->presfeb->SetText($this->FormParameters["presfeb"][$this->RowNumber], $this->RowNumber);
            $this->presmar->SetText($this->FormParameters["presmar"][$this->RowNumber], $this->RowNumber);
            $this->presabr->SetText($this->FormParameters["presabr"][$this->RowNumber], $this->RowNumber);
            $this->presmay->SetText($this->FormParameters["presmay"][$this->RowNumber], $this->RowNumber);
            $this->presjun->SetText($this->FormParameters["presjun"][$this->RowNumber], $this->RowNumber);
            $this->presago->SetText($this->FormParameters["presago"][$this->RowNumber], $this->RowNumber);
            $this->presset->SetText($this->FormParameters["presset"][$this->RowNumber], $this->RowNumber);
            $this->presoct->SetText($this->FormParameters["presoct"][$this->RowNumber], $this->RowNumber);
            $this->presnov->SetText($this->FormParameters["presnov"][$this->RowNumber], $this->RowNumber);
            $this->presdic->SetText($this->FormParameters["presdic"][$this->RowNumber], $this->RowNumber);
            $this->presjul->SetText($this->FormParameters["presjul"][$this->RowNumber], $this->RowNumber);
            $this->idalquiler->SetText($this->FormParameters["idalquiler"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->UpdateAllowed) { $Validation = ($this->UpdateRow() && $Validation); }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//FormScript Method @2-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-7F4489EB
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 4)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idalquiler"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["ano"][$RowNumber] = $piece;
                $piece = $pieces[$i + 2];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idcuota"][$RowNumber] = $piece;
                $piece = $pieces[$i + 3];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idimpuesto"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["idalquiler"][$RowNumber] = "";
                $this->CachedColumns["ano"][$RowNumber] = "";
                $this->CachedColumns["idcuota"][$RowNumber] = "";
                $this->CachedColumns["idimpuesto"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-0AD905E9
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idalquiler"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["ano"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idcuota"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idimpuesto"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-661BCEA2
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["nombreimpuesto"] = $this->nombreimpuesto->Visible;
        $this->ControlsVisible["ene"] = $this->ene->Visible;
        $this->ControlsVisible["feb"] = $this->feb->Visible;
        $this->ControlsVisible["mar"] = $this->mar->Visible;
        $this->ControlsVisible["abr"] = $this->abr->Visible;
        $this->ControlsVisible["may"] = $this->may->Visible;
        $this->ControlsVisible["jun"] = $this->jun->Visible;
        $this->ControlsVisible["jul"] = $this->jul->Visible;
        $this->ControlsVisible["ago"] = $this->ago->Visible;
        $this->ControlsVisible["sept"] = $this->sept->Visible;
        $this->ControlsVisible["oct"] = $this->oct->Visible;
        $this->ControlsVisible["nov"] = $this->nov->Visible;
        $this->ControlsVisible["dic"] = $this->dic->Visible;
        $this->ControlsVisible["presene"] = $this->presene->Visible;
        $this->ControlsVisible["presfeb"] = $this->presfeb->Visible;
        $this->ControlsVisible["presmar"] = $this->presmar->Visible;
        $this->ControlsVisible["presabr"] = $this->presabr->Visible;
        $this->ControlsVisible["presmay"] = $this->presmay->Visible;
        $this->ControlsVisible["presjun"] = $this->presjun->Visible;
        $this->ControlsVisible["presago"] = $this->presago->Visible;
        $this->ControlsVisible["presset"] = $this->presset->Visible;
        $this->ControlsVisible["presoct"] = $this->presoct->Visible;
        $this->ControlsVisible["presnov"] = $this->presnov->Visible;
        $this->ControlsVisible["presdic"] = $this->presdic->Visible;
        $this->ControlsVisible["presjul"] = $this->presjul->Visible;
        $this->ControlsVisible["idalquiler"] = $this->idalquiler->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["idalquiler"][$this->RowNumber] = $this->DataSource->CachedColumns["idalquiler"];
                    $this->CachedColumns["ano"][$this->RowNumber] = $this->DataSource->CachedColumns["ano"];
                    $this->CachedColumns["idcuota"][$this->RowNumber] = $this->DataSource->CachedColumns["idcuota"];
                    $this->CachedColumns["idimpuesto"][$this->RowNumber] = $this->DataSource->CachedColumns["idimpuesto"];
                    $this->nombreimpuesto->SetValue($this->DataSource->nombreimpuesto->GetValue());
                    $this->ene->SetValue($this->DataSource->ene->GetValue());
                    $this->feb->SetValue($this->DataSource->feb->GetValue());
                    $this->mar->SetValue($this->DataSource->mar->GetValue());
                    $this->abr->SetValue($this->DataSource->abr->GetValue());
                    $this->may->SetValue($this->DataSource->may->GetValue());
                    $this->jun->SetValue($this->DataSource->jun->GetValue());
                    $this->jul->SetValue($this->DataSource->jul->GetValue());
                    $this->ago->SetValue($this->DataSource->ago->GetValue());
                    $this->sept->SetValue($this->DataSource->sept->GetValue());
                    $this->oct->SetValue($this->DataSource->oct->GetValue());
                    $this->nov->SetValue($this->DataSource->nov->GetValue());
                    $this->dic->SetValue($this->DataSource->dic->GetValue());
                    $this->presene->SetValue($this->DataSource->presene->GetValue());
                    $this->presfeb->SetValue($this->DataSource->presfeb->GetValue());
                    $this->presmar->SetValue($this->DataSource->presmar->GetValue());
                    $this->presabr->SetValue($this->DataSource->presabr->GetValue());
                    $this->presmay->SetValue($this->DataSource->presmay->GetValue());
                    $this->presjun->SetValue($this->DataSource->presjun->GetValue());
                    $this->presago->SetValue($this->DataSource->presago->GetValue());
                    $this->presset->SetValue($this->DataSource->presset->GetValue());
                    $this->presoct->SetValue($this->DataSource->presoct->GetValue());
                    $this->presnov->SetValue($this->DataSource->presnov->GetValue());
                    $this->presdic->SetValue($this->DataSource->presdic->GetValue());
                    $this->presjul->SetValue($this->DataSource->presjul->GetValue());
                    $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->nombreimpuesto->SetText("");
                    $this->nombreimpuesto->SetValue($this->DataSource->nombreimpuesto->GetValue());
                    $this->ene->SetText($this->FormParameters["ene"][$this->RowNumber], $this->RowNumber);
                    $this->feb->SetText($this->FormParameters["feb"][$this->RowNumber], $this->RowNumber);
                    $this->mar->SetText($this->FormParameters["mar"][$this->RowNumber], $this->RowNumber);
                    $this->abr->SetText($this->FormParameters["abr"][$this->RowNumber], $this->RowNumber);
                    $this->may->SetText($this->FormParameters["may"][$this->RowNumber], $this->RowNumber);
                    $this->jun->SetText($this->FormParameters["jun"][$this->RowNumber], $this->RowNumber);
                    $this->jul->SetText($this->FormParameters["jul"][$this->RowNumber], $this->RowNumber);
                    $this->ago->SetText($this->FormParameters["ago"][$this->RowNumber], $this->RowNumber);
                    $this->sept->SetText($this->FormParameters["sept"][$this->RowNumber], $this->RowNumber);
                    $this->oct->SetText($this->FormParameters["oct"][$this->RowNumber], $this->RowNumber);
                    $this->nov->SetText($this->FormParameters["nov"][$this->RowNumber], $this->RowNumber);
                    $this->dic->SetText($this->FormParameters["dic"][$this->RowNumber], $this->RowNumber);
                    $this->presene->SetText($this->FormParameters["presene"][$this->RowNumber], $this->RowNumber);
                    $this->presfeb->SetText($this->FormParameters["presfeb"][$this->RowNumber], $this->RowNumber);
                    $this->presmar->SetText($this->FormParameters["presmar"][$this->RowNumber], $this->RowNumber);
                    $this->presabr->SetText($this->FormParameters["presabr"][$this->RowNumber], $this->RowNumber);
                    $this->presmay->SetText($this->FormParameters["presmay"][$this->RowNumber], $this->RowNumber);
                    $this->presjun->SetText($this->FormParameters["presjun"][$this->RowNumber], $this->RowNumber);
                    $this->presago->SetText($this->FormParameters["presago"][$this->RowNumber], $this->RowNumber);
                    $this->presset->SetText($this->FormParameters["presset"][$this->RowNumber], $this->RowNumber);
                    $this->presoct->SetText($this->FormParameters["presoct"][$this->RowNumber], $this->RowNumber);
                    $this->presnov->SetText($this->FormParameters["presnov"][$this->RowNumber], $this->RowNumber);
                    $this->presdic->SetText($this->FormParameters["presdic"][$this->RowNumber], $this->RowNumber);
                    $this->presjul->SetText($this->FormParameters["presjul"][$this->RowNumber], $this->RowNumber);
                    $this->idalquiler->SetText($this->FormParameters["idalquiler"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["idalquiler"][$this->RowNumber] = "";
                    $this->CachedColumns["ano"][$this->RowNumber] = "";
                    $this->CachedColumns["idcuota"][$this->RowNumber] = "";
                    $this->CachedColumns["idimpuesto"][$this->RowNumber] = "";
                    $this->nombreimpuesto->SetText("");
                    $this->ene->SetValue("");
                    $this->feb->SetValue("");
                    $this->mar->SetValue("");
                    $this->abr->SetValue("");
                    $this->may->SetValue("");
                    $this->jun->SetValue("");
                    $this->jul->SetValue("");
                    $this->ago->SetValue("");
                    $this->sept->SetValue("");
                    $this->oct->SetValue("");
                    $this->nov->SetValue("");
                    $this->dic->SetValue("");
                    $this->presene->SetText("");
                    $this->presfeb->SetText("");
                    $this->presmar->SetText("");
                    $this->presabr->SetText("");
                    $this->presmay->SetText("");
                    $this->presjun->SetText("");
                    $this->presago->SetText("");
                    $this->presset->SetText("");
                    $this->presoct->SetText("");
                    $this->presnov->SetText("");
                    $this->presdic->SetText("");
                    $this->presjul->SetText("");
                    $this->idalquiler->SetText("");
                } else {
                    $this->nombreimpuesto->SetText("");
                    $this->ene->SetText($this->FormParameters["ene"][$this->RowNumber], $this->RowNumber);
                    $this->feb->SetText($this->FormParameters["feb"][$this->RowNumber], $this->RowNumber);
                    $this->mar->SetText($this->FormParameters["mar"][$this->RowNumber], $this->RowNumber);
                    $this->abr->SetText($this->FormParameters["abr"][$this->RowNumber], $this->RowNumber);
                    $this->may->SetText($this->FormParameters["may"][$this->RowNumber], $this->RowNumber);
                    $this->jun->SetText($this->FormParameters["jun"][$this->RowNumber], $this->RowNumber);
                    $this->jul->SetText($this->FormParameters["jul"][$this->RowNumber], $this->RowNumber);
                    $this->ago->SetText($this->FormParameters["ago"][$this->RowNumber], $this->RowNumber);
                    $this->sept->SetText($this->FormParameters["sept"][$this->RowNumber], $this->RowNumber);
                    $this->oct->SetText($this->FormParameters["oct"][$this->RowNumber], $this->RowNumber);
                    $this->nov->SetText($this->FormParameters["nov"][$this->RowNumber], $this->RowNumber);
                    $this->dic->SetText($this->FormParameters["dic"][$this->RowNumber], $this->RowNumber);
                    $this->presene->SetText($this->FormParameters["presene"][$this->RowNumber], $this->RowNumber);
                    $this->presfeb->SetText($this->FormParameters["presfeb"][$this->RowNumber], $this->RowNumber);
                    $this->presmar->SetText($this->FormParameters["presmar"][$this->RowNumber], $this->RowNumber);
                    $this->presabr->SetText($this->FormParameters["presabr"][$this->RowNumber], $this->RowNumber);
                    $this->presmay->SetText($this->FormParameters["presmay"][$this->RowNumber], $this->RowNumber);
                    $this->presjun->SetText($this->FormParameters["presjun"][$this->RowNumber], $this->RowNumber);
                    $this->presago->SetText($this->FormParameters["presago"][$this->RowNumber], $this->RowNumber);
                    $this->presset->SetText($this->FormParameters["presset"][$this->RowNumber], $this->RowNumber);
                    $this->presoct->SetText($this->FormParameters["presoct"][$this->RowNumber], $this->RowNumber);
                    $this->presnov->SetText($this->FormParameters["presnov"][$this->RowNumber], $this->RowNumber);
                    $this->presdic->SetText($this->FormParameters["presdic"][$this->RowNumber], $this->RowNumber);
                    $this->presjul->SetText($this->FormParameters["presjul"][$this->RowNumber], $this->RowNumber);
                    $this->idalquiler->SetText($this->FormParameters["idalquiler"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nombreimpuesto->Show($this->RowNumber);
                $this->ene->Show($this->RowNumber);
                $this->feb->Show($this->RowNumber);
                $this->mar->Show($this->RowNumber);
                $this->abr->Show($this->RowNumber);
                $this->may->Show($this->RowNumber);
                $this->jun->Show($this->RowNumber);
                $this->jul->Show($this->RowNumber);
                $this->ago->Show($this->RowNumber);
                $this->sept->Show($this->RowNumber);
                $this->oct->Show($this->RowNumber);
                $this->nov->Show($this->RowNumber);
                $this->dic->Show($this->RowNumber);
                $this->presene->Show($this->RowNumber);
                $this->presfeb->Show($this->RowNumber);
                $this->presmar->Show($this->RowNumber);
                $this->presabr->Show($this->RowNumber);
                $this->presmay->Show($this->RowNumber);
                $this->presjun->Show($this->RowNumber);
                $this->presago->Show($this->RowNumber);
                $this->presset->Show($this->RowNumber);
                $this->presoct->Show($this->RowNumber);
                $this->presnov->Show($this->RowNumber);
                $this->presdic->Show($this->RowNumber);
                $this->presjul->Show($this->RowNumber);
                $this->idalquiler->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["idalquiler"] == $this->CachedColumns["idalquiler"][$this->RowNumber]) && ($this->DataSource->CachedColumns["ano"] == $this->CachedColumns["ano"][$this->RowNumber]) && ($this->DataSource->CachedColumns["idcuota"] == $this->CachedColumns["idcuota"][$this->RowNumber]) && ($this->DataSource->CachedColumns["idimpuesto"] == $this->CachedColumns["idimpuesto"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();
        $this->Label1->Show();
        $this->Label2->Show();
        $this->Label3->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        if($this->FormSubmitted || CCGetFromGet("ccsForm")) {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        } else {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("All", ""), "ccsForm", $CCSForm);
        }
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End impuestos_impuestosanocon Class @2-FCB6E20C

class clsimpuestos_impuestosanoconDataSource extends clsDBConnection1 {  //impuestos_impuestosanoconDataSource Class @2-C745D216

//DataSource Variables @2-66FA15ED
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;

    // Datasource fields
    var $nombreimpuesto;
    var $ene;
    var $feb;
    var $mar;
    var $abr;
    var $may;
    var $jun;
    var $jul;
    var $ago;
    var $sept;
    var $oct;
    var $nov;
    var $dic;
    var $presene;
    var $presfeb;
    var $presmar;
    var $presabr;
    var $presmay;
    var $presjun;
    var $presago;
    var $presset;
    var $presoct;
    var $presnov;
    var $presdic;
    var $presjul;
    var $idalquiler;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6117EE4E
    function clsimpuestos_impuestosanoconDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid impuestos_impuestosanocon/Error";
        $this->Initialize();
        $this->nombreimpuesto = new clsField("nombreimpuesto", ccsText, "");
        
        $this->ene = new clsField("ene", ccsBoolean, $this->BooleanFormat);
        
        $this->feb = new clsField("feb", ccsBoolean, $this->BooleanFormat);
        
        $this->mar = new clsField("mar", ccsBoolean, $this->BooleanFormat);
        
        $this->abr = new clsField("abr", ccsBoolean, $this->BooleanFormat);
        
        $this->may = new clsField("may", ccsBoolean, $this->BooleanFormat);
        
        $this->jun = new clsField("jun", ccsBoolean, $this->BooleanFormat);
        
        $this->jul = new clsField("jul", ccsBoolean, $this->BooleanFormat);
        
        $this->ago = new clsField("ago", ccsBoolean, $this->BooleanFormat);
        
        $this->sept = new clsField("sept", ccsBoolean, $this->BooleanFormat);
        
        $this->oct = new clsField("oct", ccsBoolean, $this->BooleanFormat);
        
        $this->nov = new clsField("nov", ccsBoolean, $this->BooleanFormat);
        
        $this->dic = new clsField("dic", ccsBoolean, $this->BooleanFormat);
        
        $this->presene = new clsField("presene", ccsText, "");
        
        $this->presfeb = new clsField("presfeb", ccsText, "");
        
        $this->presmar = new clsField("presmar", ccsText, "");
        
        $this->presabr = new clsField("presabr", ccsText, "");
        
        $this->presmay = new clsField("presmay", ccsText, "");
        
        $this->presjun = new clsField("presjun", ccsText, "");
        
        $this->presago = new clsField("presago", ccsText, "");
        
        $this->presset = new clsField("presset", ccsText, "");
        
        $this->presoct = new clsField("presoct", ccsText, "");
        
        $this->presnov = new clsField("presnov", ccsText, "");
        
        $this->presdic = new clsField("presdic", ccsText, "");
        
        $this->presjul = new clsField("presjul", ccsText, "");
        
        $this->idalquiler = new clsField("idalquiler", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-BF7F5B01
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-5632A397
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->AllParametersSet = true;
    }
//End Prepare Method

//Open Method @2-DC08894C
    function Open()
    {
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idalquiler"] = new clsSQLParameter("urlidalquiler", ccsInteger, "", "", CCGetFromGet("idalquiler", NULL), "", false, $this->ErrorBlock);
        $this->cp["ano"] = new clsSQLParameter("urlano", ccsInteger, "", "", CCGetFromGet("ano", NULL), "", false, $this->ErrorBlock);
            $this->RecordsCount = "CCS not counted";
          
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "EXEC sp_muestra_impuestos_alquiler " . $this->ToSQL($this->cp["idalquiler"]->GetDBValue(), $this->cp["idalquiler"]->DataType) . ", "
             . $this->ToSQL($this->cp["ano"]->GetDBValue(), $this->cp["ano"]->DataType) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query($this->SQL);
        $this->RecordsCount = "CCS not counted";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        if ($this->Errors->count()) return false;
        if ($this->RecordsCount == "CCS not counted") {
            $this->RecordsCount = $this->num_rows();
        }
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @2-A242C254
    function SetValues()
    {
        $this->CachedColumns["idalquiler"] = $this->f("idalquiler");
        $this->CachedColumns["ano"] = $this->f("ano");
        $this->CachedColumns["idcuota"] = $this->f("idcuota");
        $this->CachedColumns["idimpuesto"] = $this->f("idimpuesto");
        $this->nombreimpuesto->SetDBValue($this->f("nombreimpuesto"));
        $this->ene->SetDBValue(trim($this->f("ene")));
        $this->feb->SetDBValue(trim($this->f("feb")));
        $this->mar->SetDBValue(trim($this->f("mar")));
        $this->abr->SetDBValue(trim($this->f("abr")));
        $this->may->SetDBValue(trim($this->f("may")));
        $this->jun->SetDBValue(trim($this->f("jun")));
        $this->jul->SetDBValue(trim($this->f("jul")));
        $this->ago->SetDBValue(trim($this->f("ago")));
        $this->sept->SetDBValue(trim($this->f("sept")));
        $this->oct->SetDBValue(trim($this->f("oct")));
        $this->nov->SetDBValue(trim($this->f("nov")));
        $this->dic->SetDBValue(trim($this->f("dic")));
        $this->presene->SetDBValue($this->f("presene"));
        $this->presfeb->SetDBValue($this->f("presfeb"));
        $this->presmar->SetDBValue($this->f("presmar"));
        $this->presabr->SetDBValue($this->f("presabr"));
        $this->presmay->SetDBValue($this->f("presmay"));
        $this->presjun->SetDBValue($this->f("presjun"));
        $this->presago->SetDBValue($this->f("presago"));
        $this->presset->SetDBValue($this->f("presset"));
        $this->presoct->SetDBValue($this->f("presoct"));
        $this->presnov->SetDBValue($this->f("presnov"));
        $this->presdic->SetDBValue($this->f("presdic"));
        $this->presjul->SetDBValue($this->f("presjul"));
        $this->idalquiler->SetDBValue(trim($this->f("idalquiler")));
    }
//End SetValues Method

} //End impuestos_impuestosanoconDataSource Class @2-FCB6E20C

class clsRecordNewRecord1 { //NewRecord1 Class @48-D7EDAFB1

//Variables @48-D6FF3E86

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

//Class_Initialize Event @48-5AFC7718
    function clsRecordNewRecord1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->ano = & new clsControl(ccsListBox, "ano", "ano", ccsInteger, "", CCGetRequestParam("ano", $Method, NULL), $this);
            $this->ano->DSType = dsSQL;
            $this->ano->DataSource = new clsDBConnection1();
            $this->ano->ds = & $this->ano->DataSource;
            list($this->ano->BoundColumn, $this->ano->TextColumn, $this->ano->DBFormat) = array("ano", "descripcion", "");
            $this->ano->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);
            $this->ano->DataSource->wp = new clsSQLParameters();
            $this->ano->DataSource->wp->AddParameter("1", "urlidalquiler", ccsText, "", "", $this->ano->DataSource->Parameters["urlidalquiler"], "", false);
            $this->ano->DataSource->SQL = "select ano,(year(fechainicio)+ ano - 1) as descripcion\n" .
            "from alquileres \n" .
            "	left join anocontratoalquiler\n" .
            "	on alquileres.idalquiler = anocontratoalquiler.idalquiler\n" .
            "where alquileres.idalquiler = " . $this->ano->DataSource->SQLValue($this->ano->DataSource->wp->GetDBValue("1"), ccsText) . "";
            $this->ano->DataSource->Order = "";
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @48-A140D686
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ano->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ano->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @48-EA33BE0F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ano->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @48-ED598703
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

//Operation Method @48-2D15048E
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
        $Redirect = $FileName . "?" . CCGetQueryString("All", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("ano", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @48-5CE327F1
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

        $this->ano->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ano->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        if($this->FormSubmitted || CCGetFromGet("ccsForm")) {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        } else {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("All", ""), "ccsForm", $CCSForm);
        }
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->ano->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End NewRecord1 Class @48-FCB6E20C

//Include Page implementation @113-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Initialize Page @1-4BA0EEF0
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
$TemplateFileName = "impuestospresentados.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-67B933AE
include_once("./impuestospresentados_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-494DFFEE
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$impuestos_impuestosanocon = & new clsEditableGridimpuestos_impuestosanocon("", $MainPage);
$NewRecord1 = & new clsRecordNewRecord1("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$MainPage->impuestos_impuestosanocon = & $impuestos_impuestosanocon;
$MainPage->NewRecord1 = & $NewRecord1;
$MainPage->Header = & $Header;
$impuestos_impuestosanocon->Initialize();

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

//Execute Components @1-3C001EFF
$impuestos_impuestosanocon->Operation();
$NewRecord1->Operation();
$Header->Operations();
//End Execute Components

//Go to destination page @1-7BB81F37
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($impuestos_impuestosanocon);
    unset($NewRecord1);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E5ADBF39
$impuestos_impuestosanocon->Show();
$NewRecord1->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-67142A05
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($impuestos_impuestosanocon);
unset($NewRecord1);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
