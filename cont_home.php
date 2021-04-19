<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	$titPag = $config['titleBase'];
	//$homeM = ' active';
	include('includes/topo.inc.php');
?>

<main class="conteudo">

	<div class="topo-pagina relative" style="background: url(<?=$config['urlSite']?>images/topo-pagina-home.jpg) no-repeat center bottom;background-size: cover;">
		<div class="container d-flex justify-content-end">

			<div class="introducao texto">
				<h4 class="titulo mb-4">Chi Sono</h4>
				<p>Tradurre testi e mostrare il Brasile attraverso le lezioni di portoghese. Questo progetto nasce nel 2000 dall'esperienza che ho maturato quotidianamente con tutte quelle persone che amano questo grande Paese. E non solo!</p>
				<p>Ad essi si sono ben presto aggiunti coloro che gravitano in altre regioni di lingua portoghese, come il Mozambico e, naturalmente, al Portogallo. Si, perché il portoghese, nonostante le differenze di accento e giusto qualche parola, è uno solo. In più di dieci anni ho visto gli studenti andare nei paesi di lingua portoghese e poi rientrare in Italia soddisfatti e contenti perché sono riusciti a comunicarsi. Da questa esperienza sono nati i libri "Português do Brasil" - Corso di portoghese per italiani edito dalla Hoepli, Eserciziario di Português do Brasil e Tire de Letra! Tutti e tre editi dalla Hoepli.</p>				
				<p>Ho visto avvocati, medici, giornalisti, studenti universitari, portare avanti i loro progetti una volta tradotti dall'italiano <img src="<?=$config['urlSite']?>images/foto.jpg" style="float: right;margin: 5px 0 0 20px;display:inline-block;" /> al portoghese o vice versa. Queste sono le mie più grosse soddisfazioni e il mio lavoro è figlio di questo orgoglio e di questa gioia.</p>				
				<p><b>Eliane Oliveira dos Santos</b></p>
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