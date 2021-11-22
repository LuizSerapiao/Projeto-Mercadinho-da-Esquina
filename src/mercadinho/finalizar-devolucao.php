<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body style="justify-content: space-evenly;">
    <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
    </header>
    <h1 class="title">Devolução Confirmada!</h1>
    
    <div class="display">
      <h1>Valor a ser retornado:</h1>
      <?php
        echo "<h1>R$"."0,00</h1>";
      ?>
    </div>

    <form action="/mercadinho/caixa.php?" method="get">
      <input type="submit" style="font-size: 38px" value="Retornar ao Carrinho" />
    </form>

</body>

</html>