<?php

class Util {

    public static $STATUS_AGUARDANDO_PAGAMENTO = "Aguardando Pagamento";
    public static $STATUS_ANALISE = "Em Análise";
    public static $STATUS_PAGA = "Paga";
    public static $STATUS_DISPONIVEL = "Disponível";
    public static $STATUS_DISPUTA = "Em Disputa";
    public static $STATUS_DEVOLVIDA = "Devolvida";
    public static $STATUS_CANCELADA = "Cancelada";
    public static $STATUS_PROCESSADO = "Processado";
    
    public static $CATEGORIA_TIPO_LANCE = "Lance";

    public static function ajustaDataSql($data) {
        if ($data) {
            $dataDividida = explode("/", $data);
            return $dataDividida[2] . "-" . $dataDividida[1] . "-" . $dataDividida[0];
        }
        return NULL;
    }

    /**
     * Retorna o status em portugues do código do status 
     * da transacao passado pelo PAGSEGURO.
     * @param type $codigo 
     */
    public static function retornarStatusPTBRPorCodigo($codigo) {
        switch ($codigo) :
            case 1:
                return "Aguardando Pagamento";
            case 2:
                return "Em Análise";
            case 3:
                return "Paga";
            case 4:
                return "Disponível";
            case 5:
                return "Em Disputa";
            case 6:
                return "Devolvida";
            case 7:
                return "Cancelada";
        endswitch;
    }

    //Esta função verifica se o email digitado é valido
    public static function validaEmail($email) {
        $mail_correcto = 0;
        //verifico umas coisas 
        if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@")) {
            if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " "))) {
                //vejo se tem caracter . (ponto)
                if (substr_count($email, ".") >= 1) {
                    //obtenho a terminação do dominio 
                    $term_dom = substr(strrchr($email, '.'), 1);
                    //verifico que a terminação do dominio seja correcta 
                    if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@"))) {
                        //verifico que o de antes do dominio seja correcto 
                        $antes_dom = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);
                        if ($caracter_ult != "@" && $caracter_ult != ".") {
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

}

php
?>
