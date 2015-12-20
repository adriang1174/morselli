<?php
require "numerosALetras.class.php";

for($i=0;$i<=1000;$i++)
{
$n = new numerosALetras ( $i ) ;
print $i . ": ".$n->resultado."<br>";
}
?>