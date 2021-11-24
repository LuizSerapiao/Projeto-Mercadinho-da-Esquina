<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../styles/styles.css"/>
</head>
<body>
    <header class="header">
        <h1 class="header-title">Mercadinho da Esquina</h1>
    </header>
    <h1 class="title">Devolver Produto</h1>
    <form action="../caixa.php" method="POST">
        <div>
                <h1 style="margin-top: 71px;">Código do Produto:</h1>
                <div style="display: flex; align-items: center;">
                    <input style ="width: 603px;" type="text" name="id_produto" required/>
                    <h1 style ="font-size: 24px; margin-left: 15px;">Un.</h1>
                    <input style ="width: 109px; margin-left: 18px;" type="number" name="quantidade" value="1" required/>
                </div>
            </div>
            <div>
                <h1 style="margin-top: 62px;">Código de Venda:</h1>
                <input style ="width: 780px;" name="id_venda" type="text" required/>
            </div>
            <div style="margin-top: 113px; width: 780px; display: flex; justify-content: space-between">
                <a href="../caixa.php">
                    <input class="botao-substyle" type="button" value="VOLTAR" />
                </a>
                <input type="submit" name="devolver" value="CONFIRMAR" />
        </div>
    </form>

</body>
</form> -->

</html>
