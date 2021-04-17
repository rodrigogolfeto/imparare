<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	$titPag = 'Libri Pubblicati | '.$config['titleBase'];
	$libriM = true;
	include('includes/topo.inc.php');
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>images/topo-pagina-arara-azul.jpg) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-yellow py-5">
			<div class="container">
				<h1 class="font-24">Libri Pubblicati</h1>
			</div>
		</div>

		<div class="libri-pubblicati pt-5 pb-3">
			<div class="container pt-5 pb-3"> 
				
                <div class="texto pb-5">
					<p>Dalla mia lunga esperienza insegnando il portoghese sono nati tre libri pensati specificamente per gli italiani che desiderano imparare il portoghese del Brasile. Sono tutte e tre  editi dalla Hoepli Editore. Partendo dal presupposto che da adulti si impara un idioma rapportandosi costantemente alla propria lingua, i volumi presentano ogni tema grammaticale considerando le peculiarità di apprendimento di uno studente italiano nei con onti del portoghese.</p>
                </div>

                <div class="item d-flex align-items-end">
                    <a href="" class="foto"><div style="background: url(<?=$config['urlSite']?>images/imagem3.jpg) no-repeat center bottom;"></div></a>
                    <div class="descricao">
                        <h2 class="font-14 color-blue">“Português do Brasil<br />– corso per italiani”</h2>
                        <div class="font-14 texto">Il primo libro è stato “Português do Brasil – corso per italiani”, livello A1-B1 del Quadro Comune Europeo di Riferimento per le Lingue. Il libro si struttura in 19 capitoli. Ognuno presenta un testo iniziale attraverso il quale grammatica e lessico relativi con numerosi esercizi di diversa tipologia. Ogni capitolo riporta, inoltre, degli aspetti del linguaggio vivo con le sue espressioni idiomatiche. Compreso nel volume ci sono due CD audio e le risposte degli esercizi possono essere scaricate sul sito dell’editore nella pagina dedicata al libro.</div>
                    </div>
                </div>

                <div class="item d-flex align-items-end">
                    <a href="" class="foto"><div style="background: url(<?=$config['urlSite']?>images/imagem4.jpg) no-repeat center bottom;"></div></a>
                    <div class="descricao">
                        <h2 class="font-14 color-blue">“L’Eserciziario di Português do Brasil”</h2>
                        <div class="font-14 texto">L’Eserciziario di Português do Brasil (livello A1-B1 del Quadro Comune Europeo di Riferimento per le Lingue) ha 17 capitoli e oltre a proporre svariati esercizi di grammatica presenta un ampio lessico che permette allo studente di sviluppare le capacità di comunicare in determinate situazioni o luoghi, come chiedere informazioni, comprare un capo d’abbligliamento in un negozio, instaurare un dialogo in un ristorante, ecc… È utilizzabile in abbinamento a “Português do Brasil – corso per italiani” o a qualsiasi corso di lingua portoghese.</div>
                    </div>
                </div>

                <div class="item d-flex align-items-end">
                    <a href="" class="foto"><div style="background: url(<?=$config['urlSite']?>images/imagem5.jpg) no-repeat center bottom;"></div></a>
                    <div class="descricao">
                        <h2 class="font-14 color-blue">“Tire de Letra!”</h2>
                        <div class="font-14 texto">Tire de Letra! (livello A1 del Quadro Comune Europeo di Riferimento per le Lingue è una guida per principianti assoluti della lingua portoghese e fa parte di una collana di libri, livello A1, della Hoepli Editore. In volume si articola in 52 brevi lezioni in cui sono spiegate in modo molto semplice le regole fondamentali della grammatica di base. È adatto anche allo studio come autodidatta. Tutti i dialoghi in audio sono disponibili per il download nella pagina dedicata della Hoepli.</div>
                    </div>
                </div>
                
			</div>
		</div>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-flex justify-content-end">
                        <a href="il-corsi" class="links-uteis" style="background: url(<?=$config['urlSite']?>images/i-corsi.jpg) no-repeat center bottom;background-size: cover;">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="rounded-pill py-2 px-5 font-24 line-height-130"><b>I Corsi</b></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 d-flex justify-content-start">
                        <a href="traduzioni-e-interpretariato" class="links-uteis" style="background: url(<?=$config['urlSite']?>images/traduzioni.jpg) no-repeat center bottom;background-size: cover;">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="rounded-pill py-2 px-5 font-24 line-height-130"><b>Traduzioni e interpretariato</b></div>
                            </div>
                        </a>
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