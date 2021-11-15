<html lang="pt-br">
<h1>Registro de vendas</h1>
<!--- Caixas de entrada e botões --->
<form action="gerente.php">
    <input type="submit" value="Voltar" />
</form>

 <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "mercadinho";

     // Conexao com o servidor
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     $sql = "SELECT id_venda, valor
             FROM vendas";

     $result = $conn->query($sql);
     if ($result and $result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
             echo "Código da compra: ".$row["id_venda"]. " <------> Valor da compra: R$". $row["valor"] . "<br>";
         }
     }
     else {
         echo "Lista Vazia!";
     }

     if ( isset( $_POST['procurar'] )) {
         $id_venda = $_REQUEST['id_venda'];
         $sql = "SELECT id_venda, nome, valor, quantidade
                 FROM (
                     SELECT produtos_vendidos.id_venda, produtos.nome, produtos.valor, produtos_vendidos.quantidade
                     FROM produtos_vendidos
                     INNER JOIN produtos
                     ON produtos_vendidos.id_produto = produtos.id_produto
                 ) AS t
                 where id_venda = $id_venda";
         $result = $conn->query($sql);
         if ($result and $result->num_rows > 0) {
             echo "<br><br><b>Produtos na compra</b><br>";
             while($row = $result->fetch_assoc()) {
                 echo "Código da compra: ".$row["id_venda"]. " <------> Produto Vendido: ". $row["nome"] . " <------> Quantidade: " .$row["quantidade"] . "<br>";
             }
         }
         else {
             echo "Não foi encontrada a venda procurada!<br>";
         }

         $sql = "SELECT id_venda, nome, valor, quantidade
                 FROM (
                     SELECT devolucoes.id_venda, produtos.nome, produtos.valor, devolucoes.quantidade
                     FROM devolucoes
                     INNER JOIN produtos
                     ON devolucoes.id_produto = produtos.id_produto
                 ) AS t
                 where id_venda = $id_venda";
         $result = $conn->query($sql);
         if ($result and $result->num_rows > 0) {
             echo "<br><br><b>Produtos devolvidos</b><br>";
             while($row = $result->fetch_assoc()) {
                 echo "Código da compra: ".$row["id_venda"]. " <------> Produto Devolvido: ". $row["nome"] . " <------> Quantidade: " .$row["quantidade"] . "<br>";
             }
         }
         else {
             echo "Nenhuma devolução encontrada para essa venda!<br>";
         }
     }
 ?>
 <br><b>Buscar detalhes sobre uma venda</b>
 <form action="vendas.php" method="post">
     <input type="text" name="id_venda" placeholder="Código da venda" required />
     <input type="submit" name="procurar" value="Procurar" />
 </form>

</html>
