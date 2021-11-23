<?php

class Prod
{
    function __constructor(){
    }

    function adicionarProduto($nome, $valor, $quantidade, $conn){
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

    function removeProduto($id, $conn)
    {
        $sql = "SELECT *
            FROM produtos
            WHERE id_produto = '$id'";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            $sql = "DELETE FROM produtos
                    WHERE id_produto = '$id'";

            if ($conn->query($sql) === TRUE) {
                // echo "Produto deletado com sucesso!";
                header("Location:produtos.php");
            } else {
                echo "Erro ao deletar produto: " . $conn->error;
            }
        }
    }

    function editarProduto($id, $novo_nome, $novo_valor, $nova_quantidade, $conn){

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
                         "<td>".$id."</td>".
                         "<td>".$row["nome"]."</td>".
                         "<td>R$".$row["valor"]."</td>".
                         "<td>".$row["quantidade"]."</td>".
                         '<td><a href="produtos_editar.php?id='.$id.'&edt=editar%21"/>'.
                            '<img src="assets/Edit.png" style="height: 38px;">'.
                         "</a></td>".
                         '<td><a href="produtos.php?id='.$id.'&rmv=Remover%21"/>'.
                            '<img src="assets/delete.png" style="height: 43px;">'.
                         "</a></td>".
                         "</tr>";
                }
            }
            else {
                echo "Nenhum produto cadastrado!";
            }
        }

        else{
            echo "<b>Resultado da busca:</b> <br>";
            $sql = "SELECT *
            FROM produtos
            WHERE nome = '$nome'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id_produto"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. " - <b>Quantidade:</b> " . $row["quantidade"]. "<br>";
                }
            }
            else {
                echo "Nenhum produto encontrado";
            }
        }
    }
}
