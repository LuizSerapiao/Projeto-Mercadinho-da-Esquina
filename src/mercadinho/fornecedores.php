
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<h1>Fornecedores</h1>
<form action="gerente.php">
    <input type="submit" value="Voltar" />
</form>
<!---
<B>Adicionar Fornecedor</B>
<form action="fornecedores.php" method="post" autocomplete="off">

    <input type="text" name="nome" maxlength="50" placeholder="Nome" required/>
    <input type="text" name="telefone" size="11" placeholder="Telefone" required/>
    <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email" required/>
    <input type="text" name="estado" maxlength="50" placeholder="Estado" />
    <input type="text" name="cidade" maxlength="50" placeholder="Cidade" />
    <input type="text" name="endereço" maxlength="50" placeholder="endereço" />

    <input type="submit" name="add" value="adicionar" />
</form>
--->
<button onclick="window.location.href='cadastrar_fornecedor.php'">Cadastrar Fornecedor</button>

<form action="fornecedores_editar.php">
    <input type="submit" name="edt" value="Editar Fornecedor" />
</form>

<B>Procurar ou deletar fornecedores</B>
<form action="fornecedores.php" method="POST">
    <input type="text" name="nome" placeholder="Nome" required/>
    <input type="submit" name="lst" value="Procurar" required/>
    <input type="submit" name="rmv" value="remover" />
</form>

<form action="fornecedores.php" method="POST">
    <input type="submit" name="lst" value="Listar Fornecedores" required/>

    <br><br>
</form>


    <br>
<br><br>
<?php
    include_once ("Classes/Forn.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercadinho";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $action = new Forn();
    if ( isset( $_POST['add'])) {
        $nome = $_REQUEST['nome'];
        $telefone = $_REQUEST['telefone'];
        $email = $_REQUEST['email'];
        $estado = $_REQUEST['estado'];
        $cidade = $_REQUEST['cidade'];
        $endereco = $_REQUEST['endereço'];

        $action->insereFornecedor($nome, $telefone, $email, $estado, $cidade, $endereco, $conn);


    }
    else if ( isset( $_POST['rmv']) ) {
        $nome = $_REQUEST['nome'];
        $action->removeFornecedor($nome, $conn);

    }
     else if ( isset( $_POST['edt'])) {
        $nome = $_REQUEST['nome'];

        $novo_nome = $_REQUEST['novo_nome'];
        $novo_telefone = $_REQUEST['novo_telefone'];
        $novo_email = $_REQUEST['novo_email'];
        $novo_estado = $_REQUEST['novo_estado'];
        $nova_cidade = $_REQUEST['nova_cidade'];
        $novo_endereço = $_REQUEST['novo_endereço'];

       $action->editarFornecedor($nome, $novo_nome, $novo_telefone, $novo_email, $novo_estado, $nova_cidade, $novo_endereço, $conn);
    }
    else if (isset( $_POST['lst'])) {
        if (!empty($_REQUEST['nome'])) {
            $usuario = $_REQUEST['nome'];
            $action->listarFornecedor($usuario, $conn);
        }
        else {
            $action->listarFornecedor(null, $conn);
        }
    }

    $conn->close();
?>
</html>
