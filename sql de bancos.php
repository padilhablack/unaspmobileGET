<?php

// SELECIONA ID do PROFESSOR e MATERIA COM SEU ID
// 
// 
//	"SELECT DISTINCT supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA_PROFES, LTRIM(RTRIM(supervisor.PESSOA.NOM_PESSOA)) AS NOM_PROFES, supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA, 
//	LTRIM(RTRIM(supervisor.DISCIPLINA.DES_DISCIPLINA)) AS DES_DISCIPLINA 
//	FROM supervisor.ALUNO_X_DISCIPLINA INNER JOIN 
//	supervisor.PESSOA ON supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA_PROFES = supervisor.PESSOA.COD_PESSOA INNER JOIN 
//	supervisor.DISCIPLINA ON supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = supervisor.DISCIPLINA.COD_DISCIPLINA 		
//	WHERE (supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA = 86539  ) 
//	AND (supervisor.ALUNO_X_DISCIPLINA.ANO_LETIVO = 2014 ) 
//	AND (supervisor.ALUNO_X_DISCIPLINA.COD_TURMA = '5A800')
//	//se for selecionada toda a tabela
//      AND (supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = 'disciplia')
//	AND (supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = 'G2695')
//      ORDER BY supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA, NOM_PROFES"
//      
//      
//      
//SELECIONA NOTAS e AVALIAÇÔES
//
//SELECT TOP 100 PERCENT supervisor.AVALIACOES.DAT_AVALIACAO, supervisor.AVALIACOES.SEQ_AVALIACAO, supervisor.AVALIACOES.CAL_PESO, supervisor.AVALIACOES.COD_AVALIACAO, RTRIM(LTRIM(supervisor.AVALIACOES.DES_AVALIACAO)) AS DES_AVALIACAO, supervisor.RESULTADO.VAL_MEDIA,  
//supervisor.RESULTADO.COD_PESSOA_PROFES, supervisor.RESULTADO.COD_DISCIPLINA, LTRIM(RTRIM(supervisor.DISCIPLINA.DES_DISCIPLINA)) AS DES_DISCIPLINA 
//FROM supervisor.RESULTADO INNER JOIN 
//supervisor.AVALIACOES ON supervisor.RESULTADO.COD_TURMA = supervisor.AVALIACOES.COD_TURMA AND  
//supervisor.RESULTADO.COD_DISCIPLINA = supervisor.AVALIACOES.COD_DISCIPLINA AND  
// supervisor.RESULTADO.COD_PESSOA_PROFES = supervisor.AVALIACOES.COD_PESSOA_PROFES AND 
// supervisor.RESULTADO.ANO_LETIVO = supervisor.AVALIACOES.ANO_LETIVO AND  
//supervisor.RESULTADO.COD_PERIODO = supervisor.AVALIACOES.COD_PERIODO AND 
// supervisor.RESULTADO.COD_AVALIACAO = supervisor.AVALIACOES.COD_AVALIACAO INNER JOIN
// supervisor.DISCIPLINA ON supervisor.RESULTADO.COD_DISCIPLINA = supervisor.DISCIPLINA.COD_DISCIPLINA 	
//WHERE supervisor.RESULTADO.COD_TURMA = '5A800' 
// AND supervisor.RESULTADO.COD_PESSOA = 86539
// AND supervisor.RESULTADO.COD_DISCIPLINA = 'G1311'
//AND supervisor.RESULTADO.COD_PESSOA_PROFES = 92341
//AND supervisor.RESULTADO.COD_PERIODO = 1
// AND supervisor.RESULTADO.ANO_LETIVO = 2014
// ORDER BY supervisor.RESULTADO.COD_DISCIPLINA, supervisor.AVALIACOES.DAT_AVALIACAO, supervisor.AVALIACOES.SEQ_AVALIACAO, DES_AVALIACAO 
//
//
//
//NOME DO PROFESSOR, DISCIPLINA e STATUS
//
//
//SELECT DISTINCT LTRIM(RTRIM(supervisor.PESSOA.NOM_PESSOA)) AS NOM_PROFES, supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA,
//LTRIM(RTRIM(supervisor.DISCIPLINA.DES_DISCIPLINA)) AS DES_DISCIPLINA, CASE supervisor.ALUNO_X_DISCIPLINA.COD_STATUS
//WHEN 0 THEN 'Res. Vaga'
//WHEN 1 THEN 'Cursando'
//WHEN 2 THEN 'Cancelado'
//WHEN 3 THEN 'Desistente'
//WHEN 4 THEN 'Transf. Turma'
//WHEN 5 THEN 'Transf. Escola'
//WHEN 6 THEN 'Trancado'
//WHEN 7 THEN 'Concluído'
//WHEN 8 THEN 'Abandono'
//WHEN 9 THEN 'Reclassificado' ELSE '?'
//END AS DES_STATUS
//FROM supervisor.ALUNO_X_DISCIPLINA INNER JOIN
//supervisor.RESULTADO ON supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA_PROFES = supervisor.RESULTADO.COD_PESSOA_PROFES
//AND supervisor.ALUNO_X_DISCIPLINA.COD_TURMA = supervisor.RESULTADO.COD_TURMA
//AND supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = supervisor.RESULTADO.COD_DISCIPLINA
//AND supervisor.ALUNO_X_DISCIPLINA.ANO_LETIVO = supervisor.RESULTADO.ANO_LETIVO
//AND supervisor.ALUNO_X_DISCIPLINA.COD_PERIODO = supervisor.RESULTADO.COD_PERIODO
//AND supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA = supervisor.RESULTADO.COD_PESSOA INNER JOIN
//supervisor.PESSOA ON supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA_PROFES = supervisor.PESSOA.COD_PESSOA INNER JOIN
//supervisor.DISCIPLINA ON supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = supervisor.DISCIPLINA.COD_DISCIPLINA
//WHERE (supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA = 86539 )
//AND (supervisor.ALUNO_X_DISCIPLINA.COD_PERIODO = 1)
//AND (supervisor.ALUNO_X_DISCIPLINA.ANO_LETIVO = 2014)
//AND (supervisor.ALUNO_X_DISCIPLINA.COD_TURMA = '5A800')
////SE SELECIONAR APENAS UMA DISCIPLINA
////AND (supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = 'G1311')
////AND (supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA_PROFES = 92341
//
//ORDER BY supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA, NOM_PROFES
//
//
//
//HISTÓRICO GERAL
//
//SELECT DISTINCT HIST_RESUMO.COD_MATRIZ, SUPERVISOR.MATRIZ_CURRICULAR.DES_MATRIZ_CURRICULAR
//FROM
//(SELECT DISTINCT COD_MATRIZ_CURRICULAR AS COD_MATRIZ
//FROM VIEW_ALUNO_ACURSAR
//WHERE COD_PESSOA = 86539
//UNION
//SELECT DISTINCT COD_MATRIZ_CURRICULAR
//FROM VIEW_ALUNO_CURSANDO
//WHERE COD_PESSOA = 86539
//UNION
//SELECT DISTINCT COD_MATRIZ_CURRICULAR
//FROM SUPERVISOR.ALUNO_X_MATRIZ_RESULTADO
//WHERE COD_RESULTADO NOT IN ( 4 ) AND COD_PESSOA = 86539) AS HIST_RESUMO, SUPERVISOR.MATRIZ_CURRICULAR
//WHERE HIST_RESUMO.COD_MATRIZ = SUPERVISOR.MATRIZ_CURRICULAR.COD_MATRIZ_CURRICULAR
//ORDER BY SUPERVISOR . MATRIZ_CURRICULAR . DES_MATRIZ_CURRICULAR
// HISTORICO DETALHE
//SELECT HIST_RESUMO.COD_MATRIZ, HIST_RESUMO.COD_ETAPA, HIST_RESUMO.COD_DISCIPLINA, HIST_RESUMO.ANO_LETIVO,
// CASE HIST_RESUMO.COD_RESULTADO
//WHEN 1 THEN 'Aprovado'
//WHEN 2 THEN 'Aproveitamento'
//WHEN 3 THEN 'Notório Saber'
//WHEN 4 THEN 'Dependência'
//WHEN 5 THEN 'Dispensado'
//WHEN 6 THEN 'Aprovado por Freqüência'
//WHEN 0 THEN 'A Cursar'
//WHEN 10 THEN 'Cursando' ELSE '???'
//END AS DES_SITUACAO, DES_DISCIPLINA, DES_MATRIZ_CURRICULAR, COD_RESULTADO AS RESULTADO, QTD_SEMANAS,
// QTD_CREDITO_ACADEMICO, NOTA_TEORICA_GENERICA, NOTA_PRATICA_GENERICA
//FROM
//(SELECT COD_MATRIZ_CURRICULAR AS COD_MATRIZ, COD_ETAPA, COD_DISCIPLINA, NULL AS ANO_LETIVO, COD_RESULTADO, NULL AS NOTA_TEORICA_GENERICA, NULL AS NOTA_PRATICA_GENERICA
//FROM VIEW_ALUNO_ACURSAR
//WHERE COD_MATRIZ_CURRICULAR = 32 AND COD_PESSOA = 86539
//UNION
//SELECT COD_MATRIZ_CURRICULAR, COD_ETAPA, COD_DISCIPLINA, ANO_LETIVO, COD_RESULTADO, NULL AS NOTA_TEORICA_GENERICA, NULL AS NOTA_PRATICA_GENERICA
//FROM VIEW_ALUNO_CURSANDO
//WHERE COD_MATRIZ_CURRICULAR = 32 AND COD_PESSOA = 86539
//UNION
//SELECT COD_MATRIZ_CURRICULAR, COD_ETAPA, COD_DISCIPLINA, ANO_CURSADO AS ANO_LETIVO, COD_RESULTADO, NOTA_TEORICA_GENERICA, NOTA_PRATICA_GENERICA
//FROM SUPERVISOR.ALUNO_X_MATRIZ_RESULTADO
//WHERE COD_RESULTADO NOT IN ( 4 ) AND COD_MATRIZ_CURRICULAR = 32 AND COD_PESSOA = 86539
//) AS HIST_RESUMO, SUPERVISOR.DISCIPLINA, SUPERVISOR.MATRIZ_CURRICULAR, SUPERVISOR.MATRIZ_CURRICULAR_DISCIPLINA
//WHERE HIST_RESUMO.COD_DISCIPLINA = SUPERVISOR.DISCIPLINA.COD_DISCIPLINA AND
//HIST_RESUMO.COD_MATRIZ = SUPERVISOR.MATRIZ_CURRICULAR.COD_MATRIZ_CURRICULAR AND
//HIST_RESUMO.COD_MATRIZ = SUPERVISOR.MATRIZ_CURRICULAR_DISCIPLINA.COD_MATRIZ_CURRICULAR AND
//HIST_RESUMO.COD_ETAPA = SUPERVISOR.MATRIZ_CURRICULAR_DISCIPLINA.COD_ETAPA AND
//HIST_RESUMO.COD_DISCIPLINA = SUPERVISOR.MATRIZ_CURRICULAR_DISCIPLINA.COD_DISCIPLINA
//ORDER BY HIST_RESUMO.COD_MATRIZ, HIST_RESUMO.COD_ETAPA, DES_DISCIPLINA
// 
// 
// 
// FINANCEIRO CONTA CORRENTE
// 
//SELECT DISTINCT SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO,
// SUPERVISOR.lancamento.COD_PARCELA,
// SUPERVISOR.lancamento.ANO_REFERENCIA,
// SUPERVISOR.lancamento.MES_REFERENCIA,
// SUPERVISOR.PARCELA.DES_PARCELA,
// SUPERVISOR.TIPO_LANCAMENTO.DES_TIPO_LANCAMENTO,
// SUPERVISOR.PARCELA.COD_PARAMETRO,
// SUPERVISOR.PARCELA.TIP_PARAMETRO,
// SUPERVISOR.referencia.flg_disponivel_web,
// SUM( CASE SUPERVISOR.HISTORICO_CONTABIL.COD_TIPO_CONTA WHEN 'D' THEN SUPERVISOR.DETALHE_LANCAMENTO.VAL_LANCAMENTO ELSE - SUPERVISOR.DETALHE_LANCAMENTO.VAL_LANCAMENTO END ) VALOR,
// CONVERT(CHAR(12), MAX( SUPERVISOR.lancamento.DAT_VENCIMENTO ), 103 ) VENCIMENTO
//FROM SUPERVISOR.DETALHE_LANCAMENTO,
// SUPERVISOR.PARCELA,
// supervisor.lancamento,
// SUPERVISOR.TIPO_LANCAMENTO,
// SUPERVISOR.referencia,
// SUPERVISOR.HISTORICO_CONTABIL
//WHERE ( SUPERVISOR.lancamento.COD_PARCELA = SUPERVISOR.PARCELA.COD_PARCELA ) and
//( SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO = SUPERVISOR.TIPO_LANCAMENTO.COD_TIPO_LANCAMENTO ) and
//( SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO = SUPERVISOR.referencia.COD_TIPO_LANCAMENTO ) and
//( SUPERVISOR.lancamento.cod_parcela = SUPERVISOR.referencia.cod_parcela ) and
//( SUPERVISOR.lancamento.ano_referencia = SUPERVISOR.referencia.ano_referencia ) and
//( SUPERVISOR.lancamento.mes_referencia = SUPERVISOR.referencia.mes_referencia ) and
//( SUPERVISOR.lancamento.num_lancamento = SUPERVISOR.detalhe_lancamento.num_lancamento ) and
//( SUPERVISOR.referencia.flg_disponivel_web = 1 ) and
//( SUPERVISOR.DETALHE_LANCAMENTO.COD_HISTORICO = SUPERVISOR.HISTORICO_CONTABIL.COD_HISTORICO ) and
//( ( SUPERVISOR.lancamento.COD_PESSOA = 86539))
//GROUP BY SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO,
// SUPERVISOR.TIPO_LANCAMENTO.DES_TIPO_LANCAMENTO,
// SUPERVISOR.PARCELA.TIP_PARAMETRO,
// SUPERVISOR.PARCELA.COD_PARAMETRO,
// SUPERVISOR.PARCELA.DES_PARCELA,
// SUPERVISOR.lancamento.MES_REFERENCIA,
// SUPERVISOR.lancamento.ANO_REFERENCIA,
// SUPERVISOR.referencia.flg_disponivel_web,
// SUPERVISOR.lancamento.COD_PARCELA
//ORDER BY SUPERVISOR.lancamento.ANO_REFERENCIA DESC,
// SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO,
// SUPERVISOR.lancamento.MES_REFERENCIA DESC,
// SUPERVISOR.lancamento.COD_PARCELA DESC


