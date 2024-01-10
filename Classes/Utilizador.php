<?php

namespace Classes;


class Utilizador {

    private $user_id;
    private $first_name;
    private $last_name;
    private $notificacao;
    private $email;
    private $imagem;
    private $telefone;

    public function __construct($user_id, $first_name, $last_name, $notificacao, $email, $imagem, $telefone) {
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->notificacao = $notificacao;
        $this->email = $email;
        $this->imagem = $imagem;
        $this->telefone = $telefone;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function getNotificacao() {
        return $this->notificacao;
    }

    public function setNotificacao($notificacao) {
        $this->notificacao = $notificacao;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

}
?>
