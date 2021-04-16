<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title><?php echo $titPag; ?></title>
    <?php include('includes/metas.inc.php'); ?>
    <base href="<?php echo $config['urlSite']; ?>" />
    <link rel="stylesheet" href="<?=$config['urlSite']?>css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=$config['urlSite']?>css/main.css<?= (!empty($config['cacheFiles'])) ? '?cacheFile=' . $config['cacheFiles'] : ''; ?>" type="text/css" media="screen" />
</head>

<body>
 
    <div id="root">

        <header class="topo">
            <div class="container d-flex justify-content-between align-items-center">

                <div class="logo">
                    <a href=""><?=$config['titleBase']?></a>
                </div>
                
                <nav class="menu">
                    <ul class="d-flex">
                        <li><a href="" class="font-14">Il portoghese</a></li>
                        <li><a href="" class="font-14">I corsi</a></li>
                        <li><a href="" class="font-14">Traduzioni e interpretariato</a></li>
                        <li><a href="" class="font-14">Il Brasile</a></li>
                        <li><a href="" class="font-14">Libri pubblicati</a></li>
                        <li><a href="" class="font-14">Opinioni</a></li>
                        <li><a href="" class="font-14">CONTATTI</a></li>
                        <li><a href="" class="font-14">Blog</a></li>
                    </ul>
                </nav>

            </div>
        </header><!-- topo -->