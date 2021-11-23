
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
    <h1 class="title">Cadastrar Fornecedor</h1>
    <form action="fornecedores.php"  method="post" autocomplete="off">
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