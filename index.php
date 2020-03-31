
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
        
        if(isset ($_POST['nome'])){
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $cpf = $_POST['cpf'];

            if(!empty($nome) && !empty($endereco) && !empty($cpf)){
                if(!$consulta->insertCliente($nome,$endereco,$cpf)){
                    echo"CPF JÁ CADASTRADO NESTA BASE DE DADOS";
                }
            } else{
                echo"FAVOR PREENCHER TODOS OS DADOS PARA CADASTRAR AS INFORMAÇÕES";
            }
        } 
    ?>
    <section id="formulario">
        <form method="POST" action="">
            <h2>CADASTRAR:</h2>
            <div>
                <label for="nome" id="nome">Nome: </label>
                <input type="text" name="nome" id="nome">
            </div>
            <div>
                <label for="endereco" id="endereco">Endereço: </label>
                <input type="text" id="endereco" name="endereco">
            </div>
            <div>
                <label for="cpf" id="cpf">CPF: </label>
                <input type="text" id="cpf" name="cpf">
            </div>
            <input type="submit" id="btncadastrar" name="btncadastrar" value="Cadastrar">
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
                            <?php echo $dados[$i]['ID'];?>
                            <a href="">ALTERAR</a>
                            <a href="index.php?ID=<?php echo $dados[$i]['ID'];?>">EXCLUIR</a>
                        </td>
            <?php
                        echo"</tr>";
                    }                   
                    
                } else{
                    echo"NÃO EXISTE DADOS CADASTRADOS NO BANCO DE DADOS";
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