<html lang="pt-br">
<h1>Lista de Compras</h1>
<!--- Caixas de entrada e botões --->
<form action="index.php">
    <input type="submit" value="Voltar" />
</form>

 <?php
     include_once ("Classes/ListaCompra.php");
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "mercadinho";

     // Conexao com o servidor
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     $action = new ListaCompra();

     $sql = "SELECT lista_compras.id_produto, nome, valor, lista_compras.quantidade
             FROM lista_compras
             LEFT JOIN produtos
             ON lista_compras.id_produto = produtos.id_produto";

     $result = $conn->query($sql);
     if ($result and $result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
             echo "<b>id_produto:</b> " . $row["id_produto"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. " - <b>quantidade:</b> " . $row["quantidade"]."<br>";
         }
     }
     else {
         echo "Lista Vazia!";
     }

     // Adicionar produto na lista de compras
     if ( isset( $_POST['add'])) {
         $codigo = $_REQUEST['codigo'];
         $quantidade = $_REQUEST['quantidade'];
         $action->adicionarNaLista($codigo, $quantidade, $conn);
     }
     // Devolver produtos
     // Checa se a venda existe, se o produto sendo devolvido existe e está na venda
     // e se a quantidade que vai ser devolvida é menor ou igual a vendida.
     else if ( isset( $_POST['devolver'])) {
         // Procura pelo ID da venda no banco de dados
         $id_produto = $_REQUEST['id_produto'];
         $id_venda = $_REQUEST['id_venda'];
         $quantidade_trocar = $_REQUEST['quantidade'];
         $action->devolverProduto($id_produto, $id_venda, $quantidade_trocar, $conn);
     }
     else if ( isset( $_POST['trocar'])) {
         // Recebe 5 valores
         // id_produto_recebido
         // quantidade_recebida
         // id_produto_trocado
         // quantidade_trocada
         // id_venda
         // Procura pelo ID da venda no banco de dados
         $id_produto_recebido = $_REQUEST['id_produto_recebido'];
         $quantidade_recebida = $_REQUEST['quantidade_recebida'];
         $id_produto_trocado = $_REQUEST['id_produto_trocado'];
         $quantidade_trocada = $_REQUEST['quantidade_trocada'];
         $id_venda = $_REQUEST['id_venda'];
         $action->trocarProduto($id_produto_recebido, $quantidade_recebida, $id_produto_trocado, $quantidade_trocada, $id_venda, $conn);
     }
     // Finalizar a compra
     // Trabalha com 4 tabelas: Lista_compras, produtos, vendas e produtos_vendidos
     // Para cada produto na lista de compra, é somado o valor, e o total é armazenado em vendas.
     // Com isso, temos o id_venda, que cada produto deve receber quando for armazenado em produtos produtos_vendidos
     // (Isso é feito para possibilitar a troca depois).
     // É também alterado a quantidade de cada produto, que seria o valor de produtos no estoque.
     else if ( isset( $_POST['finalizar'])) {
       $action->finalizarCompra($conn);
     }
 ?>

<form action="consultar_produto.php">
    <input type="submit" value="Consultar Produto" />
</form>

<form action="devolver_produto.php">
    <input type="submit" value="Devolver Produto" />
</form>

<form action="trocar_produto.php">
    <input type="submit" value="Trocar Produto" />
</form>

<form action="lista_compras.php" method="POST">
    <input type="submit" name="finalizar" value="Finalizar Compra" />
</form>
</html>
