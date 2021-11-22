<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body>
  <header class="header">
  <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="content">
    <button class="botao-logout">
      <img class="imagem-logout" src="assets/log-out-circle.png" />
    </button>
    <h1 class="title">Caixa</h1>
    <form>
      <div>
      <h1 style="margin-top: 32px;">Código do Produto:</h1>
        <div style="display: flex; align-items: center;">
            <input style ="width: 603px;" type="text" required/>
            <h1 style ="font-size: 24px; margin-left: 15px;">Un.</h1>
            <input style ="width: 109px; margin-left: 18px;" type="number" value="1" required/>
            <button type="submit" style="margin-left: 15px">
              <img src="assets/dashicons_insert.png" />
            </button>
        </div>
      </div>
    </form>
    <table style="margin-left: 5%; margin-top: 50px">
      <tr>
        <td>
          <h1>Código</h1>
        </td>
        <td>
          <h1>Nome do Produto</h1>
        </td>
        <td>
          <h1>Valor(R$)</h1>
        </td>
      </tr>
      <?php
        echo "<td>
                <h1>123</h1>
              </td>
              <td>
                <h1>Esponja Bombril</h1>
              </td>
              <td>
                <h1>5,00</h1>
              </td>".'<td><button><img src="assets/delete.png" style="height: 30px"/></button></td>';
      ?>
    </table>
    <div class="caixa-buttons">
      <form action="/mercadinho/caixa.php?" method="get">
        <input class="botao-substyle" type="submit" style="font-size: 38px" value="Devolver Produto" />
      </form>
      <form action="/mercadinho/trocar_produto.php?" method="get">
        <input class="botao-substyle" type="submit" style="font-size: 38px" value="Trocar Produto" />
      </form>
      <form action="/mercadinho/caixa.php?" method="get">
        <input class="botao-substyle" type="submit" style="font-size: 38px" value="Finalizar Compra" />
      </form>
    </div>
  </div>
  

</body>

</html>