<?php

class Categoria {
    
    private $idCategoria;
    private $nome;
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

	
    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }
    
}
?>
