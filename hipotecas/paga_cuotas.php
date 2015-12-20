<?php
//Include Common Files @1-EF7D5D7E
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "paga_cuotas.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordrecibo { //recibo Class @2-E3793E7B

//Variables @2-D6FF3E86

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

//Class_Initialize Event @2-76A3A423
    function clsRecordrecibo($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record recibo/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "recibo";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nrorec = & new clsControl(ccsTextBox, "nrorec", "nrorec", ccsText, "", CCGetRequestParam("nrorec", $Method, NULL), $this);
            $this->nrorec->Required = true;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->cuotas = & new clsControl(ccsHidden, "cuotas", "cuotas", ccsText, "", CCGetRequestParam("cuotas", $Method, NULL), $this);
            $this->idhipoteca = & new clsControl(ccsHidden, "idhipoteca", "idhipoteca", ccsText, "", CCGetRequestParam("idhipoteca", $Method, NULL), $this);
            $this->otros = & new clsControl(ccsTextBox, "otros", "otros", ccsFloat, "", CCGetRequestParam("otros", $Method, NULL), $this);
            $this->observaciones = & new clsControl(ccsHidden, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", $Method, NULL), $this);
            $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", $Method, NULL), $this);
            $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->Link1->Page = "#";
        }
    }
//End Class_Initialize Event

//Validate Method @2-9EAC1B22
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->nrorec->Validate() && $Validation);
        $Validation = ($this->cuotas->Validate() && $Validation);
        $Validation = ($this->idhipoteca->Validate() && $Validation);
        $Validation = ($this->otros->Validate() && $Validation);
        $Validation = ($this->observaciones->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nrorec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cuotas->Errors->Count() == 0);
        $Validation =  $Validation && ($this->idhipoteca->Errors->Count() == 0);
        $Validation =  $Validation && ($this->otros->Errors->Count() == 0);
        $Validation =  $Validation && ($this->observaciones->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-3C531137
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nrorec->Errors->Count());
        $errors = ($errors || $this->cuotas->Errors->Count());
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->otros->Errors->Count());
        $errors = ($errors || $this->observaciones->Errors->Count());
        $errors = ($errors || $this->Link1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-20CEF869
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
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-E34B5A05
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
            $Error = ComposeStrings($Error, $this->nrorec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cuotas->Errors->ToString());
            $Error = ComposeStrings($Error, $this->idhipoteca->Errors->ToString());
            $Error = ComposeStrings($Error, $this->otros->Errors->ToString());
            $Error = ComposeStrings($Error, $this->observaciones->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Link1->Errors->ToString());
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

        $this->nrorec->Show();
        $this->Button_Insert->Show();
        $this->cuotas->Show();
        $this->idhipoteca->Show();
        $this->otros->Show();
        $this->observaciones->Show();
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End recibo Class @2-FCB6E20C

//Initialize Page @1-045A5547
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
$TemplateFileName = "paga_cuotas.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-12C5AB45
include_once("./paga_cuotas_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-55CB5FDF
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$recibo = & new clsRecordrecibo("", $MainPage);
$MainPage->recibo = & $recibo;

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

//Execute Components @1-D92C8A1C
$recibo->Operation();
//End Execute Components

//Go to destination page @1-7CEE5F78
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    unset($recibo);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-16DA11E6
$recibo->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-21252ED4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
unset($recibo);
unset($Tpl);
//End Unload Page


?>
