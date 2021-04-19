<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	$titPag = 'Blog | '.$config['titleBase'];
	$blogM = true;
	include('includes/topo.inc.php');
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>images/topo-pagina-onca.jpg) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-blue py-5">
			<div class="container">
				<h1 class="text-white font-24">Blog</h1>
			</div>
		</div>

		<div class="blog py-5">
			<div class="container py-5">

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

			</div>
		</div>

	</main>
		
<?php
	include('includes/rodape.inc.php');	
?>