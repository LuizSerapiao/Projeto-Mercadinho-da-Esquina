<html lang="pt-br">
<h1>Fazer pedido!</h1>
<!--- Caixas de entrada e botões --->
<form action="pedidos.php">
    <input type="submit" value="Voltar" />
</form>

<?php

    include_once ("Classes/Pedi.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercadinho";

    // Conexao com o servidor
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $action = new Pedi();

    $action->listar_produtos_fornecedores($conn);

    if ( isset( $_POST["pedir"])) {
        $fornecedor = $_REQUEST['fornecedor'];
        $produto = $_REQUEST['produto'];
        $quantidade = $_REQUEST['quantidade'];
        $action->adicionarProduto($fornecedor, $produto, $quantidade, $conn);
    }

?>

 <form action="fazer_pedido.php" method="post" autocomplete="off">
     <input type="text" name="fornecedor" placeholder="id_fornecedor" required />
     <br>
     <input type="text" name="produto" placeholder="id_produto" required/>
     <input type="number" step="1" name="quantidade" placeholder="Quantidade" required/>
     <input type="submit" name="pedir" value="Fazer Pedido" />
 </form>

</html>
