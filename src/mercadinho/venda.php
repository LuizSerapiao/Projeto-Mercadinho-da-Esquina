<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
  <link rel="stylesheet" type="text/css" href="styles/search.css"/>
  <title></title>
</head>

<style>
table {
    border-collapse: separate;
    border-spacing: 0 70px;
}
</style>

<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="leftbar-gerente">
    <a href="http://localhost/mercadinho/pedidos.php?">
      <img class="img-botao-gerente" src="assets/Botao Pedidos.png" alt="PEDIDOS">
    </a>
    <a href="http://localhost/mercadinho/vendas.php?">
      <img class="img-botao-gerente" src="assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
    </a>
    <a href="http://localhost/mercadinho/produtos.php?">
      <img class="img-botao-gerente" src="assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
    </a>
    <a href="http://localhost/mercadinho/fornecedores.php?">
      <img class="img-botao-gerente" src="assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
    </a>
    <a href="http://localhost/mercadinho/funcionarios.php?">
      <img class="img-botao-gerente" src="assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
    </a>
  </div>

  <div class="content-gerente">
    <!-- <button class="botao-logout"> -->
    <button style="background-color: rgb(0,0,0,0); border: 0; align-self: end; margin-right: 13px; margin-top: 11px;">
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>

    <div style="margin-top: 76px">
      <h1 class="search-title">Código da Venda</h1>
      <div class="search-field-layout">
        <input class="search-field" type="text"/>
        <button class="search-button">
          <img class="search-icon" src="assets/Search.png"/>
        </button>
      </div>
    </div>
    <div style="width: 100%; max-width: 1366px; margin-top: 38px;">
      <table style="width: 100%; margin-left: 10%">
        <tr>
          <td>
            <h1>Código de Venda:</h1>
          </td>
          <td>
            <h1>Valor(R$):</h1>
          </td>
        </tr>
        <?php
          echo "<tr>".
              "<td>"."Código de Venda:"."</td>".
              "<td>"."Valor(R$):"."</td>".
              "<tr>";
          // if( $ven->num_rows > 0){
          //   while( $registro = $res->fetch_assoc() ){
          //     echo 
          //         "<tr>".
          //           "<td>".$registro['idVenda']."</td>".
          //           "<td>".$registro['valTotal']."</td>".
          //         "<tr>";
          //   }
          // }
        ?>
      </table>
    </div>
  </div>
</body>