<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
session_start();
$men = $_POST["MENU"];
$submen = $_POST["SUBMENU"];
$idcate = $_POST["CAT"];
$id = $_POST["ID"];

$medidas = strval($idcate);
$med = explode('.',$medidas);
$men1 = $med[0];
$submen1 = intval($med[1]);

$filtro = '';

if($idcate>0){
	$filtro.= " AND ((rela_pai=".$id." and rela_filho=text_id) OR (rela_filho=".$id." and rela_pai=text_id)) and text_menu_id=".$men1." and text_subm_id=".$submen1;
	$tabelas = "tag3_relacionamentos, tag3_textos";
}else{
	$filtro.= " AND text_menu_id=".$men." and text_subm_id=".$submen;
	$tabelas = "tag3_textos";
}

/*
if($_POST['STATUS']=='a'){
	$ativos_marcado = 'marcado';
	$filtro .= " AND text_status=1";
}else if($_POST['STATUS']=='i'){
	$inativos_marcado = 'marcado';
	$filtro .= " AND text_status=0";
}else{
	$tudo_marcado = 'marcado';
	$filtro .= '';
}
*/

if($_POST['BUSCA']!=''){
	$filtro .= ' AND (text_titulo like "%'.addslashes($_POST['BUSCA']).'%" or text_resumo like "%'.addslashes($_POST['BUSCA']).'%" or text_texto like "%'.addslashes($_POST['BUSCA']).'%" or text_texto2 like "%'.addslashes($_POST['BUSCA']).'%" or text_texto3 like "%'.addslashes($_POST['BUSCA']).'%" or text_texto4 like "%'.addslashes($_POST['BUSCA']).'%" or text_texto5 like "%'.addslashes($_POST['BUSCA']).'%" or text_tags like "%'.addslashes($_POST['BUSCA']).'%" or text_info1 like "%'.addslashes($_POST['BUSCA']).'%" or text_info2 like "%'.addslashes($_POST['BUSCA']).'%" or text_info3 like "%'.addslashes($_POST['BUSCA']).'%" or text_info4 like "%'.addslashes($_POST['BUSCA']).'%" or text_info5 like "%'.addslashes($_POST['BUSCA']).'%")';
}

$conexao = new Conexao();

$resultado = $conexao->consulta("SELECT text_id FROM ".$tabelas." WHERE text_status='1' ".$filtro);
$ativos = $conexao->conta($resultado);

$resultado = $conexao->consulta("SELECT text_id FROM ".$tabelas." WHERE 1=1 ".$filtro);
$total = $conexao->conta($resultado);

$resultado = $conexao->consulta("SELECT text_id FROM ".$tabelas." WHERE text_status='0' ".$filtro);
$inativos = $conexao->conta($resultado);
//echo $filtro;
echo $total.",".$ativos.",".$inativos;

?>