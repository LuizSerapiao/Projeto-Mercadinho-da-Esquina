<?php

class Prod
{
    function __constructor(){
    }

    function adicionarProduto($nome, $valor, $quantidade, $conn){
        if ($valor >= 0) {
            if ($quantidade >= 0) {
                $sql = "INSERT INTO produtos (nome, valor, quantidade)
                VALUES ('$nome','$valor', '$quantidade')";

                if ($conn->query($sql) === TRUE) {
                    // echo "Produto $nome adicionado com sucesso!";
                    header("Location:produtos.php");
                }
                else {
                    echo "Erro ao adicionar produto: " . $sql . "<br>" . $conn->error;
                }
            }
            else {
                echo '<h2>A quantidade '.$quantidade.' é inválida!</h2>';
            }
        }
        else {
            echo '<h2>O valor '.$valor.' é inválido!</h2>';
        }
    }

    function removeProduto($id, $conn)
    {
        $sql = "SELECT *
                FROM produtos
                WHERE id_produto = '$id'";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            $sql = "DELETE FROM produtos
                    WHERE id_produto = '$id'";

            if ($conn->query($sql) === TRUE) { // produto deletado com sucesso
                $sql = "DELETE FROM produtos_fornecidos
                        WHERE id_produto = '$id'";
                    if ($conn->query($sql) === TRUE) {
                        header("Location:produtos.php");
                    }
                    else {
                        echo "Erro ao deletar produto: " . $conn->error;
                    }
            } else {
                echo "Erro ao deletar produto: " . $conn->error;
            }
        }
    }

    function editarProduto($id, $novo_nome, $novo_valor, $nova_quantidade, $conn){
        if ($novo_valor >= 0) {
            if ($nova_quantidade >= 0) {
                $sql = "UPDATE produtos
                SET nome = '$novo_nome', valor = '$novo_valor', quantidade = $nova_quantidade
                WHERE id_produto = '$id'";

                if ($conn->query($sql) === TRUE) {
                     // echo "produto editado com sucesso!";
                    header("Location:produtos.php");
                }
                else {
                    echo "Erro ao editar produto: " . $conn->error;
                }
            }
            else {
                echo '<h2>A quantidade '.$nova_quantidade.' é inválida!</h2>';
            }
        }
        else {
            echo '<h2>O valor '.$novo_valor.' é inválido!</h2>';
        }
    }

    function listarProduto($nome, $conn){
        if($nome == null){
            $sql = "SELECT *
            FROM produtos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //echo "<b>id:</b> " . $row["id_produto"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. " - <b>Quantidade:</b> " . $row["quantidade"]. "<br>";
                    $id = $row["id_produto"];
                    echo "<tr>".
                         '<td style="text-align: center;"><h2>'.$id.'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["nome"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>R$'.$row["valor"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["quantidade"].' Unidades</h2></td>'.
                         '<td style="text-align: center;"><a href="produtos_editar.php?id='.$id.'&edt=editar%21"/>'.
                            '<img src="assets/Edit.png" style="height: 38px;">'.
                         "</a>".
                         '<a href="produtos.php?id='.$id.'&rmv=Remover%21"/>'.
                            '<img src="assets/delete.png" style="height: 43px;">'.
                         "</a></td>".
                         "</tr>";
                }
            }
            else {
                echo "<tr>".
                     '<td style="text-align: center;"> <h1>-----</h1> </td>'.
                     '<td style="text-align: center;"> <h1>Nenhum</h1> </td>'.
                     '<td style="text-align: center;"> <h1>produto</h1> </td>'.
                     '<td style="text-align: center;"> <h1>registrado</h1> </td>'.
                     '<td style="text-align: center;"> <h1>-----</h1> </td>'.
                     "<td>";
            }
        }

        else{
            $sql = "SELECT *
                    FROM produtos
                    WHERE nome LIKE '%{$nome}%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $id = $row["id_produto"];
                    echo "<tr>".
                         '<td style="text-align: center;"><h2>'.$id.'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["nome"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>R$'.$row["valor"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["quantidade"].' Unidades</h2></td>'.
                         '<td style="text-align: center;"><a href="produtos_editar.php?id='.$id.'&edt=editar%21"/>'.
                            '<img src="assets/Edit.png" style="height: 38px;">'.
                         "</a>".
                         '<a href="produtos.php?id='.$id.'&rmv=Remover%21"/>'.
                            '<img src="assets/delete.png" style="height: 43px;">'.
                         "</a></td>".
                         "</tr>";
                }
            }
            else {
                echo "<tr>".
                     '<td style="text-align: center;"> <h1>-----</h1> </td>'.
                     '<td style="text-align: center;"> <h1>Nenhum<h1> </td>'.
                     '<td style="text-align: center;"> <h1>produto</h1> </td>'.
                     '<td style="text-align: center;"> <h1>encontrado!</h1> </td>'.
                     '<td style="text-align: center;"> <h1>-----</h1> </td>'.
                     "<td>";
            }
        }
    }
    function relacionar_produto($id_fornecedor, $nome, $conn) {
        if ($nome === NULL) {
            $sql = "SELECT *
            FROM produtos";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //echo "<b>id:</b> " . $row["id_produto"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. " - <b>Quantidade:</b> " . $row["quantidade"]. "<br>";
                    $id_produto = $row["id_produto"];
                    echo "<tr>".
                         '<td style="text-align: center;"><h2>'.$id_produto.'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["nome"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>R$'.$row["valor"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["quantidade"].' Unidades</h2></td>'.
                         '<td style="text-align: center;"><a href="fornecedores.php?id_produto='.$id_produto.'&id_fornecedor='.$id_fornecedor.'&relacionar=relacionar%21"/>'.
                            '<img src="assets/fornece.png" style="height: 38px;">'.
                         "</a></td>".
                         "</tr>";
                }
            }
        }
        else {
            $sql = "SELECT *
                    FROM produtos
                    WHERE nome LIKE '%{$nome}%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //echo "<b>id:</b> " . $row["id_produto"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. " - <b>Quantidade:</b> " . $row["quantidade"]. "<br>";
                    $id_produto = $row["id_produto"];
                    echo "<tr>".
                         '<td style="text-align: center;"><h2>'.$id_produto.'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["nome"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>R$'.$row["valor"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["quantidade"].' Unidades</h2></td>'.
                         '<td style="text-align: center;"><a href="fornecedores.php?id_produto='.$id_produto.'&id_fornecedor='.$id_fornecedor.'&relacionar=relacionar%21"/>'.
                            '<img src="assets/fornece.png" style="height: 38px;">'.
                         "</a></td>".
                         "</tr>";
                }
            }
        }
    }
}
