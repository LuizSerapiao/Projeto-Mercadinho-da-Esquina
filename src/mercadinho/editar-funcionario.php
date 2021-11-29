
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./styles/styles.css"/>
</head>

<style>
  .input-txt{
    width: 402px;
  }
</style>

<body style="padding-top: 0; max-width: 100%; overflow-x: hidden;">
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="leftbar-gerente">
    <a href="./pedidos.php">
      <img src="./assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
    </a>
    <a href="./vendas.php">
      <img src="./assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
    </a>
    <a href="./produtos.php">
      <img src="./assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
    </a>
    <a href="./fornecedores.php">
      <img src="./assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
    </a>
    <a href="./funcionarios.php">
      <img src="./assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
    </a>
  </div>

  <div class="content-gerente">
    <button style="align-self: end; margin-right: 13px; margin-top: 11px;">
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>
    <h1 class="title">Editar Funcionario</h1>
    <?php
    include_once ("./Classes/Prod.php");

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
    if ( isset( $_GET['edt'])) {
        $id = $_REQUEST['id'];
        $sql = "SELECT *
        FROM funcionarios
        WHERE id_funcionario = $id";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            echo '<form action="./funcionarios.php"  method="POST" autocomplete="off">'.
                 '<div style="display: flex; flex-direction: row; width: 100%; justify-content: space-evenly">'.
                 '<div class="input-column">'.
                 '<h1 style="margin-top: 45px;">Nome</h1>'.
                 '<input hidden class="input-txt" type="text" name="id" value="'.$row["id_funcionario"].'"/>'.
                 '<input class="input-txt" type="text" name="nome" value="'.$row["nome"].'" maxlength="50" required/>'.
                 '<h1 style="margin-top: 45px;">Telefone de Contato</h1>'.
                 '<input class="input-txt" type="text" name="telefone" value="'.$row["telefone"].'" size="11" required/>'.
                 '<h1 style="margin-top: 45px;">E-mail</h1>'.
                 '<input class="input-txt" type="email" name="email" value="'.$row["email"].'" required/>'.
                 '</div>'.
                 '<div class="input-column">'.
                 '<h1 style="margin-top: 45px;">Endereço</h1>'.
                 '<input class="input-txt" type="text" name="endereço" maxlength="50" value="'.$row["endereco"].'" required/>'.
                 '<h1 style="margin-top: 45px;">Usuário</h1>'.
                 '<input class="input-txt" type="text" name="usuario" maxlength="10" value="'.$row["usuario"].'" required/>'.
                 '<h1 style="margin-top: 45px;">Senha</h1>'.
                 '<input class="input-txt" type="text" name="senha" maxlength="10" value="'.$row["senha"].'" required/>'.
                 '</div>'.
                 '</div>'.
                     '<select name="admin" class="select-style">'.
                         '<option value="1">Gerente</option>'.
                         '<option value="0">Atendente</option>'.
                 '<input class="salvar" type="submit" name="edt" value="SALVAR" style="cursor: pointer;"/>'.
                 '</form>';
             }
         }
    ?>
  </div>
</body>
</html>
