<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>

<style>
  .input-txt{
    width: 402px;
  }
</style>

<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="leftbar-gerente">
    <a href="pedidos.php">
      <img src="assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
    </a>
    <a href="vendas.php">
      <img src="assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
    </a>
    <a href="produtos.php">
      <img src="assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
    </a>
    <a href="fornecedores.php">
      <img src="assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
    </a>
    <a href="funcionarios.php">
      <img src="assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
    </a>
  </div>
</body>
<!--- Caixas de entrada e botões --->
<form action="fornecedores.php">
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

    if ( isset( $_POST['ligar'])) {
        $id_fornecedor = $_REQUEST['fornecedor'];
        $sql = "SELECT id_fornecedor
                FROM fornecedores
                WHERE id_fornecedor = $id_fornecedor";
        $result = $conn->query($sql);

        if ($result and $result->num_rows > 0) {
            $id_produto = $_REQUEST['produto'];
            $sql = "SELECT id_produto
                    FROM produtos
                    WHERE id_produto = $id_produto";
            $result = $conn->query($sql);

            if ($result and $result->num_rows > 0) {
                $valor = $_REQUEST['valor'];
                $sql = "INSERT INTO produtos_fornecidos (id_fornecedor, id_produto, valor)
                        VALUES ('$id_fornecedor','$id_produto', '$valor')";

                if ($conn->query($sql) === TRUE) {
                    header("Location:fornece.php");
                }
                else {
                    echo "Erro ao criar ligação: " . $conn->error;
                }
            }
        }
        else {
            echo "Fornecedor não encontrado!";
        }
    }
?>

 <form action="fornece.php" method="post" autocomplete="off">
    <input type="text" name="fornecedor" placeholder="id_fornecedor" required />
    <br>
    <input type="text" name="produto" placeholder="id_produto" required/>
    <input type="text" name="valor" placeholder="valor" required/>
    <input type="submit" name="ligar" value="Confirmar" />
 </form>

</html>
