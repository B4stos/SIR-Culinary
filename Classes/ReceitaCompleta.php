<?php


namespace Classes;

use Classes\Ingrediente;
use Classes\Anexo;
use Classes\Comentario;
use Classes\Categoria;


class ReceitaCompleta {
    public $receita_id;
    public $titulo;
    public $modo_preparo;
    public $data_preparo;
    public $favorito;
    public $ingredientes;
    public $anexos;
    public $descricao;
    public $datadescricao;
    public $comentarios;
    public $categorias;
    public $user;


    public function __construct($receita_id,$titulo,$modo_preparo,$data_preparo,$favorito,$ingredientes,$anexos,$descricao,$datadescricao,$comentarios, $categorias, $user) {

        $this->receita_id = $receita_id;
        $this->titulo = $titulo;
        $this->modo_preparo = $modo_preparo;
        $this->data_preparo = $data_preparo;
        $this->favorito = $favorito;
        $this->ingredientes = $ingredientes;
        $this->anexos = $anexos;
        $this->descricao = $descricao;
        $this->datadescricao = $datadescricao;
        $this->comentarios = $comentarios;
        $this->categorias = $categorias;
        $this->user = $user;
    }

    public function setDataPreparoAtual() {
        $this->data_preparo = date('Y-m-d H:i:s');
    }

    public function getReceitaId() {
        return $this->receita_id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getModoPreparo() {
        return $this->modo_preparo;
    }

    public function getDataPreparo() {
        return $this->data_preparo;
    }

    public function getFavorito() {
        return $this->favorito;
    }

    public function getIngredientes() {
        return $this->ingredientes;
    }

    public function getAnexos() {
        return $this->anexos;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDataDescricao() {
        return $this->datadescricao;
    }

    public function getComentarios() {
        return $this->comentarios;
    }

    public function getCategorias() {
        return $this->categorias;
    }

    public function setReceitaId($receita_id) {
        $this->receita_id = $receita_id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setModoPreparo($modo_preparo) {
        $this->modo_preparo = $modo_preparo;
    }

    public function setDataPreparo($data_preparo) {
        $this->data_preparo = $data_preparo;
    }

    public function setFavorito($favorito) {
        $this->favorito = $favorito;
    }

    public function setIngredientes($ingredientes) {
        $this->ingredientes = $ingredientes;
    }

    public function setAnexos($anexos) {
        $this->anexos = $anexos;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setDataDescricao($datadescricao) {
        $this->datadescricao = $datadescricao;
    }

    public function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    public function setCategorias($categorias) {
        $this->categorias = $categorias;
    }

}

?>