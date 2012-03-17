<?php

class Pedido {
    
    public static $STATUS_EM_ANDAMENTO = "Em Andamento";

    private $idPedido;
    private $total;
    private $desconto;
    private $idConta;
    private $status;
    
    
    public function getIdPedido() {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getDesconto() {
        return $this->desconto;
    }

    public function setDesconto($desconto) {
        $this->desconto = $desconto;
    }
    
    public function getIdConta() {
        return $this->idConta;
    }

    public function setIdConta($idConta) {
        $this->idConta = $idConta;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
?>
