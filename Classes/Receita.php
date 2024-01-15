<?php

namespace Classes;


class Receita{

    private $receita_id;
    private $titulo;
    private $modo_preparo;
    private $data_preparo;
    private $user_id;
    
    public function __construct($receita_id, $titulo, $modo_preparo, $data_preparo, $user_id) {
        $this->receita_id = $receita_id;
        $this->titulo = $titulo;
        $this->modo_preparo = $modo_preparo;
        $this->data_preparo = $data_preparo;
        $this->user_id = $user_id;
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

    public function getUserId() {
        return $this->user_id;
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

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public  function getReceitas($database){


    }
}
