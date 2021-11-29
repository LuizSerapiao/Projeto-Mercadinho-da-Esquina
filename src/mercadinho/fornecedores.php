
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <title></title>
</head>

<header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
</header>

<style>
td {
    height: 70px;
}
</style>

<body style="max-width: 100%; overflow-x: hidden;">

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
            <a href="index.php">
                <img src="assets/log-out-circle.png" style="height: 50px"/>
            </a>
        </button>

        <?php
            if (isset( $_GET['relacionar'])) {
                $id_produto = $_REQUEST['id_produto'];
                $id_fornecedor = $_REQUEST['id_fornecedor'];
                echo '<h1 class="title">Valor cobrado pelo fornecedor</h1>'.
                '<div style="margin-top: 10px">'.
                    '<div class="search-field-layout">'.
                        '<form action="fornecedores.php" method="GET" style="display: inline;">'.
                            '<input type="hidden" name="id_produto" value="'.$id_produto.'">'.
                            '<input type="hidden" name="id_fornecedor" value="'.$id_fornecedor.'">'.
                            '<input class="search-field" step="0.01" type="number" name="valor" placeholder="Valor"/>'.
                            '<button class="search-button" name="rel" value="rel" style="cursor: pointer;">'.
                                '<img class="search-icon" src="assets/confirm.png"/>'.
                            '</button>'.
                        '</form>'.
                    '</div>'.
                '</div>'.
                '<table hidden>';
            }
            else {
                echo '<h1 class="title">Fornecedores</h1>'.
                '<div style="margin-top: 10px">'.
                    '<div class="search-field-layout">'.
                        '<form action="fornecedores.php" method="GET" style="display: inline;">'.
                            '<input class="search-field" type="text" name="nome" placeholder="Procurar fornecedor por nome"/>'.
                            '<button class="search-button" name="procurar" value="Procurar" style="cursor: pointer;">'.
                                '<img class="search-icon" src="assets/Search.png"/>'.
                            '</button>'.
                        '</form>'.
                    '</div>'.
                '</div>'.
                '<table style="width: 100%;  margin-left: 5%; margin-top: 38px;">';
            }
            ?>
                <colgroup>
                    <col span="1" style="width: 10%;">
                    <col span="1" style="width: 18%;">
                    <col span="1" style="width: 18%;">
                    <col span="1" style="width: 18%;">
                    <col span="1" style="width: 18%;">
                    <col span="1" style="width: 18%;">
                </colgroup>
                <tr>
                    <th>
                        <h1>Ligar à<br> Produto:</h1>
                    </th>
                    <th>
                        <h1>Nome:</h1>
                    </th>
                    <th>
                        <h1>Código:</h1>
                    </th>
                    <th>
                        <h1>Telefone:</h1>
                    </th>
                    <th>
                        <h1>E-mail:</h1>
                    </th>
                    <th>
                        <a href="HTML/cadastrar-fornecedor.html">
                            <img src="assets/dashicons_insert.png" style="height: 36px"/>
                        </a>
                    </th>
                    <td>
                    </tr>

                </tr>
                <?php
                include_once ("Classes/Forn.php");

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "mercadinho";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $action = new Forn();
                if ( isset( $_GET['procurar'] )) {
                    $nome = $_REQUEST['nome'];
                    $action->listarFornecedor($nome, $conn);
                }
                else if ( isset( $_POST['add'])) {
                    $nome = $_REQUEST['nome'];
                    $telefone = $_REQUEST['telefone'];
                    $email = $_REQUEST['email'];
                    $estado = $_REQUEST['estado'];
                    $cidade = $_REQUEST['cidade'];
                    $endereco = $_REQUEST['endereço'];

                    $action->insereFornecedor($nome, $telefone, $email, $estado, $cidade, $endereco, $conn);
                }
                else if (isset( $_GET['rel'])) {
                    $id_produto = $_REQUEST['id_produto'];
                    $id_fornecedor = $_REQUEST['id_fornecedor'];
                    $valor = $_REQUEST['valor'];
                    $action->relacionar($id_produto, $id_fornecedor, $valor, $conn);
                }
                else if (isset( $_POST['edt'])) {
                    $nome = $_REQUEST['nome'];
                    $novo_nome = $_REQUEST['novo_nome'];
                    $novo_telefone = $_REQUEST['novo_telefone'];
                    $novo_email = $_REQUEST['novo_email'];
                    $novo_estado = $_REQUEST['novo_estado'];
                    $nova_cidade = $_REQUEST['nova_cidade'];
                    $novo_endereço = $_REQUEST['novo_endereço'];

                    $action->editarFornecedor($nome, $novo_nome, $novo_telefone, $novo_email, $novo_estado, $nova_cidade, $novo_endereço, $conn);
                }
                else if (isset( $_GET['rmv'])) {
                    $id = $_REQUEST['id'];
                    $action->removeFornecedor($id, $conn);
                }
                else {
                    $action->listarFornecedor(NULL, $conn);
                }
                ?>

            </table>
        <!-- </div> -->
    </div>
</body>


<br>
<br><br>

<!-- include_once ("Classes/Forn.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercadinho";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = new Forn();
if ( isset( $_POST['add'])) {
    $nome = $_REQUEST['nome'];
    $telefone = $_REQUEST['telefone'];
    $email = $_REQUEST['email'];
    $estado = $_REQUEST['estado'];
    $cidade = $_REQUEST['cidade'];
    $endereco = $_REQUEST['endereço'];

    $action->insereFornecedor($nome, $telefone, $email, $estado, $cidade, $endereco, $conn);


}
else if ( isset( $_POST['rmv']) ) {
    $nome = $_REQUEST['nome'];
    $action->removeFornecedor($nome, $conn);

}
else if ( isset( $_POST['edt'])) {
    $nome = $_REQUEST['nome'];
    $novo_nome = $_REQUEST['novo_nome'];
    $novo_telefone = $_REQUEST['novo_telefone'];
    $novo_email = $_REQUEST['novo_email'];
    $novo_estado = $_REQUEST['novo_estado'];
    $nova_cidade = $_REQUEST['nova_cidade'];
    $novo_endereço = $_REQUEST['novo_endereço'];

    $action->editarFornecedor($nome, $novo_nome, $novo_telefone, $novo_email, $novo_estado, $nova_cidade, $novo_endereço, $conn);
}
else if (isset( $_POST['lst'])) {
    if (!empty($_REQUEST['nome'])) {
        $usuario = $_REQUEST['nome'];
        $action->listarFornecedor($usuario, $conn);
    }
    else {
        $action->listarFornecedor(null, $conn);
    }
}
else if (isset( $_POST['relacionar'])) {

}

$conn->close(); -->
</html>
