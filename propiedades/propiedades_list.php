<?php
//Include Common Files @1-ABF404AC
define("RelativePath", "..");
define("PathToCurrentPage", "/propiedades/");
define("FileName", "propiedades_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @52-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsRecordpropiedadesSearch { //propiedadesSearch Class @2-4F50A3E6

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

//Class_Initialize Event @2-4F36F2B6
    function clsRecordpropiedadesSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record propiedadesSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "propiedadesSearch";
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

//Operation Method @2-8547786C
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
        $Redirect = "./propiedades_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "./propiedades_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End propiedadesSearch Class @2-FCB6E20C

//Include Page implementation @53-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

class clsGridpropiedades { //propiedades class @6-9DCFE072

//Variables @6-53E9097C

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
    var $Sorter_idpropiedad;
    var $Sorter_destipopropiedad;
    var $Sorter_direccion;
    var $Sorter_localidad;
    var $Sorter_telefono;
    var $Sorter_codigopostal;
    var $Sorter_estado;
    var $Sorter_entre;
    var $Sorter_administ;
//End Variables

//Class_Initialize Event @6-FDA318A2
    function clsGridpropiedades($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "propiedades";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid propiedades";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspropiedadesDataSource($this);
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
        $this->SorterName = CCGetParam("propiedadesOrder", "");
        $this->SorterDirection = CCGetParam("propiedadesDir", "");

        $this->idpropiedad = & new clsControl(ccsLink, "idpropiedad", "idpropiedad", ccsInteger, "", CCGetRequestParam("idpropiedad", ccsGet, NULL), $this);
        $this->idpropiedad->Page = "propiedades_maint.php";
        $this->destipopropiedad = & new clsControl(ccsLabel, "destipopropiedad", "destipopropiedad", ccsText, "", CCGetRequestParam("destipopropiedad", ccsGet, NULL), $this);
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->localidad = & new clsControl(ccsLabel, "localidad", "localidad", ccsText, "", CCGetRequestParam("localidad", ccsGet, NULL), $this);
        $this->telefono = & new clsControl(ccsLabel, "telefono", "telefono", ccsText, "", CCGetRequestParam("telefono", ccsGet, NULL), $this);
        $this->codigopostal = & new clsControl(ccsLabel, "codigopostal", "codigopostal", ccsText, "", CCGetRequestParam("codigopostal", ccsGet, NULL), $this);
        $this->estado = & new clsControl(ccsLabel, "estado", "estado", ccsText, "", CCGetRequestParam("estado", ccsGet, NULL), $this);
        $this->entre = & new clsControl(ccsLabel, "entre", "entre", ccsText, "", CCGetRequestParam("entre", ccsGet, NULL), $this);
        $this->administ = & new clsControl(ccsLabel, "administ", "administ", ccsText, "", CCGetRequestParam("administ", ccsGet, NULL), $this);
        $this->Sorter_idpropiedad = & new clsSorter($this->ComponentName, "Sorter_idpropiedad", $FileName, $this);
        $this->Sorter_destipopropiedad = & new clsSorter($this->ComponentName, "Sorter_destipopropiedad", $FileName, $this);
        $this->Sorter_direccion = & new clsSorter($this->ComponentName, "Sorter_direccion", $FileName, $this);
        $this->Sorter_localidad = & new clsSorter($this->ComponentName, "Sorter_localidad", $FileName, $this);
        $this->Sorter_telefono = & new clsSorter($this->ComponentName, "Sorter_telefono", $FileName, $this);
        $this->Sorter_codigopostal = & new clsSorter($this->ComponentName, "Sorter_codigopostal", $FileName, $this);
        $this->Sorter_estado = & new clsSorter($this->ComponentName, "Sorter_estado", $FileName, $this);
        $this->Sorter_entre = & new clsSorter($this->ComponentName, "Sorter_entre", $FileName, $this);
        $this->Sorter_administ = & new clsSorter($this->ComponentName, "Sorter_administ", $FileName, $this);
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

//Show Method @6-F2D1C00F
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
            $this->ControlsVisible["idpropiedad"] = $this->idpropiedad->Visible;
            $this->ControlsVisible["destipopropiedad"] = $this->destipopropiedad->Visible;
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["localidad"] = $this->localidad->Visible;
            $this->ControlsVisible["telefono"] = $this->telefono->Visible;
            $this->ControlsVisible["codigopostal"] = $this->codigopostal->Visible;
            $this->ControlsVisible["estado"] = $this->estado->Visible;
            $this->ControlsVisible["entre"] = $this->entre->Visible;
            $this->ControlsVisible["administ"] = $this->administ->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idpropiedad->SetValue($this->DataSource->idpropiedad->GetValue());
                $this->idpropiedad->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->idpropiedad->Parameters = CCAddParam($this->idpropiedad->Parameters, "idpropiedad", $this->DataSource->f("idpropiedad"));
                $this->destipopropiedad->SetValue($this->DataSource->destipopropiedad->GetValue());
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->localidad->SetValue($this->DataSource->localidad->GetValue());
                $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                $this->codigopostal->SetValue($this->DataSource->codigopostal->GetValue());
                $this->estado->SetValue($this->DataSource->estado->GetValue());
                $this->entre->SetValue($this->DataSource->entre->GetValue());
                $this->administ->SetValue($this->DataSource->administ->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idpropiedad->Show();
                $this->destipopropiedad->Show();
                $this->direccion->Show();
                $this->localidad->Show();
                $this->telefono->Show();
                $this->codigopostal->Show();
                $this->estado->Show();
                $this->entre->Show();
                $this->administ->Show();
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
        $this->Sorter_idpropiedad->Show();
        $this->Sorter_destipopropiedad->Show();
        $this->Sorter_direccion->Show();
        $this->Sorter_localidad->Show();
        $this->Sorter_telefono->Show();
        $this->Sorter_codigopostal->Show();
        $this->Sorter_estado->Show();
        $this->Sorter_entre->Show();
        $this->Sorter_administ->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-8608077A
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idpropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->destipopropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->localidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->telefono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->codigopostal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->entre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->administ->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End propiedades Class @6-FCB6E20C

class clspropiedadesDataSource extends clsDBConnection1 {  //propiedadesDataSource Class @6-0FC356A5

//DataSource Variables @6-009BA584
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idpropiedad;
    var $destipopropiedad;
    var $direccion;
    var $localidad;
    var $telefono;
    var $codigopostal;
    var $estado;
    var $entre;
    var $administ;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-FE3CAD00
    function clspropiedadesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid propiedades";
        $this->Initialize();
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        
        $this->destipopropiedad = new clsField("destipopropiedad", ccsText, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->localidad = new clsField("localidad", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->codigopostal = new clsField("codigopostal", ccsText, "");
        
        $this->estado = new clsField("estado", ccsText, "");
        
        $this->entre = new clsField("entre", ccsText, "");
        
        $this->administ = new clsField("administ", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-45B8F664
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_idpropiedad" => array("idpropiedad", ""), 
            "Sorter_destipopropiedad" => array("destipopropiedad", ""), 
            "Sorter_direccion" => array("direccion", ""), 
            "Sorter_localidad" => array("localidad", ""), 
            "Sorter_telefono" => array("telefono", ""), 
            "Sorter_codigopostal" => array("codigopostal", ""), 
            "Sorter_estado" => array("estado", ""), 
            "Sorter_entre" => array("entre", ""), 
            "Sorter_administ" => array("administ", "")));
    }
//End SetOrder Method

//Prepare Method @6-7A2899F7
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
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "propiedades.direccion", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "propiedades.localidad", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "propiedades.telefono", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "propiedades.codigopostal", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "propiedades.entre", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "propiedades.administ", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opContains, "tipopropiedades.destipopropiedad", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opContains, "propiedades.cantocup", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
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

//Open Method @6-522CD387
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM propiedades LEFT JOIN tipopropiedades ON\n\n" .
        "propiedades.idtipopropiedad = tipopropiedades.idtipopropiedad";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} propiedades.idpropiedad, tipopropiedades.destipopropiedad, propiedades.direccion, propiedades.localidad, propiedades.telefono,\n\n" .
        "propiedades.codigopostal, propiedades.estado, propiedades.entre, propiedades.administ \n\n" .
        "FROM propiedades LEFT JOIN tipopropiedades ON\n\n" .
        "propiedades.idtipopropiedad = tipopropiedades.idtipopropiedad {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @6-BAF6EF89
    function SetValues()
    {
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
        $this->destipopropiedad->SetDBValue($this->f("destipopropiedad"));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->localidad->SetDBValue($this->f("localidad"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->codigopostal->SetDBValue($this->f("codigopostal"));
        $this->estado->SetDBValue($this->f("estado"));
        $this->entre->SetDBValue($this->f("entre"));
        $this->administ->SetDBValue($this->f("administ"));
    }
//End SetValues Method

} //End propiedadesDataSource Class @6-FCB6E20C

//Initialize Page @1-5D66AAFE
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
$TemplateFileName = "propiedades_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-DC94A87D
CCSecurityRedirect("1", "");
//End Authenticate User

//Include events file @1-4D310CE3
include_once("./propiedades_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-67797EBA
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$propiedadesSearch = & new clsRecordpropiedadesSearch("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$propiedades = & new clsGridpropiedades("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->propiedadesSearch = & $propiedadesSearch;
$MainPage->Footer = & $Footer;
$MainPage->propiedades = & $propiedades;
$propiedades->Initialize();

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

//Execute Components @1-8874D7C8
$Header->Operations();
$propiedadesSearch->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-2D9D696D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($propiedadesSearch);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($propiedades);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-902FAE9F
$Header->Show();
$propiedadesSearch->Show();
$Footer->Show();
$propiedades->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D9A58D30
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
$Header->Class_Terminate();
unset($Header);
unset($propiedadesSearch);
$Footer->Class_Terminate();
unset($Footer);
unset($propiedades);
unset($Tpl);
//End Unload Page


?>
