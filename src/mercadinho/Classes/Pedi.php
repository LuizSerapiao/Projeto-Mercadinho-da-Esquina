<?php

class Pedi
{
    function __constructor(){
    }

    function listar_pedidos($conn){
        $sql = "SELECT produtos.nome, pedidos.id_pedido, produtos.id_produto, pedidos.quantidade, pedidos.valor_total, pedidos.recebido
                FROM pedidos
                JOIN produtos
                ON pedidos.id_produto = produtos.id_produto";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if ($row["recebido"] === '1') { $text = "<b>Recebido!</b>"; }
                else { $text = "<b>Feito!</b>"; }
                $id_pedido = $row["id_pedido"];
                echo "<tr>".
                     '<td style="text-align: center;"><h2>'.$id_pedido."</h2></td>".
                     '<td style="text-align: center;"><h2>'.$row["nome"]."</h2></td>".
                     '<td style="text-align: center;"><h2>'.$row["quantidade"]."</h2></td>".
                     '<td style="text-align: center;"><h2>R$'.$row["valor_total"]."</h2></td>".
                     '<td style="text-align: center;"><h2>'.$text."</h2></td>".
                     '<td style="text-align: center;"><a href="pedidos.php?id='.$id_pedido.'&completar=Marcar+como+recebido%21"/>'.
                        '<img src="assets/confirm.png" style="height: 43px;">'.
                     "</a>".
                     '<a href="pedidos.php?id='.$id_pedido.'&cancelar=Cancelar+pedido%21"/>'.
                        '<img src="assets/delete.png" style="height: 43px;">'.
                     "</a></td>".
                     "</tr>" //teste.php?id=1&completar=Marcar+como+recebido%21
                     ;
            }
        }
        else {
            echo "<tr>".
                 '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                 '<td style="text-align: center;"> <h1>Ainda não  </h1></td>'.
                 '<td style="text-align: center;">  <h1>foram </h1></td>'.
                 '<td style="text-align: center;"> <h1>realizados</h1> </td>'.
                 '<td style="text-align: center;"> <h1>pedidos!</h1>  </td>'.
                 '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                 "<td>";
        }
    }

    function adicionarProduto($fornecedor, $produto, $quantidade, $conn) {
        $sql = "SELECT nome
                FROM fornecedores
                WHERE id_fornecedor = '$fornecedor'";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) { // Fornecedor existe
            $row = $result->fetch_assoc();
            $nome_fornecedor = $row["nome"];
            $sql = "SELECT valor
                    FROM produtos_fornecidos
                    WHERE id_produto = '$produto'";
            $result = $conn->query($sql);
            if ($result and $result->num_rows > 0) { // Produto existe
                $row = $result->fetch_assoc();
                $total = $row["valor"] * $quantidade;
                $sql = "INSERT INTO pedidos (id_produto, quantidade, valor_total)
                        VALUES ('$produto', '$quantidade', '$total')";

                if ($conn->query($sql) === TRUE) {
                    echo "<h2>Pedido feito com sucesso!<br>
                          Valor a ser pago: R$$total</h2>";
                      $sql = "SELECT quantidade_pedida
                              FROM produtos
                              WHERE id_produto = '$produto'"; // Atualizando o protudo
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      $quantidade_pedida = $row["quantidade_pedida"] + $quantidade;
                      $sql = "UPDATE produtos
                              SET quantidade_pedida = '$quantidade_pedida'
                              WHERE id_produto = '$produto'";
                      $result = $conn->query($sql);
                }
                else {
                    echo "Erro ao fazer pedido: " . $conn->error;
                }
            }
            else {
                echo "<br>ERRO: Fornecedor não oferece esse produto, ou o produto não está cadastrado no sistema!<br>";
            }
        }
        else {
            echo "<br>ERRO: Fornecedor não encontrado!<br>";
        }
    }
    function recebido($id, $conn) {
        $sql = "SELECT id_produto, recebido, quantidade
                FROM pedidos
                WHERE id_pedido = '$id'";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) { // Pedido existe
            $row = $result->fetch_assoc();
            if ($row["recebido"] === '1') { echo "ERRO: Esse pedido já foi marcado como recebido!"; }
            else {
                $produto = $row["id_produto"];
                $quantidade_pedida = $row["quantidade"];
                $sql = "UPDATE pedidos
                        SET recebido = '1'
                        WHERE id_pedido = '$id'";
                $result = $conn->query($sql);
                $sql = "SELECT quantidade, quantidade_pedida
                        FROM produtos
                        WHERE id_produto = '$produto'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $nova_quantidade_pedida = $row["quantidade_pedida"] - $quantidade_pedida;
                $nova_quantidade = $row["quantidade"] + $quantidade_pedida;
                $sql = "UPDATE produtos
                        SET quantidade = '$nova_quantidade',
                            quantidade_pedida = '$nova_quantidade_pedida'
                        WHERE id_produto = '$produto'";
                $result = $conn->query($sql);
                header("Location:pedidos.php");
            }
        }
        else {
            echo "ERRO: pedido não encontrado!";
        }
    }

    function listar_produtos_fornecedores($conn) {
        $sql = "SELECT id_fornecedor, nome
                FROM fornecedores";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id_fornecedor = $row["id_fornecedor"];
                echo "<h2>Fornecedor -> ID " . $id_fornecedor . " -> Nome: " . $row["nome"]."</h2>";
                $sql = "SELECT produtos.id_produto, produtos_fornecidos.valor, produtos.nome
                        FROM produtos
                        JOIN produtos_fornecidos
                        ON produtos.id_produto = produtos_fornecidos.id_produto
                        WHERE produtos_fornecidos.id_fornecedor = $id_fornecedor";
                $result1 = $conn->query($sql);
                if ($result1 and $result1->num_rows > 0) {
                    echo "<ol>";
                    while ($row1 = $result1->fetch_assoc()) {
                        echo "<h3><dt><b>-> Produto -> </b>Id: " . $row1["id_produto"] . " Nome: " . $row1["nome"] . " Valor de compra: R$" . $row1["valor"] . "</dt></h3>";
                    }
                    echo "</ol>";
                }
            }
        }
        echo "<br>";
    }

    function cancelar($id, $conn) {
        $sql = "SELECT id_produto, recebido, quantidade
                FROM pedidos
                WHERE id_pedido = '$id'";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) { // Pedido existe
            $row = $result->fetch_assoc();
            $sql = "DELETE FROM pedidos
                    WHERE id_pedido = '$id'";
            $result = $conn->query($sql);
            if ($result) {header("Location: pedidos.php");}
            else {echo "Erro ao deletar no banco de dados.<br>";}
        }
        else {
            echo "ERRO: pedido não encontrado!";
        }
    }
}
