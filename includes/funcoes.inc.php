<?php
	
    #############################################################################
    // REDES SOCIAIS
    #############################################################################
    $sql_redes_sociais = "SELECT text_info1,text_info2,text_info3,text_info4 FROM tag3_textos WHERE text_menu_id = '1' AND text_subm_id = '3' LIMIT 1";
    $res_redes_sociais = $conn->consulta($sql_redes_sociais);
    $lin_redes_sociais = $conn->busca($res_redes_sociais);    
    $configuracoes_social_media_label           = $lin_redes_sociais['text_info1'];
    $configuracoes_social_media_facebook        = $lin_redes_sociais['text_info2'];
    $configuracoes_social_media_instagram       = $lin_redes_sociais['text_info3'];
    $configuracoes_social_media_youtube         = $lin_redes_sociais['text_info4'];
    #############################################################################


    #############################################################################
    // RODAPÉ
    #############################################################################
    $sql_texto_contato = "SELECT text_texto FROM tag3_textos WHERE text_menu_id = '1' AND text_subm_id = '4' LIMIT 1";
    $res_texto_contato = $conn->consulta($sql_texto_contato);
    $lin_texto_contato = $conn->busca($res_texto_contato);
    $configuracoes_texto_contato = $lin_texto_contato['text_texto'];
    #############################################################################
    
    
    #############################################################################
    // IMAGENS DO RODAPÉ
    #############################################################################
    $sql_imagens_rodape = "SELECT text_id,text_titulo,imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '1' AND text_subm_id = '2' AND text_status = '1' ORDER BY text_ordem ASC";
    #############################################################################
    

    ####################################################################################################################################################################
	//FUNÇÃO CORTA CARACTERES
	####################################################################################################################################################################
	function cutHTML($text,$length=100,$ending='...',$cutWords=false,$considerHtml=false) {
		if($considerHtml){
			if(strlen(preg_replace('/<.*?>/', '', $text)) <= $length) { // se o texto for mais curto que $length, retornar o texto na totalidade
				return $text;
			}
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);// separa todas as tags html em linhas pesquisáveis
			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';
			foreach ($lines as $line_matchings) {
				if (!empty($line_matchings[1])) { // se existir uma tag html nesta linha, considerá-la e adicioná-la ao output (sem contar com ela)
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) { // se for um "elemento vazio" com ou sem barra de auto-fecho xhtml (ex. <br />)
						// não fazer nada // se a tag for de fecho (ex. </b>)
					}else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
						$pos = array_search($tag_matchings[1], $open_tags);// apagar a tag do array $open_tags
						if($pos !== false) { unset($open_tags[$pos]); }
					}else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {// se a tag é uma tag inicial (ex. <b>)
						array_unshift($open_tags, strtolower($tag_matchings[1]));// adicionar tag ao início do array $open_tags
					}
					$truncate .= $line_matchings[1];// adicionar tag html ao texto $truncate
				}
				$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));// calcular a largura da parte do texto da linha; considerar entidades como um caracter
				if ($total_length+$content_length> $length) {
					$left = $length - $total_length;// o número dos caracteres que faltam
					$entities_length = 0;
					if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {// pesquisar por entidades html
						foreach ($entities[0] as $entity) {// calcular a largura real de todas as entidades no alcance "legal"
							if ($entity[1]+1-$entities_length <= $left) {
								$left--;
								$entities_length += strlen($entity[0]);
							} else {
								break;// não existem mais caracteres
							}
						}
					}
					$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
					break;// chegamos à largura máxima, por isso saímos do loop
				} else {
					$truncate .= $line_matchings[2];
					$total_length += $content_length;
				}
				if($total_length>= $length) {// se chegarmos à largura máxima, saímos do loop
					break;
				}
			}
		} else {
			if (strlen($text) <= $length) {
				return $text;
			} else {
				$truncate = substr($text, 0, $length - strlen($ending));
			}
		}
		if (!$cutWords) {// se as palavras não puderem ser cortadas a meio...
			$spacepos = strrpos($truncate, ' ');// ...procurar a última ocorrência de um espaço...
			if (isset($spacepos)) {
				$truncate = substr($truncate, 0, $spacepos);// ...e cortar o texto nesta posição
			}
		}
		$truncate .= $ending;// adicionar $ending no final do texto	
		if($considerHtml) {
			foreach ($open_tags as $tag) {// fechar todas as tags html não fechadas
				$truncate .= '</' . $tag . '>';
			}
		}
		return $truncate;
	}
	####################################################################################################################################################################
	####################################################################################################################################################################
	


?>
