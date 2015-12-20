<?php
//Include Common Files @1-9242B900
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "anulacion_hipo.php");
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

//Operation Method @3-0E7DC8B3
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
        $Redirect = "anulacion_hipo.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "anulacion_hipo.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

//Class_Initialize Event @6-EB6124AF
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
        $this->estado = & new clsControl(ccsLabel, "estado", "estado", ccsText, "", CCGetRequestParam("estado", ccsGet, NULL), $this);
        $this->cuotaspagas = & new clsControl(ccsLabel, "cuotaspagas", "cuotaspagas", ccsText, "", CCGetRequestParam("cuotaspagas", ccsGet, NULL), $this);
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

//Show Method @6-FE2008F0
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
            $this->ControlsVisible["estado"] = $this->estado->Visible;
            $this->ControlsVisible["cuotaspagas"] = $this->cuotaspagas->Visible;
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
                $this->estado->SetValue($this->DataSource->estado->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idhipoteca->Show();
                $this->montohipoteca->Show();
                $this->fechainicio->Show();
                $this->fechafin->Show();
                $this->direccion->Show();
                $this->simbolo->Show();
                $this->estado->Show();
                $this->cuotaspagas->Show();
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

//GetErrors Method @6-E9661DC4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cuotaspagas->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End hipoteca Class @6-FCB6E20C

class clshipotecaDataSource extends clsDBConnection1 {  //hipotecaDataSource Class @6-604F958B

//DataSource Variables @6-2FCECBDB
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
    var $estado;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-E209E385
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
        
        $this->estado = new clsField("estado", ccsText, "");
        

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

//Prepare Method @6-8991D91A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "hipotecas.idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = "( hipotecas.idestado in(1,4) )";
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-58C9A30D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM estados INNER JOIN ((hipotecas INNER JOIN Monedas ON\n\n" .
        "hipotecas.idmoneda = Monedas.idmoneda) INNER JOIN propiedades ON\n\n" .
        "hipotecas.idpropiedad = propiedades.idpropiedad) ON\n\n" .
        "estados.idestado = hipotecas.idestado";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} direccion, idhipoteca, montohipoteca, fechainicio, fechafin, simbolo, estados.descripcion AS estados_descripcion \n\n" .
        "FROM estados INNER JOIN ((hipotecas INNER JOIN Monedas ON\n\n" .
        "hipotecas.idmoneda = Monedas.idmoneda) INNER JOIN propiedades ON\n\n" .
        "hipotecas.idpropiedad = propiedades.idpropiedad) ON\n\n" .
        "estados.idestado = hipotecas.idestado {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @6-726AB487
    function SetValues()
    {
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->montohipoteca->SetDBValue(trim($this->f("montohipoteca")));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->simbolo->SetDBValue($this->f("simbolo"));
        $this->estado->SetDBValue($this->f("estados_descripcion"));
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

//Prepare Method @28-12BE1744
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "hipotecas.idhipoteca", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = "( hipotecas.idestado IN( 1,4) )";
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

class clsRecordAnula { //Anula Class @106-A22F10D1

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

//Class_Initialize Event @106-4469D6C1
    function clsRecordAnula($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Anula/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Anula";
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

//Operation Method @106-65CEF376
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
        $Redirect = "anulacion.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

} //End Anula Class @106-FCB6E20C

//Initialize Page @1-0E31C506
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
$TemplateFileName = "anulacion_hipo.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B1208350
include_once("./anulacion_hipo_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2D190B96
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
$Anula = & new clsRecordAnula("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->hipotecas = & $hipotecas;
$MainPage->hipoteca = & $hipoteca;
$MainPage->deudores = & $deudores;
$MainPage->deuda = & $deuda;
$MainPage->acreedores = & $acreedores;
$MainPage->Anula = & $Anula;
$hipoteca->Initialize();
$deudores->Initialize();
$deuda->Initialize();
$acreedores->Initialize();

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

//Execute Components @1-241BDF2D
$Header->Operations();
$hipotecas->Operation();
$Anula->Operation();
//End Execute Components

//Go to destination page @1-367F1DC3
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
    unset($Anula);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3BEFD72E
$Header->Show();
$hipotecas->Show();
$hipoteca->Show();
$deudores->Show();
$deuda->Show();
$acreedores->Show();
$Anula->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-ADADF4ED
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($hipotecas);
unset($hipoteca);
unset($deudores);
unset($deuda);
unset($acreedores);
unset($Anula);
unset($Tpl);
//End Unload Page


?>
