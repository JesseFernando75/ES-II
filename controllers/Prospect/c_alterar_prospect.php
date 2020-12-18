<?php
session_start();

require_once('ControllerProspect.php');
require_once('../../models/Prospect.php');

use models\Prospect;
use controller\ControllerProspect;

if(isset($_POST['codigo'])){
   $codigo = $_POST['codigo'];
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $celular = $_POST['celular'];
   $facebook = $_POST['facebook'];
   $whatsapp = $_POST['whatsapp'];

   $prospect = new Prospect();

   $prospect->addProspect($codigo, $nome, $email, $celular, $facebook, $whatsapp);

   $ctrlProspect = new ControllerProspect();

   try{
      $ctrlProspect->salvarProspect($prospect);
      header("Location: ../../views/Prospect/v_listar_prospects.php");
   }catch(Exception $e){
      $_SESSION['erroAlteracao'] = $e->getMessage();
      header("Location: ../../views/Prospect/v_alterar_prospect.php");
   }
}else{
   $_SESSION['erroLogin'] = "Faça o Login para completar a operação";
   header("Location: ../../index.php");
}
?>