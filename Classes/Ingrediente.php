<?php

namespace Classes;

class Ingrediente {
    private $ingrediente_id;
    private $nome;
    private $tipo_ingrediente;
    private $localizacao;
    private $valor;

    public function __construct($ingrediente_id, $nome, $tipo_ingrediente, $localizacao, $valor) {
        $this->ingrediente_id = $ingrediente_id;
        $this->nome = $nome;
        $this->tipo_ingrediente = $tipo_ingrediente;
        $this->localizacao = $localizacao;
        $this->valor = $valor;
    }

    public function getIngredienteId() {
        return $this->ingrediente_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipoIngrediente() {
        return $this->tipo_ingrediente;
    }

    public function getLocalizacao() {
        return $this->localizacao;
    }

    public function getValor() {
        return $this->valor;
    }

    // Setters
    public function setIngredienteId($ingrediente_id) {
        $this->ingrediente_id = $ingrediente_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTipoIngrediente($tipo_ingrediente) {
        $this->tipo_ingrediente = $tipo_ingrediente;
    }

    public function setLocalizacao($localizacao) {
        $this->localizacao = $localizacao;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
}

?>