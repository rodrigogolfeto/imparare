<?php
include_once("classes/usuario.php");
include_once("classes/conexao.php");
include_once("includes/funcoes.php");
$conexao = new Conexao();
session_start();
//echo $_SESSION["usuario"];
if($_SESSION["usuario"]=='') {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="pt-br">

<link rel="shortcut icon" href="images/ico.ico" type="image/x-icon" /> 
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />
<!-- 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
<script type="text/javascript">if (typeof jQuery == 'undefined') { document.write(unescape("%3Cscript src='Scripts/jquery-min.js' type='text/javascript'%3E%3C/script%3E"));}</script>
-->
<script src="Scripts/jquery-min.js"></script>
<!--[if lt IE 8]><script type="text/javascript" src="Scripts/no-ie7.js"></script><![endif]-->
<script src="Scripts/efeitos.js"></script>
<title>Admin 2.5</title>
</head>

<body>
	
    <div id="tudo">
    	
        <div id="lateral">
        	
            <div class="div-inf-perfil">
            	<div class="div-perfil">
                	<a href="" class="link-foto-pefil tip" id="editar-perfil" title="Editar perfil" data-toggle="tooltip" data-placement="bottom"><img src="images/foto-padrao.png" width="60" height="60" /><img src="images/editar-perfil.png" class="editar" width="60" height="60" /><img src="images/maks-perfil.png" class="mask" width="60" height="60" /></a><!-- link-foto-pefil -->
                    <div class="div-nome"><b><?php echo ($_SESSION["usuario"]->getNome());?></b></div><!-- div-nome -->
                    <div class="div-cargo"><?php if ($_SESSION["usuario"]->getFuncao()>0) {?>administrador<?php }else{ ?>colaborador<?php }; ?></div><!-- div-cargo -->
                </div><!-- div-perfil -->
            </div><!-- div-inf-perfil -->
            
            <div class="div-data-painel">
            	<div class="div-data">
                	<div class="div-cont">
                    	<div class="dia"><?php echo date('d');?></div>
                        <div class="dia-mes"><?php echo escreveSemanaMes(date('D'), 'sem');?> <?php echo escreveSemanaMes(date('m'), 'mes');?></div>
                    </div><!-- div-cont -->
                </div><!-- div-data -->
                <a href="home.php" class="link-painel "><i class="icone monitor">&nbsp;</i>Inicio</a>
            </div><!-- div-data-painel -->
            
            <nav class="nav">
                <div class="content-nav scrollbar">
                    <ul>
                    	<?php 
    					$sql_menu = "SELECT * FROM tag3_menu WHERE menu_status=1 AND menu_menu_id=0 ORDER BY menu_ordem, menu_id ASC";
    					$consulta_menu = $conexao->consulta($sql_menu); 
    					while($reg_menu = $conexao->busca($consulta_menu)){ 
    						$sql_submenu = "SELECT * FROM tag3_menu WHERE menu_status=1 AND menu_menu_id=".$reg_menu['menu_id']." ORDER BY menu_ordem, menu_id ASC";
    						$consulta_submenu = $conexao->consulta($sql_submenu); 
    						$conta_submenu = $conexao->conta($consulta_submenu); 
    					?>
                        <li <?php if($conta_submenu>0){ ?>class="cont-drop-menu"<?php }; ?>>
                        	<a href="<?php if($conta_submenu>0){ ?>javascript:;<?php }else{ if($reg_menu['menu_tipo']=='lista'){ ?>lista.php?men=<?php echo $reg_menu['menu_id']; ?><?php }else{ ?>form.php?men=<?php echo $reg_menu['menu_id']; ?><?php }; }; ?>&submen=0" class="<?php if($conta_submenu>0){ ?>link-drop-menu<?php }; ?> <?php if($reg_menu['menu_id']==$_GET['men']){ ?>marcado<?php }; ?>"><i class="icone <?php echo $reg_menu['menu_classe']; ?>"></i><?php echo $reg_menu['menu_titulo']; ?><?php if($conta_submenu>0){ ?><i class="icone seta">&nbsp;</i><?php }; ?></a>
                            <?php if($conta_submenu>0){ ?>
                            <div class="div-drop-menu drop-nav">
                                <ul>
                                	<?php while($reg_submenu = $conexao->busca($consulta_submenu)){ ?>
                                    <li><a href="<?php  if($reg_submenu['menu_tipo']=='lista'){ ?>lista.php?men=<?php echo $reg_menu['menu_id']; ?>&submen=<?php echo $reg_submenu['menu_id']; }else{ ?>form.php?men=<?php echo $reg_menu['menu_id']; ?>&submen=<?php echo $reg_submenu['menu_id']; }; ?>" <?php if($reg_submenu['menu_id']==$_GET['submen']){ ?>class="marcado"<?php }; ?>><i class="icone <?php echo $reg_submenu['menu_classe']; ?>">&nbsp;</i><?php echo $reg_submenu['menu_titulo']; ?></a></li>
                                    <?php }; ?>
                                </ul>
                            </div><!-- div-drop -->
                            <?php }; ?>
                        </li>

                        <?php }; ?>

                    </ul>
                </div><!-- content-nav -->
            </nav><!-- nav -->
            
        </div><!-- lateral -->