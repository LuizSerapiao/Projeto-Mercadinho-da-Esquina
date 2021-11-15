<html>
<form action="lista_compras.php">
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
</form>

</html>
