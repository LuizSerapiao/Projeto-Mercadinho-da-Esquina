
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../styles/styles.css"/>
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
    <a href="../pedidos.php">
      <img src="../assets/Botao Pedidos.png" class="img-botao-gerente" alt="PEDIDOS">
    </a>
    <a href="../vendas.php">
      <img src="../assets/Botao Vendas.png" class="img-botao-gerente" alt="VENDAS">
    </a>
    <a href="../produtos.php">
      <img src="../assets/Botao Produtos.png" class="img-botao-gerente" alt="PRODUTOS">
    </a>
    <a href="../fornecedores.php">
      <img src="../assets/Botao Fornecedor.png" class="img-botao-gerente" alt="FORNECEDORES">
    </a>
    <a href="../funcionarios.php">
      <img src="../assets/Botao Caixa.png" class="img-botao-gerente" alt="CAIXA">
    </a>
  </div>
  
  <div class="content-gerente">
    <button style="align-self: end; margin-right: 13px; margin-top: 11px;">
      <img src="assets/log-out-circle.png" style="height: 50px">
    </button>
    <h1 class="title">Cadastrar Funcionario</h1>
    <form action="../funcionarios.php"  method="post" autocomplete="off">
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
          <h1 style="margin-top: 45px;">Endereço</h1>
          <input class="input-txt" type="text" name="endereço" maxlength="50"  required/>
          <h1 style="margin-top: 45px;">Usuário</h1>
          <input class="input-txt" type="text" name="usuario" maxlength="10"  required/>
          <h1 style="margin-top: 45px;">Senha</h1>
          <input class="input-txt" type="password" name="senha" maxlength="10"  required/>
        </div>
      </div>
      <input class="salvar" type="submit" name="add" value="SALVAR" />
    </form>
  </div>
</body>
</html>
