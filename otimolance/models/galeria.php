<?php

class Galeria {
    
    private $idGaleria;
    private $embed;
    private $isPrincipal;
    private $idProduto;
    private $tipoGaleria;
    
    public function getIdGaleria() {
        return $this->idGaleria;
    }

    public function setIdGaleria($idGaleria) {
        $this->idGaleria = $idGaleria;
    }

    public function getEmbed() {
        return $this->embed;
    }

    public function setEmbed($embed) {
        $this->embed = $embed;
    }

    public function getIsPrincipal() {
        return $this->isPrincipal;
    }

    public function setIsPrincipal($isPrincipal) {
        $this->isPrincipal = $isPrincipal;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function getTipoGaleria() {
        return $this->tipoGaleria;
    }

    public function setTipoGaleria($tipoGaleria) {
        $this->tipoGaleria = $tipoGaleria;
    }
}
?>
