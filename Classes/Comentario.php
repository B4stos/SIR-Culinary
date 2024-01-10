<?php 

namespace Classes;

class Comentarios {
    private $comentario_id;
    private $receita_id;
    private $user_id;
    private $data;
    private $text;
    private $validacao;

    public function __construct($comentario_id, $receita_id, $user_id, $data, $text, $validacao) {
        $this->comentario_id = $comentario_id;
        $this->receita_id = $receita_id;
        $this->user_id = $user_id;
        $this->data = $data;
        $this->text = $text;
        $this->validacao = $validacao;
    }

    public function getComentarioId() {
        return $this->comentario_id;
    }

    public function getReceitaId() {
        return $this->receita_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getData() {
        return $this->data;
    }

    public function getText() {
        return $this->text;
    }

    public function getValidacao() {
        return $this->validacao;
    }

    public function setComentarioId($comentario_id) {
        $this->comentario_id = $comentario_id;
    }

    public function setReceitaId($receita_id) {
        $this->receita_id = $receita_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setValidacao($validacao) {
        $this->validacao = $validacao;
    }
}

?>