<?php
function validarLogin($formData){    
	$objResponse = new xajaxResponse();	 
	if($formData[login]!="" && $formData[senha]!=""){
		$objResponse->addScript("document.getElementById('formLogin').submit();"); 
	}else{
		$objResponse->addAlert(utf8_encode('Campos não preenchidos.'));  
	}
    return $objResponse->getXML();
}
function gravarUsuario($formData){    
	$objResponse = new xajaxResponse();	
	if($formData[acao]=="novo"){
		if(trim($formData[campoEmail])=="" || trim($formData[campoUser])=="" || trim($formData[campoSenha])==""){ //verifica campos obrigatórios preenchidos 
			$objResponse->addScript(utf8_encode("mostraERRO('campos obrigatórios não preenchidos.', 'status', 4000)")); 
		}else if(strlen($formData[dataNasc])>0 && strlen($formData[dataNasc])<10){ //verifica se data é válida
			$objResponse->addScript(utf8_encode("mostraERRO('data de nascimento inválida', 'status', 4000)"));
		}else if (!eregi("^[-_a-z0-9]+(\\.[-_a-z0-9]+)*\\@([-a-z0-9]+\\.)*([a-z]{2,4})$", $formData[campoEmail])) { // verifica email válido
			$objResponse->addScript(utf8_encode("mostraERRO('e-mail digitado é inválido.', 'status', 4000)"));
		}else if(strlen($formData[campoSenha])<6){ //verifica senha pequena
			$objResponse->addScript(utf8_encode("mostraERRO('senha com menos de 6 dígitos', 'status', 4000)"));
		}else if($formData[campoSenha]!=$formData[campoSenha2]){ //verifica se senhas são iguais
			$objResponse->addScript(utf8_encode("mostraERRO('a confirmação de senha não confere.', 'status', 4000)"));
		}else{ //tudo ok
			$objResponse->addScript("mostraAguarde('gravando dados')");
			$objResponse->addScript("document.getElementById('formUsuario').submit();");					
		}
	}else{
		if(trim($formData[campoEmail])=="" || trim($formData[campoUser])==""){ //verifica campos obrigatórios preenchidos 
			$objResponse->addScript(utf8_encode("mostraERRO('campos obrigatórios não preenchidos.', 'status', 4000)")); 
		}else if(strlen($formData[dataNasc])>0 && strlen($formData[dataNasc])<10){ //verifica se data é válida
			$objResponse->addScript(utf8_encode("mostraERRO('data de nascimento inválida', 'status', 4000)"));
		}else if (!eregi("^[-_a-z0-9]+(\\.[-_a-z0-9]+)*\\@([-a-z0-9]+\\.)*([a-z]{2,4})$", $formData[campoEmail])) { // verifica email válido
			$objResponse->addScript(utf8_encode("mostraERRO('e-mail digitado é inválido.', 'status', 4000)"));
		}else if(trim($formData[campoSenha])!="" && strlen($formData[campoSenha])<6){ //verifica senha pequena
			$objResponse->addScript(utf8_encode("mostraERRO('senha com menos de 6 dígitos', 'status', 4000)"));
		}else if($formData[campoSenha]!=$formData[campoSenha2]){ //verifica se senhas são iguais
			$objResponse->addScript(utf8_encode("mostraERRO('a confirmação de senha não confere.', 'status', 4000)"));
		}else{ //tudo ok
			$objResponse->addScript("mostraAguarde('gravando dados')");
			$objResponse->addScript("document.getElementById('formUsuario').submit();");					
		}
	}
	//$objResponse->addAlert("formData: " . print_r($formData, true));
    return $objResponse->getXML();
}

function removeArquivo($id,$formato){
    	$objResponse = new xajaxResponse();
		$conexao = new Conexao();	
		$consulta = $conexao->consulta("DELETE FROM intra_arquivos WHERE arq_id='".$id."'");
		if(file_exists("arquivos/arq_".$id.".".$formato)){
			unlink("arquivos/arq_".$id.".".$formato);
		}
		$objResponse->addRemove("arq".$id);
		$objResponse->addRemove("no".$id);
		//$objResponse->addAlert("Curriculo excluido com sucesso!");
		//$objResponse->addRedirect("index.php?modulo=cad_curriculo");
		return $objResponse->getXML();
}

?>