<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	
	$metaTitle = 'Il Brasile | '.$config['titleBase'];
	$metaDescription = (($tot_blog > 0) ? $lin_blog['text_resumo'] : cutHTML(strip_tags($quemsomos_texto),170));
	$metaUrl = $urlSite;
	$metaImage = $config['urlSite'] . 'images/share.png';

	$ilbrasileM = true;
	include('includes/topo.inc.php');

	$sql = "SELECT text_resumo,text_texto,text_texto2,tag3_imagens.imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '13' AND text_subm_id = '0'";
	$res = $conn->consulta($sql);
	$lin = $conn->busca($res);
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin['imag_arquivo'];?>) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-yellow py-5">
			<div class="container">
				<h1 class="font-24">Il Brasile</h1>
			</div>
		</div>

		<div class="py-5">
			<div class="container py-5">
                <div class="texto"><?=$lin['text_texto2'];?></div>               
			</div>
		</div>

		<?php	
			$detalheAtive = true;
			$darken = true; 	
			include('./includes/il-portoghese.inc.php');
		?>

	</main>
		
<?php
	include('includes/rodape.inc.php');	
?>