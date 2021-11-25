<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="stylesheet" type="text/css" href="styles/search.css"/>
    <title></title>
</head>

<style>
/* table {
border-collapse: separate;
border-spacing: 0 70px;
} */
</style>

<body style="max-width: 100%; overflow-x: hidden;">
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
            <a href = "index.php">
                <img src="assets/log-out-circle.png" style="height: 50px">
            </a>
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
<!-- <div style="display: flex; margin-top: 30px"> -->
<h1 class="title">Código de Venda:
    <?php
    $id_venda = $_REQUEST['id_venda'];
    if ($id_venda) {echo $id_venda. "</h1>";}
    ?>
    <!-- </div> -->
    <!-- <div style="width: 100%; max-width: 1366px; margin-top: 38px;"> -->
    <table style="width: 100%;  margin-left: 3%; margin-top: 38px;">
        <colgroup>
            <col span="1" style="width: 23%;">
            <col span="1" style="width: 23%;">
            <col span="1" style="width: 23%;">
            <col span="1" style="width: 23%;">
            <col span="1" style="width: 8%;">
        </colgroup>
        <tr>
            <th>
                <h1>Código:</h1>
            </th>
            <th>
                <h1>Produtos:</h1>
            </th>
            <th>
                <h1>Quantidade:</h1>
            </th>
            <th>
                <h1>Valor(R$):</h1>
            </th>
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
        if ( isset( $_GET['procurar'] )) {
            $id_venda = $_REQUEST['id_venda'];
            $valor = $action->procurarVenda($id_venda, $conn);
        }
        else if (isset($_GET['excluir'])){
            $id_venda = $_REQUEST['id_venda'];
            $valor = $action->excluirVenda($id_venda, $conn);
        }
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
    <!-- </div> -->
    <h1>Valor Total:
        <?php
        if ($valor) {echo "R$".$valor."</h1>";}
        ?>
        <div class="form-center" style="margin-top: -30px";>
            <form action="vendas.php">
                <input type="submit" value="Voltar" style="cursor: pointer;"/>
            </form>
        </div>
    </div>
</body>
