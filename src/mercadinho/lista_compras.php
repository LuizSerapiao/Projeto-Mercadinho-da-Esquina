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
         echo "Lista Vazia!";
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
     // Devolver produtos
     // Checa se a venda existe, se o produto sendo devolvido existe e está na venda
     // e se a quantidade que vai ser devolvida é menor ou igual a vendida.
     else if ( isset( $_POST['devolver'])) {
         // Procura pelo ID da venda no banco de dados
         $id_produto = $_REQUEST['id_produto'];
         $id_venda = $_REQUEST['id_venda'];
         $quantidade_trocar = $_REQUEST['quantidade'];
         $sql = "SELECT id_venda
                 FROM vendas
                 WHERE id_venda = $id_venda";
         $result = $conn->query($sql);
         if ($result and $result->num_rows <= 0) { die ("<br> Erro: Venda não existe! <br>"); }
         else if (!$result){ die("<br> Erro procurando venda <br>"); }

         // Procura se o produto que deseja ser devolvido foi vendido.
         // Se for adicionado ao carrinho 2 produtos iguais, com 2 quantidades diferentes,
         // o que vai valer é o primeiro que o sistema encontrar. Da pra fazer todos contarem,
         // mas não no tempo que temos.
         $sql = "SELECT id_produto, quantidade
                 FROM produtos_vendidos
                 WHERE id_venda = $id_venda AND id_produto = $id_produto";
         $result = $conn->query($sql);
         if ($result and $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $quantidade_vendida = $row["quantidade"];
             if ($quantidade_vendida < $quantidade_trocar) {
                 echo ("<br> <h2>Quantidade insuficiente para devolver! A quantidade vendida foi " . $row["quantidade"] . " </h2><br>");
             }
             else { // Devoluçào foi aceita
                 // Atualiza o produto vendido, para não permitir que seja devolvido
                 // mais que a quantidade vendida caso sejam feitas múltiplas devoluções
                 $quantidade_update = $quantidade_vendida - $quantidade_trocar;
                 $sql = "UPDATE produtos_vendidos
                         SET quantidade = '$quantidade_update'
                         WHERE id_produto = '$id_produto'";

                 $result = $conn->query($sql);
                 if (!$result) {die ("<br>Erro atualizando produtos devolucao <br>");}

                 // Pega a quantidade de produtos que tem no estoque e atualiza, adicionando aqueles
                 // que foram devolvidos.
                 $sql = "SELECT quantidade
                         FROM produtos
                         WHERE id_produto = $id_produto";
                 $result = $conn->query($sql);
                 $row = $result->fetch_assoc();
                 $quantidade_update = $row["quantidade"] + $quantidade_trocar;
                 $sql = "UPDATE produtos
                         SET quantidade = '$quantidade_update'
                         WHERE id_produto = '$id_produto'";

                 $result = $conn->query($sql);
                 if (!$result) {die ("<br>Erro atualizando produtos devolucao <br>");}

                 // Adiciona o produto e a quantidade devolvidos na tabela devoluçõe
                 // Essa tabela é usada para mostrar o valor real da venda apos uma devolução.
                 $sql = "INSERT INTO devolucoes (id_produto, quantidade)
                         VALUES ('$id_produto','$quantidade_trocar')";

                 $result = $conn->query($sql);
                 if (!$result) {die ("<br>Erro inserindo produto na tabela devolucoes<br>");}

                 // Pega o valor do produto devolvido para calcular o quanto deve ser
                 // devolvido ao cliente.
                 $sql = "SELECT valor
                         FROM produtos
                         WHERE id_produto = $id_produto";
                 $result = $conn->query($sql);
                 if (!$result) {die ("<br>Erro recuperando valor da venda<br>");}
                 $row = $result->fetch_assoc();
                 echo ("<br>O valor a ser devolvido é R$<br>".$row["valor"] * $quantidade_trocar);
             }
         }
         else {
             echo ("<br>Erro - Produto não consta na venda!<br>");
         }
     }
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
             $sql = "SELECT lista_compras.id_produto, lista_compras.quantidade
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
