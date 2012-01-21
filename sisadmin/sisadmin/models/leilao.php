<?php

class Leilao {
    
    private $idLeilao;
	private $dataCriacao;
	private $dataCriacao;
	private $dataCriacao;
	private $dataCriacao;
	private $dataCriacao;
	
	public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getCategoria() {
        return $this->categoria;
    }
	
	public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
}
?>
