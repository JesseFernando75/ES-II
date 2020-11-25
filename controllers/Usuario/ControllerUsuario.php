<?php
namespace controllers;
require_once('../DAO/DAOUsuario.php');
use DAO\DAOUsuario;

/**
 * Classe incumbida de tratar as regras de negócio da
 * classe Usuário.
 * Limite às funções da entidade Usuário.
 * @author Jessé Fernando Bueno
 */
class ControllerUsuario{
    /**
    * Recebe os dados de login, trata as exceções e as envia para
    * a classe DAO executá-las no banco de dados.
    * @param string $login Login do Usuário
    * @param string $senha Senha do Usuário
    * @return Usuario
    */
    public function fazerLogin($login, $senha){
        $daoUsuario = new DAOUsuario();

        try{
            $usuario = $daoUsuario->logar($login, $senha);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

        unset($daoUsuario);
        return $usuario;
    }

     /**
    * Recebe os dados de um novo Usuário e envia para classe DAO 
    * que armazena os arquivos no banco de dados.
    * @param string $nome Nome do novo Usuário
    * @param string $email E-mail do novo Usuário
    * @param string $celular Celular do novo Usuário
    * @param string $login Login do novo Usuário
    * @param string $senha Senha do do novo Usuário
    * @return TRUE|Exception Retorna TRUE se a inclusão foi concluída com
    * êxito ou uma Exception caso não seja.
    */
    public function salvarUsuario($nome, $email, $celular, $login, $senha){
        $daoUsuario = new DAOUsuario();

        try{
            $usuario = $daoUsuario->incluirUsuario($nome, $email, $celular, $login, $senha);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
      return $usuario;
    }
}
?>