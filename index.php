<?php

include_once(__DIR__ . "/admin/classes/conexao.php");
$conn = new Conexao();

$urlSite = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

// QUEM SOMOS
$sql_quemsomos = "SELECT text_texto,imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '5' AND text_subm_id = '0' LIMIT 1";
$res_quemsomos = $conn->consulta($sql_quemsomos);
$lin_quemsomos = $conn->busca($res_quemsomos);
$quemsomos_imagem = '<img src="'.$config['urlSite'].'admin/arquivos/imagem/'.$lin_quemsomos['imag_arquivo'].'" alt="Chi Sono" title="Chi Sono" style="float: right;margin: 5px 0 0 20px;display:inline-block;" />';
$quemsomos_texto = $lin_quemsomos['text_texto'];
$quemsomos_texto = str_replace('#imagem_perfil',$quemsomos_imagem,$quemsomos_texto);



if($_SERVER['HTTP_HOST'] == 'imparare.localhost'){
	$s = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
	$gets = array_filter(explode('/', $s));
	$gets = explode('/',implode('/',$gets));
}
else{
	$s = (!empty($_GET['s'])) ? $_GET['s'] : '';
	$gets = explode('/', $s);	
}

$arquivo = $gets[0];

if(file_exists('cont_'.$arquivo.'.php')){
	include 'cont_'.$arquivo.'.php';
}
else if ($gets[0]==''){
	include 'cont_home.php';
}
else{

	$slug = $gets['0'];
	$sql_blog = "SELECT
		text_id,text_data_publicacao,text_titulo,text_resumo,text_texto,(SELECT tag3_imagens.imag_arquivo FROM tag3_imagens WHERE tag3_imagens.imag_text_id = tag3_textos.text_id LIMIT 1) AS imagem,
		(SELECT CONCAT(CAST(slug(artigo.text_titulo) AS CHAR),'|',artigo.text_titulo) FROM tag3_textos AS artigo WHERE artigo.text_menu_id = '21' AND artigo.text_subm_id = '23' AND artigo.text_data_publicacao < tag3_textos.text_data_publicacao AND text_status = '1' ORDER BY text_data_publicacao DESC LIMIT 1) AS anterior_blog,
		(SELECT CONCAT(CAST(slug(artigo.text_titulo) AS CHAR),'|',artigo.text_titulo) FROM tag3_textos AS artigo WHERE artigo.text_menu_id = '21' AND artigo.text_subm_id = '23' AND artigo.text_data_publicacao > tag3_textos.text_data_publicacao AND text_status = '1' ORDER BY text_data_publicacao ASC LIMIT 1) AS proximo_blog
	FROM tag3_textos WHERE text_menu_id = '21' AND text_subm_id = '23' AND text_status = '1' AND slug(text_titulo) = '$slug' LIMIT 1";
	$res_blog = $conn->consulta($sql_blog);
	$tot_blog = $conn->conta($res_blog);
	$lin_blog = $conn->busca($res_blog);

	if($tot_blog>0){

		$anterior_artigo = explode('|',$lin_blog['anterior_blog']);
		$proximo_artigo = explode('|',$lin_blog['proximo_blog']);

		list($anterior_artigo_slug,$anterior_artigo_titulo) = $anterior_artigo;
		list($proximo_artigo_slug,$proximo_artigo_titulo) = $proximo_artigo;
		
		include 'cont_blog.php';
	}
	else include 'cont_home.php';

	
}

?>