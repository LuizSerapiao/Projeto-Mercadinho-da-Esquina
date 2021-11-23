<?php

class ListaCompra
{
    function __construct(){
    }

    function adicionarNaLista($codigo, $quantidade, $conn){
        if ($quantidade > 0){
            $sql = "SELECT id_produto
                    FROM produtos
                    WHERE id_produto = $codigo";
            $result = $conn->query($sql);
            if ($result and $result->num_rows > 0) { // produto válido
                $sql = "INSERT INTO lista_compras (id_produto, quantidade)
                        VALUES ('$codigo','$quantidade')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: caixa.php");
                }
                else {
                    echo "Erro" . $sql . "<br>" . $conn->error;
                }
            }
            else {
                echo "Código de produto inválido!";
            }
        }
        else {
            echo "Quantidade inválida!";
        }
    }

    function remover_da_lista($codigo, $conn){
        $sql = "DELETE FROM lista_compras
                WHERE id_lista_compras = $codigo";

        if ($conn->query($sql) === TRUE) {
            header("Location: caixa.php");
        }
        else {
            echo "Erro" . $sql . "<br>" . $conn->error;
        }
    }

 //-------------------------------------------------------------------------------------------------------------
    function devolverProduto($id_produto, $id_venda, $quantidade_trocar, $conn){
        $sql = "SELECT id_venda, valor
                 FROM vendas
                 WHERE id_venda = $id_venda";
        $result = $conn->query($sql);
        if ($result and $result->num_rows <= 0) { echo "<br> <h2>Erro: Venda não existe! </h2><br>"; }
        else if (!$result){ echo "<br> <h2>Erro procurando venda </<h2>h2><br>"; }
        else {
            $row = $result->fetch_assoc();
            $valor_total_venda = $row["valor"];
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
                    if ($quantidade_update < 0) {
                        $quantidade_update = 0;
                    }
                    $sql = "UPDATE produtos_vendidos
                             SET quantidade = '$quantidade_update'
                             WHERE id_produto = '$id_produto'";

                    $result = $conn->query($sql);
                    if ($result) {
                        // Pega a quantidade de produtos que tem no estoque e atualiza, adicionando aqueles
                        // que foram devolvidos.
                        $sql = "SELECT quantidade
                                 FROM produtos
                                 WHERE id_produto = $id_produto";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $quantidade_update = $row["quantidade"] + $quantidade_trocar;
                        if ($quantidade_update < 0) {
                            $quantidade_update = 0;
                        }
                        $sql = "UPDATE produtos
                                 SET quantidade = '$quantidade_update'
                                 WHERE id_produto = '$id_produto'";

                        $result = $conn->query($sql);
                        if ($result) {

                            // Adiciona o produto e a quantidade devolvidos na tabela devoluçõe
                            // Essa tabela é usada para mostrar o valor real da venda apos uma devolução.
                            $sql = "INSERT INTO devolucoes (id_produto, quantidade, id_venda)
                                     VALUES ('$id_produto','$quantidade_trocar', '$id_venda')";

                            $result = $conn->query($sql);
                            if ($result) {
                                // Pega o valor do produto devolvido para calcular o quanto deve ser
                                // devolvido ao cliente.
                                $sql = "SELECT valor
                                         FROM produtos
                                         WHERE id_produto = $id_produto";
                                $result = $conn->query($sql);
                                if ($result) {
                                    $row = $result->fetch_assoc();
                                    $valor_devolvido = $row["valor"] * $quantidade_trocar;
                                    echo ("<br><h2>O valor a ser devolvido é R$".$valor_devolvido."</h2>");
                                    $update_valor = $valor_total_venda - $valor_devolvido;
                                    // Update do valor final da venda.
                                    $sql = "UPDATE vendas
                                            SET valor = '$update_valor'
                                            WHERE id_venda = '$id_venda'";
                                    $result = $conn->query($sql);
                                    if (!$result) {echo "<br><h2>Erro atualizando o valor total da compra</h2><br>";}
                                }
                                else { echo "<br><h2>Erro recuperando valor da venda</h2><br>"; }
                            }
                            else { echo "<br><h2>Erro inserindo produto na tabela devolucoes</h2><br>"; }
                        }
                        else { echo "<br><h2>Erro atualizando produtos devolucao </h2><br>"; }
                    }
                    else { echo"<br><h2>Erro atualizando produtos devolucao </h2><br>"; }
                }
            }
            else {
                echo ("<br><h2>Erro - Produto não consta na venda!</h2><br>");
            }
        }
    }
