<?php

class Venda{
    function __construct(){
    }

    function mostrarVenda($conn)
    {
        $sql = "SELECT id_venda, valor
             FROM vendas";

        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                // echo "Código da compra: " . $row["id_venda"] . " <------> Valor da compra: R$" . $row["valor"] . "<br>";
                $id_venda = $row["id_venda"];
                echo "<tr>".
                      "<td>".$id_venda."</td>".
                      "<td>R$".$row["valor"]."</td>".
                      '<td><a href="venda.php?id_venda='.$id_venda.'&procurar=procurar%21"/>'.
                         '<img src="assets/Search.png" style="height: 43px;">'.
                      "</a></td>".
                      '<td><a href="venda.php?id_venda='.$id_venda.'&excluir=excluir%21"/>'.
                         '<img src="assets/delete.png" style="height: 43px;">'.
                      "</a></td>".
                      "<tr>";
            }
        } else {
            echo "<tr>".
                  "<td> <h2>Lista Vazia!</h2> </td>".
                  "<td> - </td>".
                  "<tr>";
        }
    }
        function procurarVenda($id_venda, $conn){
            $sql = "SELECT id_venda, nome, valor, quantidade
                 FROM (
                     SELECT produtos_vendidos.id_venda, produtos.nome, produtos.valor, produtos_vendidos.quantidade
                     FROM produtos_vendidos
                     INNER JOIN produtos
                     ON produtos_vendidos.id_produto = produtos.id_produto
                 ) AS t
                 where id_venda = $id_venda";
            $result = $conn->query($sql);
            $valor = 0;
            if ($result and $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $valor = $valor + ($row["valor"]*$row["quantidade"]);
                    //echo "Código da compra: ".$row["id_venda"]. " <------> Produto Vendido: ". $row["nome"] . " <------> Quantidade: " .$row["quantidade"] . "<br>";
                    echo "<tr>".
                          "<td>".$row["nome"]."</td>".
                          "<td>".$row["quantidade"]."</td>".
                          "<td>R$".$row["valor"]."</td>".
                          "<tr>";
                }
            }
            else {
                echo "<tr>".
                      "<td> <h2>Não foi encontrada a venda procurada!</h2> </td>".
                      "<td> - </td>".
                      "<tr>";
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
                echo "<tr>".
                      "<td> <h2>DEVOLUÇÕES</h2> </td>".
                      "<td> <h2>QUANTIDADE </h2></td>".
                      "<td> <h2>VALOR</h2> </td>".
                      "<tr>";
                while($row = $result->fetch_assoc()) {
                    $valor = $valor - ($row["valor"]*$row["quantidade"]);
                    echo "<tr>".
                          "<td>".$id_venda."</td>".
                          "<td>".$row["quantidade"]."</td>".
                          "<td>R$".$row["valor"]."</td>".
                          "<tr>";
                }
            }
            else {
                echo "<tr>".
                      "<td> <h2>DEVOLUÇÕES</h2> </td>".
                      "<td> <h2>QUANTIDADE </h2></td>".
                      "<td> <h2>VALOR</h2> </td>".
                      "<tr>";
            }
            return $valor;
        }

        function excluirVenda($id_venda, $conn){
            $sql = "SELECT produtos.quantidade, produtos_vendidos.quantidade AS quantidadeVend, produtos.id_produto
                 FROM produtos_vendidos
                 LEFT JOIN produtos
                 ON produtos.id_produto = produtos_vendidos.id_produto AND produtos_vendidos.id_venda = $id_venda";
            $result = $conn->query($sql);

            if ($result and $result->num_rows > 0) {
                echo "<br><br><b>Produtos na compra</b><br>";
                while($row = $result->fetch_assoc()) {
                    $quantidadeUpdate = $row["quantidade"] + $row["quantidadeVend"];
                    $id_produto = $row["id_produto"];
                    $sql ="UPDATE produtos
                       SET quantidade = '$quantidadeUpdate'
                       WHERE produtos.id_produto = '$id_produto'";
                    $result2 = $conn->query($sql);
                    if (!$result2) {die ("<br>Erro atualizando produtos devolucao <br>");}
                }

                $sql = "DELETE FROM produtos_vendidos
                        WHERE id_venda = '$id_venda'";
                $result3 = $conn->query($sql);
                if (!$result3) {die ("Não foi possível remover os produtos vendidos!");}

                $sql = "DELETE FROM vendas
                        WHERE id_venda = '$id_venda'";
                $result4 = $conn->query($sql);
                if (!$result4) {echo ("Não foi possível remover a venda!");}
                else{header("Location: vendas.php");}
            }

            else {
                echo "<tr>".
                      "<td> <h2>Venda não encontrada!</h2> </td>".
                      "<tr>";
                // echo "Não foi encontrada a venda procurada!<br>";
            }
            return 0;
        }

}
