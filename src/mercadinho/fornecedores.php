
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <title></title>
</head>

<header class="header">
  <h1 class="header-title">Mercadinho da Esquina</h1>
</header>

<style>
td {
    height: 70px;
}
</style>

<body>

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

  <div class="content-gerente">
    <!-- <button class="botao-logout"> -->
    <button style="background-color: rgb(0,0,0,0); border: 0; align-self: end; margin-right: 13px; margin-top: 11px;">
        <a href="index.php">
            <img src="assets/log-out-circle.png" style="height: 50px"/>
        </a>
    </button>

    <div style="margin-top: 76px">
      <h1 class="searchfield-title">Nome do Fornecedor:</h1>
      <div class="search-field-layout">
        <input class="search-field" type="text"/>
        <button class="search-button">
          <img class="search-icon" src="assets/Search.png"/>
        </button>
        <div style="display: flex; flex-direction: column; align-items: center; margin-left: 30px">
          <a href="fornece.php">
            <img class="search-icon" src="assets/fornece.png"/>
          </a>
          <h1 style="font-size: 15px;">Criar relação fornecedor/produto</h1>
        </div>
      </div>
    </div>

    <div style="width: 100%; max-width: 1366px; margin-top: 38px;">
      <table style="width: 100%; margin-left: 5%">
        <tr>
          <td>
            <h1>Nome:</h1>
          </td>
          <td>
            <h1>Código:</h1>
          </td>
          <td>
            <h1>Telefone:</h1>
          </td>
          <td>
            <h1>E-mail:</h1>
          </td>
          <td>
            <a href="HTML/cadastrar-fornecedor.php">
              <img src="assets/dashicons_insert.png" style="height: 36px"/>
            </a>
            <a href="HTML/editar-fornecedor.php">
              <img src="assets/Edit.png" style="height: 36px" />
            </a>
            <a href="HTML/deletar-fornecedor.php">
              <img src="assets/delete.png" style="height: 36px" />
            </a>
          </td>
          <td>
        </tr>

      </tr>
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
         $sql = "SELECT id_fornecedor, nome, telefone, email, estado, cidade, endereço
         FROM fornecedores";
         $result = $conn->query($sql);

         if ($result and $result->num_rows > 0) {
             // output data of each row
             while($row = $result->fetch_assoc()) {
              echo "<tr>".
              "<td>".$row['nome']."</td>".
              "<td>".$row['id_fornecedor']."</td>".
              "<td>".$row['telefone']."</td>".
              "<td>".$row['email']."</td>"."<td>"."<tr>";
             }
         }
         else {
             echo "Nenhum fornecedor cadastrado";
         }

        ?>

    </table>
    </div>
  </div>
</body>


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
