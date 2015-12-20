<?
//var_dump($_REQUEST);

//Include Common Files @1-303BA07C
define("RelativePath", "..");
define("PathToCurrentPage", "/caja/");
define("FileName", "loginprocess.php");
include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");
//End Include Common Files

$error=true;
$NewConnection = new clsDBConnection1();
$pwd = md5($_REQUEST['password']);
$NewConnection->query("select id_perfil from  pwdcaja where password = '".$pwd."'");
$result = $NewConnection->next_record();
//$pwddb = $NewConnection->f("password");
if($result)
	{
		CCSetSession("AUTH_CASH", $NewConnection->f("id_perfil"));
		header("Location: menucaja.php");
	}
else
	header("Location: logincaja.php?action=error");
?>