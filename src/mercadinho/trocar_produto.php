<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
</head>
<body>
    <header class="header">
    <h1 class="header-title">Mercadinho da Esquina</h1>
    </header>
    <h1 class="title">Trocar Produto</h1>
    <form>
        <div>
            <h1 style="margin-top: 32px;">Código do Produto Devolvido</h1>
            <div style="display: flex; align-items: center;">
                <input style ="width: 603px;" type="text" required/>
                <h1 style ="font-size: 24px; margin-left: 15px;">Un.</h1>
                <input style ="width: 109px; margin-left: 18px;" type="number" value="1" required/>
            </div>
        </div>
        <div>
            <h1 style="margin-top: 32px;">Código do novo Produto</h1>
            <div style="display: flex; align-items: center;">
                <input style ="width: 603px;" type="text" required/>
                <h1 style ="font-size: 24px; margin-left: 15px;">Un.</h1>
                <input style ="width: 109px; margin-left: 18px;" type="number" value="1" required/>
            </div>
        </div>
        <div>
            <h1 style="margin-top: 32px;">Código de Venda</h1>
            <input style ="width: 780px;" type="text" required/>
        </div>
        <div style="width: 780px; display: flex; justify-content: space-between">
            <input type="submit" name="add" value="CANCELAR" />
            <input type="submit" name="add" value="CONFIRMAR" />
        </div>
    </form>

</body>

<!-- <form action="lista_compras.php">
    <input type="submit" value="Voltar" />
</form>
<h1> Devolver Produto </h1>
<form action="lista_compras.php" method="post" autocomplete="off">
    <b>Código do produto devolvido<br> </b>
    <input type="number" name="id_produto_recebido" placeholder="Codigo Do Produto" required />
    <input type="number" step="1" name="quantidade_recebida" placeholder="Qnt" required/> <br>
    <b>Código do produto trocado<br> </b>
    <input type="number" name="id_produto_trocado" placeholder="Codigo Do Produto" required />
    <input type="number" step="1" name="quantidade_trocada" placeholder="Qnt" required/> <br>
    <b>Código da venda<br> </b>
    <input type="number" name="id_venda" placeholder="Codigo Da Venda" required /> <br>

    <input type="submit" name="trocar" value="Confirmar" />
</form> -->

</html>
