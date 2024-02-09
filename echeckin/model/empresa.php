<?php

class Empresa {

    private $idEmpresa;
    private $razaoSocial;
    private $nomeFantasia;
    private $endereco;
    private $contato;
    private $responsavel;
    private $statusEmpresa;

    function __construct($idEmpresa, $razaoSocial, $nomeFantasia, $endereco, $contato, $responsavel, $statusEmpresa){
        $this->setIdEmpresa($idEmpresa);
        $this->setRazaoSocial($razaoSocial);
        $this->setNomeFantasia($nomeFantasia);
        $this->setEndereco($endereco);
        $this->setContato($contato);
        $this->setResponsavel($responsavel);
        $this->setStatusEmpresa($statusEmpresa);
    }

    function setIdEmpresa($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }

    function setRazaoSocial($razaoSocial){
        $this->razaoSocial = $razaoSocial;
    }

    function setNomeFantasia($nomeFantasia){
        $this->nomeFantasia = $nomeFantasia;
    }

    function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    function setContato($contato){
        $this->contato = $contato;
    }

    function setResponsavel($responsavel){
        $this->responsavel = $responsavel;
    }

    function setStatusEmpresa($statusEmpresa){
        $this->statusEmpresa = $statusEmpresa;
    }

    function getIdEmpresa(){
        return $this->idEmpresa;
    }

    function getRazaoSocial(){
        return $this->razaoSocial;
    }

    function getNomeFantasia(){
        return $this->nomeFantasia;
    }

    function getEndereco(){
        return $this->endereco;
    }

    function getContato(){
        return $this->contato;
    }

    function getResponsavel(){
        return $this->responsavel;
    }

    function getStatusEmpresa(){
        return $this->statusEmpresa;
    }

    function __toString(){
        return
        "<br>ID Empresa: ".$this->getIdEMpresa().
        "<br>Razão social: ".$this->getRazaoSocial().
        "<br>Nome fantasia: ".$this->getNomeFantasia().
        "<br>Endereço: ".$this->getEndereco().
        "<br>Contato: ".$this->getContato().
        "<br>Responsável: ".$this->getResponsavel().
        "<br>Status: ".$this->getStatusEmpresa()."<br>";
    }
}

?>