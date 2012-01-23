<?
$this->load->view('_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de clientes</span>
    </div>

    <div class="formulario">
        <h2>Listagem de clientes</h2>
        <input type="button" class="button" type="button" name="btNovoCliente" onclick="location.href='<?= base_url() ?>clienteController/novoClienteAction'" value="Novo Cliente" />
        <p><? echo $this->session->flashdata('sucesso'); ?></p>

        <table class="tabela">
            <thead>
            <td>Código</td>
            <td>CNPJ/CPF</td>
            <td>Fantasia</td>
            <td>Telefone</td>
            <td>E-mail</td>
            <td>Ações</td>
            </thead>
            <? foreach ($clientes as $c) { ?>
                <tr class="linha">
                    <td> <?= $c->idCliente ?> </td>
                    <td> <?= $c->cnpj_cpf ?> </td>
                    <td> <?= $c->nomeFantasia ?></td>
                    <td> <?= $c->telefone ?></td>
                    <td> <?= $c->email ?></td>
                    <td> <a href="<?= base_url() ?>clienteController/editarClienteAction/<?= $c->idCliente ?>">Editar</a> </td>
                </tr>
            <? } ?>
        </table>
        <br/>
    </div>
</div>
<?
$this->load->view('_inc/inferior');
?>
