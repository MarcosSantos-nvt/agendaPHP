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
    <section id="formulario">
        <form>
            <h2>CADASTRAR:</h2>
            <div>
                <label for="nome" id="nome">Nome: </label>
                <input type="text" name="nome" id="nome">
            </div>
            <div>
                <label for="telefone" id="telefone">Telefone: </label>
                <input type="text" id="telefone" name="telefone" placeholder="(99)99999-9999">
            </div>
            <div>
                <label for="email" id="email">e-mail: </label>
                <input type="email" id="email" name="email">
            </div>
            <input type="submit" id="btncadastrar" name="btncadastrar" value="Cadastrar">
        </form>
    </section>
    <section id="consulta">
        <table>
            <tr id="titulo">
                <td>NOME:</td>
                <td>TELEFONE:</td>
                <td colspan="2">E-MAIL:</td>
            </tr>
            <tr>
                <td>Marcos</td>
                <td>(47)99999-9999</td>
                <td>marcos@gmail.com</td>
                <td><a href="">ALTERAR</a><a href="">EXCLUIR</a></td>
            </tr>
        </table>
    </section>
</body>

</html>