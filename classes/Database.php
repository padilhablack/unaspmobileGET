<?php 
ini_set('memory_limit', '500M');
$host = "177.69.235.75";
$bd = "unasp_ec";
$user = "unaspadm";
$pswd = "latitude2349b";

mssql_connect($host, $user,$pswd) or die("Não foi possível a conexão com o servidor");

mssql_select_db($bd) or die("Não foi possível selecionar o banco de dados");

?>