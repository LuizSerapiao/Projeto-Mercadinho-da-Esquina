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
      <h1>Código de venda:</h1>
      <?php
        echo "<h1>123456</h1>";
      ?>
    </div>
    <form action="caixa.php?" method="get">
      <input type="submit" style="font-size: 38px; margin-top: 150px" value="Retornar ao Carrinho" />
    </form>
  </div>
</body>
</html>