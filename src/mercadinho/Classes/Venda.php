<?php

class Venda{
    function __construct(){
    }

    function mostrarVenda($id_venda, $conn) {
        if ($id_venda === NULL) {
            $sql = "SELECT id_venda, valor
                 FROM vendas";

            $result = $conn->query($sql);
            if ($result and $result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // echo "Código da compra: " . $row["id_venda"] . " <------> Valor da compra: R$" . $row["valor"] . "<br>";
                    $id_venda = $row["id_venda"];
                    echo "<tr>".
                          '<td></td><td style="text-align: center;"><h2>'.$id_venda."</h2></td>".
                          '<td style="text-align: center;"><h2>R$'.$row["valor"]."</h2></td>".
                          '<td style="text-align: center;"><a href="venda.php?id_venda='.$id_venda.'&procurar=procurar%21"/>'.
                             '<img src="assets/Search.png" style="height: 43px;">'.
                          "</a>".
                          '<a href="venda.php?id_venda='.$id_venda.'&excluir=excluir%21"/>'.
                             '<img src="assets/delete.png" style="height: 43px;">'.
                          "</a></td><td></td>".
                          "<tr>";
                }
            } else {
                echo "<tr><td></td>".
                     '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                     '<td style="text-align: center;"> <h1>Nenhuma venda registrada</h1> </td>'.
                     '<td style="text-align: center;"> <h1>-----</h1> </td>'.
                     "<td></td><tr>";
            }
        }
        else {
            $sql = "SELECT id_venda, valor
                    FROM vendas
                    WHERE id_venda = $id_venda";
                    $result = $conn->query($sql);
            if ($result and $result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // echo "Código da compra: " . $row["id_venda"] . " <------> Valor da compra: R$" . $row["valor"] . "<br>";
                    $id_venda = $row["id_venda"];
                    echo "<tr><td></td>".
                          '<td style="text-align: center;"><h2>'.$id_venda."</h2></td>".
                          '<td style="text-align: center;"><h2>R$'.$row["valor"]."<h2></td>".
                          '<td style="text-align: center;"><a href="venda.php?id_venda='.$id_venda.'&procurar=procurar%21"/>'.
                             '<img src="assets/Search.png" style="height: 43px;">'.
                          "</a>".
                          '<a href="venda.php?id_venda='.$id_venda.'&excluir=excluir%21"/>'.
                             '<img src="assets/delete.png" style="height: 43px;">'.
                          "</a></td>".
                          "<td></td><tr>";
                }
            } else {
                echo "<tr><td></td>".
                     '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                     '<td style="text-align: center;"> <h1>Venda não encontrada</h1> </td>'.
                     '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                     "<td></td><tr>";
            }
        }
    }
        function procurarVenda($id_venda, $conn){
            $sql = "SELECT id_venda, nome, valor, quantidade, id_produto
                 FROM (
                     SELECT produtos_vendidos.id_venda, produtos.nome, produtos.valor, produtos_vendidos.quantidade, produtos.id_produto
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
                    if ($row["quantidade"] === '0') {
                        echo "<tr>".
                              '<td style="text-align: center; text-decoration: line-through;"><h2>'.$row["id_produto"]."</h2></td>".
                              '<td style="text-align: center; text-decoration: line-through;"><h2>'.$row["nome"]."</h2></td>".
                              '<td style="text-align: center; text-decoration: line-through;"><h2>'.$row["quantidade"]."</h2></td>".
                              '<td style="text-align: center; text-decoration: line-through;"><h2>R$'.$row["valor"]."</h2></td>".
                              "<tr>";
                    }
                    else {
                        echo "<tr>".
                              '<td style="text-align: center;"><h2>'.$row["id_produto"]."</h2></td>".
                              '<td style="text-align: center;"><h2>'.$row["nome"]."</h2></td>".
                              '<td style="text-align: center;"><h2>'.$row["quantidade"]."</h2></td>".
                              '<td style="text-align: center;"><h2>R$'.$row["valor"]."</h2></td>".
                              "<tr>";
                    }
                }
            }
            else {
                echo "<tr>".
                      "<td> <h2>Não foi encontrada a venda procurada!</h2> </td>".
                      "<td> - </td>".
                      "<tr>";
            }

            $sql = "SELECT id_venda, nome, valor, quantidade, id_produto
                 FROM (
                     SELECT devolucoes.id_venda, produtos.nome, produtos.valor, devolucoes.quantidade, produtos.id_produto
                     FROM devolucoes
                     INNER JOIN produtos
                     ON devolucoes.id_produto = produtos.id_produto
                 ) AS t
                 where id_venda = $id_venda";
            $result = $conn->query($sql);
            if ($result and $result->num_rows > 0) {
                echo "<tr>".
                      '<td style="text-align: center;"><h2>CODIGO</h2></td>'.
                      '<td style="text-align: center;"><h2>DEVOLUÇÕES</h2> </td>'.
                      '<td style="text-align: center;"><h2>QUANTIDADE </h2></td>'.
                      '<td style="text-align: center;"><h2>VALOR</h2> </td>'.
                      "<tr>";
                while($row = $result->fetch_assoc()) {
                    // $valor = $valor - ($row["valor"]*$row["quantidade"]);
                    echo "<tr>".
                          '<td style="text-align: center;"><h2>'.$row["id_produto"]."</h2></td>".
                          '<td style="text-align: center;style="text-decoration: line-through;"><h2>'.$row["nome"]."</h2></td>".
                          '<td style="text-align: center;"><h2>'.$row["quantidade"]."</h2></td>".
                          '<td style="text-align: center;"><h2>R$'.$row["valor"]."</h2></td>".
                          "<tr>";
                }
            }
            else {
                echo "<tr>".
                     '<td style="text-align: center;"><h1>CODIGO</h1></td>'.
                     '<td style="text-align: center;"><h1>DEVOLUÇÕES</h1> </td>'.
                     '<td style="text-align: center;"><h1>QUANTIDADE </h1></td>'.
                     '<td style="text-align: center;"><h1>VALOR</h1> </td>'.
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

                $sql = "DELETE FROM devolucoes
                        WHERE id_venda = '$id_venda'";
                $result4 = $conn->query($sql);
                if (!$result4) {die ("Não foi possível remover as devoluções!");}

                $sql = "DELETE FROM vendas
                        WHERE id_venda = '$id_venda'";
                $result5 = $conn->query($sql);
                if (!$result5) {echo ("Não foi possível remover a venda!");}
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
