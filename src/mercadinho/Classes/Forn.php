<?php

class Forn
{
    function __construct(){
    }

    function insereFornecedor($nome, $telefone, $email, $estado, $cidade, $endereco, $conn){
        $sql = "INSERT INTO fornecedores (nome, telefone, email, estado, cidade, endereço)
        VALUES ('$nome','$telefone', '$email', '$estado', '$cidade', '$endereco')";

        if ($conn->query($sql) === TRUE) {
            echo "Fornecedor $nome adicionado com sucesso!";
        }
        else {
            echo "Erro ao adicionar caixa: " . $sql . "<br>" . $conn->error;
        }
    }

    function removeFornecedor($nome, $conn){
        $sql = "SELECT id_fornecedor, nome, telefone, email, estado, cidade, endereço
            FROM fornecedores
            WHERE nome='$nome'";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            $sql = "DELETE FROM fornecedores
        WHERE nome = '$nome'";

            if ($conn->query($sql) === TRUE) {
                echo "Fornecedor $nome removido com sucesso!";
            } else {
                echo "Erro ao deletar caixa: " . $conn->error;
            }
        }

        else{
            echo "Não há fornecedores a serem removidos!";
        }
    }

    function editarFornecedor($nome, $novo_nome, $novo_telefone, $novo_email, $novo_estado, $nova_cidade, $novo_endereco, $conn){
        $sql = "UPDATE fornecedores
        SET nome='$novo_nome', telefone='$novo_telefone', email='$novo_email', estado='$novo_estado', cidade='$nova_cidade', endereço='$novo_endereco'
        WHERE nome='$nome'";

        if ($conn->query($sql) === TRUE) {
            echo "Fornecedor $nome alterado com sucesso!";
        }
        else {
            echo "Erro ao editar caixa: " . $conn->error;
        }
    }

    function listarFornecedor($nome, $conn){
        if($nome == null){
            $sql = "SELECT id_fornecedor, nome, telefone, email, estado, cidade, endereço
            FROM fornecedores";
            $result = $conn->query($sql);

            echo "<B>Lista de Fornecedores:</B> <br>";
            if ($result and $result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id_fornecedor"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Telefone:</b> " . $row["telefone"].
                        " -<b> Email:</b> " . $row["email"]. " -<b> Estado:</b> " . $row["estado"]. " - <b>Cidade:</b> " . $row["cidade"].
                        " - <b>endereço:</b> " . $row["endereço"]."<br>";
                }
                echo "<br>";
            }
            else {
                echo "Nenhum fornecedor cadastrado";
            }
        }

        else{
            echo "<b>Resultado da busca:</b> <br>";
            $sql = "SELECT id_fornecedor, nome, telefone, email, estado, cidade, endereço
            FROM fornecedores
            WHERE nome='$nome'";
            $result = $conn->query($sql);

            if ($result and $result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id_fornecedor"]. " - <b>Nome:</b> " . $row["nome"]. " - <b>Telefone:</b> " . $row["telefone"].
                        " -<b> Email:</b> " . $row["email"]. " -<b> Estado:</b> " . $row["estado"]. " - <b>Cidade:</b> " . $row["cidade"].
                        " - <b>endereço:</b> " . $row["endereço"]."<br>";
                }
            }
            else {
                echo "Nenhum fornecedor encontrado";
            }
        }

    }
}
