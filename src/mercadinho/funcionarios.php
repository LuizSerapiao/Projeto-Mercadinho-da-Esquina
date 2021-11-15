
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="styles/funcionarios.css"/>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
</header>
<body>
    <div class="layout">
      <div class="leftbar-gerente">
          <button class="botao-gerente">
            <img src="assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
          </button>
          <button class="botao-gerente">
            <img src="assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
          </button>
          <button class="botao-gerente">
            <img src="assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
          </button>
          <button class="botao-gerente">
            <img src="assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
          </button>
          <button class="botao-gerente">
            <img src="assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
          </button>
      </div>
      <div class="content-gerente">
        <img src="assets/log-out-circle.png" class="botao-log-out">
        <div style="display: flex; flex-direction: line; margin-top: 40px">
          <div style="display: flex; flex-direction: column; align-items: center; margin-left: 198px">
            <h1 class="title">Funcionários</h1>
            <h1 class="title">cadastrados</h1>
          </div>
          <button style="background-color: rgb(0,0,0,0); border: 0; margin-left: 198px">
            <img src="assets/dashicons_insert.png" style="height: 50px;">
          </button>
        </div>
        <div class="container-funcionarios">
          <h1 class="texto-grid">Nome</h1>
          <h1 class="texto-grid">Telefone</h1>
          <div></div>

          <div style="display: flex; align-items: center">
            <button class="botao-gerente">
              <h1 class="texto-grid">Luiz Felipe</h1>
            </button>
          </div>
          <div style="display: flex; align-items: center">
            <h1 class="texto-grid">(16) 99247-3476</h1>
          </div>
          <div class="item-grid">
            <button class="botao-gerente">
              <img src="assets/Edit.png" style="height: 45px;" alt="EDITAR FUNCIONARIO">
            </button>
            <button class="botao-gerente">
              <img src="assets/delete.png" style="height: 50px;" alt="DELETAR FUNCIONARIO">
            </button>
          </div>

          <div style="display: flex; align-items: center">
            <button class="botao-gerente">
              <h1 class="texto-grid">Luiz Felipe</h1>
            </button>
          </div>
          <div style="display: flex; align-items: center">
            <h1 class="texto-grid">(16) 99247-3476</h1>
          </div>
          <div class="item-grid">
            <button class="botao-gerente">
              <img src="assets/Edit.png" style="height: 45px;" alt="EDITAR FUNCIONARIO">
            </button>
            <button class="botao-gerente">
              <img src="assets/delete.png" style="height: 50px;" alt="DELETAR FUNCIONARIO">
            </button>
          </div>

          <div style="display: flex; align-items: center">
            <button class="botao-gerente">
              <h1 class="texto-grid">Luiz Felipe</h1>
            </button>
          </div>
          <div style="display: flex; align-items: center">
            <h1 class="texto-grid">(16) 99247-3476</h1>
          </div>
          <div class="item-grid">
            <button class="botao-gerente">
              <img src="assets/Edit.png" style="height: 45px;" alt="EDITAR FUNCIONARIO">
            </button>
            <button class="botao-gerente">
              <img src="assets/delete.png" style="height: 50px;" alt="DELETAR FUNCIONARIO">
            </button>
          </div>

          
        </div>
      </div>
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
