<?php
namespace tests;

require_once('../uteis/vendor/autoload.php');
require_once('../models/Prospect.php');
require_once('../controllers/Prospect/ControllerProspect.php');

use PHPUnit\Framework\TestCase;
use models\Prospect;
use controllers\Prospect\ControllerProspect;

class ControllerProspectTest extends TestCase{
   /** @test */
   public function testInclusaoProspect(){
      $ctrlProspect = new ControllerProspect();

       try{
         $this->assertEquals(
            TRUE,
            $ctrlProspect->inclusaoProspect("Bob", "bob@gmail.com",  "(49)977552233", "facebook/bob", "(49)988577156")
         );
      }
      catch(\Exception $e){
         $this->fail($e->getMessage());
      }
   }

    /** @test */
    public function testAtualizacaoProspect(){
        $ctrlProspect = new ControllerProspect();
  
         try{
           $this->assertEquals(
              TRUE,
              $ctrlProspect->atualizacaoProspect("Paulo Roberto Cordo", "paulo@eu.com.br", "(49)96633-9988", "facebook/paulocdr", "(49)96633-9988", "6")
           );
        }
        catch(\Exception $e){
           $this->fail($e->getMessage());
        }
     }

     /** @test */
    public function testExclusaoProspect(){
        $ctrlProspect = new ControllerProspect();
  
         try{
           $this->assertEquals(
              TRUE,
              $ctrlProspect->exclusaoProspect("30")
           );
        }
        catch(\Exception $e){
           $this->fail($e->getMessage());
        }
     }

     /** @test */
     public function buscarTodosProspectTest(){
        $ctrlProspect = new ControllerProspect;
  
        $arrayComparar = array();
  
        $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
        $sqlBusca = $conn->prepare("select cod_prospect, nome, email, celular,
                                            facebook, whatsapp
                                            from prospect");
        $sqlBusca->execute();
        $result = $sqlBusca->get_result();
        if($result->num_rows !== 0){
           while($linha = $result->fetch_assoc()) {
              $linhaComparar = new Prospect();
              $linhaComparar->addProspect($linha['cod_prospect'], $linha['nome'], $linha['email'], $linha['celular'],
                                     $linha['facebook'], $linha['whatsapp']);
              $arrayComparar[] = $linhaComparar;
           }
        }
  
        $this->assertEquals(
           $arrayComparar,
           $ctrlProspect->buscaDeProspect()
        );
        unset($daoProspect);
        unset($ctrlProspect);
        $sqlBusca->close();
        $conn->close();
     }

     /** @test */
     public function buscarProspectPorEmailTest(){
        $ctrlProspect = new ControllerProspect();
        $arrayComparar = array();
        $emailProspect = 'paulo@eu.com.br';
  
        $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
        $sqlBusca = $conn->prepare("select cod_prospect, nome, email, celular,
                                            facebook, whatsapp
                                            from prospect
                                            where
                                            email = '$emailProspect'");
        $sqlBusca->execute();
        $result = $sqlBusca->get_result();
        if($result->num_rows !== 0){
          while($linha = $result->fetch_assoc()) {
              $linhaComparar = new Prospect();
              $linhaComparar->addProspect($linha['cod_prospect'], $linha['nome'], $linha['email'], $linha['celular'],
                                     $linha['facebook'], $linha['whatsapp']);
              $arrayComparar[] = $linhaComparar;
           }
        }
     } 
}
?> 