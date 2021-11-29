<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body>
  <header class="header">
      <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="content">
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

          if ( isset( $_POST['finalizar'])) {
              echo '
                  <h1 class="title" style="margin-top: 50px">Compra Finalizada!</h1>
                  <div class="display" style="margin-top: 180px">
                  ';
              $action->finalizarCompra($conn);
          }
          else if ( isset( $_POST['devolver'])) {
              $id_produto = $_REQUEST['id_produto'];
              $id_venda = $_REQUEST['id_venda'];
              $quantidade_trocar = $_REQUEST['quantidade'];
              echo '
                  <h1 class="title" style="margin-top: 50px">Devolução Finalizada!</h1>
                  <div class="display" style="margin-top: 180px">
                  ';
              $action->devolverProduto($id_produto, $id_venda, $quantidade_trocar, $conn);
          }
          else if ( isset( $_POST['trocar'])) {
              $id_produto_recebido = $_REQUEST['id_produto_recebido'];
              $quantidade_recebida = $_REQUEST['quantidade_recebida'];
              $id_produto_trocado = $_REQUEST['id_produto_trocado'];
              $quantidade_trocada = $_REQUEST['quantidade_trocada'];
              $id_venda = $_REQUEST['id_venda'];
              echo '
                  <h1 class="title" style="margin-top: 50px">Troca Finalizada!</h1>
                  <div class="display" style="margin-top: 180px">
                  ';
              $action->trocarProduto($id_produto_recebido, $quantidade_recebida, $id_produto_trocado, $quantidade_trocada, $id_venda, $conn);
          }
      ?>
    </div>
    <form action="caixa.php" method="get">
      <input type="submit" style="font-size: 38px; margin-top: 150px; cursor: pointer" value="Retornar ao Carrinho" />
    </form>
  </div>
</body>
</html>
