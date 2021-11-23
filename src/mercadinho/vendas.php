<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
  <link rel="stylesheet" type="text/css" href="styles/search.css"/>
  <title></title>
</head>

<style>
table {
    border-collapse: separate;
    border-spacing: 0 70px;
}
</style>

<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>
  <div class="leftbar-gerente">
    <a href="pedidos.php">
      <img src="assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
    </a>
    <a href="vendas.php">
      <img src="assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
    </a>
    <a href="produtos.php">
      <img src="assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
    </a>
    <a href="fornecedores.php">
      <img src="assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
    </a>
    <a href="funcionarios.php">
      <img src="assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
    </a>
  </div>

  <div class="content-gerente">
    <!-- <button class="botao-logout"> -->
    <button style="background-color: rgb(0,0,0,0); border: 0; align-self: end; margin-right: 13px; margin-top: 11px;">
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>

    <!-- <div style="margin-top: 76px">
      <h1 class="search-title">Código da Venda</h1>
      <div class="search-field-layout">
        <input class="search-field" type="text"/>
        <button class="search-button">
          <img class="search-icon" src="assets/Search.png"/>
        </button>
      </div>
    </div> -->
    <h1 class="title">Vendas:</h1>
    <div style="width: 100%; max-width: 1366px; margin-top: 38px;">
      <table style="width: 100%; margin-left: 3%; margin-top: 38px;">
        <tr>
          <td>
            <h1>Código de Venda:</h1>
          </td>
          <td>
            <h1>Valor(R$):</h1>
          </td>
          <!-- <td>
            <h1>Detalhes</h1>
          </td>
          <td>
            <h1>Deletar</h1>
          </td> -->
        </tr>
        <?php
            include_once ("Classes/Venda.php");

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mercadinho";

            // Conexao com o servidor
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $action = new Venda();
            $action ->mostrarVenda($conn);

          // if( $ven->num_rows > 0){
          //   while( $registro = $res->fetch_assoc() ){
          //     echo
          //         "<tr>".
          //           "<td>".$registro['idVenda']."</td>".
          //           "<td>".$registro['valTotal']."</td>".
          //         "<tr>";
          //   }
          // }
        ?>
      </table>
    </div>
  </div>
</body>

<!-- antigo codigo php
     include_once ("Classes/Venda.php");

     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "mercadinho";

     // Conexao com o servidor
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     $action = new Venda();
     $action->mostrarVenda($conn);

     if ( isset( $_POST['procurar'] )) {
         $id_venda = $_REQUEST['id_venda'];
         $action->procurarVenda($id_venda, $conn);
     }

     if(isset($_POST['excluir'])){
         $id_venda = $_REQUEST['id_venda'];
         $action->excluirVenda($id_venda, $conn);
     }  -->
 <br><b>Buscar detalhes sobre uma venda</b>
 <form action="venda.php" method="GET">
     <input type="text" name="id_venda" placeholder="Código da venda" required />
     <input type="submit" name="procurar" value="Procurar" />
     <input type="submit" name="excluir" value="Excluir" />
 </form>

</html>
