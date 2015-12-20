<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/hipotecas/");
define("FileName", "marca_aviso.php");

include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");

foreach($_POST['avisa'] as $idcuota => $valor)
{
		$conn = new clsDBConnection1();
		$conn->query("update cuotas set fechaaviso = GETDATE() where idcuota = ".$idcuota); 
}
$conn->close();
header("Location: avisoliq.php");

?>