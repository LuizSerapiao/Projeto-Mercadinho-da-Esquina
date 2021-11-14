<html lang="pt-br">
<h1>Consultar Produto</h1>
<!--- Caixas de entrada e botões --->
<form action="lista_compras.php">
    <input type="submit" value="Voltar" />
</form>

<form action="lista_compras.php" method="POST">
    <input type="text" name="codigo" placeholder="Codigo do produto" required/> <br>
    <input type="text" name="quantidade" placeholder="Quantidade" value="1"/> <br>
    <input type="submit" name="add" value="Adicionar" />
</form>
</html>
