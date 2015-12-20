<?php
//Include Common Files @1-303BA07C
define("RelativePath", "..");
define("PathToCurrentPage", "/propiedades/");
define("FileName", "getFicha.php");
include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");
//End Include Common Files

$error=true;
$NewConnection = new clsDBConnection1();
    
if ($_GET['idficha'] <> '')
{
	$NewConnection->query("select idficha, nombre, nrodocumento from fichas where idficha = ".$_GET['idficha']);
}
else
{		
		if ($_GET['nombre'] <> '')
			$NewConnection->query("select idficha, nombre, nrodocumento from fichas where nombre like '%".$_GET['nombre']."%'");
		else
			$NewConnection->query("select idficha, nombre, nrodocumento from fichas where nrodocumento = '".$_GET['nrodocumento']."'");
}	

while($NewConnection->next_record()){

echo "formObj.idficha_".$_GET['i'].".value			 	= '".$NewConnection->f("idficha")."';\n";    
echo "formObj.nombre_".$_GET['i'].".value 				= '".$NewConnection->f("nombre")."';\n";    
echo "formObj.nrodocumento_".$_GET['i'].".value 	= '".$NewConnection->f("nrodocumento")."';\n";    
$error=false;   
	}
if($error)
	echo "formObj.errorAjax.value = 'true';\n";
else    
	echo "formObj.errorAjax.value = 'false';\n";


?>