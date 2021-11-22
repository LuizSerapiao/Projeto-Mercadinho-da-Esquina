
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>

<style>
  .input-txt{
    width: 402px;
  }
</style>

<body>
  <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
  </header>  
  <div class="leftbar-gerente">
    <a href="http://localhost/mercadinho/pedidos.php?">
      <img src="assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
    </a>
    <a href="http://localhost/mercadinho/vendas.php?">
      <img src="assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
    </a>
    <a href="http://localhost/mercadinho/produtos.php?">
      <img src="assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
    </a>
    <a href="http://localhost/mercadinho/fornecedores.php?">
      <img src="assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
    </a>
    <a href="http://localhost/mercadinho/funcionarios.php?">
      <img src="assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
    </a>
  </div>
  
  <div class="content-gerente">
    <button style="align-self: end; margin-right: 13px; margin-top: 11px;">
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>
    <h1 class="title">Cadastrar Fornecedor</h1>
    <form>
      <div style="display: flex; flex-direction: row; width: 100%; justify-content: space-evenly">
        <div class="input-column">
          <h1 style="margin-top: 45px;">Nome</h1>
          <input class="input-txt" type="text" name="nome" maxlength="50" required/>
          <h1 style="margin-top: 45px;">Telefone de Contato</h1>
          <input class="input-txt" type="text" name="telefone" size="11" required/>
          <h1 style="margin-top: 45px;">E-mail</h1>
          <input class="input-txt" type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
        </div>
        <div class="input-column">
          <h1 style="margin-top: 45px;">Estado</h1>
          <input class="input-txt" type="text" name="estado" maxlength="50" />
          <h1 style="margin-top: 45px;">Cidade</h1>
          <input class="input-txt" type="text" name="cidade" maxlength="50" />
          <h1 style="margin-top: 45px;">Endereço</h1>
          <input class="input-txt" type="text" name="endereço" maxlength="50" />
        </div>
      </div>
      <input class="salvar" type="submit" name="add" value="SALVAR" />
    </form>
  </div>
</body>

<!-- <h1>Fornecedores</h1>
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

    <br>
<br><br>
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
            $usuario = $_REQUEST['usuario'];
            $action->listarFornecedor($usuario, $conn);
        }
        else {
            $action->listarFornecedor(null, $conn);
        }
    }

    $conn->close();
?>
</html>
