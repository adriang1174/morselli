<?php
//Include Common Files @1-1F1E21B4
define("RelativePath", "..");
define("PathToCurrentPage", "/liquidacionh/");
define("FileName", "liquidacion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid1 { //Grid1 class @2-E857A572

//Variables @2-F65B1330

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
    var $Sorter_mes;
    var $Sorter_ano;
    var $Sorter_fechavencimiento;
    var $Sorter_importe;
    var $Sorter_fechaaviso;
    var $Sorter_descripcion;
//End Variables

//Class_Initialize Event @2-80BA5F09
    function clsGridGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGrid1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("Grid1Order", "");
        $this->SorterDirection = CCGetParam("Grid1Dir", "");

        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsInteger, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->ano = & new clsControl(ccsLabel, "ano", "ano", ccsInteger, "", CCGetRequestParam("ano", ccsGet, NULL), $this);
        $this->fechavencimiento = & new clsControl(ccsLabel, "fechavencimiento", "fechavencimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechavencimiento", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsLabel, "importe", "importe", ccsFloat, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->liquida = & new clsControl(ccsCheckBox, "liquida", "liquida", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("liquida", ccsGet, NULL), $this);
        $this->liquida->CheckedValue = true;
        $this->liquida->UncheckedValue = false;
        $this->idcuota = & new clsControl(ccsHidden, "idcuota", "idcuota", ccsInteger, "", CCGetRequestParam("idcuota", ccsGet, NULL), $this);
        $this->tipocuota = & new clsControl(ccsLabel, "tipocuota", "tipocuota", ccsText, "", CCGetRequestParam("tipocuota", ccsGet, NULL), $this);
        $this->simbolo = & new clsControl(ccsLabel, "simbolo", "simbolo", ccsText, "", CCGetRequestParam("simbolo", ccsGet, NULL), $this);
        $this->punitorios = & new clsControl(ccsLabel, "punitorios", "punitorios", ccsFloat, "", CCGetRequestParam("punitorios", ccsGet, NULL), $this);
        $this->simbolop = & new clsControl(ccsLabel, "simbolop", "simbolop", ccsText, "", CCGetRequestParam("simbolop", ccsGet, NULL), $this);
        $this->idalquiler = & new clsControl(ccsHidden, "idalquiler", "idalquiler", ccsText, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->idficha = & new clsControl(ccsHidden, "idficha", "idficha", ccsInteger, "", CCGetRequestParam("idficha", ccsGet, NULL), $this);
        $this->Sorter_mes = & new clsSorter($this->ComponentName, "Sorter_mes", $FileName, $this);
        $this->Sorter_ano = & new clsSorter($this->ComponentName, "Sorter_ano", $FileName, $this);
        $this->Sorter_fechavencimiento = & new clsSorter($this->ComponentName, "Sorter_fechavencimiento", $FileName, $this);
        $this->Sorter_importe = & new clsSorter($this->ComponentName, "Sorter_importe", $FileName, $this);
        $this->Sorter_fechaaviso = & new clsSorter($this->ComponentName, "Sorter_fechaaviso", $FileName, $this);
        $this->Button1 = & new clsButton("Button1", ccsGet, $this);
        $this->idhipoteca = & new clsControl(ccsHidden, "idhipoteca", "idhipoteca", ccsText, "", CCGetRequestParam("idhipoteca", ccsGet, NULL), $this);
        $this->Link2 = & new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Parameters = CCGetQueryString("QueryString", array("idcuota", "ccsForm"));
        $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "idhipoteca", CCGetFromGet("idhipoteca", NULL));
        $this->Link2->Page = "cuota_maint.php";
        $this->Sorter_descripcion = & new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
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

//Show Method @2-9C098AAA
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
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["fechavencimiento"] = $this->fechavencimiento->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["liquida"] = $this->liquida->Visible;
            $this->ControlsVisible["idcuota"] = $this->idcuota->Visible;
            $this->ControlsVisible["tipocuota"] = $this->tipocuota->Visible;
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            $this->ControlsVisible["punitorios"] = $this->punitorios->Visible;
            $this->ControlsVisible["simbolop"] = $this->simbolop->Visible;
            $this->ControlsVisible["idalquiler"] = $this->idalquiler->Visible;
            $this->ControlsVisible["idficha"] = $this->idficha->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->ano->SetValue($this->DataSource->ano->GetValue());
                $this->fechavencimiento->SetValue($this->DataSource->fechavencimiento->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->idcuota->SetValue($this->DataSource->idcuota->GetValue());
                $this->tipocuota->SetValue($this->DataSource->tipocuota->GetValue());
                $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
                $this->punitorios->SetValue($this->DataSource->punitorios->GetValue());
                $this->simbolop->SetValue($this->DataSource->simbolop->GetValue());
                $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mes->Show();
                $this->ano->Show();
                $this->fechavencimiento->Show();
                $this->importe->Show();
                $this->nombre->Show();
                $this->liquida->Show();
                $this->idcuota->Show();
                $this->tipocuota->Show();
                $this->simbolo->Show();
                $this->punitorios->Show();
                $this->simbolop->Show();
                $this->idalquiler->Show();
                $this->idficha->Show();
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
        $this->Sorter_mes->Show();
        $this->Sorter_ano->Show();
        $this->Sorter_fechavencimiento->Show();
        $this->Sorter_importe->Show();
        $this->Sorter_fechaaviso->Show();
        $this->Button1->Show();
        $this->idhipoteca->Show();
        $this->Link2->Show();
        $this->Sorter_descripcion->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E0ED75C1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechavencimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->liquida->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipocuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->punitorios->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolop->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid1 Class @2-FCB6E20C

class clsGrid1DataSource extends clsDBConnection1 {  //Grid1DataSource Class @2-A1EC48BA

//DataSource Variables @2-5A1835E9
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $mes;
    var $ano;
    var $fechavencimiento;
    var $importe;
    var $nombre;
    var $idcuota;
    var $tipocuota;
    var $simbolo;
    var $punitorios;
    var $simbolop;
    var $idalquiler;
    var $idficha;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4E78FBBC
    function clsGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid1";
        $this->Initialize();
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->ano = new clsField("ano", ccsInteger, "");
        
        $this->fechavencimiento = new clsField("fechavencimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->idcuota = new clsField("idcuota", ccsInteger, "");
        
        $this->tipocuota = new clsField("tipocuota", ccsText, "");
        
        $this->simbolo = new clsField("simbolo", ccsText, "");
        
        $this->punitorios = new clsField("punitorios", ccsFloat, "");
        
        $this->simbolop = new clsField("simbolop", ccsText, "");
        
        $this->idalquiler = new clsField("idalquiler", ccsText, "");
        
        $this->idficha = new clsField("idficha", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-CF6E9B58
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "c.ano,c.mes,f.nombre";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mes" => array("mes", ""), 
            "Sorter_ano" => array("ano", ""), 
            "Sorter_fechavencimiento" => array("fechavencimiento", ""), 
            "Sorter_importe" => array("importe", ""), 
            "Sorter_fechaaviso" => array("fechaaviso", ""), 
            "Sorter_descripcion" => array("descripcion", "")));
    }
//End SetOrder Method

//Prepare Method @2-F6A66F26
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], 0, false);
    }
