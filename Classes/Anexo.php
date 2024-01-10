<?php

namespace Classes;

class Anexo {
    private $anexo_id;
    private $tipo;
    private $ficheiro;
    private $descricao;
    private $receita_id;
    private $user_id;

    public function __construct($anexo_id, $tipo, $ficheiro, $descricao, $receita_id, $user_id) {
        $this->anexo_id = $anexo_id;
        $this->tipo = $tipo;
        $this->ficheiro = $ficheiro;
        $this->descricao = $descricao;
        $this->receita_id = $receita_id;
        $this->user_id = $user_id;
    }


    public function getAnexoId() {
        return $this->anexo_id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getFicheiro() {
        return $this->ficheiro;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getReceitaId() {
        return $this->receita_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setAnexoId($anexo_id) {
        $this->anexo_id = $anexo_id;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setFicheiro($ficheiro) {
        $this->ficheiro = $ficheiro;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setReceitaId($receita_id) {
        $this->receita_id = $receita_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
}
