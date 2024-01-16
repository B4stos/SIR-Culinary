<?php

namespace Classes;

class Ingrediente {
    private $ingrediente_id;
    private $nome;
    private $quantidade;
    private $localizacao;
    private $valor;

    public function __construct($ingrediente_id, $nome, $quantidade, $localizacao, $valor) {
        $this->ingrediente_id = $ingrediente_id;
        $this->nome = $nome;
        $this->quantidade = $quantidade;
        $this->localizacao = $localizacao;
        $this->valor = $valor;
    }

    public function getIngredienteId() {
        return $this->ingrediente_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getOrigem() {
        return $this->localizacao;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setIngredienteId($ingrediente_id) {
        $this->ingrediente_id = $ingrediente_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setQuantidade($tipo_ingrediente) {
        $this->quantidade = $tipo_ingrediente;
    }

    public function setLocalizacao($localizacao) {
        $this->localizacao = $localizacao;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
}

?>