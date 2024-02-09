<?php

include_once(__DIR__ . '/DaoErro.php');
include_once(__DIR__ . '/../model/checkin.php');

class DaoCheckin{
    private $TBL_CHECKIN = "TBL_CHECKIN";
    private $conexao;
    private $idUsuarioSessao;

    function __construct($conexao, $idUsuarioSessao){
        $this->conexao = $conexao;
        $this->idUsuarioSessao = $idUsuarioSessao;
    }

    function inserirCheckin(Checkin $checkin){
        $idIlha = $checkin->getIdIlha();
        $idOperador = $checkin->getIdOperador();
        $dataHora = $checkin->getDataHoraCheckin();
        $statusCheckin = $checkin->getStatusCheckin();

        try{
            $stmt = $this->conexao->prepare("INSERT INTO {$this->TBL_CHECKIN} (ID_ILHA, ID_OPERADOR, DATA_CHECKIN, STATUS_CHECKIN) VALUES (?,?,?,?)");
            $stmt->bind_param("iisi", $idIlha, $idOperador, $dataHora, $statusCheckin);

            if($stmt->execute()){
                return $stmt->insert_id;
            } else {
                return -1;
            }

        } catch (Exception $e){
            $dataHoraFormatada = new DateTime();
            $erro = new Erro(0,$e->getMessage(), "DaoCheckin.inserirCheckin", $dataHoraFormatada->format('Y-m-d H:i:s'), $this->idUsuarioSessao);
            $conexaoTblErro = new Conexao();
            $daoErro = new DaoErro($conexaoTblErro->conectar());            
            $daoErro->inserirErro($erro);
            return null;    
        }
    }

    function selecionarCheckin($idCheckin){
        $idIlha = null;
        $idOperador = null;
        $dataHora = null;
        $statusCheckin = null;

        try{
            $stmt = $this->conexao->prepare("SELECT ID_ILHA, ID_OPERADOR, DATA_CHECKIN, STATUS_CHECKIN FROM {$this->TBL_CHECKIN} WHERE ID_CHECKIN = ?");
            $stmt->bind_param("i", $idCheckin);

            $stmt->execute();

            if($stmt->fetch()){
                return new Checkin($idCheckin, $idIlha, $idOperador, $dataHora, $statusCheckin);                
            } else {
                return null;
            }

        } catch (Exception $e){
            $dataHoraFormatada = new DateTime();
            $erro = new Erro(0,$e->getMessage(), "DaoCheckin.selecionarCheckin", $dataHoraFormatada->format('Y-m-d H:i:s'), $this->idUsuarioSessao);
            $conexaoTblErro = new Conexao();
            $daoErro = new DaoErro($conexaoTblErro->conectar());            
            $daoErro->inserirErro($erro);
            return null;    
        }
    }

    function gerarListaCheckin(){
        $listaCheckin = [];
        $idCheckin = null;
        $idIlha = null;
        $idOperador = null;
        $dataHora = null;
        $statusCheckin = null;

        try{
            $stmt = $this->conexao->prepare("SELECT * FROM {$this->TBL_CHECKIN}");
            $stmt->execute();

            $stmt->bind_result($idCheckin, $idIlha, $idOperador, $dataHora, $statusCheckin);

            while($stmt->fetch()){
                $checkin = new Checkin($idCheckin, $idIlha, $idOperador, $dataHora, $statusCheckin);
                $listaCheckin[] = $checkin;
            }

            $stmt->close();
            return $listaCheckin;
        } catch (Exception $e){
            $dataHoraFormatada = new DateTime();
            $erro = new Erro(0,$e->getMessage(), "DaoCheckin.gerarListaCheckin", $dataHoraFormatada->format('Y-m-d H:i:s'), $this->idUsuarioSessao);
            $conexaoTblErro = new Conexao();
            $daoErro = new DaoErro($conexaoTblErro->conectar());            
            $daoErro->inserirErro($erro);
            return null;    
        }
    }
}

?>