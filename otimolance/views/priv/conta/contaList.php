<?
$this->load->view('priv/_inc/superior');
?>
<div id="conteudo">
    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Usuários do Sistema</span>
    </div>

    <div class="formulario">
        <h2>Listagem de Usuários do Sistema</h2>
        <input type="button" class="button" type="button" name="btNovaConta" onclick="location.href='<?= base_url() ?>contaController/novaContaAction?idTipoUsuario=<? echo $_GET['idTipoUsuario'] ?>'" value="Nova Conta" />

        <table class="tabela">
            <thead>
                <td><p align="center">Código</p></td>
                <td>Nome</td>
                <td>Sobrenome</td>
                <td><p align="center">Cpf</p></td>
                <td>E-mail</td>
                <td><p align="center">Login</p></td>
                
                <? $idTipoUsuario = $_GET['idTipoUsuario']; 
                   if ($idTipoUsuario == 2){
                ?>
                <td><p align="center">Saldo</p></td>
                <? } ?>
                
                <td><p align="center">Ações</p></td>
            </thead>
            
            <? foreach ($conta as $conta) { ?>
                <tr class="linha">
                    <td><?=$conta->idConta?></td>
                    <td><?=$conta->nome?></td>
                    <td><?=$conta->sobrenome?></td>
                    <td><p align="center"><?=$conta->cpf?></p></td>
                    <td><?=$conta->email?></td>
                    <td><?=$conta->login?></td>
                    
                    <? $idTipoUsuario = $_GET['idTipoUsuario']; 
                        if ($idTipoUsuario == 2){
                    ?>
                    <td><p align="right"><?=$conta->saldo?></p></td>
                    <? } ?>
                    
                    <td>
                        <a href="<?= base_url() ?>contaController/editarContaAction/<?= $conta->idConta ?>/<?= $conta->idTipoUsuario ?>">Editar</a>
                        <a href="<?= base_url() ?>contaController/excluirContaAction/<?= $conta->idConta ?>">Excluir</a>
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
