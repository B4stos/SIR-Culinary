<?php

namespace Classes;

class Descricao {
    private $descricao_id;
    private $descricao;
    private $data;
    private $receita_id;

    public function __construct($descricao_id, $descricao, $data, $receita_id) {
        $this->descricao_id = $descricao_id;
        $this->descricao = $descricao;
        $this->data = $data;
        $this->receita_id = $receita_id;
    }

    public function getDescricaoId() {
        return $this->descricao_id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getData() {
        return $this->data;
    }

    public function getReceitaId() {
        return $this->receita_id;
    }

    public function setDescricaoId($descricao_id) {
        $this->descricao_id = $descricao_id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setReceitaId($receita_id) {
        $this->receita_id = $receita_id;
    }
}

?>