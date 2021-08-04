<?php

class Fornecedor {
    private $idfornecedor;
    private $nomeFornecedor;
    private $representante;
    private $email;
    private $telFixo;
    private $telCel;
    private $endereco;
    
    function getIdfornecedor() {
        return $this->idfornecedor;
    }

    function getNomeFornecedor() {
        return $this->nomeFornecedor;
    }

    function getRepresentante() {
        return $this->representante;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelFixo() {
        return $this->telFixo;
    }

    function getTelCel() {
        return $this->telCel;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function setIdfornecedor($idfornecedor) {
        $this->idfornecedor = $idfornecedor;
    }

    function setNomeFornecedor($nomeFornecedor) {
        $this->nomeFornecedor = $nomeFornecedor;
    }

    function setRepresentante($representante) {
        $this->representante = $representante;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelFixo($telFixo) {
        $this->telFixo = $telFixo;
    }

    function setTelCel($telCel) {
        $this->telCel = $telCel;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

}
