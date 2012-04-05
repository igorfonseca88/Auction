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
    public static function retornarStatusPTBRPorCodigo($codigo){
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
}
php?>
