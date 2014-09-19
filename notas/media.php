<?php

include '../classes/Database.php';

//$raGET = 86539;
//$anoGet = 2014;
//$turmaGet = '5A800';
//$periodoGet = 1;
//$diciplinaGet = G1311;

$raGET = $_GET['ra'];
$anoGet = $_GET['ano'];
$turmaGet = $_GET['turma'];
$periodoGet = $_GET['periodo'];
$diciplinaGet = $_GET['disciplina'];




$sql_media_detalhe = mssql_query("

SELECT DISTINCT TOP 100 PERCENT CASE WHEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_TEORICA_MANUAL IS NULL THEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_TEORICA ELSE supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_TEORICA_MANUAL END AS VAL_NOTA_TEORICA,
 CASE WHEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_PRATICA_MANUAL IS NULL THEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_PRATICA ELSE supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_PRATICA_MANUAL END AS VAL_NOTA_PRATICA,
 CASE WHEN supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA_MANUAL IS NULL THEN IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA, 0) ELSE supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA_MANUAL END AS TOT_FALTA_TEORICA,
 CASE WHEN supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA_MANUAL IS NULL THEN IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA, 0) ELSE supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA_MANUAL END AS TOT_FALTA_PRATICA,
 IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA_ABONADA, 0) as TOT_FALTA_TEORICA_ABONADA, IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA_ABONADA, 0) as TOT_FALTA_PRATICA_ABONADA, ISNULL(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_MATRICULA_TARDIA, 0) AS TOT_FALTA_MATRICULA_TARDIA,
 IsNull(supervisor.GRADE.QTD_DADAS_TEORICA, 0) as QTD_DADAS_TEORICA, IsNull(supervisor.GRADE.QTD_DADAS_PRATICA, 0) as QTD_DADAS_PRATICA, supervisor.ALUNO_X_DISCIPLINA.COD_STATUS
 FROM supervisor.ALUNO_X_DISCIPLINA INNER JOIN
 supervisor.GRADE ON supervisor.ALUNO_X_DISCIPLINA.COD_TURMA = supervisor.GRADE.COD_TURMA AND
 supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = supervisor.GRADE.COD_DISCIPLINA AND
 supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA_PROFES = supervisor.GRADE.COD_PESSOA AND
 supervisor.ALUNO_X_DISCIPLINA.ANO_LETIVO = supervisor.GRADE.ANO_LETIVO AND
 supervisor.ALUNO_X_DISCIPLINA.COD_PERIODO = supervisor.GRADE.COD_PERIODO
 WHERE (supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA = ".$raGET." )
 AND (supervisor.ALUNO_X_DISCIPLINA.ANO_LETIVO = ".$anoGet.")
 AND (supervisor.ALUNO_X_DISCIPLINA.COD_TURMA = '".$turmaGet."')
 AND (supervisor.ALUNO_X_DISCIPLINA.COD_PERIODO = ".$periodoGet.")
 AND (supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = '".$diciplinaGet."')

");
$sqs_media_resultado_final = mssql_query("
SELECT DISTINCT CASE supervisor.RESULTADO_FINAL.COD_RESULTADO 
                         WHEN 'A' THEN 'Aprovado' 
                         WHEN 'P' THEN 'Pendente/Recuperação' 
                         WHEN 'C' THEN 'Conselho'
                         WHEN 'R' THEN 'Retido por Nota' 
                         WHEN 'F' THEN 'Retido por Falta' 
                         WHEN 'E' THEN 'Retido Estágio' 
                         WHEN 'D' THEN 'Dispensado' 
                         WHEN 'N' THEN 'Retido por Nota' 
                         END AS DES_RESULTADO 
                         FROM supervisor.RESULTADO_FINAL 
		
                     WHERE (supervisor.RESULTADO_FINAL.COD_PESSOA = ".$raGET.")
                        AND (supervisor.RESULTADO_FINAL.ANO_LETIVO = ".$anoGet." )
                        AND (supervisor.RESULTADO_FINAL.COD_TURMA = '".$turmaGet."') 
			AND (supervisor.RESULTADO_FINAL.COD_PERIODO = ".$periodoGet." ) 
			AND (supervisor.RESULTADO_FINAL.COD_DISCIPLINA = '".$diciplinaGet."')
  ");

$media_detalhe = array();
$media_resultado_final = array();

while ($row = @mssql_fetch_assoc($sql_media_detalhe)) {
    $media_detalhe[] = $row;
}

while ($rou = @mssql_fetch_assoc($sqs_media_resultado_final)) {
    $media_resultado_final[] = $rou;
}


for ($i = 0; $i < count($media_detalhe); $i++) {
    $mostrar = array(
        'valor_nota_teorica' => $media_detalhe[$i]['VAL_NOTA_TEORICA'],
        'val_nota_pratica' => $media_detalhe[$i]['VAL_NOTA_PRATICA'],
        'falta_teorica' => $media_detalhe[$i]['TOT_FALTA_TEORICA'],
        'falta_pratica' => $media_detalhe[$i]['TOT_FALTA_PRATICA'],
        'falta_pratica_abadon' => $media_detalhe[$i]['TOT_FALTA_TEORICA_ABONADA'],
        'falta_matricula_tardia' => $media_detalhe[$i]['TOT_FALTA_MATRICULA_TARDIA'],
        'total_aulas' => $media_detalhe[$i]['QTD_DADAS_TEORICA'],
        'total_aulas_pratica' => $media_detalhe[$i]['QTD_DADAS_PRATICA'],
        'resultado' => $media_resultado_final[$i]['DES_RESULTADO']
    );
    $encodedArray = array_map(utf8_encode, $mostrar);
    echo(json_encode($encodedArray) . '</br>');
}

?>