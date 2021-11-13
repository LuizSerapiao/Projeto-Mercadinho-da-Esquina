
<html lang="pt-br">
<h1>Caixas</h1>
<!--- Caixas de entrada e botões --->
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
</form>
<br><br>

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

    // Tratamento para cada opção escolhida
    if ( isset( $_POST['add'])) {
        $usuario = $_REQUEST['usuario'];
        $senha = $_REQUEST['senha'];

        $sql = "INSERT INTO caixas (usuario, senha) 
        VALUES ('$usuario','$senha')";

        if ($conn->query($sql) === TRUE) {
            echo "Caixa $usuario adicionado com sucesso!";
        }
        else {
            echo "Erro ao adicionar caixa: " . $sql . "<br>" . $conn->error;
        }
    }
    else if ( isset( $_POST['rmv']) ) {
        $usuario = $_REQUEST['usuario'];
        $sql = "SELECT id, usuario, senha 
            FROM caixas
            WHERE usuario = '$usuario'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $sql = "DELETE FROM caixas 
        WHERE usuario = '$usuario'";

            if ($conn->query($sql) === TRUE) {
                echo "Caixa $usuario deletado com sucesso!";
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
        $usuario = $_REQUEST['usuario'];
        $novo_usuario = $_REQUEST['novo_usuario'];
        $nova_senha = $_REQUEST['nova_senha'];
        
        $sql = "UPDATE caixas
        SET usuario = '$novo_usuario', senha = '$nova_senha' 
        WHERE usuario = '$usuario'";


        if ($conn->query($sql) === TRUE) {
            echo "Caixa $usuario editado com sucesso!";
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
            FROM caixas
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

    $conn->close();
?>
</html>