//--------------------------------------------------------------------------------------------------------------

    function trocarProduto($id_produto_recebido, $quantidade_recebida, $id_produto_trocado, $quantidade_trocada, $id_venda, $conn){
        // Procura pelo ID da venda no banco de dados
        $sql = "SELECT id_venda, valor
                 FROM vendas
                 WHERE id_venda = $id_venda";
        $result = $conn->query($sql);
        if ($result and $result->num_rows <= 0) { die ("<br> Erro: Venda não existe! <br>"); }
        else if (!$result){ die("<br> Erro procurando venda <br>"); }
        $row = $result->fetch_assoc();
        $valor_total_venda = $row["valor"];
        // Seleciona o valor e a quantidade do produto que o cliente vai levar
        // Esses valores são escolhidos aqui para certificar no começo da operação que o
        // produto realmente existe, e, caso ele exista, já temos o a quantidade dele
        // no estoque, o que vai permitir a atualização do valor sem fazer outro select
        $sql = "SELECT valor, quantidade
                 FROM produtos
                 WHERE id_produto = $id_produto_trocado";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $estoque_produto_trocado = $row['quantidade'];
            $valor_produto_trocado = $row['valor'];
        }
        // Procura se o produto que deseja ser devolvido foi vendido.
        // Se for adicionado ao carrinho 2 produtos iguais, com 2 quantidades diferentes,
        // o que vai valer é o primeiro que o sistema encontrar. Da pra fazer todos contarem,
        // mas não no tempo que temos.
        $sql = "SELECT id_produto, quantidade
                 FROM produtos_vendidos
                 WHERE id_venda = $id_venda AND id_produto = $id_produto_recebido";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $quantidade_vendida = $row["quantidade"];
            if ($quantidade_vendida < $quantidade_recebida) {
                echo ("<br> <h2>Quantidade insuficiente para devolver! A quantidade vendida foi " . $row["quantidade"] . " </h2><br>");
            }
            else { // Devoluçào foi aceita
                // Atualiza o produto vendido, para não permitir que seja devolvido
                // mais que a quantidade vendida caso sejam feitas múltiplas devoluções
                $quantidade_update = $quantidade_vendida - $quantidade_recebida;
                if ($quantidade_update < 0) {
                    $quantidade_update = 0;
                }
                $sql = "UPDATE produtos_vendidos
                         SET quantidade = '$quantidade_update'
                         WHERE id_produto = '$id_produto_recebido'";

                $result = $conn->query($sql);
                if (!$result) {die ("<br><h2>Erro atualizando produtos devolucao<h2><br>");}

                // Pega a quantidade de produtos que tem no estoque e atualiza, adicionando aqueles
                // que foram devolvidos.
                $sql = "SELECT quantidade
                         FROM produtos
                         WHERE id_produto = $id_produto_recebido";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $quantidade_update = $row["quantidade"] + $quantidade_recebida;
                if ($quantidade_update < 0) {
                    $quantidade_update = 0;
                }
                $sql = "UPDATE produtos
                         SET quantidade = '$quantidade_update'
                         WHERE id_produto = '$id_produto_recebido'";

                $result = $conn->query($sql);
                if (!$result) {die ("<br>Erro atualizando produtos devolucao <br>");}

                // Pega a quantidade de produtos que tem no estoque e atualiza, retirando aqueles
                // que foram entregues ao cliente.
                $quantidade_update = $estoque_produto_trocado - $quantidade_trocada;
                if ($quantidade_update < 0) {
                    $quantidade_update = 0;
                }
                $sql = "UPDATE produtos
                         SET quantidade = '$quantidade_update'
                         WHERE id_produto = '$id_produto_trocado'";

                $result = $conn->query($sql);
                if (!$result) {die ("<br>Erro atualizando produtos devolucao <br>");}

                // Adiciona o produto e a quantidade devolvidos na tabela devoluçõe
                // Essa tabela é usada para mostrar o valor real da venda apos uma devolução.
                $sql = "INSERT INTO devolucoes (id_produto, id_venda, quantidade)
                         VALUES ('$id_produto_recebido', '$id_venda','$quantidade_recebida')";

                $result = $conn->query($sql);
                if (!$result) {die ("<br>Erro inserindo produto na tabela devolucoes<br>");}

                // Adiciona o produto entregue ao cliente na tabela produtos_vendidos
                // Para calcular corretamente o valor total da compra caso seja realizada uma troca.
                $sql = "INSERT INTO produtos_vendidos (id_venda, id_produto, quantidade)
                         VALUES ('$id_venda', '$id_produto_trocado', '$quantidade_trocada')";
                $result = $conn->query($sql);
                if (!$result) {die ("<br>Erro inserindo produto trocado na tabela produtos_vendidos<br>");}

                // Pega o valor do produto devolvido para calcular o quanto deve ser
                // devolvido ao cliente.
                $sql = "SELECT valor
                         FROM produtos
                         WHERE id_produto = $id_produto_recebido";
                $result = $conn->query($sql);
                if (!$result) {die ("<br>Erro recuperando valor da venda<br>");}
                $row = $result->fetch_assoc();
                $devolver = $row["valor"] * $quantidade_recebida;
                $receber = $quantidade_trocada * $valor_produto_trocado;
                if ($devolver > $receber) {
                    echo ("<br><h2>O valor a ser devolvido é R$".$devolver-$receber."</h2>");
                }
                else if ($devolver < $receber) {
                    echo ("<br><h2>O valor a ser recebido é R$".$receber-$devolver."</h2>");
                }
                else {
                    echo ("<br><h2>Nenhum valor deve ser recebido ou devolvido!"."</h2>");
                }
            }
        }
        else {
            echo ("<br><h2>Erro - Produto não consta na venda!</h2><br>");
        }
    }

