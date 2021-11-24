
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<h1>Caixas</h1>
<!--- Caixas de entrada e botões --->
<form action="gerente.php">
    <input type="submit" value="Voltar" />
</form>

<B>Adicionar Caixa</B>
<form action="caixas.php" method="post" autocomplete="off">

    <input type="text" name="usuario" maxlength="50" placeholder="Usuario" required />
    <input type="text" name="senha" minlength="8" maxlength="50" placeholder="Senha" required />
    <b>Admin</b>
    <select name="admin" id="admin">
        <option value="sim">Sim</option>
        <option value="não">Não</option>
    </select>
    <input type="submit" name="add" value="Adicionar" />

    <br>

</form>
<form action="HTML/caixas_editar.php">
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
</form>
<br><br>

<?php
include_once("Classes/Func.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercadinho";

// Conexao com o servidor
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = new Func();

// Tratamento para cada opção escolhida
if ( isset( $_POST['add'])) {
    $usuario = $_REQUEST['usuario'];
    $senha = $_REQUEST['senha'];
    $admin = $_REQUEST['admin'];

    $action->cadastrarFuncionario($usuario, $senha, $conn, $admin);

}
else if ( isset( $_POST['rmv']) ) {
    $usuario = $_REQUEST['usuario'];
    $action->removerFuncionario($usuario, $conn);

}
else if ( isset( $_POST['edt'])) {
    $usuario = $_REQUEST['usuario'];
    $novo_usuario = $_REQUEST['novo_usuario'];
    $nova_senha = $_REQUEST['nova_senha'];

    $action->editarFuncionario($usuario, $novo_usuario, $nova_senha, $conn);

}
else if (isset( $_POST['lst'])) {
    if (!empty($_REQUEST['usuario'])) {
        $usuario = $_REQUEST['usuario'];
        $action->listarUsuario($usuario, $conn);
    }
    else {
        $action->listarUsuario(null, $conn);
    }
}

$conn->close();
?>
</html>
