<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	
	
	$metaTitle = (($tot_blog > 0) ? $lin_blog['text_titulo'] : 'Blog') . ' | '.$config['titleBase'];
	$metaDescription = (($tot_blog > 0) ? cutHTML(strip_tags($lin_blog['text_resumo']),170) : cutHTML(strip_tags($quemsomos_texto),170));
	$metaUrl = $urlSite;
	$metaImage = (($tot_blog > 0 && !empty($lin_blog['imagem'])) ? $config['urlSite'].'admin/arquivos/imagem/' . $lin_blog['imagem'] : $config['urlSite'].'images/share.png');
	
	
	$blogM = true;
	include('includes/topo.inc.php');

	?>

	<main class="conteudo">

		<?php		
		if($tot_blog == 0){
			$sql = "SELECT tag3_imagens.imag_arquivo AS arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '21' AND text_subm_id = '22'";
			$res = $conn->consulta($sql);
			$lin = $conn->busca($res);
			?>
			<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin['arquivo'];?>) no-repeat center bottom;background-size: cover;"></div>
			<div class="bg-blue py-5">
				<div class="container"><h1 class="text-white font-24">Blog</h1></div>
			</div>
			<?php
		}
		?>
		
		<div class="blog py-5">
			<div class="container <?=(($tot_blog==0) ? 'pt-5' : '');?> pb-5">

				<?php
				if ($tot_blog == 0) {
					$sql = "SELECT text_id,text_data_publicacao,text_titulo,slug(text_titulo) AS slug,text_resumo,(SELECT tag3_imagens.imag_arquivo FROM tag3_imagens WHERE tag3_imagens.imag_text_id = tag3_textos.text_id) AS imagem FROM tag3_textos WHERE text_menu_id = '21' AND text_subm_id = '23' AND text_status = '1' AND text_data_publicacao <= NOW() ORDER BY text_data_publicacao DESC";
					$res = $conn->consulta($sql);
					while($lin=$conn->busca($res)){
						?>
						<div class="item">
							<div class="texto">
								<?php if(!empty($lin['imagem'])){ ?><p><a href="<?=$lin['slug'];?>"><img src="<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin['imagem'];?>" title="<?=$lin['text_titulo'];?>" alt="<?=$lin['text_titulo'];?>" /></a></p><?php } ?>
								<a href="<?=$lin['slug'];?>" class="mb-1 d-block"><p><h2 class="color-green font-24 mb-0 pb-0"><?=$lin['text_titulo'];?></h2></p></a>
								<a href="<?=$lin['slug'];?>" class="mb-4 d-inline-block"><p class="text-black-50 fw-bold font-14 pb-0 d-inline-block">Publicado em <?=date('d/m/Y H:i',strtotime($lin['text_data_publicacao']));?></p></a>
								<p><?=$lin['text_resumo'];?></p>
							</div>
						</div><!-- item -->
						<?php
					}
				} else {
					?>
					<div class="item">
						<div class="texto">
							
							<h2 class="color-green font-24 mt-4 mb-4 pb-0"><?=$lin_blog['text_titulo'];?></h2>
							<p class="text-black-50 fw-bold font-14 pb-0 mb-1">Publicado em <?=date('d/m/Y H:i',strtotime($lin_blog['text_data_publicacao']));?></p>
							<hr class="text-black-50" />
							<?php if(!empty($lin_blog['imagem'])){ ?><p><img src="<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin_blog['imagem'];?>" alt="<?=$lin_blog['text_titulo'];?>" title="<?=$lin_blog['text_titulo'];?>" /></p><?php } ?>
							<p><?=$lin_blog['text_texto'];?></p>

							<div class="row">								
								<div class="col-12 col-md-6 text-center line-height-100 text-md-start mb-4"><?=((!empty($anterior_artigo_slug)) ? '<a href="'.$anterior_artigo_slug.'" class="color-green font-14">« '.$anterior_artigo_titulo.'</a>' : '');?></div>
								<div class="col-12 col-md-6 text-center line-height-100 text-md-end mb-4"><?=((!empty($proximo_artigo_slug)) ? '<a href="'.$proximo_artigo_slug.'" class="color-green font-14">'.$proximo_artigo_titulo.' »</a>' : '');?></div>
							</div>
						</div>
					</div><!-- item -->
					
					<?php
				}

				/*
				?>
				<div class="item">
					<div class="texto">
						<p><img src="<?=$config['urlSite']?>images/imagem6.jpg" /></p>
						<p><h2 class="color-green font-24 mb-0 pb-0">Título</h2></p>
						<p>Maecenas vitae ante ac velit varius tempus non non turpis. Ut venenatis varius nisl eget accumsan. Maecenas auctor eros eget nisi malesuada ornare. Morbi eu ex quis tortor lacinia cursus ac id leo. Suspendisse varius est magna, sit amet semper felis mollis in. Nulla facilisi. Suspendisse nisl erat, pulvinar non ipsum id, scelerisque porta eros.</p>
					</div>
				</div><!-- item -->

				<div class="item">
					<div class="texto">
						<p><img src="<?=$config['urlSite']?>images/imagem6.jpg" /></p>
						<p><h2 class="color-green font-24 mb-0 pb-0">Título</h2></p>
						<p>Maecenas vitae ante ac velit varius tempus non non turpis. Ut venenatis varius nisl eget accumsan. Maecenas auctor eros eget nisi malesuada ornare. Morbi eu ex quis tortor lacinia cursus ac id leo. Suspendisse varius est magna, sit amet semper felis mollis in. Nulla facilisi. Suspendisse nisl erat, pulvinar non ipsum id, scelerisque porta eros.</p>
					</div>
				</div><!-- item -->
				*/

				?>

			</div>
		</div>

	</main>
		
<?php
	include('includes/rodape.inc.php');	
?>