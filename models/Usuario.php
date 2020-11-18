<?php
namespace models;

    /**
     *  Classe Model de Usuário.
     * @author Jessé Fernando Bueno
     */
    class Usuario{
        /**
         * Nome do usuário
         * @var string
         */
        public $nome;
        /**
         * Login do usuário
         * @var string
         */
        public $login;
        /**
         * Senha do usuário
         * @var string
         */
        public $senha;
        /**
         * E-mail do usuário
         * @var string
         */
        public $email;
        /**
         * Celular do usuário
         * @var string
         */
        public $celular;
        /**
         * Identifica se usuário está ou não logado
         * @var boolean
         */
        public $logado;

        /**
         * Define os atributos da classe usuário
         * @param string $nome Nome do usuário
         * @param string $login Login do usuário
         * @param string $senha Senha do usuário
         * @param string $email E-mail do usuário
         * @param string $celular Celular do usuário
         * @param boolean $logado Identifica se usuário está ou não logado
         * @return void
         */
        public function addUsuario($login, $senha, $nome, $email, $celular, $logado){
            $this->login - $login;
            $this->senha - $senha;
            $this->nome - $nome;
            $this->email - $email;
            $this->celular - $celular;
            $this->logado - $logado;
        }   
    }
?>