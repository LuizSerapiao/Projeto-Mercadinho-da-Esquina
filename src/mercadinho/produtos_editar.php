<html>
<form action="produtos.php">
    <input type="submit" value="Voltar" />
</form>
<form action="produtos.php" method="post" autocomplete="off">
    <input type="text" name="nome" placeholder="Nome" required />
    <br>
    <input type="text" name="novo_nome" placeholder="Novo nome" required/>
    <input type="number" step="0.01" name="novo_valor" placeholder="Novo Valor" required/>
    <input type="submit" name="edt" value="editar" />
</form>

</html>