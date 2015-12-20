<?php
//Include Common Files @1-3606BDC0
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "accesodenegado.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-5B9A99E6
include_once(RelativePath . "/menuincluible.php");
//End Include Page implementation

//Initialize Page @1-26957E06
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
$TemplateFileName = "accesodenegado.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-50E8AF61
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$menuincluible = & new clsmenuincluible("", "menuincluible", $MainPage);
$menuincluible->Initialize();
$MainPage->menuincluible = & $menuincluible;

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-DF199270
$menuincluible->Operations();
//End Execute Components

//Go to destination page @1-AF0DAB3B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    $menuincluible->Class_Terminate();
    unset($menuincluible);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-384A5DC3
$menuincluible->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3EF3DDC3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$menuincluible->Class_Terminate();
unset($menuincluible);
unset($Tpl);
//End Unload Page


?>
