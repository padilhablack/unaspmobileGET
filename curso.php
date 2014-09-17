<?php

include './classes/Database.php';

$raGET = $_GET['ra'] ;

$result = array('erro' => false);

$sql = mssql_query("SELECT DISTINCT supervisor.CURSO.COD_CURSO, RTRIM(LTRIM(supervisor.CURSO.DES_CURSO)) AS DES_CURSO  FROM supervisor.ALUNO_X_MATRIZ_CURRICULAR INNER JOIN  supervisor.MATRIZ_CURRICULAR ON supervisor.ALUNO_X_MATRIZ_CURRICULAR.COD_MATRIZ_CURRICULAR = supervisor.MATRIZ_CURRICULAR.COD_MATRIZ_CURRICULAR INNER JOIN  supervisor.CURSO ON supervisor.MATRIZ_CURRICULAR.COD_CURSO = supervisor.CURSO.COD_CURSO INNER JOIN  supervisor.UNIDADE_ESCOLAR ON supervisor.CURSO.COD_UNIDADE_ESCOLAR = supervisor.UNIDADE_ESCOLAR.COD_UNIDADE_ESCOLAR AND ISNULL(supervisor.UNIDADE_ESCOLAR.COD_PARAMETRO,0) <> 42 WHERE (supervisor.ALUNO_X_MATRIZ_CURRICULAR.COD_PESSOA = 86539 )  ORDER BY DES_CURSO");

$alunos = array();

while ($row = @mssql_fetch_assoc($sql)) {
      $alunos[] = array(
      'COD_CURSO' => $row['COD_CURSO'], 
      'DES_CURSO' => $row['DES_CURSO']
 
    );
}
echo(json_encode($alunos).'</br>');
?>