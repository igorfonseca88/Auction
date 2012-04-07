<?php

class OtimoLanceException{
    
private $pagSeguroCodExceptionList = array(
    
    //PAGINA COM O CODIGO DAS EXCEPTIONS
    //https://pagseguro.uol.com.br/v2/guia-de-integracao/codigos-de-erro.html
    
    11043 => 'maxUses out of range.',
    11044 => 'initialDate is required.',
    11045 => 'initialDate must be lower than allowed limit.',
    11046 => 'initialDate must not be older than 6 months.',
    11047 => 'initialDate must be lower than or equal finalDate.',
    11048 => 'Intervalo de Datas deve ser menor ou igual a 30 dias.',
    11049 => 'finalDate must be lower than allowed limit.',
    11050 => "initialDate invalid format, use 'yyyy-MM-ddTHH:mm' (eg. 2010-01-27T17:25).",
    11051 => "finalDate invalid format, use 'yyyy-MM-ddTHH:mm' (eg. 2010-01-27T17:25).",
    11052 => 'page invalid value.',
    11053 => 'maxPageResults invalid value (must be between 1 and 1000).'
    
    
    );
   
public function getMessage($codigoErro){
    if (isset($this->pagSeguroCodExceptionList[(int)$codigoErro])) {
           return $this->pagSeguroCodExceptionList[(int)$codigoErro];
    } else {
           return false;
    }
}
    
}

?>
