
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<!-- <style>
button{
background-color: rgb(0,0,0,0);
border: 0;
}

td{
height: 70px;
}
</style> -->
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
        <h1 class="title">Funcionários</h1>
        <h1 class="title" style="margin-top: 0;">cadastrados</h1>

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
                    <h1>Nome:</h1>
                </th>
                <th>
                    <h1>Email:</h1>
                </th>
                <th>
                    <h1>Usuário:</h1>
                </th>
                <th>
                    <h1>Tipo de conta:</h1>
                </th>
                <th>
                    <a href="HTML/cadastrar-funcionario.html">
                        <img src="assets/dashicons_insert.png" style="height: 36px"/>
                    </a>
                </th>
            </tr>
            <?php
            include_once ("Classes/Func.php");

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

            $action = new Func();
            if( isset( $_POST['add'])) {
                $nome = $_REQUEST['nome'];
                $endereco = $_REQUEST['endereço'];
                $telefone = $_REQUEST['telefone'];
                $email = $_REQUEST['email'];
                $usuario = $_REQUEST['usuario'];
                $senha = $_REQUEST['senha'];
                $admin = $_REQUEST['admin'];
                $action->cadastrarFuncionario($nome, $endereco, $telefone, $email, $usuario,$senha, $admin, $conn);
            }
            else if( isset( $_GET['rmv'])) {
                $id = $_REQUEST['id'];
                $action->removerFuncionario($id, $conn);
            }
            else if( isset( $_POST['edt'])) {
                $id = $_REQUEST['id'];
                $nome = $_REQUEST['nome'];
                $endereco = $_REQUEST['endereço'];
                $telefone = $_REQUEST['telefone'];
                $email = $_REQUEST['email'];
                $usuario = $_REQUEST['usuario'];
                $senha = $_REQUEST['senha'];
                $admin = $_REQUEST['admin'];
                $action->editarFuncionario($id, $nome, $endereco, $telefone, $email, $usuario,$senha, $admin, $conn);
            }

            $action->listarUsuario($conn);
            ?>
        </table>
    </div>
    <!-- <h1 class="title">Caixas</h1>
    <form action="index.php">
    <input type="submit" value="Voltar" />
</form>

<B>Adicionar Caixa</B>
<form action="caixas.php" method="post">

<input type="text" name="usuario" placeholder="Usuario" required />
<input type="text" name="senha" placeholder="Senha" required />

<input type="submit" name="add" value="Adicionar" />

<br>

</form>
<form action="caixas_editar.php">
<input type="submit" name="edt" value="editar" />
</form>

<B>Procurar ou deletar Caixa</B>
<form action="caixas.php" method="POST">
<input type="text" name="usuario" placeholder="Usuario" required />
<input type="submit" name="lst" value="Procurar" required/>
<input type="submit" name="rmv" value="remover" />
</form>

<form action="caixas.php" method="POST">
<input type="submit" name="lst" value="Listar Caixas" />
</form> -->
</body>
<!--- Caixas de entrada e botões --->
<br><br>


<!-- $servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercadinho";

// Conexao com o servidor
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tratamento para cada opção escolhida
if ( isset( $_POST['add'])) {



}
else if ( isset( $_POST['rmv']) ) {
    $id_usuario = $_REQUEST['id_funcionario'];
    $sql = "SELECT id_funcionario, senha
    FROM funcionarios
    WHERE id_funcionario = '$id_usuario'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $sql = "DELETE FROM funcionarios
        WHERE id_funcionario = '$id_usuario'";

        if ($conn->query($sql) === TRUE) {
            echo "Caixa $id_usuario deletado com sucesso!";
        }
        else {
            echo "Erro ao deletar caixa: " . $conn->error;
        }
    }

    else{
        echo "Não há usuario a ser removido!";
    }

}
else if ( isset( $_POST['edt'])) {
    $idusuario = $_REQUEST['id_funcionario'];
    $novo_usuario = $_REQUEST['novo_usuario'];
    $nova_senha = $_REQUEST['nova_senha'];

    $sql = "UPDATE funcionarios
    SET usuario = '$novo_usuario', senha = '$nova_senha'
    WHERE id_funcionario = '$idusuario'";


    if ($conn->query($sql) === TRUE) {
        echo "Caixa $idusuario editado com sucesso!";
    }
    else {
        echo "Erro ao editar caixa: " . $conn->error;
    }
}
else if (isset( $_POST['lst'])) {
    if (!empty($_REQUEST['usuario'])) {
        echo "<b>Resultado da busca:</b> <br>";
        $usuario = $_REQUEST['usuario'];
        $sql = "SELECT id, usuario, senha
        FROM funcionarios
        WHERE usuario = '$usuario'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<b>id:</b> " . $row["id"]. " - <b>Usuario:</b> " . $row["usuario"]. " - <b>Senha:</b> " . $row["senha"]. "<br>";
            }
        }
        else {
            echo "Nenhum caixas encontrados!";
        }
    }
    else {
        $sql = "SELECT id, usuario, senha
        FROM caixas";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<B>Lista de caixas</B> <br>";
            while($row = $result->fetch_assoc()) {
                echo "<b>id:</b> " . $row["id"]. " - <b>Usuario:</b> " . $row["usuario"]. " - <b>Senha:</b> " . $row["senha"]. "<br>";
            }
        }
        else {
            echo "Nenhum caixa cadastrado!";
        }
    }
}

$conn->close(); -->

</html>
