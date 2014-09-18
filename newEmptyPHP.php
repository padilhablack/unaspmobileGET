<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/login/logado.php");
include($_SERVER['DOCUMENT_ROOT'] . "/core/database/conexao.php");

if (!empty($_GET["id"])) {
    $_id = $_GET["id"];
    if (!empty($_GET["envia"])) {
        if ($_GET["envia"] == "1") {
            $nome = $_POST["strNome"];
            $email = $_POST["strEmail"];
            $facul = $_POST["strFaculdade"];
            $curso = $_POST["strCurso"];
            $status = $_POST["intStatus"];


            $sql = "UPDATE ENAIC_Trabalho
                            SET  strNome = '$nome',
		strEmail = '$email',
						   strFaculdade = '$facul',
						   strCurso = '$curso',
						   intStatus = '$status'
					 WHERE idTrabalho = $_id";

            mssql_query($sql, $_SESSION['connection']);

            if ($_POST["statusAnterior"] != $status) {
                $statusDesc = "";
                switch ($status) {
                    case 1:
                        $statusDesc = 'Aprovado';
                        break;

                    case 2:
                        $statusDesc = 'Rejeitado';
                        break;

                    default:
                        $statusDesc = 'Em andamento';
                        break;
                }

                $from = 'noreply@unasp-ec.com';
                $to = $email;
                $headers = "From: ENAIC 2014 <noreply@unasp-ec.com>\r\n";
                $headers .= "MIME-Version: 1.0\n";
                $headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
                $headers .= sprintf('Return-Path: %s%s', $from, PHP_EOL);
                $headers .= sprintf('Reply-To: %s%s', $from, PHP_EOL);
                $headers .= sprintf('X-Priority: %d%s', 3, PHP_EOL);
                $headers .= sprintf('X-Mailer: PHP/%s%s', phpversion(), PHP_EOL);
                $headers .= sprintf('Disposition-Notification-To: %s%s', $from, PHP_EOL);
                $subject = utf8_decode('ENAIC 2014' .$assunto);
                $assunto = 'UNASP - EC | ENAIC 2014';
                $corpo = '
				<html>
				<body>
				<h1>Trabalho Moderado!</h1>
				<p>
				<b>Olá ' . $nome . '</b>
				</p>
				<p>
				Seu trabalho foi moderado e o status foi alterado para: <b>' . $statusDesc . '</b>
				';

                if ($status == 2) {
                    $corpo = $corpo . " <br />Verifique as normas e tente nova inscrição até dia 10/10/2014.";
                }

                $corpo = $corpo . '
				
				</p>
				<p>
				Att.<br />
				Coordena&ccedil;&atilde;o de Pesquisa<br />
				UNASP - Engenheiro Coelho
				</body>
				</html>
				';

                if (mail($to, $subject, $mensagem, $headers)) {
                    //header("location:lista.php?acao=atualizado");
                    header("location:http://www.google.com.br");
                } else {
                    header("location:http://www.globoesporte.com");
                }
            }

            header("location:lista.php?acao=atualizado");
            exit();
        }
    }
} else
    header("location:lista.php?erro=1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
    </head>

    <body>

        <DIV id="global">

<?php include($_SERVER["DOCUMENT_ROOT"] . "/core/topo.php"); ?>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/core/menu.php"); ?>

            <div id="main">

                <div class="content">

                    <h2>EDITA TRABALHO</h2>

<?php
if ($_GET['msg']) {
    echo "<div class='error'>" . $_GET['msg'] . "</div><br>";
}
?>

<?php
/* CONEXAO NESSA VARIAVEL $_SESSION['connection'] */


/* INSTRUÇÂO SQL
  SELECT T.strNome,
  T.strEmail,
  T.strFaculdade,
  T.strCurso
  FROM ENAIC_Trabalho T
  JOIN ENAIC_Categoria C
  ON C.idCategoria = T.idCategoria
  WHERE T.intAno = YEAR(GETDATE()) */



/* LISTAR OS DADOS TRAZIDOS DO DATABASE */
?>

                    <?php
                    $rs_enaic = mssql_query(
                            "SELECT T.idTrabalho,
				    T.strNome,
					T.strEmail,
					T.strFaculdade,
					T.strCurso,
					T.intStatus,
					T.strArquivo
				FROM ENAIC_Trabalho T
				JOIN ENAIC_Categoria C
				ON C.idCategoria = T.idCategoria
				WHERE T.idTrabalho = $_id ", $_SESSION['connection']);

                    $row = mssql_fetch_assoc($rs_enaic);
                    ?>
                    <form action="editatrabalho.php?envia=1&id=<?php echo $id ?>" method="POST" >
                        <input type="hidden" name="statusAnterior" value="<?php echo $row["intStatus"]; ?>">
                            <table>
                                <tr>
                                    <td>Nome</td>
                                    <td colspan="3"><input type="text" name="strNome" size="50px" value="<?php echo $row["strNome"]; ?>"></td>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td colspan="3"><input type="text" name="strEmail" size="50px" value="<?php echo $row["strEmail"]; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Faculdade</td>
                                    <td colspan="3"><input type="text" name="strFaculdade" size="50px" value="<?php echo $row["strFaculdade"]; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Curso</td>
                                    <td colspan="3"><input type="text" name="strCurso" size="50px" value="<?php echo $row["strCurso"]; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><input type="radio" name="intStatus" <?php if ($row["intStatus"] == "1") {
                        echo "checked";
                    } ?> value="1">Aprovado</td>
                                    <td><input type="radio" name="intStatus" <?php if ($row["intStatus"] == "2") {
                        echo "checked";
                    } ?> value="2">Reprovado</td>
                                    <td><input type="radio" name="intStatus" <?php if ($row["intStatus"] == "") {
                        echo "checked";
                    } ?> value="">Em espera</td>
                                </tr>
                                <tr>
                                    <td>Arquivo</td>
                                    <td colspan="3"><a href="http://www.unasp-ec.edu.br/revista/media/ENAIC/<?php echo $row["strArquivo"]; ?>"><?php echo $row["strArquivo"]; ?></a></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right" colspan="3"><input type="submit" value="Atualizar">&nbsp; &nbsp;
                                            <input type="button" value="Excluir" onClick="location = 'lista.php?acao=excluir&id=<?php echo$_id ?>'"></td>
                                                </tr>
                                                </table>
                                                </form>
                                                </div>

                                                </div>

                                                <div class="bloc"></div>

                                                </DIV>

                                                </body>
                                                </html>