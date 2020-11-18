<?php  
namespace DAO;
mysqli_report(MYSQLI_REPORT_STRICT);
require_once('../models/Prospect.php');
use models\Prospect;

     /**
     * Classe reponsável por mediar a comunicação de 'Prospect' com o banco de dados.
     * Implementa as funções CRUD de Prospect (incluir, alterar, atualizar e excluir).
     * @author Jessé Fernando Bueno
     */
     class DAOProspect{
         /**
         * Inclui um novo Prospect no banco de dados.
         * @param string $nome Nome do novo Prospect
         * @param string $email Email do novo Prospect
         * @param string $celular Celular do novo Prospect
         * @param string $facebook Endereço do Facebook do novo Prospect
         * @param string $whatsapp Número de WhatsApp do novo Prospect
         * @return TRUE|Exception
         */
         public function incluirProspect($nome, $email, $celular, $facebook, $whatsapp){
             try{
                 $conexaoDB = $this->conectarBanco();
             } 
             catch(\Exception $e){
                 die($e->getMessage());
             }

             $sqlInsert = $conexaoDB->prepare("insert into prospect
                                            (nome, email, celular, facebook, whatsapp)
                                                VALUES
                                            (?,?,?,?,?)");
             $sqlInsert->bind_param("sssss", $nome, $email, $celular, $facebook, $whatsapp);
             $sqlInsert->execute();

             if(!$sqlInsert->error){
                $retorno = TRUE;
             } else{
                throw new \Exception("Não foi possível incluir novo Prospect.");
                die;
               }
             $conexaoDB->close();
             $sqlInsert->close();
             return $retorno;
        }

         /**
         * Atualiza os dados de um Prospect já cadastrado.
         * @param string $nome Novo nome para Prospect
         * @param string $email Novo email para Prospect
         * @param string $celular Novo celular para prospect
         * @param string $facebook Novo endereço de Facebook para Prospect
         * @param string $whatsapp Novo número de WhatsApp para o Prospect
         * @param string $codigoProspect ID do Prospect que será alterado
         * @return TRUE|Exception
         */
         public function atualizarProspect($nome, $email, $celular, $facebook, $whatsapp, $codigoProspect){
             try{
                $conexaoDB = $this->conectarBanco();
             } 
             catch(\Exception $e){
                die($e->getMessage());
             }

             $sqlUpdate = $conexaoDB->prepare("update prospect set
                                                nome = ?,
                                                email = ?,
                                                celular = ?,
                                                facebook = ?,
                                                whatsapp = ?
                                                where
                                                cod_prospect = ?");
             $sqlUpdate->bind_param("ssssss", $nome, $email, $celular, $facebook, $whatsapp, $codigoProspect);
             $sqlUpdate->execute();

             if(!$sqlUpdate->error){
                $retorno = TRUE;
             } else{
                throw new \Exception("Não foi possível alterar o prospect!");
                die;
              }
             $conexaoDB->close();
             $sqlUpdate->close();
             return $retorno;
         }

         /**
         * Exclui um Prospect previamente cadastrado.
         * @param string $codigoProspect ID do Prospect que será excluído
         * @return TRUE|Exception
         */
         public function excluirProspect($codigoProspect){
             try{
                $conexaoDB = $this->conectarBanco();
             } 
             catch(\Exception $e){
                die($e->getMessage());
             }

             $sqlDelete = $conexaoDB->prepare("delete from prospect
                                                where
                                                cod_prospect = ?");
             $sqlDelete->bind_param("i", $codigoProspect);
             $sqlDelete->execute();

             if(!$sqlDelete->error){
                $retorno = TRUE;
             } else{
                throw new \Exception("Não foi possível excluir o prospect!");
                die;
              }
             $conexaoDB->close();
             $sqlDelete->close();
             return $retorno;
         }

         /**
         * Busca Prospects no banco de dados.
         * @param string $email Email do Prospect que deve ser retornado. Este parâmetro é opcional
         * @return Array[Prospect] Se o campo E-mail for informada a pesquisa retornará somente o Prospect relacionado
         * senão retornará todos os Prospects do banco de dados
         */
         public function buscarProspects($email=null){
             try{
                $conexaoDB = $this->conectarBanco();
             } 
             catch (\Exception $e){
                die($e->getMessage());
             }
             /*Array que será retornado com um ou mais prospects*/
             $prospects = array();

             if($email === null){
                 $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                                  facebook, whatsapp
                                                  from prospect");
                $sqlBusca->execute();
             } else{
                 $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                                  facebook, whatsapp
                                                  from prospect
                                                  where
                                                  email = ?");
                 $sqlBusca->bind_param("s", $email);
                 $sqlBusca->execute();
               }

             $resultado = $sqlBusca->get_result();
             if($resultado->num_rows !== 0){
                 while($linha = $resultado->fetch_assoc()){
                     $prospect = new Prospect();
                     $prospect->addProspect($linha['cod_prospect'], $linha['nome'], $linha['email'], $linha['celular'],
                                            $linha['facebook'], $linha['whatsapp']);
                     $prospects[] = $prospect;
                 }
             }
             return $prospects;
             $conexaoDB->close();
             $sqlBusca->close();
        }

         private function conectarBanco(){
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = dirname(__FILE__).$ds;
      
            require($base_dir.'bd_config.php');
      
            try{ 
               $conn = new \MySQLi($dbhost, $user, $password, $db);
               return $conn;
            }
            catch(mysqli_sql_exception $e){
               throw new \Exception($e);
               die;
            } 
         }
     }
?>