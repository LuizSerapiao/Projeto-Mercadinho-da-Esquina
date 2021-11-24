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
        <a href="index.php">
            <img src="../assets/log-out-circle.png" style="height: 50px">
        </a>
    </button>
    <h1 class="title">Editar Fornecedor</h1>
    <form action="../fornecedores.php"  method="post" autocomplete="off">
      <h1 style="margin-top: 45px;">Nome atual</h1>
      <input class="input-txt" type="text" name="nome" maxlength="50" required/>
      <div style="display: flex; flex-direction: row; width: 100%; justify-content: space-evenly">
        <div class="input-column">
          <h1 style="margin-top: 45px;">Nome</h1>
          <input class="input-txt" type="text" name="novo_nome" maxlength="50" required/>
          <h1 style="margin-top: 45px;">Telefone de Contato</h1>
          <input class="input-txt" type="text" name="novo_telefone" size="11" required/>
          <h1 style="margin-top: 45px;">E-mail</h1>
          <input class="input-txt" type="text" name="novo_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
        </div>
        <div class="input-column">
          <h1 style="margin-top: 45px;">Estado</h1>
          <input class="input-txt" type="text" name="novo_estado" maxlength="50" />
          <h1 style="margin-top: 45px;">Cidade</h1>
          <input class="input-txt" type="text" name="nova_cidade" maxlength="50" />
          <h1 style="margin-top: 45px;">Endereço</h1>
          <input class="input-txt" type="text" name="novo_endereço" maxlength="50" />
        </div>
      </div>
      <input class="salvar" type="submit" name="edt" value="SALVAR" />
    </form>
  </div>
</body>
<<<<<<< HEAD:src/mercadinho/HTML/editar-fornecedor.php
=======

<!-- <html>

<form action="fornecedores.php">
    <input type="submit" value="Voltar" />
</form>

<form action="fornecedores.php" method="post" autocomplete="off">

    <input type="text" name="nome" placeholder="Nome" />
    <br>
    <input type="text" name="novo_nome" placeholder="Novo Nome" required/>
    <input type="text" name="novo_telefone" placeholder="Novo Telefone" required/>
    <input type="text" name="novo_email" placeholder="Novo Email" required/>
    <input type="text" name="novo_estado" placeholder="Novo Estado" />
    <input type="text" name="nova_cidade" placeholder="Nova Cidade" />
    <input type="text" name="novo_endereço" placeholder="Novo Endereço" />
    <input type="submit" name="edt" value="editar" />

</html> -->
>>>>>>> 65b9877c36c13e36b3dd7394154baa9042903312:src/mercadinho/editar-fornecedor.php
