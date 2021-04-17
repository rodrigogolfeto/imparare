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

		

	</main>
		
<?php
	include('includes/rodape.inc.php');	
?>