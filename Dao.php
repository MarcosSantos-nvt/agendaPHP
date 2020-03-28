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
    }
   
?>