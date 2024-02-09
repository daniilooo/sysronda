<?php

include_once(__DIR__ .'/DaoErro.php');
include_once(__DIR__ .'/../model/empresa.php');

class DaoEmpresa{
    private $TBL_EMPRESA = "TBL_EMPRESAS";
    private $conexao;
    private $idUsuarioSessao;

    function __construct($conexao, $idUsuarioSessao){
        $this->conexao = $conexao;
        $this->idUsuarioSessao = $idUsuarioSessao;
    }

    function inserirEmpresa(Empresa $empresa){
        $razaoSocial = $empresa->getRazaoSocial();
        $nomeFantasia = $empresa->getNomeFantasia();
        $endereco = $empresa->getEndereco();
        $contato = $empresa->getContato();
        $responsavel = $empresa->getResponsavel();
        $statusEmpresa = $empresa->getStatusEmpresa();

        try{

            $stmt = $this->conexao->prepare("INSERT INTO {$this->TBL_EMPRESA} (RAZAO_SOCIAL, NOME_FANTASIA, ENDERECO, CONTATO, RESPONSAVEL, STATUS_EMPRESA) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("sssssi", $razaoSocial, $nomeFantasia, $endereco, $contato, $responsavel, $statusEmpresa);

            if($stmt->execute()){
                return $stmt->insert_id;
            } else {
                return -1;
            }

        } catch (Exception $e){
            $dataHoraFormatada = new DateTime();
            $erro = new Erro(0,$e->getMessage(), "DaoEmpresa.inserirEmpresa", $dataHoraFormatada->format('Y-m-d H:i:s'), $this->idUsuarioSessao);
            $conexaoTblErro = new Conexao();
            $daoErro = new DaoErro($conexaoTblErro->conectar());            
            $daoErro->inserirErro($erro);
            return -2;    
        }
    }

    function selecionarEmpresa($idEmpresa){
        
        $razaoSocial = null;
        $nomeFantasia = null;
        $endereco = null; 
        $contato = null; 
        $responsavel = null;
        $statusEmpresa = null;

        try{
            $stmt = $this->conexao->prepare("SELECT RAZAO_SOCIAL, NOME_FANTASIA, ENDERECO, CONTATO, RESPONSAVEL, STATUS_EMPRESA FROM {$this->TBL_EMPRESA} WHERE ID_EMPRESA = ?");
            $stmt->bind_param("i", $idEmpresa);

            $stmt->execute();

            if($stmt->fetch()){
                return new Empresa($idEmpresa, $razaoSocial, $nomeFantasia, $endereco, $contato, $responsavel, $statusEmpresa);
            } else {
                return null;
            }

        } catch (Exception $e){
            $dataHoraFormatada = new DateTime();
            $erro = new Erro(0,$e->getMessage(), "DaoEmpresa.selecionarEmpresa", $dataHoraFormatada->format('Y-m-d H:i:s'), $this->idUsuarioSessao);
            $conexaoTblErro = new Conexao();
            $daoErro = new DaoErro($conexaoTblErro->conectar());            
            $daoErro->inserirErro($erro);
            return null;    
        }
    }

    function alterarStatusEmpresa(Empresa $empresa){
        
        $idEmpresa = $empresa->getIdEmpresa();
        $statusEmpresa = $empresa->getStatusEmpresa();

        try{
            $stmt = $this->conexao->prepare("UPDATE {$this->TBL_EMPRESA} SET STATUS_EMPRESA = ? WHERE ID_EMPRESA = ?");
            $stmt->bind_param("ii", $statusEmpresa, $idEmpresa);

            if($stmt->execute()){
                return $stmt->affected_rows;
            } else {
                return -1;
            }

        } catch (Exception $e){
            $dataHoraFormatada = new DateTime();
            $erro = new Erro(0,$e->getMessage(), "DaoEmpresa.alterarStatusEmpresa", $dataHoraFormatada->format('Y-m-d H:i:s'), $this->idUsuarioSessao);
            $conexaoTblErro = new Conexao();
            $daoErro = new DaoErro($conexaoTblErro->conectar());            
            $daoErro->inserirErro($erro);
            return -2;    
        }
    }

    function gerarListaEmpresas(){
        $listaEmpresas = [];
        $idEmpresa = null;
        $razaoSocial = null;
        $nomeFantasia = null;
        $endereco = null; 
        $contato = null; 
        $responsavel = null;
        $statusEmpresa = null;

        try{
            $stmt = $this->conexao->prepare("SELECT * FROM {$this->TBL_EMPRESA}");
            $stmt->execute();
            $stmt->bind_result($idEmpresa, $razaoSocial, $nomeFantasia, $endereco, $contato, $responsavel, $statusEmpresa);

            while($stmt->fetch()){
                $empresa = new Empresa($idEmpresa, $razaoSocial, $nomeFantasia, $endereco, $contato, $responsavel, $statusEmpresa);
                $listaEmpresas[] = $empresa;
            }

            $stmt->close();
            return $listaEmpresas;

        } catch (Exception $e){
            $dataHoraFormatada = new DateTime();
            $erro = new Erro(0,$e->getMessage(), "DaoEmpresa.gerarListaEmpresas", $dataHoraFormatada->format('Y-m-d H:i:s'), $this->idUsuarioSessao);
            $conexaoTblErro = new Conexao();
            $daoErro = new DaoErro($conexaoTblErro->conectar());            
            $daoErro->inserirErro($erro);
            return -2;    
        }
    }
}

?>