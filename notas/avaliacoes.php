<?php

include '../classes/Database.php';

//$raGET = 86539;
//$cursoGet = 800;
//$anoGet = 2014;
//$periodoGet = 1;
//$turmaGet = '5A800';
//$diciplinaGet = G1311;
//$professor = 92341;


$raGET = $_GET['ra'];
$cursoGet = $_GET['curso'];
$anoGet = $_GET['ano'];
$periodoGet = $_GET['periodo'];
$turmaGet = $_GET['turma'];
$diciplinaGet = $_GET['disciplina'];
$professor = $_GET['professor'];


$sql = mssql_query("SELECT TOP 100 PERCENT supervisor.AVALIACOES.DAT_AVALIACAO, supervisor.AVALIACOES.CAL_PESO, RTRIM(LTRIM(supervisor.AVALIACOES.DES_AVALIACAO)) AS DES_AVALIACAO, supervisor.RESULTADO.VAL_MEDIA,
                    LTRIM(RTRIM(supervisor.DISCIPLINA.DES_DISCIPLINA)) AS DES_DISCIPLINA
                    FROM supervisor.RESULTADO INNER JOIN
                    supervisor.AVALIACOES ON supervisor.RESULTADO.COD_TURMA = supervisor.AVALIACOES.COD_TURMA AND
                    supervisor.RESULTADO.COD_DISCIPLINA = supervisor.AVALIACOES.COD_DISCIPLINA AND
                    supervisor.RESULTADO.COD_PESSOA_PROFES = supervisor.AVALIACOES.COD_PESSOA_PROFES AND
                    supervisor.RESULTADO.ANO_LETIVO = supervisor.AVALIACOES.ANO_LETIVO AND
                    supervisor.RESULTADO.COD_PERIODO = supervisor.AVALIACOES.COD_PERIODO AND
                    supervisor.RESULTADO.COD_AVALIACAO = supervisor.AVALIACOES.COD_AVALIACAO INNER JOIN
                    supervisor.DISCIPLINA ON supervisor.RESULTADO.COD_DISCIPLINA = supervisor.DISCIPLINA.COD_DISCIPLINA
                    WHERE supervisor.RESULTADO.COD_TURMA = '".$turmaGet."'
                    AND supervisor.RESULTADO.COD_PESSOA = ".$raGET."
                    AND supervisor.RESULTADO.COD_DISCIPLINA = '".$diciplinaGet."'
                    AND supervisor.RESULTADO.COD_PESSOA_PROFES = ".$professor."
                    AND supervisor.RESULTADO.COD_PERIODO = ".$periodoGet."
                    AND supervisor.RESULTADO.ANO_LETIVO = ".$anoGet."
                    ORDER BY supervisor.RESULTADO.COD_DISCIPLINA, supervisor.AVALIACOES.SEQ_AVALIACAO, DES_AVALIACAO");

while ($row = @mssql_fetch_assoc($sql)) {
    $turma[] = $row;
}
for ($i = 0; $i < count($turma); $i++) {
    $mostrar = array(
        'data' => $turma[$i]['DAT_AVALIACAO'],
        'peso' => $turma[$i]['CAL_PESO'],
        'nota' => $turma[$i]['VAL_MEDIA'],
        'nome_disciplina' => $turma[$i]['DES_DISCIPLINA']
    );
    $encodedArray = array_map(utf8_encode, $mostrar);
    echo(json_encode($encodedArray) . '</br>');
    
}

?>