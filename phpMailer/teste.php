<?php



$teste = $_SERVER['SCRIPT_URI'];
$teste2 = $_SERVER['SCRIPT_FILENAME'];


if ($_SERVER['SCRIPT_FILENAME'] == "C:/xampp/htdocs/bla/teste.php") {
	print "oi";
}else{
	print "erro";
}

?>