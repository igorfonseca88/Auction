<?
$this->load->view('_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/revistafalaserio/">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>clienteController/">Listagem de clientes</a> &raquo; Novo cliente</span>
    </div>
    <div class="formulario">
        <h2>Novo cadastro de cliente</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="addCliente">
            <div class="item">
                <label>CNPJ/CPF</label><br />
                <input type="text" name="txtCPF_CNPJ" id="txtCPF_CNPJ" value="" class="input"/>
            </div>

            <div class="item">
                <label>Razão social</label><br />
                <input type="text" name="txtRazaoSocial" id="txtRazaoSocial" value="" class="input"/>
            </div>

            <div class="item">
                <label>Nome fantasia</label><br />
                <input type="text" name="txtNomeFantasia" id="txtNomeFantasia" value="" class="input"/>
            </div>
            <div class="item">
                <label>Logradouro</label><br />
                <input type="text" name="txtLogradouro" id="txtLogradouro" value="" class="input"/>
            </div>

            <div class="item">
                <label>Número</label><br />
                <input type="text" name="txtNumero" id="txtNumero" value="" class="input"/>
            </div>

            <div class="item">
                <label>Bairro</label><br />
                <input type="text" name="txtBairro" id="txtBairro" value="" class="input"/>
            </div>

            <div class="item">
                <label>Complemento</label><br />
                <input type="text" name="txtComplemento" id="txtComplemento" value="" class="input"/>
            </div>

            <div class="item">
                <label>CEP</label><br />
                <input type="text" name="txtCEP" id="txtCEP" value="" class="input"/>
            </div>

            <div class="item">
                <label>Telefone</label><br />
                <input type="text" name="txtTelefone" id="txtTelefone" value="" class="inputText"/>
            </div>

            <div class="item">
                <label>E-mail</label><br />
                <input type="text" name="txtEmail" id="txtEmail" value="<?= $row->email ?>" class="input"/>
            </div>

            <div class="item">
                <label>Site</label><br />
                <input type="text" name="txtSite" id="txtSite" value="" class="input"/>
            </div>

            <div class="item">
                <label>Institucional</label><br />
                <textarea class="textarea" name="txtInstitucional" id="txtInstitucional" cols="60" rows="10"></textarea>
            </div>

            <div class="item">
                <label>Vídeo</label><br />
                <input type="text" name="video" id="video" class="input"/>
            </div>

            <div class="acao">
                <input type="button" value="Cancelar" class="button" />
                <input type="submit" class="button" name="btSalvarCliente" value="Salvar Cliente" />
            </div>

        </form>

    </div>
</div>
<?
$this->load->view('_inc/inferior');
?>