<?php

function authorize_cash($level = 100)
{
//if(CCGetSession("AUTH_CASH",'') == '' or $level < CCGetSession("AUTH_CASH",100))
	if($_SESSION['AUTH_CASH'] == '' or $level < $_SESSION['AUTH_CASH'])
	{
		header("Location: cajadenegada.php");
		exit;
	}
}
?>