<?php
namespace tests;
require_once('../uteis/vendor/autoload.php');
require_once('../models/Prospect.php');
require_once('../DAO/DAOProspect.php');
use PHPUnit\Framework\TestCase;
use models\Prospect;
use DAO\DAOProspect;

         class ProspectTest extends TestCase{
            /** @test */
             public function testIncluirProspect(){
                 $daoProspect = new DAOProspect();
                 try{
                    $this->assertEquals(
                    TRUE,
                    $daoProspect->incluirProspect("Gabriel", "gabriel@gmail.com",  "(49)988551122", "facebook/gabriel", "(49)988551122")
                    );
                  unset($daoProspect);
                 }
                 catch(\Exception $e){
                  $this->fail($e->getMessage());
                 }
             } 

              /** @test */
              public function testAtualizarProspect(){
                  $daoProspect = new DAOProspect();
                  try{
                      $this->assertEquals(
                      TRUE,
                      $daoProspect->atualizarProspect("Aristides Carlos", "ari@hotmail.com",  "(48)5566-8899", "facebook/borba", "(49)955663322", "30")
                      );
                    unset($daoProspect);
                  }
                  catch(\Exception $e){
                    $this->fail($e->getMessage());
                  }
              } 

              /** @test */
              public function testExcluirProspect(){
                $daoProspect = new DAOProspect();
                try{
                  $this->assertEquals(
                  TRUE,
                  $daoProspect->excluirProspect(32)
                  );
                unset($daoProspect);
                }
                catch(\Exception $e){
                $this->fail($e->getMessage());
                }
            } 

        /** @test */
        public function buscarTodosProspectTest(){
          $daoProspect = new DAOProspect();

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
            $daoProspect->buscarProspects()
          );
          unset($daoProspect);
          unset($linhaComparar);
          $sqlBusca->close();
          $conn->close();
      }

        /** @test */
        public function buscarProspectPorEmailTest(){
            $daoProspect = new DAOProspect();
            $arrayComparar = array();
            $emailProspect = 'gernunes@hotmail.com';

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