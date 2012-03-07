<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Minha Conta / Bem-Vindo <? //= $this->session->userdata("login")       ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Leilões</span>
    </div>

    <div class="formulario">

        <form method="post" action="<?= base_url() ?>leilaoController/pesquisarAction">
            <div class="item">
                <label>Situação</label><br />
                <select name='situacao' id='situacao' class="select">
                    <option value=""> Selecione </option>
                    <option value="Em andamento" <?= $_POST["situacao"] == "Em andamento" ? "selected" : "" ?>> Em andamento</option>
                    <option value="Arrematado" <?= $_POST["situacao"] == "Arrematado" ? "selected" : "" ?>> Arrematado</option>
                </select>
            </div>

            <div class="item">
                <label>Categoria do leilão</label><br />
                <select name='idCategoriaLeilao' id='idCategoriaLeilao' class="select">
                    <option value=""> Selecione </option>
                    <?
                    if (count($categorias)) {
                        foreach ($categorias as $key) {
                            if ($key->idCategoriaLeilao == $_POST["idCategoriaLeilao"])
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


        
        <table class="tabela">
            <thead>
                <td>Leilão</td>
                <td>Produto</td>
                <td>Início</td>
                <td>Situação</td>
                <td>Qtde lances</td>
                <td>Valor arremate</td>
                <td>Conta</td>
                <td>Data arremate</td>
                <td>Imagem</td>
                <td>Ações</td>
            </thead>
            
            <? foreach ($leiloes as $leilao) {  ?>
                <tr class="linha">
                    <td><?=$leilao->idLeilao?></td>
                    <td><?=$leilao->nome?></td>
                    <td><?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?></td>
                    <td><?= ($leilao->dataFim != "") ? "Arrematado" : "Em andamento" ?></td>
                    <td><?=$leilao->qtdeLances?></td>
                    <td><?= round($leilao->valorArremate, 2)?></td>
                    <td><?=$leilao->login?></td>
                    <td><?= $leilao->dataFim != "" ? date("d/m/Y H:i:s", strtotime($leilao->dataFim)) : ""?></td>
                    <td>
                        
                        <? if ($leilao->caminho != "") { ?>
                            <img width="50px" height="80px" src="<?= base_url() ?>upload/produtos/<?= $leilao->caminho ?>"/>
                        <? } else { ?>
                            <img width="50px" height="80px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                        <? } ?>
                    </td>
                    
                    <td>
                        <a href="<?= base_url() ?>leilaoController/editarLeilaoAction/<?= $leilao->idLeilao ?>">Editar</a>
                    </td>
                </tr>
              <?}?>
         </table>


        <br/>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>

