<?php

class Pedido {
    
    private $idPedido;
    private $idItemPedido;
    private $total;
    private $desconto;
    
    
    public function getIdPedido() {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function getIdItemPedido() {
        return $this->idItemPedido;
    }

    public function setIdItemPedido($idItemPedido) {
        $this->idItemPedido = $idItemPedido;
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
}
?>
