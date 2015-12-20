<?php

class clsGridHeadercajaJSMenu { //JSMenu class @2-B1C2EB0D

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

//Class_Initialize Event @2-3D5CEBE1
    function clsGridHeadercajaJSMenu($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "JSMenu";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid JSMenu";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsHeadercajaJSMenuDataSource($this);
        $this->ds = & $this->DataSource;

        $this->Menu_Id = & new clsControl(ccsLabel, "Menu_Id", "Menu_Id", ccsText, "", CCGetRequestParam("Menu_Id", ccsGet, NULL), $this);
        $this->Menu_Caption = & new clsControl(ccsLabel, "Menu_Caption", "Menu_Caption", ccsText, "", CCGetRequestParam("Menu_Caption", ccsGet, NULL), $this);
        $this->Menu_Url = & new clsControl(ccsLabel, "Menu_Url", "Menu_Url", ccsText, "", CCGetRequestParam("Menu_Url", ccsGet, NULL), $this);
        $this->Menu_Id_Parent = & new clsControl(ccsLabel, "Menu_Id_Parent", "Menu_Id_Parent", ccsText, "", CCGetRequestParam("Menu_Id_Parent", ccsGet, NULL), $this);
        $this->Menu_Width = & new clsControl(ccsLabel, "Menu_Width", "Menu_Width", ccsText, "", CCGetRequestParam("Menu_Width", ccsGet, NULL), $this);
        $this->Menu_Icon = & new clsControl(ccsLabel, "Menu_Icon", "Menu_Icon", ccsText, "", CCGetRequestParam("Menu_Icon", ccsGet, NULL), $this);
        $this->Menu_Id_Root = & new clsControl(ccsLabel, "Menu_Id_Root", "Menu_Id_Root", ccsText, "", CCGetRequestParam("Menu_Id_Root", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-1465F9C9
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


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
            $this->ControlsVisible["Menu_Id"] = $this->Menu_Id->Visible;
            $this->ControlsVisible["Menu_Caption"] = $this->Menu_Caption->Visible;
            $this->ControlsVisible["Menu_Url"] = $this->Menu_Url->Visible;
            $this->ControlsVisible["Menu_Id_Parent"] = $this->Menu_Id_Parent->Visible;
            $this->ControlsVisible["Menu_Width"] = $this->Menu_Width->Visible;
            $this->ControlsVisible["Menu_Icon"] = $this->Menu_Icon->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                if(!is_array($this->Menu_Width->Value) && !strlen($this->Menu_Width->Value) && $this->Menu_Width->Value !== false)
                    $this->Menu_Width->SetText(170);
                $this->Menu_Id->SetValue($this->DataSource->Menu_Id->GetValue());
                $this->Menu_Caption->SetValue($this->DataSource->Menu_Caption->GetValue());
                $this->Menu_Url->SetValue($this->DataSource->Menu_Url->GetValue());
                $this->Menu_Id_Parent->SetValue($this->DataSource->Menu_Id_Parent->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Menu_Id->Show();
                $this->Menu_Caption->Show();
                $this->Menu_Url->Show();
                $this->Menu_Id_Parent->Show();
                $this->Menu_Width->Show();
                $this->Menu_Icon->Show();
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
        $this->Menu_Id_Root->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-EF161672
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Menu_Id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Menu_Caption->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Menu_Url->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Menu_Id_Parent->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Menu_Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Menu_Icon->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End JSMenu Class @2-FCB6E20C

class clsHeadercajaJSMenuDataSource extends clsDBConnection1 {  //JSMenuDataSource Class @2-29963597

//DataSource Variables @2-55A63D4F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $Menu_Id;
    var $Menu_Caption;
    var $Menu_Url;
    var $Menu_Id_Parent;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7A02C617
    function clsHeadercajaJSMenuDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid JSMenu";
        $this->Initialize();
        $this->Menu_Id = new clsField("Menu_Id", ccsText, "");
        
        $this->Menu_Caption = new clsField("Menu_Caption", ccsText, "");
        
        $this->Menu_Url = new clsField("Menu_Url", ccsText, "");
        
        $this->Menu_Id_Parent = new clsField("Menu_Id_Parent", ccsText, "");
        

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

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-53D548E0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM menucaja";
        $this->SQL = "SELECT * \n\n" .
        "FROM menucaja {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-7A78C163
    function SetValues()
    {
        $this->Menu_Id->SetDBValue($this->f("idmenu"));
        $this->Menu_Caption->SetDBValue($this->f("menu_name"));
        $this->Menu_Url->SetDBValue($this->f("menu_link"));
        $this->Menu_Id_Parent->SetDBValue($this->f("menu_id_parent"));
    }
//End SetValues Method

} //End JSMenuDataSource Class @2-FCB6E20C

class clsHeadercaja { //Headercaja class @1-B3EC376F

//Variables @1-9721D5A2
    var $ComponentType = "IncludablePage";
    var $Connections = array();
    var $FileName = "";
    var $Redirect = "";
    var $Tpl = "";
    var $TemplateFileName = "";
    var $BlockToParse = "";
    var $ComponentName = "";
    var $Attributes = "";

    // Events;
    var $CCSEvents = "";
    var $CCSEventResult = "";
    var $RelativePath;
    var $Visible;
    var $Parent;
//End Variables

//Class_Initialize Event @1-A89E0134
    function clsHeadercaja($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "Headercaja.php";
        $this->Redirect = "";
        $this->TemplateFileName = "Headercaja.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-57848EB1
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->JSMenu);
    }
//End Class_Terminate Event

//BindEvents Method @1-B2F7E306
    function BindEvents()
    {
        $this->JSMenu->Menu_Caption->CCSEvents["BeforeShow"] = "Headercaja_JSMenu_Menu_Caption_BeforeShow";
        $this->JSMenu->Menu_Url->CCSEvents["BeforeShow"] = "Headercaja_JSMenu_Menu_Url_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-D5E362BC
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->DBConnection1 = new clsDBConnection1();
        $this->Connections["Connection1"] = & $this->DBConnection1;
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->JSMenu = & new clsGridHeadercajaJSMenu($this->RelativePath, $this);
        $this->JSMenu->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-595809BB
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/caja/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->JSMenu->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End Headercaja Class @1-FCB6E20C

//Include Event File @1-B1E8A8CF
include_once(RelativePath . "/caja/Headercaja_events.php");
//End Include Event File


?>
