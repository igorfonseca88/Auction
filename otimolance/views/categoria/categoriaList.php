<?
$this->load->view('_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/revistafalaserio/">Principal</a> &raquo; 
                &raquo; Alterar minha senha</span>
    </div>

    <div class="formulario">
        <h2>Editar revista</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="/revistafalaserio/revistacontroller/editRevista">
            <? foreach ($revista as $row) { ?>
                <input type="hidden" name="idRevista" id="idRevista" value="<?= $row->idRevista ?>"/>
                <div class="item">
                    <label>Edição</label><br />
                    <input type="text" name="txtEdicao" id="txtEdicao" value="<?= $row->edicao ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Número de páginas</label><br />
                    <input type="text" name="txtPaginas" id="txtPaginas" value="<?= $row->numPaginas ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Url da Revista</label><br />
                    <input type="text" name="txtUrl" id="txtUrl" value="<?= $row->urlRevista ?>" class="input"/>
                </div>

                <div class="acao">
                    <input type="button" value="Cancelar" class="button" />
                    <input type="submit" class="button" name="btSalvarRevista" value="Salvar Revista" />
                </div>
            <? } ?>
        </form>



        <table class="tabela">
            <thead>
            <td>Data</td>
            <td>Nome</td>
            <td>Mensagem</td>
            <td>Ações</td>
            </thead>

            <? foreach ($comentarios as $c) { ?>

                <tr class="linha">
                    <td> <?= date('d/m/Y', strtotime($c->dataCriacao)) ?> </td>
                    <td> <?= $c->nome ?> </td>
                    <td> <?= $c->mensagem ?> </td>
                    <td> <a href="<?= base_url() ?>contatoController/lerContatoAction/<?= $r->idComentario ?>">Publicar</a> </td>
                </tr>

            <? } ?>
        </table>

    </div>
</div>

<?
$this->load->view('_inc/inferior');
?>