
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <title></title>
</head>
<header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
</header>
<body style="max-width: 100%; overflow-x: hidden;">

    <div class="leftbar-gerente">
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
    </div>

    <div class="content-gerente">
        <!-- <button class="botao-logout"> -->
        <button style="background-color: rgb(0,0,0,0); border: 0; align-self: end; margin-right: 13px; margin-top: 11px;">
            <a href="index.php">
                <img src="assets/log-out-circle.png" style="height: 50px">
            </a>
        </button>
        <h1 class="title">Produtos:</h1>
        <div style="margin-top: 10px">
            <div class="search-field-layout">
                <form action="produtos.php" method="GET" style="display: inline;">
                    <input class="search-field" type="text" name="nome" placeholder="Procurar produtos pelo nome"/>
                    <?php
                        if (isset( $_GET['relacionar'])) {
                            $id = $_REQUEST['id'];
                            echo '<input type="hidden" name="id" value="'.$id.'">'.
                            '<button class="search-button" name="relacionar" value="Relacionar" style="cursor: pointer;">'.
                                '<img class="search-icon" src="assets/Search.png"/>'.
                            '</button>';
                        }
                        else {
                            echo '<input type="hidden" name="id" value="$">'.
                            '<button class="search-button" name="procurar" value="Procurar" style="cursor: pointer;">'.
                                '<img class="search-icon" src="assets/Search.png"/>'.
                            '</button>';
                        }
                    ?>
                </form>
            </div>
        </div>

        <!-- <div style="flex-direction: row; display: flex; align-items: center; margin-top:63px">
        <h1>Nome:&emsp;</h1>
        <h1>Unidade(s):&emsp;</h1>
        <h1>Preço(encomenda):&emsp;</h1>
        <h1>Fornecedor:&emsp;</h1>
        <a href= "caixa.php">
        <button style="background-color: rgb(0,0,0,0); border: 0;">
        <img src="assets/dashicons_insert.png" style="height: 63px;">
    </button></a>
    <td> Nome </td>

</div> -->
<table style="width: 100%; margin-left: 0%; margin-top: 38px;">
    <colgroup>
        <col span="1" style="width: 20%;">
        <col span="1" style="width: 20%;">
        <col span="1" style="width: 20%;">
        <col span="1" style="width: 20%;">
        <col span="1" style="width: 20%;">
    </colgroup>
    <tr>
        <th>
            <h1>Código:</h1>
        </th>
        <th>
            <h1>Nome:</h1>
        </th>
        <th>
            <h1>Valor (venda):</h1>
        </th>
        <th>
            <h1>Quantidade (estoque):</h1>
        </th>
        <th>
            <?php
                if (!isset( $_GET['relacionar'])) {
                    echo "<button>".
                         '<a href="./HTML/inserir-produto.html">'.
                            '<img src="assets/dashicons_insert.png" style="height: 43px;">'.
                        '</a>'.
                    '</button>';
                }
            ?>
        </th>
    </tr>
    <?php

    include_once ("Classes/Prod.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercadinho";

    // Conexao com o servidor
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $action = new Prod();
    if ( isset( $_POST['add'])) {
        $nome = $_REQUEST['nome'];
        $valor = $_REQUEST['valor'];
        $quantidade = $_REQUEST['quantidade'];

        $action->adicionarProduto($nome, $valor,$quantidade, $conn);

    }
    else if ( isset( $_GET['rmv']) ) {
        $id = $_REQUEST['id'];
        $action->removeProduto($id, $conn);

    }
    else if ( isset( $_GET['edt'])) {
        $id = $_REQUEST['id'];
        $novo_nome = $_REQUEST['novo_nome'];
        $novo_valor = $_REQUEST['novo_valor'];
        $nova_quantidade = $_REQUEST['nova_quantidade'];

        $action->editarProduto($id, $novo_nome, $novo_valor, $nova_quantidade, $conn);
    }
    else if (isset( $_GET['procurar'])) {
        if (!empty($_REQUEST['nome'])) {
            $nome = $_REQUEST['nome'];
            $action->listarProduto($nome, $conn);
        }
    }
    else if (isset( $_GET['relacionar'])) {
        $id = $_REQUEST['id'];
        if (!empty($_REQUEST['nome'])){
            $nome = $_REQUEST['nome'];
        }
        else {
            $nome = NULL;
        }
        $action->relacionar_produto($id, $nome, $conn);
    }
    else {
        $action->listarProduto(null, $conn);
    }
    ?>
</table>
</div>
</body>
<!-- <h1>Produtos</h1> -->
<!--- Caixas de entrada e botões --->
<!-- <form action="gerente.php">
<input type="submit" value="Voltar" />
</form>

<B>Adicionar produto</B>
<form action="produtos.php" method="post" autocomplete="off">

<input type="text" name="nome" maxlength="50" placeholder="Nome" required />
<input type="number" name="valor" step="0.01" placeholder="Valor" required />
<input type="number" name="quantidade" placeholder="Quantidade" required />

<input type="submit" name="add" value="adicionar" />

<br>

</form>
<form action="produtos_editar.php">
<input type="submit" name="edt" value="editar" />
</form>

<B>Procurar ou deletar produto</B>
<form action="produtos.php" method="POST">
<input type="text" name="nome" placeholder="Nome" required />
<input type="submit" name="lst" value="Procurar" required/>
<input type="submit" name="rmv" value="remover" />
</form>

<form action="produtos.php" method="POST">
<input type="submit" name="lst" value="Listar Produtos" />
</form> -->


<br><br>

<!--
include_once ("Classes/Prod.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercadinho";

// Conexao com o servidor
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$action = new Prod();
// Tratamento para cada opção escolhida
if ( isset( $_POST['add'])) {
$nome = $_REQUEST['nome'];
$valor = $_REQUEST['valor'];
$quantidade = $_REQUEST['quantidade'];

$action->adicionarProduto($nome, $valor,$quantidade, $conn);

}
else if ( isset( $_POST['rmv']) ) {
$nome = $_REQUEST['nome'];
$action->removeProduto($nome, $conn);

}
else if ( isset( $_POST['edt'])) {
$nome = $_REQUEST['nome'];
$novo_nome = $_REQUEST['novo_nome'];
$novo_valor = $_REQUEST['novo_valor'];
$nova_quantidade = $_REQUEST['nova_quantidade'];

$action->editarProduto($nome, $novo_nome, $novo_valor, $nova_quantidade, $conn);
}
else if (isset( $_POST['lst'])) {
if (!empty($_REQUEST['nome'])) {
$nome = $_REQUEST['nome'];
$action->listarProduto($nome, $conn);
}
else {
$action->listarProduto(null, $conn);
}
}

$conn->close();
-->
</html>
