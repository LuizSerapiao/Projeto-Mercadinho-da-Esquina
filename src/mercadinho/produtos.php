
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<h1>Produtos</h1>
<!--- Caixas de entrada e botões --->
<form action="index.php">
    <input type="submit" value="Voltar" />
</form>

<B>Adicionar produto</B>
<form action="produtos.php" method="post" autocomplete="off">

    <input type="text" name="nome" maxlength="50" placeholder="Nome" required />
    <input type="number" name="valor" step="0.01" placeholder="Valor" required />

    <input type="submit" name="add" value="adicionar" />

<br>

</form>
<form action="produtos_editar.php">
    <input type="submit" name="edt" value="editar" />
</form>

<B>Procurar ou deletar produto</B>
<form action="produtos.php" method="POST">
    <input type="text" name="nome" placeholder="Nome" required />
    <input type="submit" name="lst" value="Procurar" required/>
    <input type="submit" name="rmv" value="remover" /> 
</form>

<form action="produtos.php" method="POST">
    <input type="submit" name="lst" value="Listar Produtos" />
</form>
<br><br>

<?php

include_once ("Classes/Prod.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercadinho";

    // Conexao com o servidor
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

   $action = new Prod();
    // Tratamento para cada opção escolhida
    if ( isset( $_POST['add'])) {
        $nome = $_REQUEST['nome'];
        $valor = $_REQUEST['valor'];

        $action->adicionarProduto($nome, $valor, $conn);

    }
    else if ( isset( $_POST['rmv']) ) {
        $nome = $_REQUEST['nome'];
        $action->removeProduto($nome, $conn);

    }
    else if ( isset( $_POST['edt'])) {
        $nome = $_REQUEST['nome'];
        $novo_nome = $_REQUEST['novo_nome'];
        $novo_valor = $_REQUEST['novo_valor'];

        $action->editarProduto(nome, $novo_nome, $novo_valor, $conn);
    }
    else if (isset( $_POST['lst'])) {
        if (!empty($_REQUEST['nome'])) {
            $nome = $_REQUEST['nome'];
            $action->listarProduto($nome, $conn);
        }
        else {
           $action->listarProduto(null, $conn);
        }
    }

    $conn->close();
?>
</html>
