<?php

include_once(dirname(__FILE__) . '/vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
include_once(dirname(__FILE__) . '/../includes/config.inc.php');
include_once(dirname(__FILE__) . '/../admin/classes/conexao.php');
$conn = new Conexao();

$action     = strip_tags(trim($_POST['action']));
$hash       = md5(session_id());
$nome       = strip_tags(trim($_POST['nome']));
$email      = strip_tags(trim($_POST['email']));
$assunto    = strip_tags(trim($_POST['argomento']));
$mensagem   = strip_tags(trim($_POST['messaggio']));

$validacao = true;

if(empty($nome) && $validacao == true) $validacao = false;
if(empty($email) && $validacao == true) $validacao = false;
if(empty($assunto) && $validacao == true) $validacao = false;
if(empty($mensagem) && $validacao == true) $validacao = false;

if($validacao==true && $action=='enviar-contato'){

    $sql = "INSERT INTO tag3_textos SET text_menu_id = '20',text_subm_id = '0',text_titulo = '$nome',text_info1 = '$assunto',text_info2 = '$email',text_texto = '$mensagem',text_data = DATE(NOW()),text_data_publicacao = NOW(),text_hora1 = '00:00:00',text_hora2 = '00:00:00',text_usu_id = '0'";
    $cid = $conn->consulta($sql);

    if($cid){
        
        #########################################################################################################################
        // ENVIAR POR EMAIL A FICHA DE INSCRIÇÃO
        #########################################################################################################################
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer;

        try {

            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.imparareilportoghese.it';           // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = 'no-reply@imparareilportoghese.it';   // SMTP username
            $mail->Password = 'RYwM3wnDqa';                         // SMTP password
            $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 25;                                       // TCP port to connect to

            $sqlConfig = "SELECT text_titulo AS email FROM tag3_textos WHERE text_menu_id = '1' AND text_subm_id = '4' LIMIT 1";
            $resConfig = $conn->consulta($sqlConfig);
            $linConfig = $conn->busca($resConfig);

            //Recipients
            $mail->setFrom('no-reply@imparareilportoghese.it', 'Imparare');
            $mail->addAddress($linConfig['email']);     //Add a recipient
            $mail->addReplyTo($email, $nome);


            ####################################################################################################################################################################
            // CONFIGURAÇÕES
            ###########################################################################################################
            $contato_site		= $config['urlSite'];
            $contato_titulo		= 'Contato #'.time();
            $contato_subtit		= 'Segue os detalhes do contato.';
            $contato_imagem		= $config['urlSite'] . 'images/topo-email.png';//400x100
            
            $contato_cor_borda	= '#88BC59';
            $contato_txt_rodape	= 'Esta mensagem foi enviada através do formulário de contato';
            $mensagemHTML 		= utf8_decode('<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;line-height:18px;color:#000000;"><tr><td align="center" style="padding:5px 0;"><img src="'.$contato_imagem.'" alt="" width="400" height="100" usemap="#Map2" style="display:block" /></td></tr><tr><td style="border-bottom:1px solid #CCC;">&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td align="center" valign="middle"><b style="font-size:18px;">'.$contato_titulo.'</b></td></tr><tr><td>&nbsp;</td></tr><tr><td align="center" valign="middle">'.$contato_subtit.'</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td style="font-size:13px;">
            <b>Nome completo:</b> ' . $nome . '<br>
            <b>E-mail:</b> ' . $email . '<br>
            <b>Assunto:</b> ' . $assunto . '<br><br>
            <b>Mensagem:</b><br>' . $mensagem . '<br>
            </td></tr><tr><td>&nbsp;</td></tr><tr><td style="border-bottom:2px solid '.$contato_cor_borda.';">&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><div align="center" style="font-size:12px;color:#000;"><u>'.$contato_txt_rodape.'</u></div></td></tr></table><map name="Map2" id="Map2"><area shape="rect" coords="-1,-3,243,128" href="'.$contato_site.'" target="_blank" /></map>');
            ###########################################################################################################
            ###########################################################################################################

            // Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = utf8_decode($contato_titulo);
            $mail->Body    = $mensagemHTML;
            $mail->AltBody = strip_tags($mensagemHTML);
            $mail->send();
            
            $codigo = '200';

        } catch (Exception $e) {
            
            $name = 'log-mailer.txt';
            $text = $mail->ErrorInfo;
            $file = fopen($name, 'a');
            fwrite($file, $text);
            fclose($file);
            
            $codigo = '500';

        }
        #########################################################################################################################
        
        $resultado = array('code'=>$codigo);
        
    }else{
        $resultado = array('code'=>500,'message'=>'Não foi possível salvar o registro.');
    }

}else{
    $resultado = array('code'=>400,'message'=>'Preencha todos os campos.');
}

echo json_encode($resultado);

?>