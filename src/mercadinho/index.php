<html>
<!-- <h1> Login </h1>
<form action="index.php" method="post" autocomplete="off">

    <input type="text" name="usuario" maxlength="50" placeholder="Usuario" required />
    <input type="password" name="senha" maxlength="50" placeholder="Senha" required />

    <input type="submit" name="login" value="Adicionar" />

    <br>
</form> -->
<head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body style="padding-top: 0;">
    <header class="header-login">
        <h1 class="title-login">Log-in</h1>
    </header>
    <form class="form-login">
        <div>
            <h1 style="font-size: 36px; margin-top: 37px;">Usuário</h1>
            <input style="width: 603px;" type="text" name="usuario" required/>
        </div>
        <div>
            <h1 style="font-size: 36px; margin-top: 37px;">Senha</h1>
            <input style="width: 603px;" type="password" name="senha" required/>
        </div>
        <input class="salvar" type="submit" name="add" value="ENTRAR" name="login"/>
    </form>
</body>

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