//End Prepare Method

//Open Method @2-7992169E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select c.idalquiler,f.idficha,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo,sum(c.importe) as importe,sum(c2.importe) as punitorios\n" .
        "from cuotas c\n" .
        "left join cuotas c2 on(c.ano=c2.ano and c.mes=c2.mes and c.idalquiler = c2.idalquiler and c2.idtipocuota = 9)\n" .
        "join hipotecas h on c.idhipoteca = h.idhipoteca\n" .
        "join tipocuota t on t.idtipocuota = c.idtipocuota\n" .
        "join monedas m on h.idmoneda = m.idmoneda\n" .
        "join fichas f on c.idalquiler = f.idficha\n" .
        "where\n" .
        "c.idhipoteca = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "--and fechavencimiento < getdate()\n" .
        "and c.fechapago is not null\n" .
        "and c.fechaliquidacion is null\n" .
        "and c.idtipocuota = 4\n" .
        "and h.idestado in(1,6,7) \n" .
        "group by c.idalquiler,f.idficha,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo) cnt";
        $this->SQL = "select TOP {SqlParam_endRecord} c.idalquiler,f.idficha,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo,sum(c.importe) as importe,sum(c2.importe) as punitorios\n" .
        "from cuotas c\n" .
        "left join cuotas c2 on(c.ano=c2.ano and c.mes=c2.mes and c.idalquiler = c2.idalquiler and c2.idtipocuota = 9)\n" .
        "join hipotecas h on c.idhipoteca = h.idhipoteca\n" .
        "join tipocuota t on t.idtipocuota = c.idtipocuota\n" .
        "join monedas m on h.idmoneda = m.idmoneda\n" .
        "join fichas f on c.idalquiler = f.idficha\n" .
        "where\n" .
        "c.idhipoteca = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "--and fechavencimiento < getdate()\n" .
        "and c.fechapago is not null\n" .
        "and c.fechaliquidacion is null\n" .
        "and c.idtipocuota = 4\n" .
        "and h.idestado in(1,6,7) \n" .
        "group by c.idalquiler,f.idficha,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo {SQL_OrderBy}";
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

