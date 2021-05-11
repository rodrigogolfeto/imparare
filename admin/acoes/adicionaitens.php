<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();
session_start();
$html="";
$inicio = $_POST['INICIO'];
$fim = $_POST['FIM'];
$filtro = $_POST['FILTRO'];

$consulta = $conexao->consulta("SELECT * FROM tag3_textos WHERE 1=1 $filtro ORDER BY text_data_publicacao DESC LIMIT $inicio, $fim"); 
while($reg = $conexao->busca($consulta)){
	if($reg['text_status']==0){ 
		$classe1 = "bt inativo tip";
		$classe2 = "bt ativo esconde tip";
	}else{
		$classe1 = "bt inativo esconde tip";
		$classe2 = "bt ativo tip";
	}
	$html .= "<li class='dd-item' data-id='".$reg['text_id']."'><span class='sp-drag dd-handle'>&nbsp;</span><div class='div-linha'>";
	if($_SESSION["usuario"]->getFuncao()>0){
		$html .= "<div class='div-cell borda' style='width:5%;'><div class='div-checkbox check'><a  id='acheck".$reg["text_id"]."' href='javascript:checar(".$reg["text_id"].");'></a><input type='checkbox' id='check".$reg["text_id"]."' name='registro[]' value='".$reg["text_id"]."' /></div></div><!-- div-cell -->";
	}
	$html .= "<div class='div-cell' style='width:8%;text-align:center;'>".mostra_data($reg['text_data_publicacao'])."</div><!-- div-cell -->";
	$html .= "<div class='div-cell' style='width:12%;text-align:center;'>..</div><!-- div-cell -->";
	$html .= "</div>";
	if($_SESSION["usuario"]->getFuncao()>0){
		$html .= "<div class='div-cell' style='width:10%;'><div class='div-acao'><a id='i".$reg['text_id']."' href='javascript:mudastatus(".$reg['text_id'].",1);' class='$classe1' data-toggle='tooltip' data-placement='top' title='Ativar'>Inativo</a><a id='a".$reg['text_id']."' href='javascript:mudastatus(".$reg['text_id'].",0);' class='$classe2' data-toggle='tooltip' data-placement='top' title='Ativar'>Ativo</a> <a href='noticias-form.php?id=".$reg['text_id']."&a=".$_GET['a']."&f=".$_GET['f']."&b=".$_GET['b']."&t=".$_GET['t']."&di=".$_GET['di']."&df=".$_GET['df']."' class='bt editar tip' data-toggle='tooltip' data-placement='top' title='Editar'>Editar</a> <a href='javascript:remover(".$reg['not_id'].");' class='bt excluir tip' data-toggle='tooltip' data-placement='top' title='Excluir'>Excluir</a></div><!-- div-acao --></div><!-- div-cell --></div><!-- div-linha -->";	
	}
	$html .= "</li>";
}
//echo $filtro;
echo ($html);
?>