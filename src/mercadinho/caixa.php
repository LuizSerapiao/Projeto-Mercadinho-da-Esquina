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
    <button class="botao-logout" >
        <a href="index.php">
            <img class="imagem-logout" src="assets/log-out-circle.png" />
        </a>
    </button>
    <h1 class="title">Caixa</h1>
    <form>
      <div>
      <h1 style="margin-top: 32px;">Código do Produto:</h1>
        <div style="display: flex; align-items: center;">
            <form action="consultar_produto.php" method="GET">
                <input style ="width: 603px;" name="codigo" type="text" required/>
                <h1 style ="font-size: 24px; margin-left: 15px;">Un.</h1>
                <input style ="width: 109px; margin-left: 18px;" type="number" name="quantidade" value="1" required/>
                <button type="submit" name="add" style="margin-left: 15px">
                  <img src="assets/dashicons_insert.png" />
                </button>
            </form>
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
          <h1>Quantidade</h1>
        </td>
        <td>
          <h1>Valor(R$)</h1>
        </td>
      </tr>
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
          $action->listar_produtos_caixa($conn);

          if ( isset( $_GET["add"])) {
              $codigo = $_REQUEST['codigo'];
              $quantidade = $_REQUEST['quantidade'];
              $action->adicionarNaLista($codigo, $quantidade, $conn);
          }
          else if ( isset( $_GET["deletar"])) {
              $id = $_REQUEST['id'];
              $action->remover_da_lista($id, $conn);
          }
          else if ( isset( $_POST['devolver'])) {
              $id_produto = $_REQUEST['id_produto'];
              $id_venda = $_REQUEST['id_venda'];
              $quantidade_trocar = $_REQUEST['quantidade'];
              $action->devolverProduto($id_produto, $id_venda, $quantidade_trocar, $conn);
          }
          else if ( isset( $_POST['trocar'])) {
              $id_produto_recebido = $_REQUEST['id_produto_recebido'];
              $quantidade_recebida = $_REQUEST['quantidade_recebida'];
              $id_produto_trocado = $_REQUEST['id_produto_trocado'];
              $quantidade_trocada = $_REQUEST['quantidade_trocada'];
              $id_venda = $_REQUEST['id_venda'];
              $action->trocarProduto($id_produto_recebido, $quantidade_recebida, $id_produto_trocado, $quantidade_trocada, $id_venda, $conn);
          }
      ?>
    </table>
    <div style="width: 95%; height: 10px; background-color: #25ABD6; margin-top: 93px"></div>
    <div class="caixa-buttons">
      <form action="HTML/devolver_produto.php" method="get">
        <input class="botao-substyle" type="submit" style="font-size: 38px" value="Devolver Produto" />
      </form>
      <form action="HTML/trocar_produto.php" method="get">
        <input class="botao-substyle" type="submit" style="font-size: 38px" value="Trocar Produto" />
      </form>
      <form action="HTML/metodo-pagamento.php" method="get">
        <input class="botao-substyle" type="submit" style="font-size: 38px" value="Finalizar Compra" />
      </form>
    </div>
  </div>


</body>

</html>
