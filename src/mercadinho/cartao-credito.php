<html>
<head>
    <link rel="stylesheet" type="text/css" href="./styles/styles.css"/>
</head>
<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="content">
    <h1 class="title">Parcelar em quantas vezes:</h1>
    <form action="./finalizar-compra.php" method="post" style="margin-top: 100px">
      <div style="display: flex; align-items: center; gap: 20px">
        <?php
            include_once ("./Classes/ListaCompra.php");

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
            $valor = $action->get_valor_total($conn);
            echo'<h1>Total: R$'.$valor.' </h1>'
        ?>
        <input type="number" style="width: 100px" value="1"/>
      </div>
      <div>
        <h1 style="margin-top: 50px">Senha:</h1>
        <input type="password" required/>
      </div>
      <div style="margin-top: -30px; width: 780px; display: flex; justify-content: space-between">
          <a href="./caixa.php" style="cursor: default">
            <input class="botao-substyle" type="button" name="add" value="CANCELAR" style="cursor: pointer" />
          </a>
          <input class="botao-substyle" type="submit" name="finalizar" value="FINALIZAR" style="cursor: pointer" />
      </div>
    </form>

  </div>
</body>
</html>
