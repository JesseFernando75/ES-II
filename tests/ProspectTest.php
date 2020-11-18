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
            public function testBuscarProspect(){
              $daoProspect = new DAOProspect();
              $prospect = new Prospect();
                try{
                 $prospect->addProspect("João", "j.o@gmail.com", "48978964512", "facebook/joao", "9878453212");
                  $this->assertEquals(
                    $prospect,
                    $daoProspect->buscarProspect("j.o@gmail.com")
                  );
                }
              catch(\Exception $e){
                $this->fail($e->getMessage());
              }
              unset($prospect);
              unset($daoProspect);
          }
        }
?>