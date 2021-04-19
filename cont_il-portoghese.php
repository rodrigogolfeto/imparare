<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	$titPag = 'Il Portoghese | '.$config['titleBase'];
	$ilportogheseM = true;
	include('includes/topo.inc.php');
?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>images/topo-pagina-tucano.jpg) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-blue py-5">
			<div class="container">
				<h1 class="text-white font-24">Il Portoghese</h1>
			</div>
		</div>

		<div class="py-5">
			<div class="container py-5">
				<div class="texto">
					<p>Il portoghese è il sesto idioma più parlato al mondo dopo il cinese, lo spagnolo, l’inglese, il bengali e hindi. Tra le lingue europee, è addirittura la terza dopo inglese e spagnolo. Il portoghese, inoltre, è la lingua ufficiale di otto Paesi in quattro continenti: Portogallo, Capo Verde, Guinea-Bissau, São Tomè e Príncipe, Mozambico, Angola, Brasile, Timor Est; ma anche nelle regioni di Macao (territorio speciale d’oltremare, appartenente alla Cina), Goa (in India) e Galizia (Spagna).</p>
					<p>E non solo. E’anche la lingua scelta da 12 organizzazioni internazionali per la comunicazione. Nonostante ciò, è una lingua ancora tutta da scoprire e manifesta segnali di crescita ogni giorno. In Africa, per esempio, soprattutto nell’emisfero Sud, si registra un incremento dell’insegnamento di portoghese come lingua ufficiale nei Paesi che fanno parte del SADC (Comunidade de Desenvolvimento da Africa Austral). Un andamento simile si verifica anche nell’Africa Occidentale, soprattutto in Senegal.</p>
					<p>In America del Sud la creazione del “Mercosul” (l´Unione Doganale di Brasile, Argentina, Paraguay e Uruguay) ha portato una crescita dello studio del portoghese in Argentina, Uruguay e Paraguay. Grazie alle enormi dimensioni del Brasile, poi, con i suoi, circa, 170 milioni di abitanti, il Continente resta il luogo al mondo dove il portoghese è maggiormente parlato.</p>
					<p>In Africa l’idioma  ha una tradizione antichissima. I portoghesi furono i primi a esplorarne la costa e nel 1460 costruirono il loro primo forte ad Arguin, in Mauritania. Quindi, nel 1482, fu la volta del castello di São Jorge de la Mina nella Costa de Oro, l’attuale Ghana. In generale la lingua fu parlata lungo tutta la costa durante il quindicesimo e sedicesimo secolo. Oggi è la lingua ufficiale in Mozambico, Angola, Sao Tomè, Guinea Bissau e Isole di Capo Verde. Una sua variante creola viene utilizzata in Senegal e Guinea Equatoriale, e una grossa comunità di lingua portoghese risiede in Sud Africa. Il portoghese ha influenzato perfino la lingua Swahili, usata oggi lungo la costa est dell’Africa. In questo idioma si contano circa 120 parole di origine portoghese.</p>
					<p>Anche in Asia la lingua ha una lunga tradizione, dovuta sia agli scambi commerciali sia all’espansione coloniale del Portogallo. Oggi esistono piccole e grandi comunità che parlano la lingua portoghese a Malacca, Goa, Korlai, Damão, Ceylon, Macao, Hong Kong, Goa, Diu, Timor Est, Isole Flores.</p>
					<p>ll portoghese è un idioma che ha la plasticità per descrivere realtà cosi diverse come l’europea, l’africana, la sudamericana e l’asiatica. Disseminata per il mondo si evolve, si trasforma, si arricchisce continuamente con nuove parole e nuovi concetti. Se nessuna capitale dei paesi lusofoni si considera padrona della lingua, tutte in qualche modo si sentono legate dalla coscienza di appartenere ad un universo di punti di riferimento comuni.</p>
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