<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="content">
    <h1 class="title" style="margin-top: 150px">Compra Finalizada!</h1>
    <div class="display" style="margin-top: 180px">
      <!-- <h1>Código de venda:</h1> -->
      <?php
      include_once ("Classes/ListaCompra.php");

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "mercadinho";

      // Conexao com o servidor
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }

      $action = new ListaCompra();
      $action->finalizarCompra($conn);
      ?>
    </div>
    <form action="caixa.php" method="get">
      <input type="submit" style="font-size: 38px; margin-top: 150px" value="Retornar ao Carrinho" />
    </form>
  </div>
</body>
</html>
