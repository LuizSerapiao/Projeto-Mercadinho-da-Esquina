<html>
    
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

</html>