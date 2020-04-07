<?php
    
         
    class Dao{
        
        private $dbname = "app_studind";
        private $user = "root";
        private $password = "";
        private $pdo = null;

        public function __construct(){

            try{
                $this->pdo = new PDO('mysql:host=localhost; dbname='. $this->dbname, $this->user, $this->password);                        
            }

            catch(PDOException $e){
                echo 'ERRO AO CONECTAR  BD:';
                echo '</br>';
                echo $e->getMessage();
            }
        }
        
        public function selectAll(){
           
            try{
                $res = array();
                $cmd = $this->pdo->prepare("SELECT * FROM cliente;");
                $cmd->execute();
                $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }
            
            catch(PDOException $e){
                echo"ERRO COM A TRANSAÇÃO NO BD";
                echo"</br>";
                echo $e->getMessage();
            }
        }

        public function insertCliente($nome, $endereco, $cpf){

            $consulta = $this->pdo->prepare("SELECT * FROM cliente WHERE CPF = :cpf;");
            $consulta->bindValue(":cpf", $cpf);
            $consulta->execute();

            if($consulta->rowCount()>0){
                return false;
            }
            else{
                $con = $this->pdo->prepare("INSERT INTO cliente(NOME, ENDERECO, CPF) VALUES (:nome, :endereco, :cpf)");
                $con->bindValue(":nome", $nome);
                $con->bindValue(":endereco", $endereco);
                $con->bindValue(":cpf", $cpf);
                $con->execute();
                return true;
            }
        }

        public function deleteCliente($id){

            $cmd = $this->pdo->prepare("DELETE FROM cliente WHERE ID = :id;");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
        }

        public function selectDadoCliente($id_up){

            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM cliente WHERE ID= :id;");
            $cmd->bindValue(":id",$id_up);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;                            
        }

        public function updateCliente($id, $nome, $endereco, $cpf){

            $cmd = $this->pdo->prepare("UPDATE cliente SET NOME=:nome, ENDERECO=:endereco, CPF=:cpf WHERE ID=:id;");
            
            $cmd->bindValue(":nome", $nome);
            $cmd->bindValue(":endereco", $endereco);
            $cmd->bindValue(":cpf", $cpf);
            $cmd->bindValue(":id", $id);
            $cmd->execute();           
        }
    }
   
?>