
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    
    <title></title>
</head>
<header class="header">
  <h1 class="header-title">Mercadinho da Esquina</h1>
</header>
<body>

  <div class="leftbar-gerente">
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
  </div>

  <div class="content-gerente">
    <!-- <button class="botao-logout"> -->
    <button style="background-color: rgb(0,0,0,0); border: 0; align-self: end; margin-right: 13px; margin-top: 11px;">
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>

    <div style="margin-top: 76px">
      <h1 class="searchfield-title">Nome do Produto</h1>
      <div class="search-field-layout">
        <input class="search-field" type="text"/>
        <button class="search-button">
          <img class="search-icon" src="assets/Search.png"/>
        </button>
      </div>
    </div>

    <div style="flex-direction: row; display: flex; align-items: center; margin-top:63px">
      <h1>Nome:&emsp;</h1>
      <h1>Unidade(s):&emsp;</h1>
      <h1>Preço(encomenda):&emsp;</h1>
      <h1>Fornecedor:&emsp;</h1>
      <button style="background-color: rgb(0,0,0,0); border: 0;">
        <img src="assets/dashicons_insert.png" style="height: 63px;">
      </button>
    </div>
  </div>
</body>
<!-- <h1>Produtos</h1> -->
<!--- Caixas de entrada e botões --->
<!-- <form action="gerente.php">
    <input type="submit" value="Voltar" />
</form>

<B>Adicionar produto</B>
<form action="produtos.php" method="post" autocomplete="off">

    <input type="text" name="nome" maxlength="50" placeholder="Nome" required />
    <input type="number" name="valor" step="0.01" placeholder="Valor" required />
    <input type="number" name="quantidade" placeholder="Quantidade" required />

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
</form> -->


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
    $quantidade = $_REQUEST['quantidade'];

    $action->adicionarProduto($nome, $valor,$quantidade, $conn);

}
else if ( isset( $_POST['rmv']) ) {
    $nome = $_REQUEST['nome'];
    $action->removeProduto($nome, $conn);

}
else if ( isset( $_POST['edt'])) {
    $nome = $_REQUEST['nome'];
    $novo_nome = $_REQUEST['novo_nome'];
    $novo_valor = $_REQUEST['novo_valor'];
    $nova_quantidade = $_REQUEST['nova_quantidade'];

    $action->editarProduto($nome, $novo_nome, $novo_valor, $nova_quantidade, $conn);
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
