<?
$this->load->view('_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/otimolance/conta">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>conta/leilaoController">Listagem de leilões</a> &raquo; Editar cadastro de leilão</span>
    </div>

    <div class="formulario">
        <h2>Editar cadastro de leilão</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="<?= BASE_URL(); ?>conta/leilaoController/editarLeilao">

            <? foreach ($leilao as $row) { ?>
                <div class="item">
                <label>Data início</label><br />
                <input type="text" name="dataInicio" id="dataInicio" value="<?=$row->dataInicio?>" class="input"/>
            </div>
            
            <div class="item">
                <label>Hora início</label><br />
                <input type="text" name="horaInicio" id="horaInicio" value="" class="input"/>
            </div>

            <div class="item">
                <label>Tempo cronômetro</label><br />
                <select name='tempoCronometro' id='tempoCronometro' class="select">
                    <option value=""> Selecione </option>
                    <option value="15"> 15 segundos</option>
                    <option value="20"> 20 segundos</option>
                    <option value="25"> 25 segundos</option>
                    <option value="30"> 30 segundos</option>
                </select>
            </div>

            <div class="item">
                <label>Valor leilão</label><br />
                <select name='valorLeilao' id='valorLeilao' class="select">
                    <option value=""> Selecione </option>
                    <option value="1"> 1 centavo</option>
                    <option value="2"> 2 centavoss</option>
                </select>
            </div>
            
            
            <div class="item">
                <label>Categoria do leilão</label><br />
                <select name='idCategoriaLeilao' id='idCategoriaLeilao' class="select">
                    <option value=""> Selecione </option>
                    <?
                    if (count($categorias)) {
                        foreach ($categorias as $key) {
                            echo "<option value='" . $key->idCategoriaLeilao . "'>" . $key->categoriaLeilao . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>


                <div class="acao">
                    <input type="button" value="Cancelar" class="button" />
                    <input type="submit" class="button" name="btSalvarCliente" value="Salvar Cliente" />
                </div>		
                
            <? } ?>
        </form>

        <h2>Logo</h2>
        
         <form id="upload" action="<?= base_url() ?>clienteController/uploadImagem/<?= $row->idCliente ?>" method="post" enctype="multipart/form-data">
            <label>Arquivo: </label> <span id="status" style="display: none;"><img src="<?= base_url(); ?>img/loader.gif" alt="Enviando..." /></span> <br />
            <input type="file" name="userfile" id="userfile" />
            <input type="submit" name="enviar" class="button" value="Enviar" />

        </form>
        
        <div id="frameAnexos">
            
            <ul id="anexos">

                <? if (isset($row->logomarca)) { ?>
                    <li lang="<?php echo $row->logomarca ?>">
                        <?php echo $row->logomarca ?> <a href="<?= base_url() ?>upload/clientes/<?= $row->logomarca ?>" target="_blank"><img src="<?= base_url() ?>img/file.png"/></a> 
                        <a href="<?= base_url() ?>clienteController/removerImagem/<?= $row->idCliente ?>"><img src="<?= base_url() ?>img/remove.png" alt="Remover" class="remover"/></a>
                    </li>
                <? } ?>

            </ul>
        </div>

       

        <br/>



       
    </div>
</div>
<?
$this->load->view('_inc/inferior');
?>