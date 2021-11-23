<html>
<!-- <h1> Login </h1>
<form action="index.php" method="post" autocomplete="off">

    <input type="text" name="usuario" maxlength="50" placeholder="Usuario" required />
    <input type="password" name="senha" maxlength="50" placeholder="Senha" required />

    <input type="submit" name="login" value="Adicionar" />

    <br>
</form> -->
<head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="content">
    <h1 class="title">Método de Pagamento</h1>
    <form action="cartao.php" method="get">
      <input type="submit" style="font-size: 38px" value="Cartão de Crédito" />
    </form>
    <form action="trocar_produto.php?" method="get">
      <input type="submit" style="font-size: 38px" value="Dinheiro" />
    </form>
    <a href="caixa.php">
      <input class="botao-substyle" type="button" name="add" value="CANCELAR" />
    </a>
  </div>
</body>
</html>