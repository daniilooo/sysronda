<?php

class Checkin{

    private $idCheckin;
    private $idIlha;
    private $idOperador;
    private $dataHoraCheckin;
    private $statusCheckin;

    function __construct($idCheckin, $idIlha, $idOperador, $dataHora, $statusCheckin){
        $this->setIdCheckin($idCheckin);
        $this->setIdIlha($idIlha);
        $this->setIdOperador($idOperador);
        $this->setDataHora($dataHora);
        $this->setStatusCheckin($statusCheckin);
    }

    function setIdCheckin($idCheckin){
        $this->idCheckin = $idCheckin;
    }

    function setIdIlha($idIlha){
        $this->idIlha = $idIlha;
    }

    function setIdOperador($idOperador){
        $this->idOperador = $idOperador;
    }

    function setDataHora($dataHora){
        // Verifica se já é um objeto DateTime
        if ($dataHora instanceof DateTime) {
            $this->dataHoraCheckin = $dataHora;
        } else {
            $this->dataHoraCheckin = new DateTime($dataHora);
        }
    }

    function setStatusCheckin($statusCheckin){
        $this->statusCheckin = $statusCheckin;
    }

    function getIdCheckin(){
        return $this->idCheckin;
    }

    function getIdIlha(){
        return $this->idIlha;
    }

    function getIdOperador(){
        return $this->idOperador;
    }

    function getDataHoraCheckin(){
        return $this->dataHoraCheckin;
    }

    function getStatusCheckin(){
        return $this->statusCheckin;
    }

    function __toString(){
        return
        "<br>ID CheckIn: ".$this->getIdCheckin().
        "<br>ID Ilha: ".$this->getIdIlha().
        "<br>ID Operador: ".$this->getIdOperador().
        "<br>Data e hora do Check-in: ".$this->getDataHoraCheckin().
        "<br>Status do checkin: ".$this->getStatusCheckin()."<br>";
    } 

}

?>