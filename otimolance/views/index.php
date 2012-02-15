<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="js/dhtmlxcommon.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        <link rel="stylesheet" type="text/css" href="/otimolance/css/conteudo.css" media="screen" />

    </head>
    <body>
        <div id="conteudo">


            <? 
            if ($this->session->userdata("login") != "") { ?>
                <div class="titulo">
                    <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
                    <li><a href="<?= BASE_URL(); ?>clientes/sair"><span>Sair</span></a></li>
                </div>
            <? } else { ?>
            <div class="formulario">
                <form action="<?= base_url() ?>clientes/login" method="post">

                    <input type="text" name="login" id="login" class="inputSmall" value=""/>
                    <input type="password" name="senha" id="senha" class="inputSmall" value=""/>
                    <input type="submit" value="Enviar" class="button"/>

                </form>  
            </div>
            <? } ?>


            <div class="formulario">

                <h2>Listagem de leilões</h2>


                <? foreach ($leiloes as $leilao) { ?>

                    <div class="galeria_lista">
                        <p>Produto: <?= $leilao->nome ?></p>
                        <p>Leilão nº <?= $leilao->idLeilao ?> - Início <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?></p>
                        <div class="galeria_img">
                            <a href="<?= base_url() ?>leiloes/<?= $leilao->idLeilao ?>-<?= $leilao->nome ?>.html">
                                <img width="130px" height="180px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                            </a> 
                        </div>
                    </div>

                <? } ?>
            </div>
        </div>
    </body>
</html>