<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
session_start();
$conexao = new Conexao();

$html="";
$chave = $_POST['CHAVE'];
$id = $_POST['ID'];

$vetor = explode(".", $_SESSION['imagem_destaque_nome']);
array_pop($vetor);
$nome_arquivo_original = implode("", $vetor);
	
$nome_imagem = str_replace('dest_','final_',$nome_arquivo_original);

if($id!=''){
	$consulta = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_id=".$id); 
	$total = $conexao->conta($consulta);
	$reg = $conexao->busca($consulta);
}else{
	$consulta = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_chave=".$chave);
	$total = $conexao->conta($consulta); 
	$reg = $conexao->busca($consulta);
}

$nome_imagem_final = str_replace('dest_','final_',$reg['imag_arquivo']);
if($total>0){
		$consulta = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_arquivo='".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']."'"); 
		$reg = $conexao->busca($consulta);
		if($reg['imag_id']!=''){
			$consulta = $conexao->consulta("UPDATE tag3_imagens SET imag_arquivo='".slug($nome_imagem)."-".$id.".".$_SESSION['imagem_destaque_tipo']."' WHERE imag_id=".$id); 
			rename("../arquivos/imagem/".$nome_imagem_final, "../arquivos/imagem/".slug($nome_imagem)."-".$id.".".$_SESSION['imagem_destaque_tipo']);
		}else{
			$consulta = $conexao->consulta("UPDATE tag3_imagens SET imag_legenda='".$LEGENDA."', imag_descricao='".$DESCRICAO."', imag_arquivo='".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']."' WHERE imag_id=".$id); 
			rename("../arquivos/imagem/".$nome_imagem_final, "../arquivos/imagem/".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']);
		}
}
$html = "<img src='arquivos/imagem/dest_".$reg['imag_chave'].".".$_SESSION['imagem_destaque_tipo']."' /><div class=\"div-acoes marcado\"><!-- adicionar a classe marcado para apareecer -->
                                            	<a href=\"\" class=\"bt bt-editar tip\" data-toggle=\"modal\" data-target=\"#destaqueModal\" data-placement=\"top\" title=\"Editar\">Editar</a>
                                                <a href=\"\" class=\"bt bt-excluir tip\" data-placement=\"top\" title=\"Excluir\">Excluir</a>
                                            </div><!-- div-editar-excluir -->";
echo $html;
?>