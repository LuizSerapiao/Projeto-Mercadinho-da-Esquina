
<html lang="pt-br">
<h1>Produtos</h1>
<!--- Caixas de entrada e botões --->
<form action="index.php">
    <input type="submit" value="Voltar" />
</form>

<B>Adicionar produto</B>
<form action="produtos.php" method="post">

    <input type="text" name="nome" placeholder="Nome" required />
    <input type="text" name="valor" placeholder="Valor" required />

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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercadinho";

    // Conexao com o servidor
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Tratamento para cada opção escolhida
    if ( isset( $_POST['add'])) {
        $nome = $_REQUEST['nome'];
        $valor = $_REQUEST['valor'];

        $sql = "INSERT INTO produtos (nome, valor) 
        VALUES ('$nome','$valor')";

        if ($conn->query($sql) === TRUE) {
            echo "Produto $nome adicionado com sucesso!";
        }
        else {
            echo "Erro ao adicionar produto: " . $sql . "<br>" . $conn->error;
        }
    }
    else if ( isset( $_POST['rmv']) ) {
        $nome = $_REQUEST['nome'];
        
        $sql = "DELETE FROM produtos 
        WHERE nome = '$nome'";

        if ($conn->query($sql) === TRUE) {
            echo "Produto $nome deletado com sucesso!";
        }
        else {
            echo "Erro ao deletar produto: " . $conn->error;
        }
    }
    else if ( isset( $_POST['edt'])) {
        $nome = $_REQUEST['nome'];
        $novo_nome = $_REQUEST['novo_nome'];
        $novo_valor = $_REQUEST['novo_valor'];
        
        $sql = "UPDATE produtos
        SET nome = '$novo_nome', valor = '$novo_valor' 
        WHERE nome = '$nome'";

        if ($conn->query($sql) === TRUE) {
            echo "produto $nome editado com sucesso!";
        }
        else {
            echo "Erro ao editar produto: " . $conn->error;
        }
    }
    else if (isset( $_POST['lst'])) {
        if (!empty($_REQUEST['nome'])) {
            echo "<b>Resultado da busca:</b> <br>";
            $nome = $_REQUEST['nome'];
            $sql = "SELECT id, nome, valor 
            FROM produtos
            WHERE nome = '$nome'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. "<br>";
                }
            }
            else {
                echo "Nenhum produto encontrado";
            }
        }
        else {
            $sql = "SELECT id, nome, valor 
            FROM produtos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo "<B>Lista de produtos</B> <br>";
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. "<br>";
                }
            }
            else {
                echo "Nenhum produto cadastrado!";
            }
        }
    }

    $conn->close();
?>
</html>
