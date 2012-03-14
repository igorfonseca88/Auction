<?php

class ItemPedido {
    
    private $idItemPedido;
    private $idProduto;
    private $idPedido;
    private $quantidade;
    public $arrayAux;
    
    public function getIdItemPedido() {
        return $this->idItemPedido;
    }

    public function setIdItemPedido($idItemPedido) {
        $this->idItemPedido = $idItemPedido;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function getIdPedido() {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

}
?>
