<?php

namespace Classes;


class Categoria {
    private $categoria_id;
    private $nome;

    public function __construct($categoria_id, $nome) {
        $this->categoria_id = $categoria_id;
        $this->nome = $nome;
    }

    public function getCategoriaId() {
        return $this->categoria_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setCategoriaId($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
}

?>