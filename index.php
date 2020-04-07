
<?php
    require_once ('Dao.php');
    $consulta = new Dao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo/estilo.css">
    <link rel="shortcut icon" href="img\phonebook.ico">
    <title>Agenda</title>
</head>
<body>
    <?php       
        
        if(isset ($_POST['nome']))        
        //SELEÇÃO CADASTRAR OU EDITAR 
        {           
                        
            if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
                
                $id_upda = addslashes($_GET['id_up']);
                $nome = $_POST['nome'];
                $endereco = $_POST['endereco'];
                $cpf = $_POST['cpf'];
                if(!empty($nome) && !empty($endereco) && !empty($cpf)){
                   
                    $consulta->updateCliente($id_upda, $nome, $endereco, $cpf);
                    header('location:index.php');
                } 
                
                
            }

            else
            //------------------------cadastrar------------------
            {

                $nome = $_POST['nome'];
                $endereco = $_POST['endereco'];
                $cpf = $_POST['cpf'];
                
                if(!empty($nome) && !empty($endereco) && !empty($cpf)){
                   
                    if(!$consulta->insertCliente($nome,$endereco,$cpf)){
                        ?>
                        <div class="aviso">
                            <h3>CPF JÁ CADASTRADO NESTA BASE!</h3>
                        </div>
                    <?php
                    }
                } 
                else
                    {
                        ?>
                        <div class="aviso">
                            <h3>FAVOR PREENCHER TODOS OS DADOS PARA EXECUTAR O CADASTRO!</h3>
                        </div>
                    <?php
                    }

                }
            
        } 
    ?>

    <?php
        if (isset($_GET['id_up'])){

            $id_update = addslashes($_GET['id_up']);
            $res = $consulta->selectDadoCliente($id_update);            
        }
    ?>
    <section id="formulario">
        <form method="POST">
            <h2>CADASTRAR:</h2>
            <div>
                <label for="nome" id="nome">Nome: </label>
                <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['NOME'];}?>">
            </div>
            <div>
                <label for="endereco" id="endereco">Endereço: </label>
                <input type="text" id="endereco" name="endereco"value="<?php if(isset($res)){echo $res['ENDERECO'];}?>">
            </div>
            <div>
                <label for="cpf" id="cpf">CPF: </label>
                <input type="text" id="cpf" name="cpf"value="<?php if(isset($res)){echo $res['CPF'];}?>">
            </div>
            <input type="submit" id="btncadastrar" name="btncadastrar" value="<?php if(isset($res)){echo'ATUALIZAR';} 
            else{ echo 'CADASTRAR';} ?>">
        </form>
    </section>
    <section id="consulta">    
        <table>
            <tr id="titulo">
                <td>NOME:</td>
                <td>ENDEREÇO:</td>
                <td colspan="2">CPF:</td>
            </tr>
            <?php
            
                $dados = $consulta->selectAll();

                if (count($dados) > 0){
                    for ($i=0; $i < count($dados) ; $i++) { 
                        echo"<tr>";
                        foreach ($dados[$i] as $key => $value) {
                            if($key!="ID"){
                                echo"<td>".$value."</td>";
                            }
                        }
            ?>
                        <td>                            
                            <a href="index.php?id_up=<?php echo $dados[$i]['ID'];?>">ALTERAR</a>
                            <a href="index.php?ID=<?php echo $dados[$i]['ID'];?>">EXCLUIR</a>
                        </td>
            <?php
                        echo"</tr>";
                    }                   
                    
                } else{

                    ?>
                        <div class="aviso">
                            <h3>NÃO EXISTEM DADOS CADASTRADOS!</h3>
                        </div>
                    <?php
                }

            ?>
            
        </table>
    </section>
</body>

</html>

<?php
    if(isset($_GET['ID'])){
        $id_cliente = addslashes($_GET['ID']);
        $consulta->deleteCliente($id_cliente);
        header("location: index.php");
    }
?>