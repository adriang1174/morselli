<?
//var_dump($_REQUEST);

//Include Common Files @1-303BA07C
define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "cesion.php");
include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");
//End Include Common Files

$error=true;
$NewConnection = new clsDBConnection1();

$NewConnection->query("EXEC sp_anula_hipoteca ".$_REQUEST['idhipoteca']);

header("Location: anulacion_hipo.php?st=a&idhipoteca=".$_REQUEST['idhipoteca']);

?>
