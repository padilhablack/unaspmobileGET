<?php

include './classes/Database.php';

$raGET = $_GET['ra'] ;
$senhaGET = $_GET['senha'];

$result = array('erro' => false);

$sql = mssql_query( "SELECT cod_senha, cod_pessoa, nom_pessoa, end_email FROM supervisor.pessoa where cod_pessoa = $raGET and cod_senha = $senhaGET");

$alunos = array();


while ($row = @mssql_fetch_assoc($sql)) {
      $alunos[] = array(
      'RA' => $row['cod_pessoa'], 
      'NOME' => $row['nom_pessoa'], 
      'EMAIL' => $row['end_email'], 
      'SENHA' => $row['cod_senha']
    );
}
echo(json_encode($alunos).'</br>');
?>