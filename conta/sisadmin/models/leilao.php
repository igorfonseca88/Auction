<?php

class Leilao {
    
    private $idLeilao;
    private $dataCriacao;
    private $dataInicio;
    private $dataFim;
    private $tempoCronometro;
    private $valorLeilao;
    private $idConta;
    private $idCategoriaLeilao;
	
    public function getIdLeilao() {
        return $this->idLeilao;
    }

    public function setIdLeilao($idLeilao) {
        $this->idLeilao = $idLeilao;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }
    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }

    public function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    public function getTempoCronometro() {
        return $this->tempoCronometro;
    }

    public function setTempoCronometro($tempoCronometro) {
        $this->tempoCronometro = $tempoCronometro;
    }

    public function getValorLeilao() {
        return $this->valorLeilao;
    }

    public function setValorLeilao($valorLeilao) {
        $this->valorLeilao = $valorLeilao;
    }

    public function getIdConta() {
        return $this->idConta;
    }

    public function setIdConta($idConta) {
        $this->idConta = $idConta;
    }

    public function getIdCategoriaLeilao() {
        return $this->idCategoriaLeilao;
    }

    public function setIdCategoriaLeilao($idCategoriaLeilao) {
        $this->idCategoriaLeilao = $idCategoriaLeilao;
    }
}
?>
