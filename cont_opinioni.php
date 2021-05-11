<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	
	
	$metaTitle = 'Opinioni | '.$config['titleBase'];
	$metaDescription = (($tot_blog > 0) ? $lin_blog['text_resumo'] : cutHTML(strip_tags($quemsomos_texto),170));
	$metaUrl = $urlSite;
	$metaImage = $config['urlSite'] . 'images/share.png';
	
	
	$opinioniM = true;
	include('includes/topo.inc.php');

	$sql = "SELECT imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '17' AND text_subm_id = '18' LIMIT 1";
	$res = $conn->consulta($sql);
	$lin = $conn->busca($res);
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin['imag_arquivo'];?>) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-yellow py-5">
			<div class="container">
				<h1 class="font-24">Opinioni</h1>
			</div>
		</div>

		<div class="opinioni py-5">
			<div class="container py-5">

				<?php

				$sql = "SELECT text_id,text_titulo,text_texto FROM tag3_textos WHERE text_menu_id = '17' AND text_subm_id = '19' AND text_status = '1' ORDER BY text_ordem ASC";
				$res = $conn->consulta($sql);
				while($lin=$conn->busca($res)){
					?>
					<div class="item-wrapper">
						<div class="item texto mb-5">
							<?=$lin['text_texto']?>
							<p><b><?=$lin['text_titulo'];?></b></p>
						</div>
					</div>
					<?php
				}
				
				/*
                <div class="item-wrapper">
                    <div class="item texto mb-5">
                        <p>Maecenas vitae ante ac velit varius tempus non non turpis. Ut venenatis varius nisl eget accumsan. Maecenas auctor eros eget nisi malesuada ornare. Morbi eu ex quis tortor lacinia cursus ac id leo. Suspendisse varius est magna, sit amet semper felis mollis in. Nulla facilisi. Suspendisse nisl erat, pulvinar non ipsum id, scelerisque porta eros.</p>
                        <p><b>Mariana Medeiros</b></p>
                    </div>
                </div>
                
                <div class="item-wrapper">
                    <div class="item texto mb-5">
                        <p>Maecenas vitae ante ac velit varius tempus non non turpis. Ut venenatis varius nisl eget accumsan. Maecenas auctor eros eget nisi malesuada ornare. Morbi eu ex quis tortor lacinia cursus ac id leo. Suspendisse varius est magna, sit amet semper felis mollis in. Nulla facilisi. Suspendisse nisl erat, pulvinar non ipsum id, scelerisque porta eros.</p>
                        <p><b>Mariana Medeiros</b></p>
                    </div>
                </div>

                <div class="item-wrapper">
                    <div class="item texto mb-5">
                        <p>Maecenas vitae ante ac velit varius tempus non non turpis. Ut venenatis varius nisl eget accumsan. Maecenas auctor eros eget nisi malesuada ornare. Morbi eu ex quis tortor lacinia cursus ac id leo. Suspendisse varius est magna, sit amet semper felis mollis in. Nulla facilisi. Suspendisse nisl erat, pulvinar non ipsum id, scelerisque porta eros.</p>
                        <p><b>Mariana Medeiros</b></p>
                    </div>
                </div>
				*/

				?>
                
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