<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Minha Conta / Bem-Vindo <? //= $this->session->userdata("login")      ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de leilões</span>
    </div>

    <div class="formulario">

        <form method="post" action="<?= base_url() ?>leilaoController/pesquisarAction">
            <div class="item">
                <label>Situação</label><br />
                <select name='situacao' id='situacao' class="select">
                    <option value=""> Selecione </option>
                    <option value="Em andamento" <?= $_POST["situacao"] == "Em andamento" ? "selected" : "" ?>> Em andamento</option>
                    <option value="Finalizado" <?= $_POST["situacao"] == "Finalizado" ? "selected" : "" ?>> Finalizado</option>
                </select>
            </div>

            <div class="item">
                <label>Categoria do leilão</label><br />
                <select name='idCategoriaLeilao' id='idCategoriaLeilao' class="select">
                    <option value=""> Selecione </option>
                    <?
                    if (count($categorias)) {
                        foreach ($categorias as $key) {
                            if($key->idCategoriaLeilao == $_POST["idCategoriaLeilao"])
                                echo "<option value='" . $key->idCategoriaLeilao . "' selected>" . $key->categoriaLeilao . "</option>";
                            else
                                echo "<option value='" . $key->idCategoriaLeilao . "'>" . $key->categoriaLeilao . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="acao">
                <input type="submit" class="button" name="btPesquisar" value="Pesquisar" />
            </div>
        </form>   


        <h2>Listagem de leilões</h2>
        <input type="button" class="button" type="button" name="btNovoLeilao" onclick="location.href='<?= base_url() ?>leilaoController/novoLeilaoAction'" value="Novo leilão" />
        <p><? //echo $this->session->flashdata('sucesso');      ?></p>


        <? foreach ($leiloes as $leilao) { ?>

            <div class="galeria_lista">
                <p>Produto: <?= $leilao->nome ?></p>
                <p>Leilão nº <?= $leilao->idLeilao ?> - Início <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?></p>
                <div class="galeria_img">
                    <a href="<?= base_url() ?>leilaoController/editarLeilaoAction/<?= $leilao->idLeilao ?>">
                        <img width="130px" height="180px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                    </a> 
                </div>
            </div>

        <? } ?>


        <br/>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>
