<?php
namespace tests;

require_once('../uteis/vendor/autoload.php');
require_once('../models/Usuario.php');
require_once('../controllers/Usuario/ControllerUsuario.php');

use PHPUnit\Framework\TestCase;
use models\Usuario;
use controllers\Usuario\ControllerUsuario;

class ControllerUsuarioTest extends TestCase{
   /** @test */
   public function testLogar(){
      $ctrlUsuario = new ControllerUsuario();
      $usuario = new Usuario();

       try{
         $usuario->addUsuario("pedro", "Pedro Carvalho", "pedro@gmail.com", "(49)988551122", TRUE);

         $this->assertEquals(
            $usuario,
            $ctrlUsuario->fazerLogin('pedro', '789')
         );
      }
      catch(\Exception $e){
         $this->fail($e->getMessage());
      }
      unset($usuario);
      unset($daoUsuario);
   }

   /** @test */
   public function testIncluirUsuario(){
      $ctrlUsuario = new ControllerUsuario();

      try{
         $this->assertEquals(
            TRUE,
            $ctrlUsuario->salvarUsuario("Machado de Asssis", "escritor@gmail.com","(49)9962-7854", "leandro", "abc")
         );
      }catch(\Exception $e){
         $this->fail($e->getMessage());
      }
   }
}
?> 