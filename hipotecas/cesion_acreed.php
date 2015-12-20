<?php
//Include Common Files @1-3CFC962C
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "cesion_acreed.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordhipotecas { //hipotecas Class @3-08E7C8A3

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

//Class_Initialize Event @3-ADE5E12E
    function clsRecordhipotecas($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record hipotecas/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "hipotecas";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->idhipoteca = & new clsControl(ccsTextBox, "idhipoteca", "idhipoteca", ccsInteger, "", CCGetRequestParam("idhipoteca", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-2A5497B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idhipoteca->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idhipoteca->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-BD23F23B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idhipoteca->Errors->Count());
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

//Operation Method @3-B4D7E978
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
        $Redirect = "cesion_acreed.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "cesion_acreed.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-A8A6C0D7
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
            $Error = ComposeStrings($Error, $this->idhipoteca->Errors->ToString());
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
        $this->idhipoteca->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End hipotecas Class @3-FCB6E20C

class clsGridhipoteca { //hipoteca class @6-BB26D050

//Variables @6-AC1EDBB9

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
//End Variables

//Class_Initialize Event @6-E24CBFE4
    function clsGridhipoteca($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "hipoteca";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid hipoteca";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clshipotecaDataSource($this);
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

        $this->idhipoteca = & new clsControl(ccsLabel, "idhipoteca", "idhipoteca", ccsInteger, "", CCGetRequestParam("idhipoteca", ccsGet, NULL), $this);
        $this->montohipoteca = & new clsControl(ccsLabel, "montohipoteca", "montohipoteca", ccsFloat, "", CCGetRequestParam("montohipoteca", ccsGet, NULL), $this);
        $this->fechainicio = & new clsControl(ccsLabel, "fechainicio", "fechainicio", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechainicio", ccsGet, NULL), $this);
        $this->fechafin = & new clsControl(ccsLabel, "fechafin", "fechafin", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechafin", ccsGet, NULL), $this);
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->simbolo = & new clsControl(ccsLabel, "simbolo", "simbolo", ccsText, "", CCGetRequestParam("simbolo", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @6-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @6-9F0C205E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);

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
            $this->ControlsVisible["idhipoteca"] = $this->idhipoteca->Visible;
            $this->ControlsVisible["montohipoteca"] = $this->montohipoteca->Visible;
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["fechafin"] = $this->fechafin->Visible;
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idhipoteca->SetValue($this->DataSource->idhipoteca->GetValue());
                $this->montohipoteca->SetValue($this->DataSource->montohipoteca->GetValue());
                $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idhipoteca->Show();
                $this->montohipoteca->Show();
                $this->fechainicio->Show();
                $this->fechafin->Show();
                $this->direccion->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-D5602408
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End hipoteca Class @6-FCB6E20C

class clshipotecaDataSource extends clsDBConnection1 {  //hipotecaDataSource Class @6-604F958B

//DataSource Variables @6-C8A4B532
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idhipoteca;
    var $montohipoteca;
    var $fechainicio;
    var $fechafin;
    var $direccion;
    var $simbolo;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-307CAF3A
    function clshipotecaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid hipoteca";
        $this->Initialize();
        $this->idhipoteca = new clsField("idhipoteca", ccsInteger, "");
        
        $this->montohipoteca = new clsField("montohipoteca", ccsFloat, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, $this->DateFormat);
        
        $this->fechafin = new clsField("fechafin", ccsDate, $this->DateFormat);
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->simbolo = new clsField("simbolo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @6-FFC1E5F0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "hipotecas.idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = "( hipotecas.idestado = 1 )";
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-BC45F54C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (hipotecas INNER JOIN Monedas ON\n\n" .
        "hipotecas.idmoneda = Monedas.idmoneda) INNER JOIN propiedades ON\n\n" .
        "hipotecas.idpropiedad = propiedades.idpropiedad";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} direccion, idhipoteca, montohipoteca, fechainicio, fechafin, simbolo \n\n" .
        "FROM (hipotecas INNER JOIN Monedas ON\n\n" .
        "hipotecas.idmoneda = Monedas.idmoneda) INNER JOIN propiedades ON\n\n" .
        "hipotecas.idpropiedad = propiedades.idpropiedad {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @6-D181D007
    function SetValues()
    {
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->simbolo->SetDBValue($this->f("simbolo"));
    }
//End SetValues Method

} //End hipotecaDataSource Class @6-FCB6E20C

class clsGriddeudores { //deudores class @28-94C52CBB

//Variables @28-AC1EDBB9

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
//End Variables

//Class_Initialize Event @28-5D55B994
    function clsGriddeudores($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "deudores";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid deudores";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdeudoresDataSource($this);
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

        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
        $this->duenoporcentaje = & new clsControl(ccsLabel, "duenoporcentaje", "duenoporcentaje", ccsFloat, "", CCGetRequestParam("duenoporcentaje", ccsGet, NULL), $this);
        $this->destipodocumento = & new clsControl(ccsLabel, "destipodocumento", "destipodocumento", ccsText, "", CCGetRequestParam("destipodocumento", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @28-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @28-48790769
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);

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
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
            $this->ControlsVisible["duenoporcentaje"] = $this->duenoporcentaje->Visible;
            $this->ControlsVisible["destipodocumento"] = $this->destipodocumento->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                $this->duenoporcentaje->SetValue($this->DataSource->duenoporcentaje->GetValue());
                $this->destipodocumento->SetValue($this->DataSource->destipodocumento->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nombre->Show();
                $this->nrodocumento->Show();
                $this->duenoporcentaje->Show();
                $this->destipodocumento->Show();
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
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @28-7FF6346C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->duenoporcentaje->Errors->ToString());
        $errors = ComposeStrings($errors, $this->destipodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End deudores Class @28-FCB6E20C

class clsdeudoresDataSource extends clsDBConnection1 {  //deudoresDataSource Class @28-D5A2563D

//DataSource Variables @28-D1E3C1CC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $nombre;
    var $nrodocumento;
    var $duenoporcentaje;
    var $destipodocumento;
//End DataSource Variables

//DataSourceClass_Initialize Event @28-0CCA5778
    function clsdeudoresDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid deudores";
        $this->Initialize();
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->duenoporcentaje = new clsField("duenoporcentaje", ccsFloat, "");
        
        $this->destipodocumento = new clsField("destipodocumento", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @28-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @28-FFC1E5F0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "hipotecas.idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = "( hipotecas.idestado = 1 )";
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @28-E9283E38
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM hipotecas INNER JOIN (fichaspropiedades INNER JOIN (fichas INNER JOIN tipodocumentos ON\n\n" .
        "fichas.idtipodocumento = tipodocumentos.idtipodocumento) ON\n\n" .
        "fichaspropiedades.idficha = fichas.idficha) ON\n\n" .
        "hipotecas.idpropiedad = fichaspropiedades.idpropiedad";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} duenoporcentaje, hipotecas.*, destipodocumento, nombre, nrodocumento \n\n" .
        "FROM hipotecas INNER JOIN (fichaspropiedades INNER JOIN (fichas INNER JOIN tipodocumentos ON\n\n" .
        "fichas.idtipodocumento = tipodocumentos.idtipodocumento) ON\n\n" .
        "fichaspropiedades.idficha = fichas.idficha) ON\n\n" .
        "hipotecas.idpropiedad = fichaspropiedades.idpropiedad {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @28-F375A910
    function SetValues()
    {
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->nrodocumento->SetDBValue($this->f("nrodocumento"));
        $this->duenoporcentaje->SetDBValue(trim($this->f("duenoporcentaje")));
        $this->destipodocumento->SetDBValue($this->f("destipodocumento"));
    }
//End SetValues Method

} //End deudoresDataSource Class @28-FCB6E20C

class clsGriddeuda { //deuda class @50-1BDB2C0B

//Variables @50-AC1EDBB9

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
//End Variables

//Class_Initialize Event @50-8F1EF7A6
    function clsGriddeuda($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "deuda";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid deuda";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdeudaDataSource($this);
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

        $this->deuda = & new clsControl(ccsLabel, "deuda", "deuda", ccsText, "", CCGetRequestParam("deuda", ccsGet, NULL), $this);
        $this->liquidacionp = & new clsControl(ccsLabel, "liquidacionp", "liquidacionp", ccsText, "", CCGetRequestParam("liquidacionp", ccsGet, NULL), $this);
        $this->honorarios = & new clsControl(ccsLabel, "honorarios", "honorarios", ccsText, "", CCGetRequestParam("honorarios", ccsGet, NULL), $this);
        $this->Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @50-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @50-58989391
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlRETURN_VALUE"] = CCGetFromGet("RETURN_VALUE", NULL);
        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);

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
            $this->ControlsVisible["deuda"] = $this->deuda->Visible;
            $this->ControlsVisible["liquidacionp"] = $this->liquidacionp->Visible;
            $this->ControlsVisible["honorarios"] = $this->honorarios->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->deuda->SetValue($this->DataSource->deuda->GetValue());
                $this->liquidacionp->SetValue($this->DataSource->liquidacionp->GetValue());
                $this->honorarios->SetValue($this->DataSource->honorarios->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->deuda->Show();
                $this->liquidacionp->Show();
                $this->honorarios->Show();
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
        $this->Label1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @50-0119520F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->deuda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->liquidacionp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->honorarios->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End deuda Class @50-FCB6E20C

class clsdeudaDataSource extends clsDBConnection1 {  //deudaDataSource Class @50-CD5BF076

//DataSource Variables @50-56ADCD83
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;


    // Datasource fields
    var $deuda;
    var $liquidacionp;
    var $honorarios;
//End DataSource Variables

//DataSourceClass_Initialize Event @50-CCD7AF38
    function clsdeudaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid deuda";
        $this->Initialize();
        $this->deuda = new clsField("deuda", ccsText, "");
        
        $this->liquidacionp = new clsField("liquidacionp", ccsText, "");
        
        $this->honorarios = new clsField("honorarios", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @50-BF7F5B01
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @50-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @50-4D2CEDC5
    function Open()
    {
        $this->cp["RETURN_VALUE"] = new clsSQLParameter("urlRETURN_VALUE", ccsInteger, "", "", CCGetFromGet("RETURN_VALUE", NULL), "", false, $this->ErrorBlock);
        $this->cp["idhipoteca"] = new clsSQLParameter("urlidhipoteca", ccsInteger, "", "", CCGetFromGet("idhipoteca", NULL), "", false, $this->ErrorBlock);
            $this->RecordsCount = "CCS not counted";
          
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "EXEC sp_deuda_hipoteca " . $this->ToSQL($this->cp["idhipoteca"]->GetDBValue(), $this->cp["idhipoteca"]->DataType) . ";";
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

//SetValues Method @50-774FAFD4
    function SetValues()
    {
        $this->deuda->SetDBValue($this->f("deuda"));
        $this->liquidacionp->SetDBValue($this->f("liquidacionp"));
        $this->honorarios->SetDBValue($this->f("honorarios"));
    }
//End SetValues Method

} //End deudaDataSource Class @50-FCB6E20C

class clsGridacreedores { //acreedores class @57-F63CE10F

//Variables @57-AC1EDBB9

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
//End Variables

//Class_Initialize Event @57-CB83B9CB
    function clsGridacreedores($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "acreedores";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid acreedores";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsacreedoresDataSource($this);
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

        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
        $this->porcentajehip = & new clsControl(ccsLabel, "porcentajehip", "porcentajehip", ccsFloat, "", CCGetRequestParam("porcentajehip", ccsGet, NULL), $this);
        $this->destipodocumento = & new clsControl(ccsLabel, "destipodocumento", "destipodocumento", ccsText, "", CCGetRequestParam("destipodocumento", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->idhipoteca = & new clsControl(ccsHidden, "idhipoteca", "idhipoteca", ccsText, "", CCGetRequestParam("idhipoteca", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @57-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @57-3A4F0F90
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);

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
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
            $this->ControlsVisible["porcentajehip"] = $this->porcentajehip->Visible;
            $this->ControlsVisible["destipodocumento"] = $this->destipodocumento->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                $this->porcentajehip->SetValue($this->DataSource->porcentajehip->GetValue());
                $this->destipodocumento->SetValue($this->DataSource->destipodocumento->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nombre->Show();
                $this->nrodocumento->Show();
                $this->porcentajehip->Show();
                $this->destipodocumento->Show();
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
        $this->Navigator->Show();
        $this->idhipoteca->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @57-38A30183
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajehip->Errors->ToString());
        $errors = ComposeStrings($errors, $this->destipodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End acreedores Class @57-FCB6E20C

class clsacreedoresDataSource extends clsDBConnection1 {  //acreedoresDataSource Class @57-F2885C04

//DataSource Variables @57-AFA163DE
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $nombre;
    var $nrodocumento;
    var $porcentajehip;
    var $destipodocumento;
//End DataSource Variables

//DataSourceClass_Initialize Event @57-1980AF6F
    function clsacreedoresDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid acreedores";
        $this->Initialize();
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->porcentajehip = new clsField("porcentajehip", ccsFloat, "");
        
        $this->destipodocumento = new clsField("destipodocumento", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @57-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @57-890F6D3B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "fichashipotecas.idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @57-4F402889
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichashipotecas INNER JOIN (fichas INNER JOIN tipodocumentos ON\n\n" .
        "fichas.idtipodocumento = tipodocumentos.idtipodocumento) ON\n\n" .
        "fichashipotecas.idficha = fichas.idficha";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} destipodocumento, nombre, nrodocumento, porcentajehip, fichashipotecas.idficha AS fichashipotecas_idficha \n\n" .
        "FROM fichashipotecas INNER JOIN (fichas INNER JOIN tipodocumentos ON\n\n" .
        "fichas.idtipodocumento = tipodocumentos.idtipodocumento) ON\n\n" .
        "fichashipotecas.idficha = fichas.idficha {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @57-BB7C4CDC
    function SetValues()
    {
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->nrodocumento->SetDBValue($this->f("nrodocumento"));
        $this->porcentajehip->SetDBValue(trim($this->f("porcentajehip")));
        $this->destipodocumento->SetDBValue($this->f("destipodocumento"));
    }
//End SetValues Method

} //End acreedoresDataSource Class @57-FCB6E20C

class clsEditableGridfichashipotecascesion { //fichashipotecascesion Class @81-10986BBC

//Variables @81-F667987F

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

//Class_Initialize Event @81-11455158
    function clsEditableGridfichashipotecascesion($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid fichashipotecascesion/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "fichashipotecascesion";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["idhipoteca"][0] = "idhipoteca";
        $this->CachedColumns["idficha"][0] = "idficha";
        $this->DataSource = new clsfichashipotecascesionDataSource($this);
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

        $this->EmptyRows = 1;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
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

        $this->idficha = & new clsControl(ccsTextBox, "idficha", "Idficha", ccsInteger, "", NULL, $this);
        $this->idficha->Required = true;
        $this->porcentajehip = & new clsControl(ccsTextBox, "porcentajehip", "Porcentajehip", ccsFloat, "", NULL, $this);
        $this->CheckBox_Delete = & new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = & new clsButton("Button_Submit", $Method, $this);
        $this->errorAjax = & new clsControl(ccsHidden, "errorAjax", "errorAjax", ccsText, "", NULL, $this);
        $this->nombre = & new clsControl(ccsTextBox, "nombre", "nombre", ccsText, "", NULL, $this);
        $this->nrodocumento = & new clsControl(ccsTextBox, "nrodocumento", "nrodocumento", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @81-6FCE9FC1
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @81-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @81-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @81-8F76CB93
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["idficha"][$RowNumber] = CCGetFromPost("idficha_" . $RowNumber, NULL);
            $this->FormParameters["porcentajehip"][$RowNumber] = CCGetFromPost("porcentajehip_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["nombre"][$RowNumber] = CCGetFromPost("nombre_" . $RowNumber, NULL);
            $this->FormParameters["nrodocumento"][$RowNumber] = CCGetFromPost("nrodocumento_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @81-2B85A663
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idhipoteca"] = $this->CachedColumns["idhipoteca"][$this->RowNumber];
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
            $this->porcentajehip->SetText($this->FormParameters["porcentajehip"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
            $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @81-56A6EEDC
    function ValidateRow()
    {
        global $CCSLocales;
        $this->idficha->Validate();
        $this->porcentajehip->Validate();
        $this->CheckBox_Delete->Validate();
        $this->nombre->Validate();
        $this->nrodocumento->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajehip->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $this->idficha->Errors->Clear();
        $this->porcentajehip->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->nombre->Errors->Clear();
        $this->nrodocumento->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @81-781A120E
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["idficha"][$this->RowNumber]) && count($this->FormParameters["idficha"][$this->RowNumber])) || strlen($this->FormParameters["idficha"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["porcentajehip"][$this->RowNumber]) && count($this->FormParameters["porcentajehip"][$this->RowNumber])) || strlen($this->FormParameters["porcentajehip"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nombre"][$this->RowNumber]) && count($this->FormParameters["nombre"][$this->RowNumber])) || strlen($this->FormParameters["nombre"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nrodocumento"][$this->RowNumber]) && count($this->FormParameters["nrodocumento"][$this->RowNumber])) || strlen($this->FormParameters["nrodocumento"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @81-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @81-909F269B
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
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @81-7F75F5A8
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["idhipoteca"] = $this->CachedColumns["idhipoteca"][$this->RowNumber];
            $this->DataSource->CachedColumns["idficha"] = $this->CachedColumns["idficha"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
            $this->porcentajehip->SetText($this->FormParameters["porcentajehip"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
            $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
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

//InsertRow Method @81-1ECFAD97
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
        $this->DataSource->porcentajehip->SetValue($this->porcentajehip->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @81-977E9F13
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->idficha->SetValue($this->idficha->GetValue(true));
        $this->DataSource->porcentajehip->SetValue($this->porcentajehip->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @81-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @81-ED7CC240
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var fichashipotecascesionElements;\n";
        $script .= "var fichashipotecascesionEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "idfichaID = 0;\n";
        $script .= "var " . $this->ComponentName . "porcentajehipID = 1;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 2;\n";
        $script .= "var " . $this->ComponentName . "nombreID = 3;\n";
        $script .= "var " . $this->ComponentName . "nrodocumentoID = 4;\n";
        $script .= "\nfunction initfichashipotecascesionElements() {\n";
        $script .= "\tvar ED = document.forms[\"fichashipotecascesion\"];\n";
        $script .= "\tfichashipotecascesionElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.idficha_" . $i . ", " . "ED.porcentajehip_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.nombre_" . $i . ", " . "ED.nrodocumento_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @81-73E8755B
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
            for($i = 2; $i < sizeof($pieces); $i = $i + 2)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idhipoteca"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["idficha"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["idhipoteca"][$RowNumber] = "";
                $this->CachedColumns["idficha"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @81-6DD60A4D
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idhipoteca"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["idficha"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @81-55ED8D9E
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
        $this->ControlsVisible["idficha"] = $this->idficha->Visible;
        $this->ControlsVisible["porcentajehip"] = $this->porcentajehip->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["nombre"] = $this->nombre->Visible;
        $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["idhipoteca"][$this->RowNumber] = $this->DataSource->CachedColumns["idhipoteca"];
                    $this->CachedColumns["idficha"][$this->RowNumber] = $this->DataSource->CachedColumns["idficha"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                    $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                    $this->porcentajehip->SetValue($this->DataSource->porcentajehip->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                    $this->porcentajehip->SetText($this->FormParameters["porcentajehip"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["idhipoteca"][$this->RowNumber] = "";
                    $this->CachedColumns["idficha"][$this->RowNumber] = "";
                    $this->idficha->SetText("");
                    $this->porcentajehip->SetText("");
                    $this->nombre->SetText("");
                    $this->nrodocumento->SetText("");
                } else {
                    $this->idficha->SetText($this->FormParameters["idficha"][$this->RowNumber], $this->RowNumber);
                    $this->porcentajehip->SetText($this->FormParameters["porcentajehip"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->nombre->SetText($this->FormParameters["nombre"][$this->RowNumber], $this->RowNumber);
                    $this->nrodocumento->SetText($this->FormParameters["nrodocumento"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show($this->RowNumber);
                $this->porcentajehip->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                $this->nombre->Show($this->RowNumber);
                $this->nrodocumento->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["idhipoteca"] == $this->CachedColumns["idhipoteca"][$this->RowNumber]) && ($this->DataSource->CachedColumns["idficha"] == $this->CachedColumns["idficha"][$this->RowNumber])) {
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
        $this->Button_Submit->Show();
        $this->errorAjax->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
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

} //End fichashipotecascesion Class @81-FCB6E20C

class clsfichashipotecascesionDataSource extends clsDBConnection1 {  //fichashipotecascesionDataSource Class @81-2ED49866

//DataSource Variables @81-EFDBBFD9
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $CountSQL;
    var $wp;
    var $AllParametersSet;

    var $CachedColumns;
    var $CurrentRow;
    var $InsertFields = array();
    var $UpdateFields = array();

    // Datasource fields
    var $idficha;
    var $porcentajehip;
    var $CheckBox_Delete;
    var $nombre;
    var $nrodocumento;
//End DataSource Variables

//DataSourceClass_Initialize Event @81-CD344A06
    function clsfichashipotecascesionDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid fichashipotecascesion/Error";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->porcentajehip = new clsField("porcentajehip", ccsFloat, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        

        $this->InsertFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["porcentajehip"] = array("Name" => "porcentajehip", "Value" => "", "DataType" => ccsFloat);
        $this->InsertFields["idhipoteca"] = array("Name" => "idhipoteca", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["idficha"] = array("Name" => "idficha", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["porcentajehip"] = array("Name" => "porcentajehip", "Value" => "", "DataType" => ccsFloat);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @81-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @81-767034E6
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @81-77AD4AE2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichashipotecascesion";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM fichashipotecascesion {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @81-93AAFF92
    function SetValues()
    {
        $this->CachedColumns["idhipoteca"] = $this->f("idhipoteca");
        $this->CachedColumns["idficha"] = $this->f("idficha");
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->porcentajehip->SetDBValue(trim($this->f("porcentajehip")));
    }
//End SetValues Method

//Insert Method @81-E6AA0E1C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["porcentajehip"] = new clsSQLParameter("ctrlporcentajehip", ccsFloat, "", "", $this->porcentajehip->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idhipoteca"] = new clsSQLParameter("urlidhipoteca", ccsInteger, "", "", CCGetFromGet("idhipoteca", NULL), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        if (!is_null($this->cp["porcentajehip"]->GetValue()) and !strlen($this->cp["porcentajehip"]->GetText()) and !is_bool($this->cp["porcentajehip"]->GetValue())) 
            $this->cp["porcentajehip"]->SetValue($this->porcentajehip->GetValue(true));
        if (!is_null($this->cp["idhipoteca"]->GetValue()) and !strlen($this->cp["idhipoteca"]->GetText()) and !is_bool($this->cp["idhipoteca"]->GetValue())) 
            $this->cp["idhipoteca"]->SetText(CCGetFromGet("idhipoteca", NULL));
        $this->InsertFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->InsertFields["porcentajehip"]["Value"] = $this->cp["porcentajehip"]->GetDBValue(true);
        $this->InsertFields["idhipoteca"]["Value"] = $this->cp["idhipoteca"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("fichashipotecascesion", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @81-D1D3850E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["idficha"] = new clsSQLParameter("ctrlidficha", ccsInteger, "", "", $this->idficha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["porcentajehip"] = new clsSQLParameter("ctrlporcentajehip", ccsFloat, "", "", $this->porcentajehip->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsidhipoteca", ccsInteger, "", "", $this->CachedColumns["idhipoteca"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "dsidficha", ccsInteger, "", "", $this->CachedColumns["idficha"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["idficha"]->GetValue()) and !strlen($this->cp["idficha"]->GetText()) and !is_bool($this->cp["idficha"]->GetValue())) 
            $this->cp["idficha"]->SetValue($this->idficha->GetValue(true));
        if (!is_null($this->cp["porcentajehip"]->GetValue()) and !strlen($this->cp["porcentajehip"]->GetText()) and !is_bool($this->cp["porcentajehip"]->GetValue())) 
            $this->cp["porcentajehip"]->SetValue($this->porcentajehip->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "idhipoteca", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "idficha", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsInteger),false);
        $Where = $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]);
        $this->UpdateFields["idficha"]["Value"] = $this->cp["idficha"]->GetDBValue(true);
        $this->UpdateFields["porcentajehip"]["Value"] = $this->cp["porcentajehip"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("fichashipotecascesion", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @81-2574B717
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "";
        $this->SQL = "DELETE FROM fichashipotecascesion";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End fichashipotecascesionDataSource Class @81-FCB6E20C

class clsRecordCesion { //Cesion Class @106-9C4EA50D

//Variables @106-D6FF3E86

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

//Class_Initialize Event @106-0A1475DD
    function clsRecordCesion($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Cesion/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Cesion";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->exito = & new clsControl(ccsLabel, "exito", "exito", ccsText, "", CCGetRequestParam("exito", $Method, NULL), $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @106-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @106-4236B11E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->exito->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @106-ED598703
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

//Operation Method @106-E0C91449
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
        $Redirect = "cesion.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//Show Method @106-DD72EE48
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

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->exito->Errors->ToString());
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

        $this->exito->Show();
        $this->Button_Insert->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Cesion Class @106-FCB6E20C

//Initialize Page @1-7AC1C714
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
$TemplateFileName = "cesion_acreed.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CCEDE9C1
include_once("./cesion_acreed_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DAE8F064
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$hipotecas = & new clsRecordhipotecas("", $MainPage);
$hipoteca = & new clsGridhipoteca("", $MainPage);
$deudores = & new clsGriddeudores("", $MainPage);
$deuda = & new clsGriddeuda("", $MainPage);
$acreedores = & new clsGridacreedores("", $MainPage);
$fichashipotecascesion = & new clsEditableGridfichashipotecascesion("", $MainPage);
$Cesion = & new clsRecordCesion("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->hipotecas = & $hipotecas;
$MainPage->hipoteca = & $hipoteca;
$MainPage->deudores = & $deudores;
$MainPage->deuda = & $deuda;
$MainPage->acreedores = & $acreedores;
$MainPage->fichashipotecascesion = & $fichashipotecascesion;
$MainPage->Cesion = & $Cesion;
$hipoteca->Initialize();
$deudores->Initialize();
$deuda->Initialize();
$acreedores->Initialize();
$fichashipotecascesion->Initialize();

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

//Execute Components @1-A196E9B1
$Header->Operations();
$hipotecas->Operation();
$fichashipotecascesion->Operation();
$Cesion->Operation();
//End Execute Components

//Go to destination page @1-2D7751FC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($hipotecas);
    unset($hipoteca);
    unset($deudores);
    unset($deuda);
    unset($acreedores);
    unset($fichashipotecascesion);
    unset($Cesion);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-869ABC4A
$Header->Show();
$hipotecas->Show();
$hipoteca->Show();
$deudores->Show();
$deuda->Show();
$acreedores->Show();
$fichashipotecascesion->Show();
$Cesion->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-68C5CA4E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($hipotecas);
unset($hipoteca);
unset($deudores);
unset($deuda);
unset($acreedores);
unset($fichashipotecascesion);
unset($Cesion);
unset($Tpl);
//End Unload Page


?>
