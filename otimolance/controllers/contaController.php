<?php

class ContaController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    private $msgPadrao = "";

    function index() {
        $this->load->model('Conta_model', 'contaDAO');
        $conta["contas"] = $this->contaDAO->getAll();
        $this->load->view("priv/conta/contaList",$conta);
    }
    
    function cadastroClienteSite(){
        $this->load->model('Conta_model', 'contaDAO');
        $conta["contas"] = $this->contaDAO->getAll();
        $conta["tiposUsuario"] = $this->getTiposUsuario();
        $this->load->view("conta/contaAdd", $conta);
    }
    
    function salvarClienteSite(){
        $this->load->model("Conta_model", "conta");
        $nome = $this->input->post("txtNome");
        $sobrenome = $this->input->post("txtSobrenome");
        $cpf = $this->input->post("txtCpf");
        $login = $this->input->post("txtLogin");
        $email = $this->input->post("txtEmail");
        $repetirEmail = $this->input->post("txtRepetirEmail");
        $senha = $this->input->post("txtSenha");
        $repetirSenha = $this->input->post("txtRepetirSenha");
        $receberEmail = $this->input->post("checkReceberEmail");
        $aceitarTermo = $this->input->post("checkAceitarTermo");
        $idTipoUsuario = $this->input->post("idTipoUsuario");
               
        $mensagem = array();
        $msg = "";
        $erro = false;
        
        // Verificar se login já foi cadastrado
        $this->load->model('Conta_model', 'conta');
        $listaLogin["$listaLogin"] = $this->conta->buscarLoginCadastrado($login);
           
        foreach ($listaLogin as $row) {
            $loginExistente =  $row[0]->login;
        }

        if (!is_null($loginExistente)){
            $erro = true;
            $msg .= "Login já cadastrado." . "<br/>";
        }
        
        // Verificar de cpf já foi cadastrado
        $listaCpf["$listaCpf"] = $this->conta->buscarCpfCadastrado($cpf);
           
        foreach ($listaCpf as $row) {
            $cpfExistente =  $row[0]->cpf;
        }

        if (!is_null($cpfExistente)){
            $erro = true;
            $msg .= "Cpf já cadastrado." . "<br/>";
        }
        
        // Verificar de email já foi cadastrado
        $listaEmail["$listaEmail"] = $this->conta->buscarEmailCadastrado($email);
           
        foreach ($listaEmail as $row) {
            $emailExistente =  $row[0]->email;
        }

        if (!is_null($emailExistente)){
            $erro = true;
            $msg .= "E-mail já cadastrado." . "<br/>";
        }
        
        // Verificar se ip já foi utilizado
        $this->load->model('Parametro_model', 'parametro');
        $listaParametro["$listaParametro"] = $this->parametro->buscarParametros();
        
        foreach ($listaParametro as $row) {
            $maxIp = $row[0]->maxIp;
        }
        
        $ip = getenv("REMOTE_ADDR");
        $listaIp["$listaIp"] = $this->conta->buscarIpCadastrado($ip);

        $cont = 0;
        
        foreach ($listaIp as $row) {
            $ipExistente =  $row[0]->ip;
            $cont++;
        }
        
        if ($cont > $maxIp){
            $erro = true;
            $msg .= "Limite máximo de cadastro por ip atingido." . "<br/>";
        }
        
        // Validações de campos nulos
        if ($nome == "") {
            $erro = true;
            $msg .= "O campo Nome é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($sobrenome == "") {
            $erro = true;
            $msg .= "O campo Sobrenome é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($cpf == "") {
            $erro = true;
            $msg .= "O campo Cpf é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($login == "") {
            $erro = true;
            $msg .= "O campo Login é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($email == "") {
            $erro = true;
            $msg .= "O campo E-mail é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($senha == "") {
            $erro = true;
            $msg .= "O campo Senha obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($this->validaCPF($cpf) == false){
            $erro = true;
            $msg .= "Cpf inválido." . "<br/>";
        }
        
        if ($this->validaEMAIL($email) == false){
            $erro = true;
            $msg .= "E-mail inválido." . "<br/>";
        }
        
        if ($email != $repetirEmail){
            $erro = true;
            $msg .= "O e-mail e a confirmação de e-mail não conferem." . "<br/>";
        }
        
        if ($senha != $repetirSenha){
            $erro = true;
            $msg .= "A senha e a confirmação de senha não conferem." . "<br/>";
        }

        if ($erro == false) {
            $data = array(
                "nome" => $nome,
                "sobrenome" => $sobrenome,
                "cpf" => $cpf,
                "login" => $login,
                "email" => $email,
                "senha" => $senha,
                "receberEmail" => $receberEmail,
                "aceitarTermo" => $aceitarTermo,
                "idTipoUsuario" => 2,
                "ip" => $ip
            );
            $id = $this->conta->salvar($data);
            
            if ($id > 0) {
                $this->load->model('Conta_model', 'conta');
                $conta["conta"] = $this->conta->buscarContaPorId($id);

                if (!is_null($conta)) {
                    $this->enviarEMAIL($email);
                    $conta["sucesso"] = "Cadastro realizado com sucesso.";
                    $conta["tiposUsuario"] = $this->getTiposUsuario();
       
                    $this->load->vars($conta);
                    $this->load->view("conta/contaMsg");
                }
            }
        }
        else {
            $this->load->model('Conta_model', 'conta');
            $conta["tiposUsuario"] = $this->getTiposUsuario();
            $conta["erro"] = $msg;
            $this->load->vars($conta);
            $this->load->view("conta/contaAdd"); 
        }
    }
   
    function salvarNovaConta() {
        $this->load->model("Conta_model", "conta");
        $nome = $this->input->post("txtNome");
        $sobrenome = $this->input->post("txtSobrenome");
        $cpf = $this->input->post("txtCpf");
        $login = $this->input->post("txtLogin");
        $email = $this->input->post("txtEmail");
        $repetirEmail = $this->input->post("txtRepetirEmail");
        $senha = $this->input->post("txtSenha");
        $repetirSenha = $this->input->post("txtRepetirSenha");
        $receberEmail = $this->input->post("checkReceberEmail");
        $aceitarTermo = $this->input->post("checkAceitarTermo");
        $idTipoUsuario = $this->input->post("idTipoUsuario");
        
        $mensagem = array();
        $msg = "";
        $erro = false;
        
        // Verificar se login já foi cadastrado
        $this->load->model('Conta_model', 'conta');
        $listaLogin["$listaLogin"] = $this->conta->buscarLoginCadastrado($login);
           
        foreach ($listaLogin as $row) {
            $loginExistente =  $row[0]->login;
        }

        if (!is_null($loginExistente)){
            $erro = true;
            $msg .= "Login já cadastrado." . "<br/>";
        }
        
        // Verificar de cpf já foi cadastrado
        $listaCpf["$listaCpf"] = $this->conta->buscarCpfCadastrado($cpf);
           
        foreach ($listaCpf as $row) {
            $cpfExistente =  $row[0]->cpf;
        }

        if (!is_null($cpfExistente)){
            $erro = true;
            $msg .= "Cpf já cadastrado." . "<br/>";
        }
        
        // Verificar de email já foi cadastrado
        $listaEmail["$listaEmail"] = $this->conta->buscarEmailCadastrado($email);
           
        foreach ($listaEmail as $row) {
            $emailExistente =  $row[0]->email;
        }

        if (!is_null($emailExistente)){
            $erro = true;
            $msg .= "E-mail já cadastrado." . "<br/>";
        }
        
        // Validações de campos nulos
        if ($nome == "") {
            $erro = true;
            $msg .= "O campo Nome é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($sobrenome == "") {
            $erro = true;
            $msg .= "O campo Sobrenome é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($cpf == "") {
            $erro = true;
            $msg .= "O campo Cpf é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($login == "") {
            $erro = true;
            $msg .= "O campo Login é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($email == "") {
            $erro = true;
            $msg .= "O campo E-mail é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($senha == "") {
            $erro = true;
            $msg .= "O campo Senha obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }
        
        if ($this->validaCPF($cpf) == false){
            $erro = true;
            $msg .= "Cpf inválido." . "<br/>";
        }
        
        if ($this->validaEMAIL($email) == false){
            $erro = true;
            $msg .= "E-mail inválido." . "<br/>";
        }
        
        if ($email != $repetirEmail){
            $erro = true;
            $msg .= "O e-mail e a confirmação de e-mail não conferem." . "<br/>";
        }
        
        if ($senha != $repetirSenha){
            $erro = true;
            $msg .= "A senha e a confirmação de senha não conferem." . "<br/>";
        }

        if ($erro == false) {
            $data = array(
                "nome" => $nome,
                "sobrenome" => $sobrenome,
                "cpf" => $cpf,
                "login" => $login,
                "email" => $email,
                "senha" => $senha,
                "receberEmail" => 0,
                "aceitarTermo" => 1,
                "idTipoUsuario" => $idTipoUsuario
            );
            $id = $this->conta->salvar($data);
            
            if ($id > 0) {
                $this->load->model('Conta_model', 'conta');
                $conta["conta"] = $this->conta->buscarContaPorId($id);

                if (!is_null($conta)) {
                    //$this->enviarEMAIL($email);
                    $conta["sucesso"] = "Salvo com sucesso.";
                    $conta["tiposUsuario"] = $this->getTiposUsuario();
                    
                    $this->load->model('Conta_model', 'contaDAO');
                    $conta["contas"] = $this->contaDAO->getAll();
                    $this->load->view("priv/conta/contaEdit",$conta);
                }
            }
        }
        else {
            $this->load->model('Conta_model', 'conta');
            $conta["tiposUsuario"] = $this->getTiposUsuario();
            $conta["erro"] = $msg;
            $this->load->vars($conta);
            $this->load->view("priv/conta/contaAdd"); 
        }
    }
    
    // Função que valida o CPF
    function validaCPF($cpf){	
        //// Verifiva se o número digitado contém todos os digitos
        $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
            
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
        {
            return false;
        }
        else
            {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }
    
    //Esta função verifica se o email digitado é valido
    function validaEMAIL($email){ 
        $mail_correcto = 0; 
        //verifico umas coisas 
        if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
            if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
                //vejo se tem caracter . (ponto)
                if (substr_count($email,".")>= 1){ 
                    //obtenho a terminação do dominio 
                    $term_dom = substr(strrchr ($email, '.'),1); 
                    //verifico que a terminação do dominio seja correcta 
                    if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
                        //verifico que o de antes do dominio seja correcto 
                        $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                        $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                        if ($caracter_ult != "@" && $caracter_ult != "."){ 
                        $mail_correcto = 1; 
                        } 
                    } 
                } 
            } 
        }  
        if ($mail_correcto) 
            return true; 
        else 
            return false; 
    }
    
    function enviarEMAIL($email){
        $this->load->model('Parametro_model', 'parametro');
        $servidor["servidor"] = $this->parametro->buscarParametros();
        $this->load->library('email');
        
        $this->email->smtp_host = $servidor["servidor"][0]->smtp_host;
        $this->email->smtp_port = $servidor["servidor"][0]->smtp_port;
        $this->email->smtp_user = $servidor["servidor"][0]->smtp_user;
        $this->email->smtp_pass = $servidor["servidor"][0]->smtp_pass;
        
        $this->email->from('otimolance@gmail.com','Team OtimoLance');
        $this->email->to($email);
        $this->email->subject('[OtimoLance] Ative sua conta no OtimoLance');
        $this->email->message($servidor["servidor"][0]->padraoEmailConfirmarCadastro);
        $this->email->send();
        echo $this->email->print_debugger();
    }

    function editarConta() {
        $this->load->model("Conta_model", "conta");
        $id = $this->input->post("idContah");
        
        $nome = $this->input->post("txtNome");
        $sobrenome = $this->input->post("txtSobrenome");
        $cpf = $this->input->post("txtCpf");
        $login = $this->input->post("txtLogin");
        $idTipoUsuario = $this->input->post("idTipoUsuario");
        
        $mensagem = array();
        $msg = "";
        $erro = false;
        
        if ($nome == "") {
            $erro = true;
            $msg .= "O campo Nome não pode ser nulo." . "<br/>";
        }
        
        if ($sobrenome == "") {
            $erro = true;
            $msg .= "O campo Sobrenome não pode ser nulo." . "<br/>";
        }
        
        if ($cpf == "") {
            $erro = true;
            $msg .= "O campo Cpf não pode ser nulo." . "<br/>";
        }
        
        if ($login == "") {
            $erro = true;
            $msg .= "O campo Login não pode ser nulo." . "<br/>";
        }
        
        if ($this->validaCPF($cpf) == false){
            $erro = true;
            $msg .= "Cpf inválido." . "<br/>";
        }

        if ($erro == false) {
            $data = array(
                "nome" => $nome,
                "sobrenome" => $sobrenome,
                "cpf" => $cpf,
                "login" => $login,
                "idTipoUsuario" => $idTipoUsuario
            );
        
            $this->conta->update($data, $id);
            $this->msgPadrao = "Conta salva com sucesso.";
            $this->editarContaAction($id);
        }
        else {           
            $this->msgPadrao = $msg;
            
            $this->load->model('Conta_model', 'conta');
            $conta["conta"] = $this->conta->buscarContaPorId($id);
            $conta["tiposUsuario"] = $this->getTiposUsuario();

            $conta["erro"] = $this->msgPadrao;
            $this->load->vars($conta);
            $this->load->view("priv/conta/contaEdit");
        }
    }

     /* Actions */

    function editarContaAction($id) {
        $this->load->model('Conta_model', 'conta');
        $conta["conta"] = $this->conta->buscarContaPorId($id);
        $conta["tiposUsuario"] = $this->getTiposUsuario();

        $conta["sucesso"] = $this->msgPadrao;
        $this->load->vars($conta);
        $this->load->view("priv/conta/contaEdit");
    }

    function novaContaAction() {
        $conta["tiposUsuario"] = $this->getTiposUsuario();
        $this->load->vars($conta);
        $this->load->view("priv/conta/contaAdd");
    }
    
    function excluirContaAction($idConta){
        $this->load->model('Conta_model', 'conta');
        
        $delete = array("idConta" => $idConta);
         
        $this->conta->excluirConta($delete);
        $this->session->set_flashdata('sucesso','Conta excluída com sucesso.');
        redirect("contaController");
    }
    
    function getTiposUsuario() {
        $this->load->model("TipoUsuario_model", "tipoUsuario");
        return $this->tipoUsuario->getAll();
    }
}

?>
