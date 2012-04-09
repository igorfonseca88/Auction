<?php

class Cparametro extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('Parametro_model', 'parametro');
        $parametros["parametros"] = $this->parametro->buscarParametros();
        $this->load->view("priv/parametro/parametroEdit", $parametros);
    }

    function salvarParametro($id) {
        $this->load->model("Parametro_model", "parametro");

        $data = array(
            "numLancesNovoCadastro" => $this->input->post("numLancesNovoCadastro"),
            "maxIp" => $this->input->post("maxIp"),
            "emailRemetente" => $this->input->post("emailRemetente"),
            "smtp_host" => $this->input->post("smtp_host"),
            "smtp_port" => $this->input->post("smtp_port"),
            "smtp_user" => $this->input->post("smtp_user"),
            "smtp_pass" => $this->input->post("smtp_pass"),
            "padraoEmailConfirmarCadastro" => $this->input->post("padraoEmailConfirmarCadastro"),
            "padraoEmailCadastroConfirmado" => $this->input->post("padraoEmailCadastroConfirmado"),
            "padraoEmailRecuperarSenha" => $this->input->post("padraoEmailRecuperarSenha"),
            "padraoEmailTrocaDeSenha" => $this->input->post("padraoEmailTrocaDeSenha"),
            "numMinimoExpert" => $this->input->post("numMinimoExpert")
        );


        if ($this->parametro->salvar($data, $id) > 0) {
            $parametros["parametros"] = $this->parametro->buscarParametros();

            if (!is_null($parametros)) {
                $parametros["sucesso"] = "Salvo com sucesso.";
            }
            else{
                $parametros["error"] = "Erro ao salvar parâmetros.";
            }
        }
        
        $this->load->vars($parametros);
        $this->load->view("priv/parametro/parametroEdit");
    }

}

?>
