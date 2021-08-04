<?php

class Endereco {
    private $idendereco;
    private $cep;
    private $logradouro;
    private $complemento;
    private $bairro;
    private $cidade;
    private $uf;
    
    function getIdendereco() {
        return $this->idendereco;
    }

    function getCep() {
        return $this->cep;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function setIdendereco($idendereco) {
        $this->idendereco = $idendereco;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

}
