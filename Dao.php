<?php
    
         
    class Dao{
        
        private $pdo;

        public function __construct($user, $password){

            try{
            $this->pdo = new PDO('mysql:host=localhost; dbname=app_studind', $user, $password);
            $msg = "conexão com sucesso";
            }
            catch(PDOException $e){
                echo 'ERRO AO CONECTAR OS BD:';
                echo '</br>';
                echo $e->getMessage();
            }
        }
        
        public function selectAll(){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM cliente;");
            $cmd->execute();
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;

            echo 'tudo bem até aki';
        }
    }
   
?>