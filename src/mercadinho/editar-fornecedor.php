<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./styles/styles.css"/>
</head>

<style>
.input-txt{
    width: 402px;
}
</style>

<body style="max-width: 100%; overflow-x: hidden;">
    <header class="header">
        <h1 class="header-title">Mercadinho da Esquina</h1>
    </header>
    <div class="leftbar-gerente">
        <a href="./pedidos.php">
            <img src="./assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
        </a>
        <a href="./vendas.php">
            <img src="./assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
        </a>
        <a href="./produtos.php">
            <img src="./assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
        </a>
        <a href="./fornecedores.php">
            <img src="./assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
        </a>
        <a href="./funcionarios.php">
            <img src="./assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
        </a>
    </div>

    <div class="content-gerente">
        <button style="align-self: end; margin-right: 13px; margin-top: 11px;">
            <a href="index.php">
                <img src="./assets/log-out-circle.png" style="height: 50px">
            </a>
        </button>
        <h1 class="title">Editar Fornecedor</h1>
        <?php
        include_once ("./Classes/Prod.php");

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
        if ( isset( $_GET['edt'])) {
            $id = $_REQUEST['id'];
            $sql = "SELECT *
            FROM fornecedores
            WHERE id_fornecedor = $id";
            $result = $conn->query($sql);
            if ($result and $result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
                echo '<form action="./fornecedores.php"  method="post" autocomplete="off">'.
                     '<input hidden class="input-txt" type="text" name="nome" value="'.$id.'" required/>'.
                     '<div style="display: flex; flex-direction: row; width: 100%; justify-content: space-evenly">'.
                     '<div class="input-column">'.
                     '<h1 style="margin-top: 45px;">Nome</h1>'.
                     '<input class="input-txt" type="text" name="novo_nome" maxlength="50" value="'.$row["nome"].'"required/>'.
                     '<h1 style="margin-top: 45px;">Telefone de Contato</h1>'.
                     '<input class="input-txt" type="text" name="novo_telefone" size="11" value="'.$row["telefone"].'" required/>'.
                     '<h1 style="margin-top: 45px;">E-mail</h1>'.
                     '<input class="input-txt" type="email" name="novo_email" value="'.$row["email"].'" required/>'.
                     '</div>'.
                     '<div class="input-column">'.
                     '<h1 style="margin-top: 45px;">Estado</h1>'.
                     '<input class="input-txt" type="text" name="novo_estado" value="'.$row["estado"].'" maxlength="50" />'.
                     '<h1 style="margin-top: 45px;">Cidade</h1>'.
                     '<input class="input-txt" type="text" name="nova_cidade" value="'.$row["cidade"].'" maxlength="50" />'.
                     '<h1 style="margin-top: 45px;">Endereço</h1>'.
                     '<input class="input-txt" type="text" name="novo_endereço" value="'.$row["endereço"].'" maxlength="50" />'.
                     '</div>'.
                     '</div>'.
                     '<input class="salvar" type="submit" name="edt" value="SALVAR" style="cursor: pointer;"/>'.
                     '</form>';
                 }
             }
        ?>
    </div>
</body>


<!-- <html>

<form action="fornecedores.php">
<input type="submit" value="Voltar" />
</form>

<form action="fornecedores.php" method="post" autocomplete="off">

<input type="text" name="nome" placeholder="Nome" />
<br>
<input type="text" name="novo_nome" placeholder="Novo Nome" required/>
<input type="text" name="novo_telefone" placeholder="Novo Telefone" required/>
<input type="text" name="novo_email" placeholder="Novo Email" required/>
<input type="text" name="novo_estado" placeholder="Novo Estado" />
<input type="text" name="nova_cidade" placeholder="Nova Cidade" />
<input type="text" name="novo_endereço" placeholder="Novo Endereço" />
<input type="submit" name="edt" value="editar" />

</html> -->
