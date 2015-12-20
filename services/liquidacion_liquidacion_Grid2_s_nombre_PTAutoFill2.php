<?php
//Include Common Files @1-06547A98
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "liquidacion_liquidacion_Grid2_s_nombre_PTAutoFill2.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridfichas { //fichas class @2-0FEEC35D

//Variables @2-AC1EDBB9

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

//Class_Initialize Event @2-D0B0C7B3
    function clsGridfichas($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "fichas";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid fichas";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsfichasDataSource($this);
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

        $this->idficha = & new clsControl(ccsLabel, "idficha", "idficha", ccsInteger, "", CCGetRequestParam("idficha", ccsGet, NULL), $this);
        $this->idtipocontribuyente = & new clsControl(ccsLabel, "idtipocontribuyente", "idtipocontribuyente", ccsInteger, "", CCGetRequestParam("idtipocontribuyente", ccsGet, NULL), $this);
        $this->idtipodocumento = & new clsControl(ccsLabel, "idtipodocumento", "idtipodocumento", ccsInteger, "", CCGetRequestParam("idtipodocumento", ccsGet, NULL), $this);
        $this->idestadocivil = & new clsControl(ccsLabel, "idestadocivil", "idestadocivil", ccsInteger, "", CCGetRequestParam("idestadocivil", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->direccion = & new clsControl(ccsLabel, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", ccsGet, NULL), $this);
        $this->localidad = & new clsControl(ccsLabel, "localidad", "localidad", ccsText, "", CCGetRequestParam("localidad", ccsGet, NULL), $this);
        $this->codigopostal = & new clsControl(ccsLabel, "codigopostal", "codigopostal", ccsText, "", CCGetRequestParam("codigopostal", ccsGet, NULL), $this);
        $this->telefono = & new clsControl(ccsLabel, "telefono", "telefono", ccsText, "", CCGetRequestParam("telefono", ccsGet, NULL), $this);
        $this->celular = & new clsControl(ccsLabel, "celular", "celular", ccsText, "", CCGetRequestParam("celular", ccsGet, NULL), $this);
        $this->fechanac = & new clsControl(ccsLabel, "fechanac", "fechanac", ccsDate, $DefaultDateFormat, CCGetRequestParam("fechanac", ccsGet, NULL), $this);
        $this->provincia = & new clsControl(ccsLabel, "provincia", "provincia", ccsText, "", CCGetRequestParam("provincia", ccsGet, NULL), $this);
        $this->email = & new clsControl(ccsLabel, "email", "email", ccsText, "", CCGetRequestParam("email", ccsGet, NULL), $this);
        $this->actividad = & new clsControl(ccsLabel, "actividad", "actividad", ccsText, "", CCGetRequestParam("actividad", ccsGet, NULL), $this);
        $this->observaciones = & new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
        $this->cuit = & new clsControl(ccsLabel, "cuit", "cuit", ccsText, "", CCGetRequestParam("cuit", ccsGet, NULL), $this);
        $this->nrodocumento = & new clsControl(ccsLabel, "nrodocumento", "nrodocumento", ccsText, "", CCGetRequestParam("nrodocumento", ccsGet, NULL), $this);
        $this->nacionalidad = & new clsControl(ccsLabel, "nacionalidad", "nacionalidad", ccsText, "", CCGetRequestParam("nacionalidad", ccsGet, NULL), $this);
        $this->nupcias = & new clsControl(ccsLabel, "nupcias", "nupcias", ccsText, "", CCGetRequestParam("nupcias", ccsGet, NULL), $this);
        $this->conyuge = & new clsControl(ccsLabel, "conyuge", "conyuge", ccsText, "", CCGetRequestParam("conyuge", ccsGet, NULL), $this);
        $this->padre = & new clsControl(ccsLabel, "padre", "padre", ccsText, "", CCGetRequestParam("padre", ccsGet, NULL), $this);
        $this->madre = & new clsControl(ccsLabel, "madre", "madre", ccsText, "", CCGetRequestParam("madre", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-60E9DEE7
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlkeyword"] = CCGetFromGet("keyword", NULL);

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
            $this->ControlsVisible["idficha"] = $this->idficha->Visible;
            $this->ControlsVisible["idtipocontribuyente"] = $this->idtipocontribuyente->Visible;
            $this->ControlsVisible["idtipodocumento"] = $this->idtipodocumento->Visible;
            $this->ControlsVisible["idestadocivil"] = $this->idestadocivil->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["direccion"] = $this->direccion->Visible;
            $this->ControlsVisible["localidad"] = $this->localidad->Visible;
            $this->ControlsVisible["codigopostal"] = $this->codigopostal->Visible;
            $this->ControlsVisible["telefono"] = $this->telefono->Visible;
            $this->ControlsVisible["celular"] = $this->celular->Visible;
            $this->ControlsVisible["fechanac"] = $this->fechanac->Visible;
            $this->ControlsVisible["provincia"] = $this->provincia->Visible;
            $this->ControlsVisible["email"] = $this->email->Visible;
            $this->ControlsVisible["actividad"] = $this->actividad->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            $this->ControlsVisible["cuit"] = $this->cuit->Visible;
            $this->ControlsVisible["nrodocumento"] = $this->nrodocumento->Visible;
            $this->ControlsVisible["nacionalidad"] = $this->nacionalidad->Visible;
            $this->ControlsVisible["nupcias"] = $this->nupcias->Visible;
            $this->ControlsVisible["conyuge"] = $this->conyuge->Visible;
            $this->ControlsVisible["padre"] = $this->padre->Visible;
            $this->ControlsVisible["madre"] = $this->madre->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                $this->idtipocontribuyente->SetValue($this->DataSource->idtipocontribuyente->GetValue());
                $this->idtipodocumento->SetValue($this->DataSource->idtipodocumento->GetValue());
                $this->idestadocivil->SetValue($this->DataSource->idestadocivil->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                $this->localidad->SetValue($this->DataSource->localidad->GetValue());
                $this->codigopostal->SetValue($this->DataSource->codigopostal->GetValue());
                $this->telefono->SetValue($this->DataSource->telefono->GetValue());
                $this->celular->SetValue($this->DataSource->celular->GetValue());
                $this->fechanac->SetValue($this->DataSource->fechanac->GetValue());
                $this->provincia->SetValue($this->DataSource->provincia->GetValue());
                $this->email->SetValue($this->DataSource->email->GetValue());
                $this->actividad->SetValue($this->DataSource->actividad->GetValue());
                $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                $this->cuit->SetValue($this->DataSource->cuit->GetValue());
                $this->nrodocumento->SetValue($this->DataSource->nrodocumento->GetValue());
                $this->nacionalidad->SetValue($this->DataSource->nacionalidad->GetValue());
                $this->nupcias->SetValue($this->DataSource->nupcias->GetValue());
                $this->conyuge->SetValue($this->DataSource->conyuge->GetValue());
                $this->padre->SetValue($this->DataSource->padre->GetValue());
                $this->madre->SetValue($this->DataSource->madre->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idficha->Show();
                $this->idtipocontribuyente->Show();
                $this->idtipodocumento->Show();
                $this->idestadocivil->Show();
                $this->nombre->Show();
                $this->direccion->Show();
                $this->localidad->Show();
                $this->codigopostal->Show();
                $this->telefono->Show();
                $this->celular->Show();
                $this->fechanac->Show();
                $this->provincia->Show();
                $this->email->Show();
                $this->actividad->Show();
                $this->observaciones->Show();
                $this->cuit->Show();
                $this->nrodocumento->Show();
                $this->nacionalidad->Show();
                $this->nupcias->Show();
                $this->conyuge->Show();
                $this->padre->Show();
                $this->madre->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
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

//GetErrors Method @2-ECAE0043
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idtipocontribuyente->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idtipodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idestadocivil->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->localidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->codigopostal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->telefono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->celular->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechanac->Errors->ToString());
        $errors = ComposeStrings($errors, $this->provincia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->actividad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cuit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nrodocumento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nacionalidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nupcias->Errors->ToString());
        $errors = ComposeStrings($errors, $this->conyuge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->padre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->madre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End fichas Class @2-FCB6E20C

class clsfichasDataSource extends clsDBConnection1 {  //fichasDataSource Class @2-05DD9D51

//DataSource Variables @2-0EB79B67
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idficha;
    var $idtipocontribuyente;
    var $idtipodocumento;
    var $idestadocivil;
    var $nombre;
    var $direccion;
    var $localidad;
    var $codigopostal;
    var $telefono;
    var $celular;
    var $fechanac;
    var $provincia;
    var $email;
    var $actividad;
    var $observaciones;
    var $cuit;
    var $nrodocumento;
    var $nacionalidad;
    var $nupcias;
    var $conyuge;
    var $padre;
    var $madre;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FC87D8F9
    function clsfichasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid fichas";
        $this->Initialize();
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->idtipocontribuyente = new clsField("idtipocontribuyente", ccsInteger, "");
        
        $this->idtipodocumento = new clsField("idtipodocumento", ccsInteger, "");
        
        $this->idestadocivil = new clsField("idestadocivil", ccsInteger, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->localidad = new clsField("localidad", ccsText, "");
        
        $this->codigopostal = new clsField("codigopostal", ccsText, "");
        
        $this->telefono = new clsField("telefono", ccsText, "");
        
        $this->celular = new clsField("celular", ccsText, "");
        
        $this->fechanac = new clsField("fechanac", ccsDate, $this->DateFormat);
        
        $this->provincia = new clsField("provincia", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->actividad = new clsField("actividad", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        
        $this->cuit = new clsField("cuit", ccsText, "");
        
        $this->nrodocumento = new clsField("nrodocumento", ccsText, "");
        
        $this->nacionalidad = new clsField("nacionalidad", ccsText, "");
        
        $this->nupcias = new clsField("nupcias", ccsText, "");
        
        $this->conyuge = new clsField("conyuge", ccsText, "");
        
        $this->padre = new clsField("padre", ccsText, "");
        
        $this->madre = new clsField("madre", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-3BCFEC42
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsText, "", "", $this->Parameters["urlkeyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "nombre", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-3B1C8A03
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichas";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM fichas {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-6515A236
    function SetValues()
    {
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->idtipocontribuyente->SetDBValue(trim($this->f("idtipocontribuyente")));
        $this->idtipodocumento->SetDBValue(trim($this->f("idtipodocumento")));
        $this->idestadocivil->SetDBValue(trim($this->f("idestadocivil")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->localidad->SetDBValue($this->f("localidad"));
        $this->codigopostal->SetDBValue($this->f("codigopostal"));
        $this->telefono->SetDBValue($this->f("telefono"));
        $this->celular->SetDBValue($this->f("celular"));
        $this->fechanac->SetDBValue(trim($this->f("fechanac")));
        $this->provincia->SetDBValue($this->f("provincia"));
        $this->email->SetDBValue($this->f("email"));
        $this->actividad->SetDBValue($this->f("actividad"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
        $this->cuit->SetDBValue($this->f("cuit"));
        $this->nrodocumento->SetDBValue($this->f("nrodocumento"));
        $this->nacionalidad->SetDBValue($this->f("nacionalidad"));
        $this->nupcias->SetDBValue($this->f("nupcias"));
        $this->conyuge->SetDBValue($this->f("conyuge"));
        $this->padre->SetDBValue($this->f("padre"));
        $this->madre->SetDBValue($this->f("madre"));
    }
//End SetValues Method

} //End fichasDataSource Class @2-FCB6E20C

//Initialize Page @1-A70E95B7
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
$TemplateFileName = "liquidacion_liquidacion_Grid2_s_nombre_PTAutoFill2.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B2D468E0
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$fichas = & new clsGridfichas("", $MainPage);
$MainPage->fichas = & $fichas;
$fichas->Initialize();

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

//Go to destination page @1-6C2FD881
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($fichas);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1D38102F
$fichas->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AFE563A6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($fichas);
unset($Tpl);
//End Unload Page


?>
