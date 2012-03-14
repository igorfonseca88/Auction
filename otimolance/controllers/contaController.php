<?php

class ContaController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    private $msgPadrao = "";

    function index() {
        $this->load->model('Conta_model', 'contaDAO');
        $conta["conta"] = $this->contaDAO->getAll();
        $this->load->view("priv/conta/contaList",$conta);
    }
    
    function cadastroClienteSite(){
        $this->load->model('Conta_model', 'contaDAO');
        $conta["conta"] = $this->contaDAO->getAll();
        $conta["tiposUsuario"] = $this->getTiposUsuario();
        $this->load->view("conta/contaAdd", $conta);
    }
    
    function salvarClienteSite(){
        $this->load->model("Conta_model", "contaDAO");
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
        $listaLogin["$listaLogin"] = $this->contaDAO->buscarLoginCadastrado($login);
           
        foreach ($listaLogin as $row) {
            $loginExistente =  $row[0]->login;
        }

        if (!is_null($loginExistente)){
            $erro = true;
            $msg .= "Login já cadastrado." . "<br/>";
        }
        
        // Verificar de cpf já foi cadastrado
        $listaCpf["$listaCpf"] = $this->contaDAO->buscarCpfCadastrado($cpf);
           
        foreach ($listaCpf as $row) {
            $cpfExistente =  $row[0]->cpf;
        }

        if (!is_null($cpfExistente)){
            $erro = true;
            $msg .= "Cpf já cadastrado." . "<br/>";
        }
        
        // Verificar de email já foi cadastrado
        $listaEmail["$listaEmail"] = $this->contaDAO->buscarEmailCadastrado($email);
           
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
        $listaIp["$listaIp"] = $this->contaDAO->buscarIpCadastrado($ip);

        $cont = 0;
        
        foreach ($listaIp as $row) {
            $ipExistente =  $row[0]->ip;
            $cont++;
        }
        
        if ($cont > $maxIp){
            $erro = true;
            $msg .= "Limite máximo de cadastro por ip atingido." . "<br/>";
        }
        
        //$mac = $this->pegaMac();
        
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
                "ip" => $ip,
                "status" => "bloqueado"
            );
            $id = $this->contaDAO->salvar($data);
            
            if ($id > 0) {
                $conta["conta"] = $this->contaDAO->buscarContaPorId($id);

                if (!is_null($conta)) {
                    $this->enviarEmailAtivacao($email, $id);
                    $conta["tiposUsuario"] = $this->getTiposUsuario();
                    
                    $msgHtml = "<h3>Verifique o seu e-mail!!</h3>
                                <br/>
                                <br/>
                                <label>Acabamos de enviar um e-mail para você. Para que possamos finalizar seu cadastro é necessário que você verifique o e-mail que usou na etapa anterior e clique no link que enviamos.</label>
                                <br/><br/>
                                <label>Obs.: Caso o e-mail não esteja em sua caixa de entrada, por favor verifique a pasta de spam/lixo eletrônico.</label>
                                <br/><br/>
                                <label>Obrigado</label>
                                <br/><br/>
                                <label>Equipe OtimoLance</label>";
       
                    $conta["msgHtml"] = $msgHtml;
                    $conta["sucesso"] = "Cadastro realizado com sucesso.";
                    $this->load->vars($conta);
                    $this->load->view("conta/contaMsg");
                }
            }
        }
        else {
            $conta["tiposUsuario"] = $this->getTiposUsuario();
            $conta["erro"] = $msg;
            $this->load->vars($conta);
            $this->load->view("conta/contaAdd"); 
        }
    }
   
    function salvarNovaConta() {
        $this->load->model("Conta_model", "contaDAO");
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
        $listaLogin["$listaLogin"] = $this->contaDAO->buscarLoginCadastrado($login);
           
        foreach ($listaLogin as $row) {
            $loginExistente =  $row[0]->login;
        }

        if (!is_null($loginExistente)){
            $erro = true;
            $msg .= "Login já cadastrado." . "<br/>";
        }
        
        // Verificar de cpf já foi cadastrado
        $listaCpf["$listaCpf"] = $this->contaDAO->buscarCpfCadastrado($cpf);
           
        foreach ($listaCpf as $row) {
            $cpfExistente =  $row[0]->cpf;
        }

        if (!is_null($cpfExistente)){
            $erro = true;
            $msg .= "Cpf já cadastrado." . "<br/>";
        }
        
        // Verificar de email já foi cadastrado
        $listaEmail["$listaEmail"] = $this->contaDAO->buscarEmailCadastrado($email);
           
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
                "idTipoUsuario" => $idTipoUsuario,
                "status" => "liberado"
            );
            
            $id = $this->contaDAO->salvar($data);
            
            if ($id > 0) {
                $this->msgPadrao = "Salvo com sucesso.";
                $this->editarContaAction($id);
            }
        }
        else {
            $conta["tiposUsuario"] = $this->getTiposUsuario();
            $conta["erro"] = $msg;
            $this->load->vars($conta);
            $this->load->view("priv/conta/contaAdd"); 
        }
    }
    
    // Função que busca endereço MAC do usuário
    function pegaMac(){
        exec("ipconfig /all", $output);
        foreach($output as $line){
                if (preg_match("/(.*)Endereço físico(.*)/", $line)){
                        $mac = $line;
                        $mac = str_replace("Endereço físico . . . . . . . . . . :","",$mac);
                }
        }
        //$ip = $_SERVER['REMOTE_ADDR'];
        //$saida = trim(shell_exec("sudo arp -n | grep $ip | awk '{print $3}'"));
        return $mac;
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
    
    function enviarEmailAtivacao($email, $id){
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
        
        $string = "http://localhost/otimolance/contaController/liberarConta?id=$id";
        $mensagem = $servidor["servidor"][0]->padraoEmailConfirmarCadastro;
        $msg = SPrintF($mensagem, $string);
        
        $this->email->message($msg);
        $this->email->send();
        //echo $this->email->print_debugger();
    }
    
    function enviarEmailConfirmacao($email, $id, $login){
        $this->load->model('Parametro_model', 'parametro');
        $servidor["servidor"] = $this->parametro->buscarParametros();
        $this->load->library('email');
        
        $this->email->smtp_host = $servidor["servidor"][0]->smtp_host;
        $this->email->smtp_port = $servidor["servidor"][0]->smtp_port;
        $this->email->smtp_user = $servidor["servidor"][0]->smtp_user;
        $this->email->smtp_pass = $servidor["servidor"][0]->smtp_pass;
        
        $this->email->from('otimolance@gmail.com','Team OtimoLance');
        $this->email->to($email);
        $this->email->subject('[OtimoLance] Sua conta foi ativada com sucesso!');
        
        $string = "Usuário: $login";
        $mensagem = $servidor["servidor"][0]->padraoEmailCadastroConfirmado;      
        $msg = SPrintF($mensagem, "$string");     
        
        $this->email->message($msg);
        $this->email->send();
        //echo $this->email->print_debugger();
    }
    
    function enviarSenhaUsuario($email, $login, $senha){
        $this->load->model('Parametro_model', 'parametro');
        $servidor["servidor"] = $this->parametro->buscarParametros();
        $this->load->library('email');
        
        $this->email->smtp_host = $servidor["servidor"][0]->smtp_host;
        $this->email->smtp_port = $servidor["servidor"][0]->smtp_port;
        $this->email->smtp_user = $servidor["servidor"][0]->smtp_user;
        $this->email->smtp_pass = $servidor["servidor"][0]->smtp_pass;
        
        $this->email->from('otimolance@gmail.com','Team OtimoLance');
        $this->email->to($email);
        $this->email->subject('[OtimoLance] Recuperação de senha!');
        
        $string1 = "Seu usuário é: $login";
        $string2 = "Sua senha atual é: $senha";
        $mensagem = $servidor["servidor"][0]->padraoEmailRecuperarSenha;      
        $msg = SPrintF($mensagem, "$string1", "$string2");     
        
        $this->email->message($msg);
        $this->email->send();
        //echo $this->email->print_debugger();
    }
    
    function liberarConta() {
        $id = $_GET['id'];
        $this->load->model("Conta_model", "contaDAO");

        $data = array(
            "status" => "liberado"
        );

        $this->contaDAO->update($data, $id);
        
        $conta["conta"] = $this->contaDAO->buscarContaPorId($id);
         
        foreach ($conta as $row) {
            $email=  $row[0]->email;
            $login=  $row[0]->login;
        }
        
        $this->enviarEmailConfirmacao($email, $id, $login);
        
        $msgHtml = "<h3>Seu cadastro foi ativado com sucesso!</h3>  
                    <br/><br/>
                    <label>Agora você já pode começar ganhar! \o/</label>
                    <br/><br/>
                    <label>Para acessar suas informações pessoais, comprar pacote de lances e participar de um leilão, você deverá utilizar seu login e senha criados.</label>
                    <label>Por segurança, não compartilhe essas informações com ninguém.</label>";
        
        $conta["msgHtml"] = $msgHtml;
        $conta["sucesso"] = "Ativação realizada com sucesso.";
        $this->load->view("conta/contaMsg",$conta);     
    }
    
    function recuperarSenha(){
        $this->load->view("conta/recuperarSenha");
    }
    
    function retornarSenha(){
        $email = $_POST["txtEmail"];
        
        $this->load->model("Conta_model", "contaDAO");
        $conta["conta"] = $this->contaDAO->recuperarSenha($email);
            
        if (is_null($conta)){
            $msgHtml = "";
            $conta["msgHtml"] = $msgHtml;
            $conta["erro"] = "E-mail não cadastrado.";
            $this->load->view("conta/contaMsg",$conta); 
        }
        else{
            foreach ($conta as $row) {
                $senha=  $row[0]->senha;
                $login=  $row[0]->login;
            } 
            
            $this->enviarSenhaUsuario($email, $login, $senha);

            $msgHtml = "<h3>Em alguns minutos você receberá um email com suas informações de usuário e senha.</h3>
                        <br/>
                        <br/>
                        <label>Caso demore a chegar, verificar se por algum motivo ele não foi para no lixo eletrônico do seu email.</label>
                        <br/><br/>
                        <label>Obrigado</label>
                        <br/><br/>
                        <label>Equipe OtimoLance</label>";
            
            $conta["msgHtml"] = $msgHtml;
            $conta["sucesso"] = "Solicitação efetuada com sucesso.";
            $this->load->view("conta/contaMsg",$conta); 
        }
    }
    
    function alterarSenha(){
        $this->load->view("priv/conta/contaAlterarSenha"); 
    }
    
    function editarConta() {
        $this->load->model("Conta_model", "contaDAO");
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
        
            $this->contaDAO->update($data, $id);
            $this->msgPadrao = "Conta salva com sucesso.";
            $this->editarContaAction($id);
        }
        else {           
            $this->msgPadrao = $msg;
            
            $conta["conta"] = $this->contaDAO->buscarContaPorId($id);
            $conta["tiposUsuario"] = $this->getTiposUsuario();

            $conta["erro"] = $this->msgPadrao;
            $this->load->vars($conta);
            $this->load->view("priv/conta/contaEdit");
        }
    }

     /* Actions */

    function editarContaAction($id) {
        $this->load->model('Conta_model', 'contaDAO');
        $conta["conta"] = $this->contaDAO->buscarContaPorId($id);
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
        $this->load->model('Conta_model', 'contaDAO');
        
        $delete = array("idConta" => $idConta);
         
        $this->contaDAO->excluirConta($delete);
        $this->session->set_flashdata('sucesso','Conta excluída com sucesso.');
        redirect("contaController");
    }
    
    function getTiposUsuario() {
        $this->load->model("TipoUsuario_model", "tipoUsuario");
        return $this->tipoUsuario->getAll();
    }
}

?>
