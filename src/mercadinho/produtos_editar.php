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
    <h1 class="title">Editar Produto</h1>
    <form action="produtos.php" method="GET">
      <div class="input-column">
          <?php
          if ( isset( $_GET['edt'])) {
              $id = $_REQUEST['id'];
              echo
                '<h1 style="margin-top: 45px;">Id produto sendo alterado</h1>'.
                '<input class="input-txt" type="text"name="id" value="'.$id.'" readonly="readonly"/><br>'.
                '<h1 style="margin-top: 45px;">Nome</h1>'.
                '<input class="input-txt" type="text" name="novo_nome" value="Novo nome" required/>'.
                '<div>'.
                  '<h1 style="margin-top: 45px;">Valor</h1>'.
                  '<input class="input-txt" type="number" name="novo_valor" value="1" required/>'.
                '</div>'.
                '<div>'.
                  '<h1 style="margin-top: 45px;">Quantidade</h1>'.
                  '<input class="input-txt" type="number" name="nova_quantidade" value="1" required/>'.
                '</div>'.
                '<input class="salvar" type="submit" name="edt" value="edt" />';
            }
        ?>
    </form>
  </div>
</body>
</html>
