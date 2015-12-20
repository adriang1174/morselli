<?php

$level = CCGetParam('level',100);

if(CCGetSession("AUTH_CASH",'') == '' or $level < CCGetSession("AUTH_CASH",100))
{
	header("Location: cajadenegada.php");
	exit;
}

?>