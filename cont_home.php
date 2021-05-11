<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	
	$metaTitle = $config['titleBase'];
	$metaDescription = (($tot_blog > 0) ? $lin_blog['text_resumo'] : cutHTML(strip_tags($quemsomos_texto),170));
	$metaUrl = $urlSite;
	$metaImage = $config['urlSite'] . 'images/share.png';

	//$homeM = ' active';
	include('includes/topo.inc.php');
?>

<main class="conteudo">

	<?php
	$sql_destaque = "SELECT text_id,text_titulo,imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '1' AND text_subm_id = '24' LIMIT 1";
	$res_destaque = $conn->consulta($sql_destaque);
	$lin_destaque = $conn->busca($res_destaque);
	?>

	<div class="topo-pagina relative" style="background: url(<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin_destaque['imag_arquivo'];?>) no-repeat center bottom;background-size: cover;">
		<div class="container d-flex justify-content-end">
			<div class="introducao texto">
				<h4 class="titulo mb-4">Chi Sono</h4>
				<?=$quemsomos_texto;?>
				<p class="d-block mb-5 pb-5 mb-md-0 pb-md-0">&nbsp;</p>
			</div>
			<div class="acoes d-flex align-items-center justify-content-center">
				<button type="button" class="blog bg-blue text-uppercase"><b>blog</b></button>
				<button type="button" class="livros bg-green text-uppercase"><b>Libri pubblicati</b></button>
			</div>
		</div>
	</div>

	<?php		
		include('./includes/il-portoghese.inc.php');
	?>

	<div class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6 d-flex justify-content-end py-4 py-md-0">
					<a href="il-corsi" class="links-uteis" style="background: url(<?=$config['urlSite']?>images/i-corsi.jpg) no-repeat center bottom;background-size: cover;">
						<div class="d-flex align-items-center justify-content-center">
							<div class="rounded-pill py-2 px-5 font-24 line-height-130"><b>I Corsi</b></div>
						</div>
					</a>
				</div>
				<div class="col-12 col-md-6 d-flex justify-content-start py-4 py-md-0">
					<a href="traduzioni-e-interpretariato" class="links-uteis" style="background: url(<?=$config['urlSite']?>images/traduzioni.jpg) no-repeat center bottom;background-size: cover;">
						<div class="d-flex align-items-center justify-content-center">
							<div class="rounded-pill py-2 px-5 font-24 line-height-130"><b>Traduzioni e interpretariato</b></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	<?php		
		include('./includes/il-brasile.inc.php');
	?>

</main>
		
<?php
	include('includes/rodape.inc.php');	
?>