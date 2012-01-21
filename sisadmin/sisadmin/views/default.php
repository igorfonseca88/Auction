<?
$this->load->view('_inc/superior');
?>
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a>  </span>
    </div>
</div>

<?
$this->load->view('_inc/inferior');
?>