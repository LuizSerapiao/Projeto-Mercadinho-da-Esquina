<html lang="pt-br">
<h1>Lista de Compras</h1>
<!--- Caixas de entrada e botões --->
<form action="index.php">
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
         echo "Nenhum produto cadastrado!";
     }

     // Adicionar produto na lista de compras
     if ( isset( $_POST['add'])) {
         $codigo = $_REQUEST['codigo'];
         $quantidade = $_REQUEST['quantidade'];

         $sql = "INSERT INTO lista_compras (id_produto, quantidade)
         VALUES ('$codigo','$quantidade')";

         if ($conn->query($sql) === TRUE) {
             header("Refresh:0");
         }
         else {
             echo "Erro" . $sql . "<br>" . $conn->error;
         }
     }
     // Ainda não foi terminado, ignorar por enquanto
     // else if ( isset( $_POST['devolver'])) {
     //     $id_produto = $_REQUEST['id_produto'];
     //     $id_venda = $_REQUEST['id_venda'];
     //     $quantidade = $_REQUEST['quantidade'];
     //     $sql = "SELECT id_produtos_vendidos, id_produto, quantidade
     //     FROM produtos_vendidos
     //     WHERE id_venda = $id_venda";
     //     $result = $conn->query($sql);
     //     if ($result and $result->num_rows > 0) {
     //         // output data of each row
     //         while($row = $result->fetch_assoc()) {
     //             echo "<b>id_produto:</b> " . $row["id_produto"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. " - <b>quantidade:</b> " . $row["quantidade"]."<br>";
     //         }
     //     }
     //     else {
     //         echo "Nenhum produto cadastrado!";
     //     }
     // }

     // Finalizar a compra
     // Trabalha com 4 tabelas: Lista_compras, produtos, vendas e produtos_vendidos
     // Para cada produto na lista de compra, é somado o valor, e o total é armazenado em vendas.
     // Com isso, temos o id_venda, que cada produto deve receber quando for armazenado em produtos produtos_vendidos
     // (Isso é feito para possibilitar a troca depois).
     // É também alterado a quantidade de cada produto, que seria o valor de produtos no estoque.
     else if ( isset( $_POST['finalizar'])) {
         // Juntando as tabelas para pegar o valor e a quantidade de cada produto que foi vendido
         $sql = "SELECT lista_compras.id_produto, valor, lista_compras.quantidade as l_quantidade, produtos.quantidade as p_quantidade
                 FROM lista_compras
                 LEFT JOIN produtos
                 ON lista_compras.id_produto = produtos.id_produto";
         $result = $conn->query($sql);
         if ($result and $result->num_rows > 0) {
             // Para cada produto na lista de compras:
             $valor_total = 0;
             while($row = $result->fetch_assoc()) {
                 // Somando o valor total da compra
                 $valor_total = $valor_total + ($row["l_quantidade"] * $row["valor"]);

                 // Variáveis para atualizar a quantidade.
                 $quantidade = $row["l_quantidade"];
                 $produto = $row['id_produto'];
                 $quantidade_update = $row["p_quantidade"] - $quantidade;
                 if ($quantidade_update < 0) { $quantidade_update = 0; }
                 $id_produto = $row["id_produto"];

                 // Atualizando a quantidade dos produtos
                 $sql = "UPDATE produtos
                         SET quantidade = '$quantidade_update'
                         WHERE id_produto = '$id_produto'";
                 $result1 = $conn->query($sql);
                 if (!$result1) {die ("ERRO! result1 - 2");}

             }
             // Printando o valor total, não sei se deve ou não ser removido.
             // Inserindo a venda com o valor total
             $sql = "INSERT INTO vendas (valor)
                     VALUES ('$valor_total')";
             $result = $conn->query($sql);
             if (!$result) { die ("ERRO! vendas1"); }

             // Recuperando o ID da venda que acabou de ser feita para cadastrar cada produtos
             // em produtos_vendidos
             $sql = "SELECT LAST_INSERT_ID()";
             $result = $conn->query($sql);
             if (!$result) { die ("ERRO! vendas 2"); }
             while($row = $result->fetch_assoc()) { $id_venda = $row["LAST_INSERT_ID()"]; }

             // Inserindo cada produto vendido em produtos_vendidos.
             $sql = "SELECT lista_compras.id_produto, produtos.quantidade
                     FROM lista_compras
                     LEFT JOIN produtos
                     ON lista_compras.id_produto = produtos.id_produto";
             $result = $conn->query($sql);
             if (!$result) { die ("ERRO! select1"); }
             while($row = $result->fetch_assoc()) {
                 $var_id_produto = $row['id_produto'];
                 $var_quantidades = $row['quantidade'];
                 $sql = "INSERT INTO produtos_vendidos (id_venda, id_produto, quantidade)
                         VALUES ('$id_venda','$var_id_produto','$var_quantidades')";
                 $result1 = $conn->query($sql);
                 if (!$result1) {die ("ERRO! select2");}
             }

         $sql = "DELETE from lista_compras";
         $result = $conn->query($sql);
         if (!$result) { die ("ERRO DELETANDO!"); }
            // Se possível, em vez de atualizar a página, mandar para outra página que mostra o valor total a ser pago.
            // header("Refresh:0");
            echo "<h1> Valor a ser pago: ";
            print $valor_total;
            echo "<br></h1>";
         }
         else {
             echo "Nenhum produto na lista de compras!";
         }
     }
 ?>

<form action="consultar_produto.php">
    <input type="submit" value="Consultar Produto" />
</form>

<form action="devolver_produto.php">
    <input type="submit" value="Devolver Produto" />
</form>

<form action="index.php">
    <input type="submit" value="Trocar Produto" />
</form>

<form action="lista_compras.php" method="POST">
    <input type="submit" name="finalizar" value="Finalizar Compra" />
</form>
</html>
