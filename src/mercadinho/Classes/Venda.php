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
                echo "Código da compra: " . $row["id_venda"] . " <------> Valor da compra: R$" . $row["valor"] . "<br>";
            }
        } else {
            echo "Lista Vazia!";
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
                if (!$result3) {echo "Não foi possível remover os produtos vendidos!";}

                $sql = "DELETE FROM vendas
                        WHERE id_venda = '$id_venda'";
                $result4 = $conn->query($sql);
                if (!$result4) {echo "Não foi possível remover a venda!";}
                else{echo "Venda removida com sucesso!";}
            }

            else {
                echo "Não foi encontrada a venda procurada!<br>";
            }

        }

}