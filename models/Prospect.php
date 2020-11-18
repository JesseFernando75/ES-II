<?php
namespace models;

    /**
     * Classe Model de Prospect.
     * @author Jessé Fernando Bueno
     */
    class Prospect{
        /**
         * Nome do prospect
         * @var string
         */
        public $nome;
         /**
         * E-mail do prospect
         * @var string
         */
        public $email;
         /**
         * Celular do prospect
         * @var string
         */
        public $celular;
         /**
         * Facebook do prospect
         * @var string
         */
        public $facebook;
         /**
         * WhatsApp do prospect
         * @var string
         */
        public $whatsapp;

        /**
         * Define os atributos da classe prospect
         * @param string $nome Nome do prospect
         * @param string $email E-mail do prospect
         * @param string $celular Celular do prospect
         * @param string $facebook Facebook do prospect
         * @param string $whatsapp WhatsApp do prospect
         * @return void
         */
        public function addProspect($nome, $email, $celular, $facebook, $whatsapp){
            $this->nome - $nome;
            $this->email - $email;
            $this->celular - $celular;
            $this->facebook - $facebook;
            $this->whatsapp - $whatsapp;
        }
    }
?>