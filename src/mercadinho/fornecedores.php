
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<h1>Fornecedores</h1>
<form action="index.php">
    <input type="submit" value="Voltar" />
</form>

<B>Adicionar Fornecedor</B>
<form action="fornecedores.php" method="post" autocomplete="off">

    <input type="text" name="nome" maxlength="50" placeholder="Nome" required/>
    <input type="text" name="telefone" size="11" placeholder="Telefone" required/>
    <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email" required/>
    <input type="text" name="estado" maxlength="50" placeholder="Estado" />
    <input type="text" name="cidade" maxlength="50" placeholder="Cidade" />
    <input type="text" name="endereço" maxlength="50" placeholder="endereço" />

    <input type="submit" name="add" value="adicionar" />
</form>

<form action="fornecedores_editar.php">
    <input type="submit" name="edt" value="editar" />
</form>

<B>Procurar ou deletar fornecedores</B>
<form action="fornecedores.php" method="POST">
    <input type="text" name="nome" placeholder="Nome" required/>
    <input type="submit" name="lst" value="Procurar" required/>
    <input type="submit" name="rmv" value="remover" /> 
</form>

<form action="fornecedores.php" method="POST">
    <input type="submit" name="lst" value="Listar Fornecedores" required/>

    <br><br>
    <input type="reset" name="limpar" value="LIMPAR">
</form>


    <br>
<br><br>
<?php
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

    if ( isset( $_POST['add'])) {
        $nome = $_REQUEST['nome'];
        $telefone = $_REQUEST['telefone'];
        $email = $_REQUEST['email'];
        $estado = $_REQUEST['estado'];
        $cidade = $_REQUEST['cidade'];
        $endereço = $_REQUEST['endereço'];

        $sql = "INSERT INTO fornecedores (nome, telefone, email, estado, cidade, endereço) 
        VALUES ('$nome','$telefone', '$email', '$estado', '$cidade', '$endereço')";

        if ($conn->query($sql) === TRUE) {
            echo "Fornecedor $nome adicionado com sucesso!";
        }
        else {
            echo "Erro ao adicionar caixa: " . $sql . "<br>" . $conn->error;
        }
    }
    else if ( isset( $_POST['rmv']) ) {
        $nome = $_REQUEST['nome'];

        $sql = "SELECT id, nome, telefone, email, estado, cidade, endereço 
            FROM fornecedores
            WHERE nome='$nome'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $sql = "DELETE FROM fornecedores 
        WHERE nome = '$nome'";

            if ($conn->query($sql) === TRUE) {
                echo "Fornecedor $nome removido com sucesso!";
            } else {
                echo "Erro ao deletar caixa: " . $conn->error;
            }
        }

        else{
            echo "Não há fornecedores a serem removidos!";
        }
    }
     else if ( isset( $_POST['edt'])) {
        $nome = $_REQUEST['nome'];

        $novo_nome = $_REQUEST['novo_nome'];
        $novo_telefone = $_REQUEST['novo_telefone'];
        $novo_email = $_REQUEST['novo_email'];
        $novo_estado = $_REQUEST['novo_estado'];
        $nova_cidade = $_REQUEST['nova_cidade'];
        $novo_endereço = $_REQUEST['novo_endereço'];
        
        $sql = "UPDATE fornecedores
        SET nome='$novo_nome', telefone='$novo_telefone', email='$novo_email', estado='$novo_estado', cidade='$nova_cidade', endereço='$novo_endereço'
        WHERE nome='$nome'";

        if ($conn->query($sql) === TRUE) {
            echo "Fornecedor $nome alterado com sucesso!";
        }
        else {
            echo "Erro ao editar caixa: " . $conn->error;
        }
    }
    else if (isset( $_POST['lst'])) {
        if (!empty($_REQUEST['nome'])) {
            $nome = $_REQUEST['nome'];
            $sql = "SELECT id, nome, telefone, email, estado, cidade, endereço 
            FROM fornecedores
            WHERE nome='$nome'";
            $result = $conn->query($sql);

            echo "<B>Resultado da busca:</B> <br>";
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Telefone:</b> " . $row["telefone"]. 
                    " -<b> Email:</b> " . $row["email"]. " -<b> Estado:</b> " . $row["estado"]. " - <b>Cidade:</b> " . $row["cidade"]. 
                    " - <b>endereço:</b> " . $row["endereço"]."<br>";
                }
            }
            else {
                echo "Nenhum fornecedor encontrado";
            }
        }
        else {
            $sql = "SELECT id, nome, telefone, email, estado, cidade, endereço 
            FROM fornecedores";
            $result = $conn->query($sql);

            echo "<B>Lista de Fornecedores:</B> <br>";
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Telefone:</b> " . $row["telefone"]. 
                    " -<b> Email:</b> " . $row["email"]. " -<b> Estado:</b> " . $row["estado"]. " - <b>Cidade:</b> " . $row["cidade"]. 
                    " - <b>endereço:</b> " . $row["endereço"]."<br>";
                }
            }
            else {
                echo "Nenhum fornecedor cadastrado";
            }
        }
    }

    $conn->close();
?>
</html>
