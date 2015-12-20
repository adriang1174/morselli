<?php
//Include Common Files @1-645DD584
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
define("FileName", "alquileres_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @57-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordalquileresSearch { //alquileresSearch Class @2-16D69638

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

//Class_Initialize Event @2-FA9C23F7
    function clsRecordalquileresSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record alquileresSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "alquileresSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-A144A629
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
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

//Operation Method @2-C1406B70
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
        $Redirect = "./alquileres_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "./alquileres_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-7913FA87
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
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
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

        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End alquileresSearch Class @2-FCB6E20C

class clsGridalquileres { //alquileres class @6-234247D4

//Variables @6-3CC3D7E7

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
    var $Sorter_idalquiler;
    var $Sorter_direccion;
    var $Sorter_descripcion;
    var $Sorter_fechainicio;
    var $Sorter_fechafin;
    var $Sorter_ano1;
    var $Sorter_ano2;
    var $Sorter_ano3;
    var $Sorter_porcentajehonorarios;
    var $Sorter_vto;
    var $Sorter_acuerdo;
//End Variables

//Class_Initialize Event @6-95629AE0
    function clsGridalquileres($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "alquileres";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid alquileres";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsalquileresDataSource($this);
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
        $this->SorterName = CCGetParam("alquileresOrder", "");
        $this->SorterDirection = CCGetParam("alquileresDir", "");

        $this->idalquiler = & new clsControl(ccsLink, "idalquiler", "idalquiler", ccsInteger, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->idalquiler->Page = "./alquileres_maint.php";
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->descripcion = & new clsControl(ccsLabel, "descripcion", "descripcion", ccsText, "", CCGetRequestParam("descripcion", ccsGet, NULL), $this);
        $this->fechainicio = & new clsControl(ccsLabel, "fechainicio", "fechainicio", ccsText, "", CCGetRequestParam("fechainicio", ccsGet, NULL), $this);
        $this->fechafin = & new clsControl(ccsLabel, "fechafin", "fechafin", ccsText, "", CCGetRequestParam("fechafin", ccsGet, NULL), $this);
        $this->ano1 = & new clsControl(ccsLabel, "ano1", "ano1", ccsText, "", CCGetRequestParam("ano1", ccsGet, NULL), $this);
        $this->ano2 = & new clsControl(ccsLabel, "ano2", "ano2", ccsText, "", CCGetRequestParam("ano2", ccsGet, NULL), $this);
        $this->ano3 = & new clsControl(ccsLabel, "ano3", "ano3", ccsText, "", CCGetRequestParam("ano3", ccsGet, NULL), $this);
        $this->porcentajehonorarios = & new clsControl(ccsLabel, "porcentajehonorarios", "porcentajehonorarios", ccsText, "", CCGetRequestParam("porcentajehonorarios", ccsGet, NULL), $this);
        $this->vto = & new clsControl(ccsLabel, "vto", "vto", ccsText, "", CCGetRequestParam("vto", ccsGet, NULL), $this);
        $this->acuerdo = & new clsControl(ccsLabel, "acuerdo", "acuerdo", ccsText, "", CCGetRequestParam("acuerdo", ccsGet, NULL), $this);
        $this->Sorter_idalquiler = & new clsSorter($this->ComponentName, "Sorter_idalquiler", $FileName, $this);
        $this->Sorter_direccion = & new clsSorter($this->ComponentName, "Sorter_direccion", $FileName, $this);
        $this->Sorter_descripcion = & new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
        $this->Sorter_fechainicio = & new clsSorter($this->ComponentName, "Sorter_fechainicio", $FileName, $this);
        $this->Sorter_fechafin = & new clsSorter($this->ComponentName, "Sorter_fechafin", $FileName, $this);
        $this->Sorter_ano1 = & new clsSorter($this->ComponentName, "Sorter_ano1", $FileName, $this);
        $this->Sorter_ano2 = & new clsSorter($this->ComponentName, "Sorter_ano2", $FileName, $this);
        $this->Sorter_ano3 = & new clsSorter($this->ComponentName, "Sorter_ano3", $FileName, $this);
        $this->Sorter_porcentajehonorarios = & new clsSorter($this->ComponentName, "Sorter_porcentajehonorarios", $FileName, $this);
        $this->Sorter_vto = & new clsSorter($this->ComponentName, "Sorter_vto", $FileName, $this);
        $this->Sorter_acuerdo = & new clsSorter($this->ComponentName, "Sorter_acuerdo", $FileName, $this);
        $this->alquileres_Insert = & new clsControl(ccsLink, "alquileres_Insert", "alquileres_Insert", ccsText, "", CCGetRequestParam("alquileres_Insert", ccsGet, NULL), $this);
        $this->alquileres_Insert->Parameters = CCGetQueryString("QueryString", array("idalquiler", "ccsForm"));
        $this->alquileres_Insert->Page = "./alquileres_maint.php";
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

//Show Method @6-EF562052
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);

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
            $this->ControlsVisible["idalquiler"] = $this->idalquiler->Visible;
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["descripcion"] = $this->descripcion->Visible;
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["fechafin"] = $this->fechafin->Visible;
            $this->ControlsVisible["ano1"] = $this->ano1->Visible;
            $this->ControlsVisible["ano2"] = $this->ano2->Visible;
            $this->ControlsVisible["ano3"] = $this->ano3->Visible;
            $this->ControlsVisible["porcentajehonorarios"] = $this->porcentajehonorarios->Visible;
            $this->ControlsVisible["vto"] = $this->vto->Visible;
            $this->ControlsVisible["acuerdo"] = $this->acuerdo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                $this->idalquiler->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idalquiler->Parameters = CCAddParam($this->idalquiler->Parameters, "idalquiler", $this->DataSource->f("idalquiler"));
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                $this->ano1->SetValue($this->DataSource->ano1->GetValue());
                $this->ano2->SetValue($this->DataSource->ano2->GetValue());
                $this->ano3->SetValue($this->DataSource->ano3->GetValue());
                $this->porcentajehonorarios->SetValue($this->DataSource->porcentajehonorarios->GetValue());
                $this->vto->SetValue($this->DataSource->vto->GetValue());
                $this->acuerdo->SetValue($this->DataSource->acuerdo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idalquiler->Show();
                $this->direccion->Show();
                $this->descripcion->Show();
                $this->fechainicio->Show();
                $this->fechafin->Show();
                $this->ano1->Show();
                $this->ano2->Show();
                $this->ano3->Show();
                $this->porcentajehonorarios->Show();
                $this->vto->Show();
                $this->acuerdo->Show();
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
        $this->Sorter_idalquiler->Show();
        $this->Sorter_direccion->Show();
        $this->Sorter_descripcion->Show();
        $this->Sorter_fechainicio->Show();
        $this->Sorter_fechafin->Show();
        $this->Sorter_ano1->Show();
        $this->Sorter_ano2->Show();
        $this->Sorter_ano3->Show();
        $this->Sorter_porcentajehonorarios->Show();
        $this->Sorter_vto->Show();
        $this->Sorter_acuerdo->Show();
        $this->alquileres_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-A3A360B8
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->descripcion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->porcentajehonorarios->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->acuerdo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End alquileres Class @6-FCB6E20C

class clsalquileresDataSource extends clsDBConnection1 {  //alquileresDataSource Class @6-0F6C066C

//DataSource Variables @6-14AAB31F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idalquiler;
    var $direccion;
    var $descripcion;
    var $fechainicio;
    var $fechafin;
    var $ano1;
    var $ano2;
    var $ano3;
    var $porcentajehonorarios;
    var $vto;
    var $acuerdo;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-9AA254EF
    function clsalquileresDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid alquileres";
        $this->Initialize();
        $this->idalquiler = new clsField("idalquiler", ccsInteger, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->descripcion = new clsField("descripcion", ccsText, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsText, "");
        
        $this->fechafin = new clsField("fechafin", ccsText, "");
        
        $this->ano1 = new clsField("ano1", ccsText, "");
        
        $this->ano2 = new clsField("ano2", ccsText, "");
        
        $this->ano3 = new clsField("ano3", ccsText, "");
        
        $this->porcentajehonorarios = new clsField("porcentajehonorarios", ccsText, "");
        
        $this->vto = new clsField("vto", ccsText, "");
        
        $this->acuerdo = new clsField("acuerdo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-CB366BAD
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idalquiler" => array("idalquiler", ""), 
            "Sorter_direccion" => array("direccion", ""), 
            "Sorter_descripcion" => array("descripcion", ""), 
            "Sorter_fechainicio" => array("fechainicio", ""), 
            "Sorter_fechafin" => array("fechafin", ""), 
            "Sorter_ano1" => array("ano1", ""), 
            "Sorter_ano2" => array("ano2", ""), 
            "Sorter_ano3" => array("ano3", ""), 
            "Sorter_porcentajehonorarios" => array("porcentajehonorarios", ""), 
            "Sorter_vto" => array("vto", ""), 
            "Sorter_acuerdo" => array("acuerdo", "")));
    }
//End SetOrder Method

//Prepare Method @6-29CD9D7F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("3", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("4", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("5", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("6", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("7", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("8", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "alquileres.fechainicio", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "alquileres.fechafin", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "alquileres.ano1", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "alquileres.ano2", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "alquileres.ano3", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "alquileres.porcentajehonorarios", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opContains, "alquileres.vto", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opContains, "alquileres.acuerdo", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
        $this->Where = $this->wp->opOR(
             true, $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]), 
             $this->wp->Criterion[8]);
    }
//End Prepare Method

//Open Method @6-8DDB7A67
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (alquileres LEFT JOIN propiedades ON\n\n" .
        "alquileres.idpropiedad = propiedades.idpropiedad) LEFT JOIN estados ON\n\n" .
        "alquileres.idestado = estados.idestado";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} alquileres.idalquiler, propiedades.direccion, estados.descripcion, alquileres.fechainicio, alquileres.fechafin, alquileres.ano1,\n\n" .
        "alquileres.ano2, alquileres.ano3, alquileres.porcentajehonorarios, alquileres.vto, alquileres.acuerdo \n\n" .
        "FROM (alquileres LEFT JOIN propiedades ON\n\n" .
        "alquileres.idpropiedad = propiedades.idpropiedad) LEFT JOIN estados ON\n\n" .
        "alquileres.idestado = estados.idestado {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @6-5A5DAF29
    function SetValues()
    {
        $this->idalquiler->SetDBValue(trim($this->f("idalquiler")));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->fechainicio->SetDBValue($this->f("fechainicio"));
        $this->fechafin->SetDBValue($this->f("fechafin"));
        $this->ano1->SetDBValue($this->f("ano1"));
        $this->ano2->SetDBValue($this->f("ano2"));
        $this->ano3->SetDBValue($this->f("ano3"));
        $this->porcentajehonorarios->SetDBValue($this->f("porcentajehonorarios"));
        $this->vto->SetDBValue($this->f("vto"));
        $this->acuerdo->SetDBValue($this->f("acuerdo"));
    }
//End SetValues Method

} //End alquileresDataSource Class @6-FCB6E20C

//Include Page implementation @58-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-9C4795B9
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
$TemplateFileName = "alquileres_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C497DBD6
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$alquileresSearch = & new clsRecordalquileresSearch("", $MainPage);
$alquileres = & new clsGridalquileres("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->Header = & $Header;
$MainPage->alquileresSearch = & $alquileresSearch;
$MainPage->alquileres = & $alquileres;
$MainPage->Footer = & $Footer;
$alquileres->Initialize();

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

//Execute Components @1-CE1C5D4E
$Header->Operations();
$alquileresSearch->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-263C3951
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($alquileresSearch);
    unset($alquileres);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-597247F1
$Header->Show();
$alquileresSearch->Show();
$alquileres->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D2556392
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($alquileresSearch);
unset($alquileres);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
