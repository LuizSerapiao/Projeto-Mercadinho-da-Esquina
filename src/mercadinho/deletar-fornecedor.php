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
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>
    <h1 class="title">Deletar Fornecedor</h1>
    <form action="fornecedores.php"  method="post" autocomplete="off">
      <h1 style="margin-top: 45px;">Nome do fornecedor para ser deletado:</h1>
      <input class="input-txt" type="text" name="nome" maxlength="50" required/>
      <input class="salvar" type="submit" name="edt" value="DELETAR" />
    </form>
  </div>
</body>