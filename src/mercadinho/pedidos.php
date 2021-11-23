<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body>
    <header class="header">
        <h1 class="header-title">Mercadinho da Esquina</h1>
    </header>
    <div class="leftbar-gerente">
      <a href="http://localhost/mercadinho/pedidos.php?">
        <img src="assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
      </a>
      <a href="http://localhost/mercadinho/vendas.php?">
        <img src="assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
      </a>
      <a href="http://localhost/mercadinho/produtos.php?">
        <img src="assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
      </a>
      <a href="http://localhost/mercadinho/fornecedores.php?">
        <img src="assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
      </a>
      <a href="http://localhost/mercadinho/funcionarios.php?">
        <img src="assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
      </a>
    </div>
    <div class="content-gerente">

      <button style="align-self: end; margin-right: 13px; margin-top: 11px;">
        <img src="assets/log-out-circle.png" style="height: 50px">
      </button>

      <h1 class="title">Status dos seus pedidos:</h1>

      
      <table style="width: 100%; margin-left: 3%; margin-top: 38px;">
        <tr>
          <td>
            <h1>Produto:</h1>
          </td>
          <td>
            <h1>Unidades:</h1>
          </td>
          <td>
            <h1>Fornecedor:</h1>
          </td>
          <td>
            <h1>Valor(R$):</h1>
          </td>
          <td>
            <h1>Status:</h1>
          </td>
          <!-- <td>
            <button>
              <img src="assets/dashicons_insert.png" style="height: 43px;">
            </button>
          </td> -->
        </tr>
        <?php
          echo "<tr>".
              "<td>".'<button>'."Açúcar Refinado União"."</button>"."</td>".
              "<td>"."30"."</td>".
              "<td>"."União"."</td>".
              "<td>"."Valor(R$)"."</td>".
              "<td>"."Aguardando"."</td>".
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
</body>
</html>