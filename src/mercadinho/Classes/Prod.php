<?php

class Prod
{
    function __constructor(){
    }

    function adicionarProduto($nome, $valor, $conn){
        $sql = "INSERT INTO produtos (nome, valor) 
        VALUES ('$nome','$valor')";

        if ($conn->query($sql) === TRUE) {
            echo "Produto $nome adicionado com sucesso!";
        }
        else {
            echo "Erro ao adicionar produto: " . $sql . "<br>" . $conn->error;
        }
    }

    function removeProduto($nome, $conn)
    {
        $sql = "SELECT id, nome, valor 
            FROM produtos
            WHERE nome = '$nome'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql = "DELETE FROM produtos 
        WHERE nome = '$nome'";

            if ($conn->query($sql) === TRUE) {
                echo "Produto $nome deletado com sucesso!";
            } else {
                echo "Erro ao deletar produto: " . $conn->error;
            }
        }
    }

    function editarProduto($nome, $novo_nome, $novo_valor, $conn){

        $sql = "UPDATE produtos
        SET nome = '$novo_nome', valor = '$novo_valor' 
        WHERE nome = '$nome'";

        if ($conn->query($sql) === TRUE) {
            echo "produto $nome editado com sucesso!";
        }
        else {
            echo "Erro ao editar produto: " . $conn->error;
        }
    }

    function listarProduto($nome, $conn){
        if($nome == null){
            $sql = "SELECT id, nome, valor 
            FROM produtos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo "<B>Lista de produtos</B> <br>";
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. "<br>";
                }
            }
            else {
                echo "Nenhum produto cadastrado!";
            }
        }

        else{
            echo "<b>Resultado da busca:</b> <br>";
            $sql = "SELECT id, nome, valor 
            FROM produtos
            WHERE nome = '$nome'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Valor:</b> R$ " . $row["valor"]. "<br>";
                }
            }
            else {
                echo "Nenhum produto encontrado";
            }
        }
    }
}