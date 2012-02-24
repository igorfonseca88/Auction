<?
$this->load->view('priv/_inc/superior');
?>
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?//= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Contas do Sistema</span>
    </div>

    <div class="formulario">
        <h2>Listagem de Contas do Sistema</h2>
        <input type="button" class="button" type="button" name="btNovaConta" onclick="location.href='<?= base_url() ?>contaController/novaContaAction'" value="Nova Conta" />
        <p><? //echo $this->session->flashdata('sucesso'); ?></p>

        <table class="tabela">
            <thead>
                <td>Código</td>
                <td>Nome</td>
                <td>Sobrenome</td>
                <td>Login</td>
                <td>Ações</td>
            </thead>
            
            <? foreach ($contas as $conta) { ?>
                <tr class="linha">
                    <td><?=$conta->idConta?></td>
                    <td><?=$conta->nome?></td>
                    <td><?=$conta->sobrenome?></td>
                    <td><?=$conta->login?></td>
                    <td>
                        <a href="<?= base_url() ?>conta/contaController/editarContaAction/<?= $usuario->idConta ?>">Editar</a>
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
