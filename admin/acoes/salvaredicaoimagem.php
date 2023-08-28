<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
session_start();
$conexao = new Conexao();

$html="";
$chave = $_POST['CHAVE'];
$id = $_POST['IDIMAGEM'];
$legenda = $_POST['LEGENDA'];
$descricao = $_POST['DESCRICAO'];

$consulta = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_arquivo!='' AND imag_chave='".$chave."'"); 
$temimg = $conexao->conta($consulta);
$regimg = $conexao->busca($consulta);
$imagem_banco = $regimg['imag_arquivo'];

if($temimg!=0){
	if($_SESSION['imagem_destaque_nome']!=""){
		if(file_exists("../arquivos/imagem/dest_".$chave.".".$_SESSION['imagem_destaque_tipo'])){
			$vetor = explode(".", $_SESSION['imagem_destaque_nome']);
			array_pop($vetor);
			$nome_arquivo_original = implode("", $vetor);
				
			$nome_imagem = str_replace('dest_','final_',$nome_arquivo_original);
			
			$consulta = $conexao->consulta("UPDATE tag3_imagens SET imag_legenda='".$legenda."', imag_descricao='".$descricao."', imag_arquivo='".$regimg['imag_id']."-".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']."' WHERE imag_chave='".$chave."'"); 
			
			rename("../arquivos/imagem/final_".$chave.".".$_SESSION['imagem_destaque_tipo'], "../arquivos/imagem/".$regimg['imag_id']."-".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']);
			rename("../arquivos/imagem/dest_".$chave.".".$_SESSION['imagem_destaque_tipo'], "../arquivos/imagem/dest_".$regimg['imag_id']."-".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']);
			rename("../arquivos/imagem/o_".$chave.".".$_SESSION['imagem_destaque_tipo'], "../arquivos/imagem/o_".$regimg['imag_id']."-".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']);
			
			if($_SESSION['imagem_anterior_banco']!='' && file_exists("../arquivos/imagem/".$_SESSION['imagem_anterior_banco'])){
				unlink("../arquivos/imagem/".$_SESSION['imagem_anterior_banco']);
			}
			if($_SESSION['imagem_anterior_banco']!='' && file_exists("../arquivos/imagem/dest_".$_SESSION['imagem_anterior_banco'])){
				unlink("../arquivos/imagem/dest_".$_SESSION['imagem_anterior_banco']);
			}
			if($_SESSION['imagem_anterior_banco']!='' && file_exists("../arquivos/imagem/o_".$_SESSION['imagem_anterior_banco'])){
				unlink("../arquivos/imagem/o_".$_SESSION['imagem_anterior_banco']);
			}
			$imnfo = @getimagesize('arquivos/imagem/dest_'.$regimg['imag_id'].'-'.slug($nome_imagem).'.'.$_SESSION['imagem_destaque_tipo']); 
			$larg = 250;
			if($imnfo[0]<250){
				$larg = $imnfo[0];
			}
			$html = "<img src='arquivos/imagem/dest_".$regimg['imag_id']."-".slug($nome_imagem).".".$_SESSION['imagem_destaque_tipo']."' style=\"display:block;\" width=\"".$larg."\" /><div class=\"div-acoes marcado\"><!-- adicionar a classe marcado para apareecer -->
															<a href=\"\" class=\"bt bt-editar tip\" data-toggle=\"modal\" data-target=\"#destaqueModal\" data-placement=\"top\" title=\"Editar\">Editar</a>
															<a href=\"javascript:excluirImagemDestaque(".$regimg['imag_id'].");\" class=\"bt bt-excluir tip\" data-placement=\"top\" title=\"Excluir\">Excluir</a>
														</div><!-- div-editar-excluir -->";
		}else{
			$html = "sem corte";
		}
	}else{
		$consulta = $conexao->consulta("UPDATE tag3_imagens SET imag_legenda='".$legenda."', imag_descricao='".$descricao."' WHERE imag_chave='".$chave."'"); 
		$html = "<img src='arquivos/imagem/".$imagem_banco."' style=\"display:block;\" width=\"".$larg."\" /><div class=\"div-acoes marcado\"><!-- adicionar a classe marcado para apareecer -->
															<a href=\"\" class=\"bt bt-editar tip\" data-toggle=\"modal\" data-target=\"#destaqueModal\" data-placement=\"top\" title=\"Editar\">Editar</a>
															<a href=\"javascript:excluirImagemDestaque(".$id.");\" class=\"bt bt-excluir tip\" data-placement=\"top\" title=\"Excluir\">Excluir</a>
														</div><!-- div-editar-excluir -->";
	}
}else{
	$html = 'sem imagem';
}
echo $html;
?>