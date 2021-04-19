<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	$titPag = 'Traduzioni e interpretariato | '.$config['titleBase'];
	$traduzioniM = true;
	include('includes/topo.inc.php');
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>images/topo-pagina-belem-para.jpg) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-green py-5">
			<div class="container">
				<h1 class="text-white font-24">Traduzioni Portoghese</h1>
			</div>
		</div>

		<div class="py-5">
			<div class="container py-5"> 
				
                <div class="texto">
					
                    <p><span class="color-blue">Traduzioni portoghese/italiano/portoghese</span></p>
                    <p>I prezzi delle traduzioni di portoghese variano in funzione del volume, dell’urgenza, della complessità lessicale, strutturale e tecnica del testo. Per questo non abbiamo un listino prezzi fisso. Preferiamo prendere visione del documento e fare un preventivo a misura di ogni progetto. I prezzi  sotto indicato sono indicativi.</p>
                    <p>Le tariffe di traduzioni, trascrizioni, revisioni e correzioni sono calcolate a cartella standard. Per “cartella” s’intende la pagina standard internazionale, composta di 1.500 battute spazi inclusi, circa 25 righe e 250 parole. Il conteggio dei caratteri è effettuato sul testo sorgente.</p>

					
					<div class="bloco">
						<p>
							Prezzi a cartella: € 35,00<br />
							Prezzi a parola: € 0,13<br />
							Prezzi a riga:  € 1,12
						</p>

						<p>
							Revisione di testi o correzioni di bozze : 35% della tariffa ordinaria<br />
							Traduzione medico-scientifica: maggiorazione del 16% sul prezzo della traduzione<br />
							Traduzione su lucidi, cartelle con impaginazione o comportanti disegni, tabelle, grafici o formule: maggiorazione del 25% sulla tariffa ordinaria<br />
							Riduzione sulla quantità superiore a 25 cartelle: 5%<br />
							Urgenza: maggiorazione del 30% sulla tariffa ordinaria<br />
						</p>
					</div>
					
					<p><span class="color-blue">L’urgenza</span></p>
					<p>Se non si tratta di un incarico urgente, la norma è di circa 5 cartelle per ogni giorno lavorativo, per cui il calcolo dei giorni lavorativi verrà effettuato sulla base di tale dato. Di norma si definiscono urgenti incarichi che, dal momento del conferimento a quello della scadenza della consegna, prevedano la traduzione di oltre *5 cartelle al giorno, che siano formulati con un preavviso di 24 ore e/o che richiedano l’impegno del traduttore in giorni festivi o prefestivi.</p>
					<p>*Nel caso di traduzione medico-scientifiche, secondo la complessità del testo da tradurre, il numero di cartelle può essere minore.</p>
					<p>Il traduttore deve avere la possibilità di prendere visione del testo da tradurre, completo di eventuali tabelle, grafici e figure.</p>
					
					<p><span class="color-blue">Traduzioni Giurate</span></p>

					<p>L’asseverazione di un documento in Tribunale è conteggiata a parte al prezzo della traduzione.</p>

					<p>Prezzi per l’asseverazione: € 55,00 + marca da bollo di € 16,00 ogni quattro facciate della traduzione.</p>

                </div>

                <div class="form-conteudo pt-5">
                    
                    <button class="border-0 rounded-pill bg-blue font-24 text-white py-1 px-5 mb-4"><span class="px-5">Scrivimi</span></button>
                    
                    <form>
                        <div class="pb-3"><input type="text" placeholder="Nome" class="rounded-pill" /></div>
                        <div class="pb-3"><input type="text" placeholder="E-mail" class="rounded-pill" /></div>
                        <div class="pb-3"><textarea placeholder="Messaggio" ></textarea></div>
                        <div class="d-flex justify-content-end pt-2">
                            <button type="submit" class="border-0 rounded-pill bg-green font-16 py-1 px-5 text-white"><span class="px-5">Invia</span></button>
                        </div>
                    </form>          
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