<html lang="pt-br">
<h1>Conectar fornecedor e produto!</h1>
<!--- Caixas de entrada e botões --->
<form action="fornecedores.php">
    <input type="submit" value="Voltar" />
</form>

<?php

    include_once ("Classes/Forn.php"); //listarFornecedor($nome, $conn)
    include_once ("Classes/Prod.php"); //listarProduto($nome, $conn)

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercadinho";

    // Conexao com o servidor
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $forn = new Forn();
    $prod = new Prod();

    $forn->listarFornecedor(NULL, $conn);
    $prod->listarProduto(NULL, $conn);

    if ( isset( $_POST['ligar'])) {
        $id_fornecedor = $_REQUEST['fornecedor'];
        $id_produto = $_REQUEST['produto'];
        $valor = $_REQUEST['valor'];
        $sql = "INSERT INTO produtos_fornecidos (id_fornecedor, id_produto, valor)
                VALUES ('$id_fornecedor','$id_produto', '$valor')";

        if ($conn->query($sql) === TRUE) {
            echo "Conexão criada com sucesso!";
        }
        else {
            echo "Erro ao criar ligação: " . $conn->error;
        }
    }
?>

 <form action="ligar_fornecedor_produto.php" method="post" autocomplete="off">
     <input type="text" name="fornecedor" placeholder="id_fornecedor" required />
     <br>
     <input type="text" name="produto" placeholder="id_produto" required/>
     <input type="number" step="0.01" name="valor" placeholder="valor" required/>
     <input type="submit" name="ligar" value="Conectar!" />
 </form>

</html>
