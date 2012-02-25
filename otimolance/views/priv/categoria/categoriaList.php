<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Categoria</span>
    </div>

    <div class="formulario">
       <h2>Listagem de Categoria</h2>
        <input type="button" class="button" type="button" name="btNovaCategoria" onclick="location.href='<?= base_url() ?>categoriaController/novaCategoriaAction'" value="Nova Categoria"/>
            
       <table class="tabela">
            <thead>
                <td>Código</td>
                <td>Nome</td>
                <td>Ações</td>
            </thead>
            
            <? foreach ($categorias as $categoria) { ?>
                <tr class="linha">
                    <td><?=$categoria->idCategoria?></td>
                    <td><?=$categoria->nome?></td>
                    <td>
                        <a href="<?= base_url() ?>categoriaController/editarCategoriaAction/<?= $categoria->idCategoria ?>">Editar</a>
                        <a href="<?= base_url() ?>categoriaController/excluirCategoriaAction/<?= $categoria->idCategoria ?>">Excluir</a>
                    </td>
                </tr>
              <?}?>
         </table>

    </div>
</div>

<?
$this->load->view('priv/_inc/inferior');
?>