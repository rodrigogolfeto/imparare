<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	
	$metaTitle = $config['titleBase'];
	$metaDescription = (($tot_blog > 0) ? $lin_blog['text_resumo'] : cutHTML(strip_tags($quemsomos_texto),170));
	$metaUrl = $urlSite;
	$metaImage = $config['urlSite'] . 'images/share.png';

	$homeM = ' active';
	include('includes/topo.inc.php');
?>

Contato
		
<?php
	include('includes/rodape.inc.php');	
?>