//
//MEDIA TOTAL
//
//
//
//SELECT DISTINCT TOP 100 PERCENT CASE WHEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_TEORICA_MANUAL IS NULL THEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_TEORICA ELSE supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_TEORICA_MANUAL END AS VAL_NOTA_TEORICA,
// CASE WHEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_PRATICA_MANUAL IS NULL THEN supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_PRATICA ELSE supervisor.ALUNO_X_DISCIPLINA.VAL_NOTA_PRATICA_MANUAL END AS VAL_NOTA_PRATICA,
// CASE WHEN supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA_MANUAL IS NULL THEN IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA, 0) ELSE supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA_MANUAL END AS TOT_FALTA_TEORICA,
// CASE WHEN supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA_MANUAL IS NULL THEN IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA, 0) ELSE supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA_MANUAL END AS TOT_FALTA_PRATICA,
// IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_TEORICA_ABONADA, 0) as TOT_FALTA_TEORICA_ABONADA, IsNull(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_PRATICA_ABONADA, 0) as TOT_FALTA_PRATICA_ABONADA, ISNULL(supervisor.ALUNO_X_DISCIPLINA.TOT_FALTA_MATRICULA_TARDIA, 0) AS TOT_FALTA_MATRICULA_TARDIA,
// IsNull(supervisor.GRADE.QTD_DADAS_TEORICA, 0) as QTD_DADAS_TEORICA, IsNull(supervisor.GRADE.QTD_DADAS_PRATICA, 0) as QTD_DADAS_PRATICA, supervisor.ALUNO_X_DISCIPLINA.COD_STATUS
//FROM supervisor.ALUNO_X_DISCIPLINA INNER JOIN
//supervisor.GRADE ON supervisor.ALUNO_X_DISCIPLINA.COD_TURMA = supervisor.GRADE.COD_TURMA AND
//supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = supervisor.GRADE.COD_DISCIPLINA AND
//supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA_PROFES = supervisor.GRADE.COD_PESSOA AND
//supervisor.ALUNO_X_DISCIPLINA.ANO_LETIVO = supervisor.GRADE.ANO_LETIVO AND
//supervisor.ALUNO_X_DISCIPLINA.COD_PERIODO = supervisor.GRADE.COD_PERIODO
//WHERE (supervisor.ALUNO_X_DISCIPLINA.COD_PESSOA = 86539 )
//AND (supervisor.ALUNO_X_DISCIPLINA.ANO_LETIVO = 2014)
//AND (supervisor.ALUNO_X_DISCIPLINA.COD_TURMA = '5A800')
//AND (supervisor.ALUNO_X_DISCIPLINA.COD_PERIODO = 1)
//AND (supervisor.ALUNO_X_DISCIPLINA.COD_DISCIPLINA = 'G1311')
