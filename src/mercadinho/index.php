<html>
<h1> Login </h1>
<form action="index.php" method="post" autocomplete="off">

    <input type="text" name="usuario" maxlength="50" placeholder="Usuario" required />
    <input type="password" name="senha" maxlength="50" placeholder="Senha" required />

    <input type="submit" name="login" value="Adicionar" />

    <br>
</form>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercadinho";

    // Conexao com o servidor
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Adicionar produto na lista de compras
    if ( isset( $_POST['login'])) {
        $usuario = $_REQUEST['usuario'];
        $senha = $_REQUEST['senha'];
        $sql = "SELECT admin
                FROM funcionarios
                WHERE (usuario = '$usuario' AND senha = '$senha')";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['admin'] === '1') {
                header("Location: gerente.php");
            }
            else {
                header("Location: lista_compras.php");
            }
        }
        else {
            echo ("Erro: Nome de usuário ou senha errados!");
        }
    }
?>
</html>
