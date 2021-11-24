<html>
<head>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css"/>
</head>
<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="content">
    <h1 class="title">Método de Pagamento</h1>
    <form action="../finalizar-compra.php" method="get">
      <input class="botao-substyle" type="submit" style="font-size: 38px" value="Débito" />
    </form>
    <form action="cartao-credito.php" method="get">
      <input class="botao-substyle" type="submit" style="font-size: 38px" value="Crédito" />
    </form>
    <a href="../caixa.php">
      <input class="botao-substyle" type="button" name="add" value="CANCELAR" />
    </a>
  </div>
</body>
</html>