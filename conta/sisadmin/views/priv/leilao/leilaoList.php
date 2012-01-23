<?
$this->load->view('_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?//= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de clientes</span>
    </div>

    <div class="formulario">
        <h2>Listagem de leilões</h2>
        <input type="button" class="button" type="button" name="btNovoLeilao" onclick="location.href='<?= base_url() ?>clienteController/novoClienteAction'" value="Novo leilão" />
        <p><? //echo $this->session->flashdata('sucesso'); ?></p>

       
            <? foreach ($leiloes as $leilao) { ?>
            
            <div class="galeria_lista">
                <p>Leilão número <?=$leilao->idLeilao?></p>
                <div class="galeria_img">
                    <a href="<?= base_url() ?>leilaoController/editarLeilaoAction/<?=$leilao->idLeilao?>"><img width="150px" height="180px" src="<?= base_url() ?>minha_conta/upload/produtos/velutex.jpg"/></a> 
                </div>
            </div>
             
              <?}?>
        
        
        
        <br/>
    </div>
</div>
<?
$this->load->view('_inc/inferior');
?>