//-------------------------------------------------------------------------------------------

    function finalizarCompra($conn){
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
            echo "<h1> Valor a ser pago: R$" . $valor_total . " <br> Código da compra: ".$id_venda."</h1>";
        }
        else {
            echo "Nenhum produto na lista de compras!";
        }
    }

    function listar_produtos_caixa($conn) {
        $sql = "SELECT lista_compras.id_lista_compras, lista_compras.id_produto, nome, valor, lista_compras.quantidade
                FROM lista_compras
                LEFT JOIN produtos
                ON lista_compras.id_produto = produtos.id_produto";

        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            // output data of each row
            $total = 0;
            while($row = $result->fetch_assoc()) {
                //echo "<b>id_produto:</b> " . $row["id_produto"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. " - <b>quantidade:</b> " . $row["quantidade"]."<br>";
                $valor = $row["valor"]*$row["quantidade"];
                $total = $total + $valor;
                echo '<tr><td><h1>'.$row["id_produto"].'</h1></td>
                <td><h1>'.$row["nome"].'</h1></td>
                <td><h1>'.$row["quantidade"].'</h1></td>
                <td><h1>R$'.$valor.'</h1></td>'.
                '<td><a href="caixa.php?id='.$row["id_lista_compras"].'&deletar=del%21"/>'.
                   '<img src="assets/delete.png" style="height: 43px;">'.
                "</a></td>";
                //'<td><button><img src="assets/delete.png" style="height: 30px"/></button></td></tr>';
            }
            echo '<tr><td><h1> - </h1></td>
            <td><h1> - </h1></td>
            <td><h1> Total </h1></td>
            <td><h1>R$'.$total.'</h1></td>';
        }
        else {
            echo '<tr><td><h1> - </h1></td>
            <td><h1> Lista Vazia! </h1></td>
            <td><h1> - </h1></td>
            <td><h1> - </h1></td>';
        }
    }

}
