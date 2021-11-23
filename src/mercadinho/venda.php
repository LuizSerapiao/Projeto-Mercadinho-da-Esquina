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
    <div style="display: flex; margin-top: 30px">
      <h1>Código de Venda: </h1>
      <?php
        echo "<h1>12345</h1>";
      ?>
    </div>
    <div style="width: 100%; max-width: 1366px; margin-top: 38px;">
      <table style="width: 100%; margin-left: 15%">
        <tr>
          <td>
            <h1>Produtos:</h1>
          </td>
          <td>
            <h1>Quantidade:</h1>
          </td>
          <td>
            <h1>Valor(R$):</h1>
          </td>
        </tr>
        <?php
          echo "<tr>".
              "<td>"."<h2>Shampoo Dove</h2>"."</td>".
              "<td>"."<h2>2</h2>"."</td>".
              "<td>"."<h2>23,50</h2>"."</td>".
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
        <tr>
          <th><h1>Total:</h1></th>
          <?php
          echo "<th><h1>"."19"."</h1></th>";
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
        <tr>
      </table>
    </div>
  </div>
</body>