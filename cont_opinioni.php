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

        <div class="cmdetalhe bg-blue darken py-5">
			<div class="container py-5">
				<h4 class="titulo text-white pb-3">Il Portoghese</h4>
				<div class="texto font-16 text-white">Il portoghese è il sesto idioma più parlato al mondo dopo il cinese, lo spagnolo, l’inglese, il bengali e hindi. Tra le lingue europee, è addirittura la terza dopo inglese e spagnolo. Il portoghese, inoltre, è la lingua ufficiale di otto Paesi in quattro continenti: Portogallo, Capo Verde, Guinea-Bissau, São Tomè e Príncipe, Mozambico, Angola, Brasile, Timor Est; ma anche nelle regioni di Macao (territorio speciale d’oltremare, appartenente alla Cina), Goa (in India) e Galizia (Spagna).</div>
				<div class="d-flex justify-content-end pt-2 px-3">
					<a href="il-portoghese" class="bg-yellow btn-mais">+</a>
				</div>
			</div>
		</div>

	</main>
		
<?php
	include('includes/rodape.inc.php');	
?>