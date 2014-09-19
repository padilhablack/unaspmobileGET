<?php

include '../classes/Database.php';

$raGET = $_GET['ra'];
//$raGET = 86539;

$result = array('erro' => false);

$sql = mssql_query("SELECT DISTINCT supervisor.CURSO.COD_CURSO, RTRIM(LTRIM(supervisor.CURSO.DES_CURSO)) AS DES_CURSO  FROM supervisor.ALUNO_X_MATRIZ_CURRICULAR INNER JOIN  supervisor.MATRIZ_CURRICULAR ON supervisor.ALUNO_X_MATRIZ_CURRICULAR.COD_MATRIZ_CURRICULAR = supervisor.MATRIZ_CURRICULAR.COD_MATRIZ_CURRICULAR INNER JOIN  supervisor.CURSO ON supervisor.MATRIZ_CURRICULAR.COD_CURSO = supervisor.CURSO.COD_CURSO INNER JOIN  supervisor.UNIDADE_ESCOLAR ON supervisor.CURSO.COD_UNIDADE_ESCOLAR = supervisor.UNIDADE_ESCOLAR.COD_UNIDADE_ESCOLAR AND ISNULL(supervisor.UNIDADE_ESCOLAR.COD_PARAMETRO,0) <> 42 WHERE (supervisor.ALUNO_X_MATRIZ_CURRICULAR.COD_PESSOA = ".$raGET.")  ORDER BY DES_CURSO");

$alunos = array();
$mostrar = array();

while ($row = mssql_fetch_assoc($sql)) {

    $alunos[] = $row;
}
for ($i = 0; $i < count($alunos); $i++) {
    $mostrar = array(
        'id_curso' => $alunos[$i]['COD_CURSO'],
        'nome_curso' => $alunos[$i]['DES_CURSO']
    );
    $encodedArray = array_map(utf8_decode,$mostrar);
    $encode = json_encode($encodedArray);

}
?>
