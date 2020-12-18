<?php

session_start();
require_once('ControllerUsuario.php');
use controller\ControllerUsuario;

if(isset($_POST['nome'])){
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $celular = $_POST['celular'];
   $login = $_POST['login'];
   $senha = $_POST['senha'];

   $cUsuario = new ControllerUsuario();

   try{
      $cUsuario->salvarUsuario($nome, $email, $celular, $login, $senha);
      unset($cUsuario);
      $_SESSION['erroLogin'] = "Faça o Login para entrar no sistema!";
      header("Location: ../../index.php");
   }catch(Exception $e){
      $_SESSION['erroNovoUsuario'] = $e->getMessage();
      unset($cUsuario);
      header("Location: ../../views/Usuario/v_incluir_usuario.php");
   }
}else{
      $_SESSION['erroLogin'] = "Faça o Login para entrar no sistema!";
      header("Location: ../../index.php");
}
?>