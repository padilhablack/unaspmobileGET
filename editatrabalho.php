<?php 
include($_SERVER["DOCUMENT_ROOT"]."/core/login/logado.php");
include($_SERVER['DOCUMENT_ROOT']."/core/database/conexao.php"); 

if(!empty($_GET["id"]))
{
	$_id = $_GET["id"];
	if(!empty($_GET["envia"]))
	{
		if ($_GET["envia"] == "1")
		{
			echo $nome = $_POST["strNome"];
			echo $email = $_POST["strEmail"];
			echo $facul = $_POST["strFaculdade"];
			echo $curso = $_POST["strCurso"];
			echo $status = $_POST["intStatus"];
			
	
		}
	}		
}
else
	header("location:lista.php?erro=1");
	


	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER["DOCUMENT_ROOT"]."/core/head.php"); ?>
</head>

<body>

<DIV id="global">
	
<?php include($_SERVER["DOCUMENT_ROOT"]."/core/topo.php");?>

<?php include($_SERVER["DOCUMENT_ROOT"]."/core/menu.php"); ?>

<div id="main">

	<div class="content">
	
	  	<h2>EDITA TRABALHO</h2>
        
        <?php if ($_GET['msg']) {
			echo "<div class='error'>".$_GET['msg']."</div><br>";
		} ?>
        
        <?php
		/*CONEXAO NESSA VARIAVEL $_SESSION['connection']*/
	
		
		/*INSTRUÇÂO SQL
		SELECT T.strNome,
			   T.strEmail,
			   T.strFaculdade,
			   T.strCurso
		  FROM ENAIC_Trabalho T
		  JOIN ENAIC_Categoria C
			ON C.idCategoria = T.idCategoria
		 WHERE T.intAno = YEAR(GETDATE()) */
		 
		 
		 
		 /*LISTAR OS DADOS TRAZIDOS DO DATABASE*/
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
			<form action="editatrabalho.php?envia=1&id=<?php echo $id?>" method="POST" >
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
					<td><input type="radio" name="intStatus" <?php if($row["intStatus"] == "1") { echo "checked"; } ?> value="1">Aprovado</td>
					<td><input type="radio" name="intStatus" <?php if($row["intStatus"] == "2") { echo "checked"; }?> value="2">Reprovado</td>
					<td><input type="radio" name="intStatus" <?php if($row["intStatus"] == "") { echo "checked"; }?> value="">Em espera</td>
				</tr>
				<tr>
					<td>Arquivo</td>
					<td colspan="3"><a href="http://www.unasp-ec.edu.br/revista/media/ENAIC/<?php echo $row["strArquivo"]; ?>"><?php echo $row["strArquivo"]; ?></a></td>
				</tr>
				<tr>
					<td></td>
					<td align="right" colspan="3"><input type="submit" value="Atualizar">&nbsp; &nbsp;
						<input type="button" value="Excluir" onClick="location = 'lista.php?acao=excluir&id=<?php echo$_id?>'"></td>
				</tr>
			</table>
			</form>
	</div>
   
</div>

<div class="bloc"></div>

</DIV>

</body>
</html>