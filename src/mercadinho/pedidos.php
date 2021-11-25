<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
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

        <button style="align-self: end; margin-right: 13px; margin-top: 11px;">
            <a href="index.php">
                <img src="assets/log-out-circle.png" style="height: 50px">
            </a>
        </button>

        <h1 class="title">Status dos seus pedidos:</h1>


        <table style="width: 100%; margin-left: 3%; margin-top: 38px;">
            <colgroup>
                <col span="1" style="width: 16%;">
                <col span="1" style="width: 16%;">
                <col span="1" style="width: 16%;">
                <col span="1" style="width: 16%;">
                <col span="1" style="width: 16%;">
                <col span="1" style="width: 16%;">
            </colgroup>
            <tr>
                <td style="text-align: center;">
                    <h1>Id Pedido:</h1>
                </td>
                <td style="text-align: center;">
                    <h1>Produto:</h1>
                </td>
                <td style="text-align: center;">
                    <h1>Unidades:</h1>
                </td>
                <td style="text-align: center;">
                    <h1>Valor(R$):</h1>
                </td>
                <td style="text-align: center;">
                    <h1>Status:</h1>
                </td>
                <td style="text-align: center;">
                    <button>
                        <a href="fazer_pedido.php">
                            <img src="assets/dashicons_insert.png" style="height: 43px;">
                        </a>
                    </button>
                </td>
            </tr>
            <?php
            include_once ("Classes/Pedi.php");

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mercadinho";

            // Conexao com o servidor
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $action = new Pedi();
            $action->listar_pedidos($conn);

            if ( isset( $_GET["completar"])) {
                $id = $_REQUEST['id'];
                $action->recebido($id, $conn);
            }
            else if ( isset( $_GET["cancelar"])) {
                $id = $_REQUEST['id'];
                $action->cancelar($id, $conn);
            }
            ?>
        </table>
    </div>
</body>
</html>
