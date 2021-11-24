<html>
<head>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css"/>
</head>
<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="content">
    <h1 class="title">Parcelar em quantas vezes:</h1>
    <form action="../finalizar-compra.php" method="get" style="margin-top: 100px">
      <div style="display: flex; align-items: center; gap: 20px">
        <?php
          echo"<h1>Total: R$ 50,00</h1>"
        ?>
        <input type="number" style="width: 100px" value="1"/>
      </div>
      <div>
        <h1 style="margin-top: 50px">Senha:</h1>
        <input type="password" required/>
      </div>
      <input class="botao-substyle" type="submit" style="font-size: 38px" value="Finalizar" />
    </form>
    <a href="../caixa.php">
      <input class="botao-substyle" type="button" name="add" value="CANCELAR" />
    </a>
  </div>
</body>
</html>