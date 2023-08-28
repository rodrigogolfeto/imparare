<?php
include_once("config/dadosCliente.php");
require_once("xajax.inc.php");
require_once("xajax_funcoes.php");
$tag3 = new xajax();
$tag3 -> registerFunction("validarLogin");
$tag3 -> processRequests();

if($_POST['acao']=="logar"){
	include_once("classes/usuario.php");
	include_once("classes/conexao.php");
	$login = $_POST["login"];
	$senha = md5($_POST["senha"]);
	$conexao = new Conexao();
	$sql = "SELECT usu_nome, usu_cliente, usu_email, usu_funcao, usu_id FROM tag3_usuarios WHERE usu_login='".addslashes($login)."' and usu_senha='".addslashes($senha)."' and usu_status!=0";
	$consulta = $conexao->consulta($sql);
	if ($conexao->conta($consulta)>0) {
		$dados = $conexao->busca($consulta);
		$usuario = new Usuario($dados[0], $dados[1], $dados[2], $dados[3], $dados[4]);
		session_start();
		$_SESSION['usuario'] = $usuario;
		if($_POST['chkLembrar']==1){
			setcookie("tag3_login", $_POST["login"], time() + 60 * 60 * 24 * 365);
			setcookie("tag3_senha", $_POST["senha"], time() + 60 * 60 * 24 * 365);
		}else{
			setcookie("tag3_login");
			setcookie("tag3_senha");
		}
	}else{
		setcookie("tag3_login");
		setcookie("tag3_senha");
	}			
	if($usuario != null){
		if($_SESSION["usuario"]->getFuncao()!=0){
			header("location:home.php");
		}else{
			header("location:home.php");	
		}
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="pt-br">

<link rel="shortcut icon" href="images/ico.ico" type="image/x-icon" /> 
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!--[if lt IE 8]><script type="text/javascript" src="Scripts/no-ie7.js"></script><![endif]-->
<script src="Scripts/efeitos.js"></script>
<title>Admin Tag3</title>
<?php $tag3 -> printJavascript(); ?>
</head>

<body onload="setFocus('campologin');<?php if($_POST['acao']!=""){?>aparece();<?php }; ?>">
	
    <div id="tudo-login">
    	
        <header id="topo-login">
        	<div class="div-cont">            	
            	<div class="div-logo-login"><img src="images/logo-login.png" alt="Admin 2.5" width="123" height="70" /></div><!-- div-logo-login -->
                <div class="div-aviso-login">Caro usuário, faça o login para  acessar a área administrativa!</div><!-- div-aviso-login -->
                <img src="images/fundo-topo-login.png" class="fundo-topo" width="24" height="327" />
            </div><!-- div-cont -->        	
        </header><!-- topo -->
        
        <div id="conteudo-login">
        	<script>
						function aparece() {
							$('.div-erro').slideDown(100);	
							setTimeout(apaga, 2000)
						}
						function apaga(){
							$('.div-erro').slideUp(100);	
						}
				</script>
                
        		<div class="div-form-login">
                <div class="div-erro">ERRO: Nome de usu&aacute;rio ou senha inv&aacute;lidos.</div><!-- div-erro -->
            	<div class="div-item marcado" id="login">
                    <form name="formLogin" id="formLogin" method="post" action="index.php">
                    	<input type="hidden" id="acao" name="acao" value="logar" />
                        <div class="div-campo">
                            <i class="icone icone-login">&nbsp;</i>
                            <input type="text" id="campologin" name="login" value="<?php echo $_COOKIE["tag3_login"];?>" onkeypress="detectaEnterLogin(event);" placeholder="Login" />
                        </div><!-- div-campo -->
                        <div class="div-campo">
                            <i class="icone icone-senha">&nbsp;</i>
                            <input type="password" id="camposenha" name="senha" value="<?php echo $_COOKIE["tag3_senha"];?>" onkeypress="detectaEnterLogin(event);" placeholder="Senha" />
                        </div><!-- div-campo -->
                        <div class="div-campo baixo">
                            <div class="div-lembrarme">
                                <div class="div-checbox">
                                    <input type="hidden" id="chkLembrar" name="chkLembrar" value="1" <?php if($_COOKIE["tag3_login"]!=""){ ?>checked="checked"<?php }; ?> onkeypress="detectaEnterLogin(event);" />
                                    <a href="javascript:;" <?php if($_COOKIE["tag3_login"]!=""){ ?>class="marcado"<?php }; ?>><i>&nbsp;</i>Lembrar-me</a>
                                </div><!-- div-checbox -->
                            </div><!-- div-lembrarme -->
                            <a href="javascript:document.getElementById('formLogin').submit();void(0);" class="bt-enviar">Entrar</a>
                        </div><!-- div-campo -->
                    </form>
                    <a href="javascript:;" class="link-esqueciasenha" data-id="esquecisenha">Esqueci minha senha</a>
                </div><!-- div-item -->
                
                <div class="div-item" id="esquecisenha">
                    <form id="" name="" method="" action="">
                    	<div class="div-texto">Identifique-se para receber um e-mail com as instruções e o link para criar uma nova senha.</div><!-- div-texto -->
                        <div class="div-campo">
                            <i class="icone icone-email">&nbsp;</i>
                            <input type="text" id="" name="" placeholder="E-mail" />
                        </div><!-- div-campo -->                        
                        <div class="div-campo baixo">                            
                            <a href="" class="bt-enviar">Enviar</a>
                        </div><!-- div-campo -->
                    </form>
                    <a href="javascript:;" class="link-esqueciasenha" data-id="login">Voltar</a>
                </div><!-- div-item -->
            </div><!-- div-form-login -->
        </div><!-- conteudo -->
        
    </div><!-- tudo -->

</body>
</html>