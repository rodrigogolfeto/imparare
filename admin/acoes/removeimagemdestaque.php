<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$id = $_POST['ID'];
$consulta = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_id=".$id);
$reg = $conexao->busca($consulta);
unlink("../arquivos/imagem/".$reg['imag_arquivo']);
unlink("../arquivos/imagem/dest_".$reg['imag_arquivo']);
unlink("../arquivos/imagem/o_".$reg['imag_arquivo']);
$consulta2 = $conexao->consulta("DELETE FROM tag3_imagens WHERE imag_id=".$id);
?>