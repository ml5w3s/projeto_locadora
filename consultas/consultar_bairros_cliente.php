<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Projeto Locadora</title>
	<link rel='stylesheet' type='text/css' href='../estilos/geral.css'>
</head>
<body>
<h1>Média de locacoes por bairro</h1>
<div class="flex-container">
<div id="box">
<fieldset>
	<table border="1"><tr><th width="50%">Bairro</th><th>Média de valores locados</th></tr>
<?php
include ("../controle/conexao.php");
try{
	$sql = "SELECT b.bairro, AVG(f.valor) FROM cliente c
	INNER JOIN bairro b ON b.cod_bairro=c.bairro_cliente 
	INNER JOIN locacao l ON c.cod_cliente=l.cliente_locacao
	INNER JOIN itens_locacao i ON i.locacao=l.cod_locacao     
	INNER JOIN filme f ON i.filme_locado=f.cod_filme
	GROUP BY b.bairro ORDER BY AVG(f.valor) DESC";
	foreach ($conn->query($sql) as $row) {
	   print "<tr><td>".$row['bairro']."</td>
              <td class='valores' width='25%'>R$ ".number_format($row['AVG(f.valor)'],2,",",".")."</td></tr>";
	}
}catch(PDOException $ex){
	echo 'Erro '. $ex->getMessage();
}
?>
</table><br><a href='http://projeto_locadora'>Voltar</a>
</fieldset></div></div></body></html>