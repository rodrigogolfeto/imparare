<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	$titPag = 'Il Corsi | '.$config['titleBase'];
	$ilcorsiM = true;
	include('includes/topo.inc.php');
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>images/topo-pagina-bonito-ms.jpg) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-green py-5">
			<div class="container">
				<h1 class="text-white font-24">I Corsi di Portoghese</h1>
			</div>
		</div>

		<div class="ilcorsi py-5">
			<div class="container py-5"> 
				
                <div class="texto">
					<p>Per il corso di portoghese e cultura brasiliana  ”tradizionale” le lezioni si svolgono a Milano. Invece, per chi ha problemi di spostamenti o vive fuori Milano, si può studiare il portoghese online.  Il programma del corso è pensato  appositamente per gli italiani. Con gli studenti che vogliono raggiungere il livello B1 si studia su due dei miei libri, entrambi editi dalla Hoepli:  “Português do Brasil” – corso per italiani e Eserciziario di Português do Brasil.</p>
                    <p>Invece, con gli studenti che hanno fretta di imparare e vogliono arrivare ad un livello A1 della lingua portoghese, si studia sul libro Tire de Letra! (Hoepli -2020).   Tutte e tre i libri nascono dalle mie lezioni, dalla esperienza che ho maturato insegnando il mio idioma in Italia. Affronta tutti gli argomenti grammaticali tenendo conto delle difficoltà di apprendimento più comuni di uno studente italiano nei confronti della lingua portoghese.</p>
                    
                    <p><img src="<?=$config['urlSite']?>images/imagem.jpg" title="" alt="" /></p>

                    <p>
                        <span class="color-blue">Struttura delle lezioni private di portoghese</span><br />
                        • grammatica, sintassi e fonetica del portoghese brasiliano<br />
                        • lettura di testi vari in portoghese, adeguati al livello degli alunni;<br />
                        • curiosità  e somiglianze del vocabolario portoghese brasiliano/ italiano;<br />
                        • traduzione di testi dall’italiano al portoghese;<br />
                        • ascolto di brani musicali come mezzo per sviluppare il vocabolario, imparare delle nuove espressioni e conoscere la cultura brasiliana;<br />
                        • proiezione di film e documentari in lingua originale accompagnati  da un studio del vocabolario del film e da tutte le informazioni sul regista, la sceneggiatura e gli attori;<br />
                        • analisi delle differenze che intercorrono tra il portoghese del Brasile e quello del Portogallo
                    </p>

                    <p>
                        <span class="color-blue">Modalità  del corso di portoghese</span>
                        Flessibilità ! É questo il grande vantaggio di fare lezione in privato. Il corso si basa esclusivamente su lezioni personalizzate che permettono di imparare il portoghese in base alla propria disponibilità di tempo, alle necessità  e alle capacità  di ciascuno, rispettando soprattutto il ritmo di apprendimento dell’allievo.
                    </p>

                    <p>Prima  di decidere fatte  una lezione di prova.</p>
                    
                    <p>
                        <span class="color-blue">Vantaggi principali</span><br />
                        Una lezione di prova prima di decidere<br />
                        Flessibilità  di orario e di metodo<br />
                        Non solo grammatica di portoghese, ma anche musica, cinema e cultura del Brasile.
                    </p>

                    <p>Per chi, invece, volesse fare lezione ogni tanto c’è la formula “Portoghese quando vuoi, come vuoi.”</p>

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