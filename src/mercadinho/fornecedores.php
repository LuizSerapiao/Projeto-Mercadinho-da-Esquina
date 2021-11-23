
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="stylesheet" type="text/css" href="styles/search.css"/>
    <title></title>
</head>

<header class="header">
  <h1 class="header-title">Mercadinho da Esquina</h1>
</header>

<style>
td {
    height: 70px;
}
</style>

<body>

  <div class="leftbar-gerente">
    <a href="pedidos.php">
      <img class="img-botao-gerente" src="assets/Botao Pedidos.png" alt="PEDIDOS">
    </a>
    <a href="vendas.php">
      <img class="img-botao-gerente" src="assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
    </a>
    <a href="produtos.php">
      <img class="img-botao-gerente" src="assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
    </a>
    <a href="fornecedores.php">
      <img class="img-botao-gerente" src="assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
    </a>
    <a href="funcionarios.php">
      <img class="img-botao-gerente" src="assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
    </a>
  </div>

  <div class="content-gerente">
    <!-- <button class="botao-logout"> -->
    <button style="background-color: rgb(0,0,0,0); border: 0; align-self: end; margin-right: 13px; margin-top: 11px;">
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>

    <div style="margin-top: 76px">
      <h1 class="searchfield-title">Nome do Fornecedor:</h1>
      <div class="search-field-layout">
        <input class="search-field" type="text"/>
        <button class="search-button">
          <img class="search-icon" src="assets/Search.png"/>
        </button>
      </div>
    </div>

    <div style="width: 100%; max-width: 1366px; margin-top: 38px;">
      <table style="width: 100%; margin-left: 5%">
        <tr>
          <td>
            <h1>Nome:</h1>
          </td>
          <td>
            <h1>Código:</h1>
          </td>
          <td>
            <h1>Telefone:</h1>
          </td>
          <td>
            <h1>E-mail:</h1>
          </td>
          <td> 
            <button style="background-color: rgb(0,0,0,0); border: 0;">
              <img src="assets/dashicons_insert.png" style="height: 36px;name="edt value="editar">
            </button>
            </button>
          </td>
        </tr>

        <tr>
        <td> Nestle </td>".
         <td> 012</td>".
         <td> (15)98390-7423</td>
         <td> nestle@gmail.com </td>

         <td>
         <a href="fornecedores_editar.php">  
         <button style="background-color: rgb(0,0,0,0); border: 0;">
              <img src="assets/Edit.png" style="height: 36px"/></button></a>
         </td>

         <td> 
         <button style="background-color: rgb(0,0,0,0); border: 0; margin-left: 10px">
              <img src="assets/delete.png" style="height: 36px"/></button>
         </td> 
                
      </tr>
        <?php
          // echo "<tr>".
              // "<td>"."Nestle"."</td>".
              // "<td>"."012"."</td>".
              // "<td>"."(15)98390-7423"."</td>".
              // "<td>"."nestle@gmail.com"."</td>"."<td>".
              // '<button style="background-color: rgb(0,0,0,0); border: 0;">'.
              //  '<img src="assets/Edit.png" style="height: 36px"/>'."</button>".
              // '<button style="background-color: rgb(0,0,0,0); border: 0; margin-left: 10px">'.
              // '<img src="assets/delete.png" style="height: 36px"/>'."</button>"."</td>"."<tr>";
          // if( $ven->num_rows > 0){
          //   while( $registro = $res->fetch_assoc() ){
          //     echo
          //         "<tr>".
          //           "<td>".$registro['idVenda']."</td>".
          //           "<td>".$registro['valTotal']."</td>".
          //         "<tr>";
          //   }
          // }
        ?>
         
    </table>
    </div>
  </div>
</body>

<!-- <h1>Fornecedores</h1>
<form action="gerente.php">
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
</form> -->

<form action="ligar_fornecedor_produto.php">
    <input type="submit" value="Conectar produto a um fornecedor" required/>

    <br><br>
</form>

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
            $usuario = $_REQUEST['nome'];
            $action->listarFornecedor($usuario, $conn);
        }
        else {
            $action->listarFornecedor(null, $conn);
        }
    }

    $conn->close();
?>
</html>
