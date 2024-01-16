<?php

namespace Classes;

class ReceitaCard {

    public $id_receita;
    public $titulo_receita;
    public $data;
    public $imagem_anexo;
    public $nome_categoria;
    public $user_id;
    public $first_name;
    public $imagem_usuario;

    public function __construct($id_receita, $titulo_receita, $data, $imagem_anexo, $nome_categoria, $user_id, $first_name, $imagem_usuario) {
        $this->id_receita = $id_receita;
        $this->titulo_receita = $titulo_receita;
        $this->data = $data;
        $this->imagem_anexo = $imagem_anexo;
        $this->nome_categoria = $nome_categoria;
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->imagem_usuario = $imagem_usuario;
    }

    public function setDefaultImagemAnexo() {
       if ($this->imagem_anexo == null) {
            $this->imagem_anexo = '.\assets\images\Imagensr\base\baseImagenReceitaCard.jpg';
        }
    }

    public function setDefaultImagemUsuario() {
        if ($this->imagem_usuario == null) {
            $this->imagem_usuario = '.\assets\images\Imagensr\base\L2.jpg';
        }
    }

    public function formatarData($data) {
        return substr($data, 0, 10);
    }

    public function getIdReceita() {
        return $this->id_receita;
    }

    public function getTituloReceita() {
        return $this->titulo_receita;
    }

    public function getImagemAnexo() {
        return $this->imagem_anexo;
    }

    public function getData() {
        return $this->data;
    }

    public function getNomeCategoria() {
        return $this->nome_categoria;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getImagemUsuario() {
        return $this->imagem_usuario;
    }


    public function setIdReceita($id_receita) {
        $this->id_receita = $id_receita;
    }

    public function setTituloReceita($titulo_receita) {
        $this->titulo_receita = $titulo_receita;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setImagemAnexo($imagem_anexo) {
        $this->imagem_anexo = $imagem_anexo;
    }

    public function setNomeCategoria($nome_categoria) {
        $this->nome_categoria = $nome_categoria;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function setImagemUsuario($imagem_usuario) {
        $this->imagem_usuario = $imagem_usuario;
    }
}

?>