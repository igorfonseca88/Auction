<?
$this->load->view('_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/otimolance/minha_conta">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>minha_conta/leilaoController">Listagem de leilões</a> &raquo; Editar cadastro de leilão</span>
    </div>

    <div class="formulario">
        <h2>Editar cadastro de leilão</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="<?= BASE_URL(); ?>minha_conta/leilaoController/editCliente">

            <? foreach ($leilao as $row) { ?>
                <input type="hidden" name="idClienteh" id="idClienteh" value="<?= $row->idCliente ?>"/>
                <div class="item">
                    <label>Categoria</label><br />
                    <input type="text" name="txtCategoria" id="txtCategoria" value="<?= $row->cnpj_cpf ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Razão social</label><br />
                    <input type="text" name="txtRazaoSocial" id="txtRazaoSocial" value="<?= $row->razaoSocial ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Nome fantasia</label><br />
                    <input type="text" name="txtNomeFantasia" id="txtNomeFantasia" value="<?= $row->nomeFantasia ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Logradouro</label><br />
                    <input type="text" name="txtLogradouro" id="txtLogradouro" value="<?= $row->logradouro ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Número</label><br />
                    <input type="text" name="txtNumero" id="txtNumero" value="<?= $row->nro ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Bairro</label><br />
                    <input type="text" name="txtBairro" id="txtBairro" value="<?= $row->bairro ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Complemento</label><br />
                    <input type="text" name="txtComplemento" id="txtComplemento" value="<?= $row->complemento ?>" class="input"/>
                </div>

                <div class="item">
                    <label>CEP</label><br />
                    <input type="text" name="txtCEP" id="txtCEP" value="<?= $row->cep ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Telefone</label><br />
                    <input type="text" name="txtTelefone" id="txtTelefone" value="<?= $row->telefone ?>" class="input"/>
                </div>

                <div class="item">
                    <label>E-mail</label><br />
                    <input type="text" name="txtEmail" id="txtEmail" value="<?= $row->email ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Site</label><br />
                    <input type="text" name="txtSite" id="txtSite" value="<?= $row->site ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Institucional</label><br />
                    <textarea class="textarea" name="txtInstitucional" id="txtInstitucional" cols="60" rows="10"><?= $row->institucional ?></textarea>
                </div>

                <div class="item">
                    <label>Vídeo</label><br />
                    <input type="text" name="video" id="video" value="" class="input"/>
                    
                    <?= $row->video; ?>
                </div>
                <br/>

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