<?php

include '../classes/Database.php';
//
//$raGET = 86539;

$raGET = $_GET['ra'] ;

$sql = mssql_query("
                    SELECT DISTINCT 
                        SUPERVISOR.lancamento.ANO_REFERENCIA, 
                        SUPERVISOR.PARCELA.DES_PARCELA,
                             
                        SUM( CASE  SUPERVISOR.HISTORICO_CONTABIL.COD_TIPO_CONTA WHEN 'D' THEN  SUPERVISOR.DETALHE_LANCAMENTO.VAL_LANCAMENTO ELSE - SUPERVISOR.DETALHE_LANCAMENTO.VAL_LANCAMENTO END ) VALOR, 
                        CONVERT(CHAR(12), MAX( SUPERVISOR.lancamento.DAT_VENCIMENTO ), 103 ) VENCIMENTO 
                    FROM SUPERVISOR.DETALHE_LANCAMENTO,  
                        SUPERVISOR.PARCELA, 
                        supervisor.lancamento, 
                        SUPERVISOR.TIPO_LANCAMENTO, 
                        SUPERVISOR.referencia, 
                        SUPERVISOR.HISTORICO_CONTABIL 
	   
                     WHERE ( SUPERVISOR.lancamento.COD_PARCELA = SUPERVISOR.PARCELA.COD_PARCELA ) and 
                           ( SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO = SUPERVISOR.TIPO_LANCAMENTO.COD_TIPO_LANCAMENTO ) and 
                           ( SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO = SUPERVISOR.referencia.COD_TIPO_LANCAMENTO ) and 
                           ( SUPERVISOR.lancamento.cod_parcela = SUPERVISOR.referencia.cod_parcela ) and 
                           ( SUPERVISOR.lancamento.ano_referencia = SUPERVISOR.referencia.ano_referencia ) and 
                           ( SUPERVISOR.lancamento.mes_referencia = SUPERVISOR.referencia.mes_referencia ) and 
                           ( SUPERVISOR.lancamento.num_lancamento = SUPERVISOR.detalhe_lancamento.num_lancamento ) and 
                           ( SUPERVISOR.referencia.flg_disponivel_web = 1 ) and 
                           ( SUPERVISOR.DETALHE_LANCAMENTO.COD_HISTORICO = SUPERVISOR.HISTORICO_CONTABIL.COD_HISTORICO ) and 
                      ( ( SUPERVISOR.lancamento.COD_PESSOA = ".$raGET."))
	
                    GROUP BY SUPERVISOR.lancamento.COD_TIPO_LANCAMENTO,          
                             SUPERVISOR.PARCELA.DES_PARCELA, 
                             SUPERVISOR.lancamento.ANO_REFERENCIA, 
                             SUPERVISOR.lancamento.COD_PARCELA 
                    ORDER BY SUPERVISOR.lancamento.ANO_REFERENCIA DESC
        ");
$fincancas = array();

while ($row = @mssql_fetch_assoc($sql)) {
    $fincancas[] = $row;
}

for ($i = 0; $i < count($fincancas); $i++) {
    $mostrar = array(
        'ano_referencia' => $fincancas[$i]['ANO_REFERENCIA'],
        'des_parcela' => $fincancas[$i]['DES_PARCELA'],
        'valor' => $fincancas[$i]['VALOR'],
        'vencimento' => $fincancas[$i]['VENCIMENTO'],
    );

 
$array = array_map(utf8_encode,$mostrar);
 echo(json_encode($array) . '</br>');
}

?>