//SetValues Method @2-14A3AC9B
    function SetValues()
    {
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->ano->SetDBValue(trim($this->f("ano")));
        $this->fechavencimiento->SetDBValue(trim($this->f("fechavencimiento")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->idcuota->SetDBValue(trim($this->f("idcuota")));
        $this->tipocuota->SetDBValue($this->f("descripcion"));
        $this->simbolo->SetDBValue($this->f("simbolo"));
        $this->punitorios->SetDBValue(trim($this->f("punitorios")));
        $this->simbolop->SetDBValue($this->f("simbolo"));
        $this->idalquiler->SetDBValue($this->f("idalquiler"));
        $this->idficha->SetDBValue(trim($this->f("idficha")));
    }
//End SetValues Method

} //End Grid1DataSource Class @2-FCB6E20C

class clsRecordGrid2 { //Grid2 Class @15-542C3E47

//Variables @15-D6FF3E86

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

//Class_Initialize Event @15-4BED6BAB
    function clsRecordGrid2($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Grid2/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Grid2";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->idhipoteca = & new clsControl(ccsTextBox, "idhipoteca", "idhipoteca", ccsText, "", CCGetRequestParam("idhipoteca", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @15-2A5497B8
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

//CheckErrors Method @15-BD23F23B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->idhipoteca->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @15-ED598703
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

//Operation Method @15-9B5435E9
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
        $Redirect = "liquidacion.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "liquidacion.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @15-A8A6C0D7
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

} //End Grid2 Class @15-FCB6E20C

//Include Page implementation @25-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsGridGrid3 { //Grid3 class @69-DA61C7F0

//Variables @69-F65B1330

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
    var $Sorter_mes;
    var $Sorter_ano;
    var $Sorter_fechavencimiento;
    var $Sorter_importe;
    var $Sorter_fechaaviso;
    var $Sorter_descripcion;
//End Variables

//Class_Initialize Event @69-F41151D8
    function clsGridGrid3($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid3";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid3";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGrid3DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("Grid3Order", "");
        $this->SorterDirection = CCGetParam("Grid3Dir", "");

        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsInteger, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->ano = & new clsControl(ccsLabel, "ano", "ano", ccsInteger, "", CCGetRequestParam("ano", ccsGet, NULL), $this);
        $this->fechavencimiento = & new clsControl(ccsLabel, "fechavencimiento", "fechavencimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechavencimiento", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsLabel, "importe", "importe", ccsFloat, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->tipocuota = & new clsControl(ccsLabel, "tipocuota", "tipocuota", ccsText, "", CCGetRequestParam("tipocuota", ccsGet, NULL), $this);
        $this->simbolo = & new clsControl(ccsLabel, "simbolo", "simbolo", ccsText, "", CCGetRequestParam("simbolo", ccsGet, NULL), $this);
        $this->punitorios = & new clsControl(ccsLabel, "punitorios", "punitorios", ccsFloat, "", CCGetRequestParam("punitorios", ccsGet, NULL), $this);
        $this->simbolop = & new clsControl(ccsLabel, "simbolop", "simbolop", ccsText, "", CCGetRequestParam("simbolop", ccsGet, NULL), $this);
        $this->idcuota = & new clsControl(ccsHidden, "idcuota", "idcuota", ccsInteger, "", CCGetRequestParam("idcuota", ccsGet, NULL), $this);
        $this->idalquiler = & new clsControl(ccsHidden, "idalquiler", "idalquiler", ccsText, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->Sorter_mes = & new clsSorter($this->ComponentName, "Sorter_mes", $FileName, $this);
        $this->Sorter_ano = & new clsSorter($this->ComponentName, "Sorter_ano", $FileName, $this);
        $this->Sorter_fechavencimiento = & new clsSorter($this->ComponentName, "Sorter_fechavencimiento", $FileName, $this);
        $this->Sorter_importe = & new clsSorter($this->ComponentName, "Sorter_importe", $FileName, $this);
        $this->Sorter_fechaaviso = & new clsSorter($this->ComponentName, "Sorter_fechaaviso", $FileName, $this);
        $this->idhipoteca = & new clsControl(ccsHidden, "idhipoteca", "idhipoteca", ccsText, "", CCGetRequestParam("idhipoteca", ccsGet, NULL), $this);
        $this->idficha = & new clsControl(ccsHidden, "idficha", "idficha", ccsText, "", CCGetRequestParam("idficha", ccsGet, NULL), $this);
        $this->Sorter_descripcion = & new clsSorter($this->ComponentName, "Sorter_descripcion", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @69-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @69-A7D2B6EB
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
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["fechavencimiento"] = $this->fechavencimiento->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["tipocuota"] = $this->tipocuota->Visible;
            $this->ControlsVisible["simbolo"] = $this->simbolo->Visible;
            $this->ControlsVisible["punitorios"] = $this->punitorios->Visible;
            $this->ControlsVisible["simbolop"] = $this->simbolop->Visible;
            $this->ControlsVisible["idcuota"] = $this->idcuota->Visible;
            $this->ControlsVisible["idalquiler"] = $this->idalquiler->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->ano->SetValue($this->DataSource->ano->GetValue());
                $this->fechavencimiento->SetValue($this->DataSource->fechavencimiento->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->tipocuota->SetValue($this->DataSource->tipocuota->GetValue());
                $this->simbolo->SetValue($this->DataSource->simbolo->GetValue());
                $this->punitorios->SetValue($this->DataSource->punitorios->GetValue());
                $this->simbolop->SetValue($this->DataSource->simbolop->GetValue());
                $this->idcuota->SetValue($this->DataSource->idcuota->GetValue());
                $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mes->Show();
                $this->ano->Show();
                $this->fechavencimiento->Show();
                $this->importe->Show();
                $this->nombre->Show();
                $this->tipocuota->Show();
                $this->simbolo->Show();
                $this->punitorios->Show();
                $this->simbolop->Show();
                $this->idcuota->Show();
                $this->idalquiler->Show();
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
        $this->Sorter_mes->Show();
        $this->Sorter_ano->Show();
        $this->Sorter_fechavencimiento->Show();
        $this->Sorter_importe->Show();
        $this->Sorter_fechaaviso->Show();
        $this->idhipoteca->Show();
        $this->idficha->Show();
        $this->Sorter_descripcion->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @69-7651E542
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechavencimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipocuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->punitorios->Errors->ToString());
        $errors = ComposeStrings($errors, $this->simbolop->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid3 Class @69-FCB6E20C

class clsGrid3DataSource extends clsDBConnection1 {  //Grid3DataSource Class @69-E5A1616B

//DataSource Variables @69-0D9D2E0D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $mes;
    var $ano;
    var $fechavencimiento;
    var $importe;
    var $nombre;
    var $tipocuota;
    var $simbolo;
    var $punitorios;
    var $simbolop;
    var $idcuota;
    var $idalquiler;
//End DataSource Variables

//DataSourceClass_Initialize Event @69-B0518573
    function clsGrid3DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid3";
        $this->Initialize();
        $this->mes = new clsField("mes", ccsInteger, "");
        
        $this->ano = new clsField("ano", ccsInteger, "");
        
        $this->fechavencimiento = new clsField("fechavencimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->importe = new clsField("importe", ccsFloat, "");
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->tipocuota = new clsField("tipocuota", ccsText, "");
        
        $this->simbolo = new clsField("simbolo", ccsText, "");
        
        $this->punitorios = new clsField("punitorios", ccsFloat, "");
        
        $this->simbolop = new clsField("simbolop", ccsText, "");
        
        $this->idcuota = new clsField("idcuota", ccsInteger, "");
        
        $this->idalquiler = new clsField("idalquiler", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @69-CF6E9B58
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "c.ano,c.mes,f.nombre";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mes" => array("mes", ""), 
            "Sorter_ano" => array("ano", ""), 
            "Sorter_fechavencimiento" => array("fechavencimiento", ""), 
            "Sorter_importe" => array("importe", ""), 
            "Sorter_fechaaviso" => array("fechaaviso", ""), 
            "Sorter_descripcion" => array("descripcion", "")));
    }
//End SetOrder Method

//Prepare Method @69-F6A66F26
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidhipoteca", ccsInteger, "", "", $this->Parameters["urlidhipoteca"], 0, false);
    }
//End Prepare Method

//Open Method @69-55E19F3E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select c.idalquiler,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo,sum(c.importe) as importe,sum(c2.importe) as punitorios\n" .
        "from cuotas c\n" .
        "left join cuotas c2 on(c.ano=c2.ano and c.mes=c2.mes and c.idalquiler = c2.idalquiler and c2.idtipocuota = 9)\n" .
        "join hipotecas h on c.idhipoteca = h.idhipoteca\n" .
        "join tipocuota t on t.idtipocuota = c.idtipocuota\n" .
        "join monedas m on h.idmoneda = m.idmoneda\n" .
        "join fichas f on c.idalquiler = f.idficha\n" .
        "where\n" .
        "c.idhipoteca = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "--and fechavencimiento < getdate()\n" .
        "and c.fechapago is not null\n" .
        "and c.fechaliquidacion is not null\n" .
        "and c.idtipocuota = 4\n" .
        "and h.idestado in(1,6,7) \n" .
        "group by c.idalquiler,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo) cnt";
        $this->SQL = "select TOP {SqlParam_endRecord} c.idalquiler,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo,sum(c.importe) as importe,sum(c2.importe) as punitorios\n" .
        "from cuotas c\n" .
        "left join cuotas c2 on(c.ano=c2.ano and c.mes=c2.mes and c.idalquiler = c2.idalquiler and c2.idtipocuota = 9)\n" .
        "join hipotecas h on c.idhipoteca = h.idhipoteca\n" .
        "join tipocuota t on t.idtipocuota = c.idtipocuota\n" .
        "join monedas m on h.idmoneda = m.idmoneda\n" .
        "join fichas f on c.idalquiler = f.idficha\n" .
        "where\n" .
        "c.idhipoteca = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "--and fechavencimiento < getdate()\n" .
        "and c.fechapago is not null\n" .
        "and c.fechaliquidacion is not null\n" .
        "and c.idtipocuota = 4\n" .
        "and h.idestado in(1,6,7) \n" .
        "group by c.idalquiler,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo {SQL_OrderBy}";
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

//SetValues Method @69-EEE0FDB4
    function SetValues()
    {
        $this->mes->SetDBValue(trim($this->f("mes")));
        $this->ano->SetDBValue(trim($this->f("ano")));
        $this->fechavencimiento->SetDBValue(trim($this->f("fechavencimiento")));
        $this->importe->SetDBValue(trim($this->f("importe")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->tipocuota->SetDBValue($this->f("descripcion"));
        $this->simbolo->SetDBValue($this->f("simbolo"));
        $this->punitorios->SetDBValue(trim($this->f("punitorios")));
        $this->simbolop->SetDBValue($this->f("simbolo"));
        $this->idcuota->SetDBValue(trim($this->f("idcuota")));
        $this->idalquiler->SetDBValue($this->f("idalquiler"));
    }
//End SetValues Method

} //End Grid3DataSource Class @69-FCB6E20C

//Initialize Page @1-B333E8C3
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
$TemplateFileName = "liquidacion.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E600BEAA
include_once("./liquidacion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0FE77F23
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid1 = & new clsGridGrid1("", $MainPage);
$Grid2 = & new clsRecordGrid2("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$Grid3 = & new clsGridGrid3("", $MainPage);
$MainPage->Grid1 = & $Grid1;
$MainPage->Grid2 = & $Grid2;
$MainPage->Header = & $Header;
$MainPage->Grid3 = & $Grid3;
$Grid1->Initialize();
$Grid3->Initialize();

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

//Execute Components @1-2D26F3CC
$Grid2->Operation();
$Header->Operations();
//End Execute Components

//Go to destination page @1-AA8C15B2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($Grid1);
    unset($Grid2);
    $Header->Class_Terminate();
    unset($Header);
    unset($Grid3);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F8CE899C
$Grid1->Show();
$Grid2->Show();
$Header->Show();
$Grid3->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-714EC9B0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($Grid1);
unset($Grid2);
$Header->Class_Terminate();
unset($Header);
unset($Grid3);
unset($Tpl);
//End Unload Page


?>
