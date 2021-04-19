<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	$titPag = 'Opinioni | '.$config['titleBase'];
	$opinioniM = true;
	include('includes/topo.inc.php');
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>images/topo-pagina-cacau.jpg) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-yellow py-5">
			<div class="container">
				<h1 class="font-24">Opinioni</h1>
			</div>
		</div>

		<div class="opinioni py-5">
			<div class="container py-5"> 
				
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