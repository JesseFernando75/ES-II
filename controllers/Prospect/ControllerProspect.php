<?php
namespace controllers;
require_once('../DAO/DAOProspect.php');
use DAO\DAOProspect;

/**
 * Classe incumbida de tratar as regras de negócio da
 * classe Prospect.
 * Limite às funções da entidade Prospect.
 * @author Jessé Fernando Bueno
 */
class ControllerUsuario{
    /**
    * Recebe os dados de um novo Prospect, trata as exceções e as envia para
    * a classe DAO executá-las no banco de dados.
    * @param string $nome Nome do novo Prospect
    * @param string $email E-mail do novo Prospect
    * @param string $facebook Facebook do novo Prospect
    * @param string $whatsapp WhatsApp do novo Prospect
    * @return TRUE|Exception Retorna TRUE se a inclusão foi concluída com
    * êxito ou uma Exception caso não seja.
    */
    public function inclusaoProspect($nome, $email, $celular, $facebook, $whatsapp){
        $daoProspect = new DAOProspect();

        try{
            $prospect = $daoProspect->incluirProspect($nome, $email, $celular, $facebook, $whatsapp);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

     /**
    * Recebe os dados de um Prospect já existente, trata as exceções e 
    * e envia para classe DAO atualizar o banco de dados.
    * @param string $nome Nome do novo Prospect
    * @param string $email E-mail do novo Prospect
    * @param string $facebook Facebook do novo Prospect
    * @param string $whatsapp WhatsApp do novo Prospect
    * @param string $codProspect Código do Prospect que será alterado
    * @return TRUE|Exception Retorna TRUE se a modificação foi concluída com
    * êxito ou uma Exception caso não seja.
    */
    public function atualizacaoProspect($nome, $email, $celular, $facebook, $whatsapp, $codProspect){
        $daoProspect = new DAOProspect();

        try{
            $prospect = $daoProspect->atualizarProspect($nome, $email, $celular, $facebook, $whatsapp, $codProspect);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

     /**
    * Recebe os dados de um Prospect já existente, trata as exceções e 
    * e envia para classe DAO excluí-lo do banco de dados.
    * @param string $codProspect Código do Prospect que será excluido
    * @return TRUE|Exception Retorna TRUE se a exclusao foi concluída com
    * êxito ou uma Exception caso não seja.
    */
    public function exclusaoProspect($codProspect){
        $daoProspect = new DAOProspect();

        try{
            $prospect = $daoProspect->excluirProspect($codProspect);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
    * Recebe um campo de busca que retornará ou não o Prospect correspondente.
    * @param string $email E-mail do Prospect a ser buscado
    * @return Array[Prospect] Se informado email, retorna somente o prospect relacionado,
    * senão retorna todos os prospects cadastrados.
    */
    public function buscaDeProspect($email = null){
        $daoProspect = new DAOProspect();

        try{
            $prospect = array();
            $prospect = $daoProspect->buscarProspect($email);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        unset($daoProspect);
        return $prospect;
    }
}
?>