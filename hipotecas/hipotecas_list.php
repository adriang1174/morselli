<?php
//Include Common Files @1-9D0B54FF
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "hipotecas_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @35-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordhipotecasSearch { //hipotecasSearch Class @2-53F9AA5A

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

//Class_Initialize Event @2-A18147CA
    function clsRecordhipotecasSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record hipotecasSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "hipotecasSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->idhipoteca = & new clsControl(ccsTextBox, "idhipoteca", "idhipoteca", ccsText, "", CCGetRequestParam("idhipoteca", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_nombre = & new clsControl(ccsTextBox, "s_nombre", "s_nombre", ccsText, "", CCGetRequestParam("s_nombre", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-EA4F695D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->idhipoteca->Validate() && $Validation);
        $Validation = ($this->s_nombre->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->idhipoteca->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombre->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-69AC09A2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->s_nombre->Errors->Count());
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

//Operation Method @2-9185CA65
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
        $Redirect = "./hipotecas_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "./hipotecas_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-1917F86B
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

        $this->idhipoteca->Show();
        $this->Button_DoSearch->Show();
        $this->s_nombre->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End hipotecasSearch Class @2-FCB6E20C

class clsGridhipotecas { //hipotecas class @6-B6DCBA15

//Variables @6-265EE567

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
    var $Sorter_idhipoteca;
    var $Sorter_direccion;
    var $Sorter_descripcion;
    var $Sorter_montohipoteca;
    var $Sorter_fechainicio;
    var $Sorter_fechafin;
//End Variables

//Class_Initialize Event @6-33A62596
    function clsGridhipotecas($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "hipotecas";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid hipotecas";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clshipotecasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->Visible = (CCSecurityAccessCheck("") == "success");
        $this->SorterName = CCGetParam("hipotecasOrder", "");
        $this->SorterDirection = CCGetParam("hipotecasDir", "");

        $this->idhipoteca = & new clsControl(ccsLink, "idhipoteca", "idhipoteca", ccsInteger, "", CCGetRequestParam("idhipoteca", ccsGet, NULL), $this);
        $this->idhipoteca->Page = "hipotecas_maint.php";
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->descripcion = & new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->montohipoteca = & new clsControl(ccsLabel, "montohipoteca", "montohipoteca", ccsText, "", CCGetRequestParam("montohipoteca", ccsGet, NULL), $this);
        $this->fechainicio = & new clsControl(ccsLabel, "fechainicio", "fechainicio", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechainicio", ccsGet, NULL), $this);
        $this->fechafin = & new clsControl(ccsLabel, "fechafin", "fechafin", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechafin", ccsGet, NULL), $this);
        $this->idhipotecaRO = & new clsControl(ccsLabel, "idhipotecaRO", "idhipotecaRO", ccsText, "", CCGetRequestParam("idhipotecaRO", ccsGet, NULL), $this);
        $this->simbolo = & new clsControl(ccsLabel, "simbolo", "simbolo", ccsText, "", CCGetRequestParam("simbolo", ccsGet, NULL), $this);
        $this->Sorter_idhipoteca = & new clsSorter($this->ComponentName, "Sorter_idhipoteca", $FileName, $this);
        $this->Sorter_direccion = & new clsSorter($this->ComponentName, "Sorter_direccion", $FileName, $this);
        $this->Sorter_descripcion = & new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_montohipoteca = & new clsSorter($this->ComponentName, "Sorter_montohipoteca", $FileName, $this);
        $this->Sorter_fechainicio = & new clsSorter($this->ComponentName, "Sorter_fechainicio", $FileName, $this);
        $this->Sorter_fechafin = & new clsSorter($this->ComponentName, "Sorter_fechafin", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @6-4AFCBF42
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidhipoteca"] = CCGetFromGet("idhipoteca", NULL);
        $this->DataSource->Parameters["urls_nombre"] = CCGetFromGet("s_nombre", NULL);

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
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["montohipoteca"] = $this->montohipoteca->Visible;
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["fechafin"] = $this->fechafin->Visible;
            $this->ControlsVisible["idhipotecaRO"] = $this->idhipotecaRO->Visible;
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idhipoteca->SetValue($this->DataSource->idhipoteca->GetValue());
                $this->idhipoteca->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idhipoteca->Parameters = CCAddParam($this->idhipoteca->Parameters, "idhipoteca", $this->DataSource->f("idhipoteca"));
                $this->idhipoteca->Parameters = CCAddParam($this->idhipoteca->Parameters, "idpropiedad", $this->DataSource->f("hipotecas_idpropiedad"));
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->montohipoteca->SetValue($this->DataSource->montohipoteca->GetValue());
                $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                $this->idhipotecaRO->SetValue($this->DataSource->idhipotecaRO->GetValue());
                $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idhipoteca->Show();
                $this->direccion->Show();
                $this->descripcion->Show();
                $this->montohipoteca->Show();
                $this->fechainicio->Show();
                $this->fechafin->Show();
                $this->idhipotecaRO->Show();
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
        $this->Sorter_idhipoteca->Show();
        $this->Sorter_direccion->Show();
        $this->Sorter_descripcion->Show();
        $this->Sorter_montohipoteca->Show();
        $this->Sorter_fechainicio->Show();
        $this->Sorter_fechafin->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-CC573ECC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idhipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->montohipoteca->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idhipotecaRO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End hipotecas Class @6-FCB6E20C

class clshipotecasDataSource extends clsDBConnection1 {  //hipotecasDataSource Class @6-279D5256

//DataSource Variables @6-F94DE218
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idhipoteca;
    var $direccion;
    var $descripcion;
    var $montohipoteca;
    var $fechainicio;
    var $fechafin;
    var $idhipotecaRO;
    var $simbolo;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-857BB408
    function clshipotecasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid hipotecas";
        $this->Initialize();
        $this->idhipoteca = new clsField("idhipoteca", ccsInteger, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->montohipoteca = new clsField("montohipoteca", ccsText, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, $this->DateFormat);
        
        $this->fechafin = new clsField("fechafin", ccsDate, $this->DateFormat);
        
        $this->idhipotecaRO = new clsField("idhipotecaRO", ccsText, "");
        
        $this->simbolo = new clsField("simbolo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-14283B67
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idhipoteca" => array("idhipoteca", ""), 
            "Sorter_direccion" => array("direccion", ""), 
            "Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_montohipoteca" => array("montohipoteca", ""), 
            "Sorter_fechainicio" => array("fechainicio", ""), 
            "Sorter_fechafin" => array("fechafin", "")));
    }
//End SetOrder Method

//Prepare Method @6-CEFC113B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], 0, false);
        $this->wp->AddParameter("2", "urls_nombre", ccsText, "", "", $this->Parameters["urls_nombre"], "", false);
    }
//End Prepare Method

//Open Method @6-BD9425FA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT hipotecas.idhipoteca, propiedades.direccion, estados.descripcion AS estados_descripcion, hipotecas.montohipoteca, hipotecas.fechainicio,\n" .
        "hipotecas.fechafin, hipotecas.idpropiedad AS hipotecas_idpropiedad, simbolo \n" .
        "FROM ((hipotecas LEFT JOIN propiedades ON\n" .
        "hipotecas.idpropiedad = propiedades.idpropiedad) LEFT JOIN estados ON\n" .
        "hipotecas.idestado = estados.idestado) INNER JOIN Monedas ON\n" .
        "hipotecas.idmoneda = Monedas.idmoneda\n" .
        "WHERE hipotecas.idhipoteca = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " \n" .
        "or  hipotecas.idhipoteca in(\n" .
        "							select distinct idhipoteca \n" .
        "							from hipotecas h join propiedades p on(h.idpropiedad = p.idpropiedad)\n" .
        "							join fichaspropiedades fp on(fp.idpropiedad = p.idpropiedad)\n" .
        "							join fichas f on(fp.idficha = f.idficha)\n" .
        "							where f.nombre like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' and '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "' <> ''\n" .
        "							)) cnt";
        $this->SQL = "SELECT hipotecas.idhipoteca, propiedades.direccion, estados.descripcion AS estados_descripcion, hipotecas.montohipoteca, hipotecas.fechainicio,\n" .
        "hipotecas.fechafin, hipotecas.idpropiedad AS hipotecas_idpropiedad, simbolo \n" .
        "FROM ((hipotecas LEFT JOIN propiedades ON\n" .
        "hipotecas.idpropiedad = propiedades.idpropiedad) LEFT JOIN estados ON\n" .
        "hipotecas.idestado = estados.idestado) INNER JOIN Monedas ON\n" .
        "hipotecas.idmoneda = Monedas.idmoneda\n" .
        "WHERE hipotecas.idhipoteca = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " \n" .
        "or  hipotecas.idhipoteca in(\n" .
        "							select distinct idhipoteca \n" .
        "							from hipotecas h join propiedades p on(h.idpropiedad = p.idpropiedad)\n" .
        "							join fichaspropiedades fp on(fp.idpropiedad = p.idpropiedad)\n" .
        "							join fichas f on(fp.idficha = f.idficha)\n" .
        "							where f.nombre like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' and '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "' <> ''\n" .
        "							)";
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

//SetValues Method @6-321AA8EB
    function SetValues()
    {
        $this->idhipoteca->SetDBValue(trim($this->f("idhipoteca")));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->montohipoteca->SetDBValue($this->f("montohipoteca"));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->idhipotecaRO->SetDBValue($this->f("idhipoteca"));
        $this->simbolo->SetDBValue($this->f("simbolo"));
    }
//End SetValues Method

} //End hipotecasDataSource Class @6-FCB6E20C

//Include Page implementation @36-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-28AE083C
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
$TemplateFileName = "hipotecas_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-47B4B4FB
include_once("./hipotecas_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1332546A
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$hipotecasSearch = & new clsRecordhipotecasSearch("", $MainPage);
$hipotecas = & new clsGridhipotecas("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->Header = & $Header;
$MainPage->hipotecasSearch = & $hipotecasSearch;
$MainPage->hipotecas = & $hipotecas;
$MainPage->Footer = & $Footer;
$hipotecas->Initialize();

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

//Execute Components @1-84BC5461
$Header->Operations();
$hipotecasSearch->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-6323FF23
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($hipotecasSearch);
    unset($hipotecas);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B0C24F0B
$Header->Show();
$hipotecasSearch->Show();
$hipotecas->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A7C1B248
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($hipotecasSearch);
unset($hipotecas);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
