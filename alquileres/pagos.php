<?php
//Include Common Files @1-560C92F7
define("RelativePath", "..");
define("PathToCurrentPage", "/alquileres/");
define("FileName", "pagos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridalquileres_fichas_fichasp { //alquileres_fichas_fichasp class @2-241FF7AB

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

//Class_Initialize Event @2-51053675
    function clsGridalquileres_fichas_fichasp($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "alquileres_fichas_fichasp";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid alquileres_fichas_fichasp";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsalquileres_fichas_fichaspDataSource($this);
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

        $this->idalquiler = & new clsControl(ccsLabel, "idalquiler", "idalquiler", ccsInteger, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->fechainicio = & new clsControl(ccsLabel, "fechainicio", "fechainicio", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechainicio", ccsGet, NULL), $this);
        $this->fechafin = & new clsControl(ccsLabel, "fechafin", "fechafin", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechafin", ccsGet, NULL), $this);
        $this->nombre = & new clsControl(ccsLabel, "nombre", "nombre", ccsText, "", CCGetRequestParam("nombre", ccsGet, NULL), $this);
        $this->idpropiedad = & new clsControl(ccsLabel, "idpropiedad", "idpropiedad", ccsInteger, "", CCGetRequestParam("idpropiedad", ccsGet, NULL), $this);
        $this->idficha = & new clsControl(ccsLabel, "idficha", "idficha", ccsInteger, "", CCGetRequestParam("idficha", ccsGet, NULL), $this);
        $this->propiedades_direccion = & new clsControl(ccsLabel, "propiedades_direccion", "propiedades_direccion", ccsText, "", CCGetRequestParam("propiedades_direccion", ccsGet, NULL), $this);
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

//Show Method @2-039028FC
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidpropiedad"] = CCGetFromGet("idpropiedad", NULL);

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
            $this->ControlsVisible["fechainicio"] = $this->fechainicio->Visible;
            $this->ControlsVisible["fechafin"] = $this->fechafin->Visible;
            $this->ControlsVisible["nombre"] = $this->nombre->Visible;
            $this->ControlsVisible["idpropiedad"] = $this->idpropiedad->Visible;
            $this->ControlsVisible["idficha"] = $this->idficha->Visible;
            $this->ControlsVisible["propiedades_direccion"] = $this->propiedades_direccion->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->idalquiler->SetValue($this->DataSource->idalquiler->GetValue());
                $this->fechainicio->SetValue($this->DataSource->fechainicio->GetValue());
                $this->fechafin->SetValue($this->DataSource->fechafin->GetValue());
                $this->nombre->SetValue($this->DataSource->nombre->GetValue());
                $this->idpropiedad->SetValue($this->DataSource->idpropiedad->GetValue());
                $this->idficha->SetValue($this->DataSource->idficha->GetValue());
                $this->propiedades_direccion->SetValue($this->DataSource->propiedades_direccion->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->idalquiler->Show();
                $this->fechainicio->Show();
                $this->fechafin->Show();
                $this->nombre->Show();
                $this->idpropiedad->Show();
                $this->idficha->Show();
                $this->propiedades_direccion->Show();
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

//GetErrors Method @2-F2B21CB2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->idalquiler->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechainicio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fechafin->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idpropiedad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->propiedades_direccion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End alquileres_fichas_fichasp Class @2-FCB6E20C

class clsalquileres_fichas_fichaspDataSource extends clsDBConnection1 {  //alquileres_fichas_fichaspDataSource Class @2-CFB5C304

//DataSource Variables @2-BCD21B8F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $idalquiler;
    var $fechainicio;
    var $fechafin;
    var $nombre;
    var $idpropiedad;
    var $idficha;
    var $propiedades_direccion;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D553D7E6
    function clsalquileres_fichas_fichaspDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid alquileres_fichas_fichasp";
        $this->Initialize();
        $this->idalquiler = new clsField("idalquiler", ccsInteger, "");
        
        $this->fechainicio = new clsField("fechainicio", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->fechafin = new clsField("fechafin", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nombre = new clsField("nombre", ccsText, "");
        
        $this->idpropiedad = new clsField("idpropiedad", ccsInteger, "");
        
        $this->idficha = new clsField("idficha", ccsInteger, "");
        
        $this->propiedades_direccion = new clsField("propiedades_direccion", ccsText, "");
        

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

//Prepare Method @2-F3394EAD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidpropiedad", ccsInteger, "", "", $this->Parameters["urlidpropiedad"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "alquileres.idpropiedad", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-65A9FF8E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM fichas INNER JOIN ((alquileres INNER JOIN propiedades ON\n\n" .
        "alquileres.idpropiedad = propiedades.idpropiedad) INNER JOIN fichasalquileres ON\n\n" .
        "alquileres.idalquiler = fichasalquileres.idalquiler) ON\n\n" .
        "fichas.idficha = fichasalquileres.idficha";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} alquileres.idalquiler AS alquileres_idalquiler, fechainicio, fechafin, propiedades.direccion AS propiedades_direccion, nombre,\n\n" .
        "fichasalquileres.* \n\n" .
        "FROM fichas INNER JOIN ((alquileres INNER JOIN propiedades ON\n\n" .
        "alquileres.idpropiedad = propiedades.idpropiedad) INNER JOIN fichasalquileres ON\n\n" .
        "alquileres.idalquiler = fichasalquileres.idalquiler) ON\n\n" .
        "fichas.idficha = fichasalquileres.idficha {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-8F12C6CE
    function SetValues()
    {
        $this->idalquiler->SetDBValue(trim($this->f("idalquiler")));
        $this->fechainicio->SetDBValue(trim($this->f("fechainicio")));
        $this->fechafin->SetDBValue(trim($this->f("fechafin")));
        $this->nombre->SetDBValue($this->f("nombre"));
        $this->idpropiedad->SetDBValue(trim($this->f("idpropiedad")));
        $this->idficha->SetDBValue(trim($this->f("idficha")));
        $this->propiedades_direccion->SetDBValue($this->f("propiedades_direccion"));
    }
//End SetValues Method

} //End alquileres_fichas_fichaspDataSource Class @2-FCB6E20C

class clsGridcuotas { //cuotas class @29-F6FD2B3C

//Variables @29-AC1EDBB9

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

//Class_Initialize Event @29-71D29E88
    function clsGridcuotas($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "cuotas";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid cuotas";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscuotasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 30;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->fechavencimiento = & new clsControl(ccsLabel, "fechavencimiento", "fechavencimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechavencimiento", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsLabel, "importe", "importe", ccsText, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->ano = & new clsControl(ccsLabel, "ano", "ano", ccsText, "", CCGetRequestParam("ano", ccsGet, NULL), $this);
        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsText, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->idcuota = & new clsControl(ccsHidden, "idcuota", "idcuota", ccsText, "", CCGetRequestParam("idcuota", ccsGet, NULL), $this);
        $this->paga = & new clsControl(ccsCheckBox, "paga", "paga", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("paga", ccsGet, NULL), $this);
        $this->paga->CheckedValue = true;
        $this->paga->UncheckedValue = false;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link2 = & new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "idalquiler", CCGetFromGet("idalquiler", NULL));
        $this->Link2->Page = "cuota_maint.php";
        $this->Button1 = & new clsButton("Button1", ccsGet, $this);
        $this->idalquiler = & new clsControl(ccsHidden, "idalquiler", "idalquiler", ccsText, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->lblidalquiler = & new clsControl(ccsLabel, "lblidalquiler", "lblidalquiler", ccsText, "", CCGetRequestParam("lblidalquiler", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @29-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @29-87C3A467
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);

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
            $this->ControlsVisible["fechavencimiento"] = $this->fechavencimiento->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["idcuota"] = $this->idcuota->Visible;
            $this->ControlsVisible["paga"] = $this->paga->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->fechavencimiento->SetValue($this->DataSource->fechavencimiento->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->ano->SetValue($this->DataSource->ano->GetValue());
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->idcuota->SetValue($this->DataSource->idcuota->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->fechavencimiento->Show();
                $this->importe->Show();
                $this->ano->Show();
                $this->mes->Show();
                $this->idcuota->Show();
                $this->paga->Show();
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
        $this->Link2->Show();
        $this->Button1->Show();
        $this->idalquiler->Show();
        $this->lblidalquiler->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @29-400B18F6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->fechavencimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->idcuota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->paga->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End cuotas Class @29-FCB6E20C

class clscuotasDataSource extends clsDBConnection1 {  //cuotasDataSource Class @29-8D383C10

//DataSource Variables @29-E6AC4D22
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $fechavencimiento;
    var $importe;
    var $ano;
    var $mes;
    var $idcuota;
//End DataSource Variables

//DataSourceClass_Initialize Event @29-ACE3C6E1
    function clscuotasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid cuotas";
        $this->Initialize();
        $this->fechavencimiento = new clsField("fechavencimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->importe = new clsField("importe", ccsText, "");
        
        $this->ano = new clsField("ano", ccsText, "");
        
        $this->mes = new clsField("mes", ccsText, "");
        
        $this->idcuota = new clsField("idcuota", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @29-3C4E1AE0
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "fechavencimiento, ano, mes";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @29-B862566F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], "", false);
        $this->wp->Criterion[1] = "( fechapago is null )";
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "idalquiler", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = "( idtipocuota = 1 )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @29-20E756DA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM cuotas";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} idalquiler, fechavencimiento, importe AS importe, idcuota, ano, mes \n\n" .
        "FROM cuotas {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @29-1B699861
    function SetValues()
    {
        $this->fechavencimiento->SetDBValue(trim($this->f("fechavencimiento")));
        $this->importe->SetDBValue($this->f("importe"));
        $this->ano->SetDBValue($this->f("ano"));
        $this->mes->SetDBValue($this->f("mes"));
        $this->idcuota->SetDBValue($this->f("idcuota"));
    }
//End SetValues Method

} //End cuotasDataSource Class @29-FCB6E20C

//Include Page implementation @49-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

class clsGridcuotaspagadas { //cuotaspagadas class @67-73F141E0

//Variables @67-AC1EDBB9

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

//Class_Initialize Event @67-5A2C9EBA
    function clsGridcuotaspagadas($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "cuotaspagadas";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid cuotaspagadas";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscuotaspagadasDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 30;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->fechavencimiento = & new clsControl(ccsLabel, "fechavencimiento", "fechavencimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fechavencimiento", ccsGet, NULL), $this);
        $this->importe = & new clsControl(ccsLabel, "importe", "importe", ccsText, "", CCGetRequestParam("importe", ccsGet, NULL), $this);
        $this->ano = & new clsControl(ccsLabel, "ano", "ano", ccsText, "", CCGetRequestParam("ano", ccsGet, NULL), $this);
        $this->mes = & new clsControl(ccsLabel, "mes", "mes", ccsText, "", CCGetRequestParam("mes", ccsGet, NULL), $this);
        $this->ivacom = & new clsControl(ccsLabel, "ivacom", "ivacom", ccsText, "", CCGetRequestParam("ivacom", ccsGet, NULL), $this);
        $this->otros = & new clsControl(ccsLabel, "otros", "otros", ccsText, "", CCGetRequestParam("otros", ccsGet, NULL), $this);
        $this->Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "recibo-reimp.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->idalquiler = & new clsControl(ccsHidden, "idalquiler", "idalquiler", ccsText, "", CCGetRequestParam("idalquiler", ccsGet, NULL), $this);
        $this->lblidalquiler = & new clsControl(ccsLabel, "lblidalquiler", "lblidalquiler", ccsText, "", CCGetRequestParam("lblidalquiler", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @67-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @67-DB8AB41E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlidalquiler"] = CCGetFromGet("idalquiler", NULL);

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
            $this->ControlsVisible["fechavencimiento"] = $this->fechavencimiento->Visible;
            $this->ControlsVisible["importe"] = $this->importe->Visible;
            $this->ControlsVisible["ano"] = $this->ano->Visible;
            $this->ControlsVisible["mes"] = $this->mes->Visible;
            $this->ControlsVisible["ivacom"] = $this->ivacom->Visible;
            $this->ControlsVisible["otros"] = $this->otros->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->fechavencimiento->SetValue($this->DataSource->fechavencimiento->GetValue());
                $this->importe->SetValue($this->DataSource->importe->GetValue());
                $this->ano->SetValue($this->DataSource->ano->GetValue());
                $this->mes->SetValue($this->DataSource->mes->GetValue());
                $this->ivacom->SetValue($this->DataSource->ivacom->GetValue());
                $this->otros->SetValue($this->DataSource->otros->GetValue());
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "idalquiler", CCGetFromGet("idalquiler", NULL));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "ano", $this->DataSource->f("ano"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "mes", $this->DataSource->f("mes"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->fechavencimiento->Show();
                $this->importe->Show();
                $this->ano->Show();
                $this->mes->Show();
                $this->ivacom->Show();
                $this->otros->Show();
                $this->Link1->Show();
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
        $this->idalquiler->Show();
        $this->lblidalquiler->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @67-E4E93415
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->fechavencimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->importe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ano->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mes->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ivacom->Errors->ToString());
        $errors = ComposeStrings($errors, $this->otros->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End cuotaspagadas Class @67-FCB6E20C

class clscuotaspagadasDataSource extends clsDBConnection1 {  //cuotaspagadasDataSource Class @67-F425E7B0

//DataSource Variables @67-D3DEE947
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $fechavencimiento;
    var $importe;
    var $ano;
    var $mes;
    var $ivacom;
    var $otros;
//End DataSource Variables

//DataSourceClass_Initialize Event @67-8B344627
    function clscuotaspagadasDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid cuotaspagadas";
        $this->Initialize();
        $this->fechavencimiento = new clsField("fechavencimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->importe = new clsField("importe", ccsText, "");
        
        $this->ano = new clsField("ano", ccsText, "");
        
        $this->mes = new clsField("mes", ccsText, "");
        
        $this->ivacom = new clsField("ivacom", ccsText, "");
        
        $this->otros = new clsField("otros", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @67-A5CF9046
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "c1.fechavencimiento, c1.ano, c1.mes";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @67-879A04A9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlidalquiler", ccsInteger, "", "", $this->Parameters["urlidalquiler"], 0, false);
    }
//End Prepare Method

//Open Method @67-52AA5E91
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT c1.idalquiler, c1.fechavencimiento, c1.ano, c1.mes, c1.fechapago, c1.importe AS importe, isnull(c2.importe,0) as ivacom, isnull(c3.importe,0) as otros\n" .
        "FROM cuotas c1\n" .
        "left join ( select idalquiler,ano,mes,sum(importe) as importe\n" .
        "            from cuotas\n" .
        "		where idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and idtipocuota in(3,7)\n" .
        "		and fechapago is not null\n" .
        "	    group by  idalquiler,ano,mes\n" .
        "	   ) c2 on( c1.ano = c2.ano and c1.mes = c2.mes and c2.idalquiler = c1.idalquiler)\n" .
        "left join ( select idalquiler,ano,mes,sum(importe) as importe\n" .
        "            from cuotas\n" .
        "		where idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and idtipocuota in(8)\n" .
        "		and fechapago is not null\n" .
        "	    group by  idalquiler,ano,mes\n" .
        "	   ) c3 on( c1.ano = c3.ano and c1.mes = c3.mes and c3.idalquiler = c1.idalquiler)\n" .
        "WHERE ( c1.fechapago is not null  )\n" .
        "AND c1.idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND ( c1.idtipocuota = 1 )) cnt";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} c1.idalquiler, c1.fechavencimiento, c1.ano, c1.mes, c1.fechapago, c1.importe AS importe, isnull(c2.importe,0) as ivacom, isnull(c3.importe,0) as otros\n" .
        "FROM cuotas c1\n" .
        "left join ( select idalquiler,ano,mes,sum(importe) as importe\n" .
        "            from cuotas\n" .
        "		where idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and idtipocuota in(3,7)\n" .
        "		and fechapago is not null\n" .
        "	    group by  idalquiler,ano,mes\n" .
        "	   ) c2 on( c1.ano = c2.ano and c1.mes = c2.mes and c2.idalquiler = c1.idalquiler)\n" .
        "left join ( select idalquiler,ano,mes,sum(importe) as importe\n" .
        "            from cuotas\n" .
        "		where idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . " and idtipocuota in(8)\n" .
        "		and fechapago is not null\n" .
        "	    group by  idalquiler,ano,mes\n" .
        "	   ) c3 on( c1.ano = c3.ano and c1.mes = c3.mes and c3.idalquiler = c1.idalquiler)\n" .
        "WHERE ( c1.fechapago is not null  )\n" .
        "AND c1.idalquiler = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "AND ( c1.idtipocuota = 1 )  {SQL_OrderBy}";
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

//SetValues Method @67-2919064C
    function SetValues()
    {
        $this->fechavencimiento->SetDBValue(trim($this->f("fechapago")));
        $this->importe->SetDBValue($this->f("importe"));
        $this->ano->SetDBValue($this->f("ano"));
        $this->mes->SetDBValue($this->f("mes"));
        $this->ivacom->SetDBValue($this->f("ivacom"));
        $this->otros->SetDBValue($this->f("otros"));
    }
//End SetValues Method

} //End cuotaspagadasDataSource Class @67-FCB6E20C

//Initialize Page @1-58BC2C7F
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
$TemplateFileName = "pagos.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F57B267D
include_once("./pagos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8444FEBD
$DBConnection1 = new clsDBConnection1();
$MainPage->Connections["Connection1"] = & $DBConnection1;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$alquileres_fichas_fichasp = & new clsGridalquileres_fichas_fichasp("", $MainPage);
$cuotas = & new clsGridcuotas("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$cuotaspagadas = & new clsGridcuotaspagadas("", $MainPage);
$Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("verpagos", "ccsForm"));
$Link1->Page = "pagos.php";
$Link2 = & new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $MainPage);
$Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link2->Page = "mostrar_impuestos.php";
$MainPage->alquileres_fichas_fichasp = & $alquileres_fichas_fichasp;
$MainPage->cuotas = & $cuotas;
$MainPage->Header = & $Header;
$MainPage->cuotaspagadas = & $cuotaspagadas;
$MainPage->Link1 = & $Link1;
$MainPage->Link2 = & $Link2;
$alquileres_fichas_fichasp->Initialize();
$cuotas->Initialize();
$cuotaspagadas->Initialize();

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

//Execute Components @1-47111282
$Header->Operations();
//End Execute Components

//Go to destination page @1-A5EB197C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnection1->close();
    header("Location: " . $Redirect);
    unset($alquileres_fichas_fichasp);
    unset($cuotas);
    $Header->Class_Terminate();
    unset($Header);
    unset($cuotaspagadas);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-06A64F7C
$alquileres_fichas_fichasp->Show();
$cuotas->Show();
$Header->Show();
$cuotaspagadas->Show();
$Link1->Show();
$Link2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1C870BF4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnection1->close();
unset($alquileres_fichas_fichasp);
unset($cuotas);
$Header->Class_Terminate();
unset($Header);
unset($cuotaspagadas);
unset($Tpl);
//End Unload Page


?>
