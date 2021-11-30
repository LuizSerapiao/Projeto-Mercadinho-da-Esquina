<?php

class Forn
{
    function __construct(){
    }

    function insereFornecedor($nome, $telefone, $email, $estado, $cidade, $endereco, $conn){
        $sql = "INSERT INTO fornecedores (nome, telefone, email, estado, cidade, endereço)
        VALUES ('$nome','$telefone', '$email', '$estado', '$cidade', '$endereco')";

        if ($conn->query($sql) === TRUE) {
            //header("Location:fornecedores.php");
            return true;
        }
        else {
            echo "Erro ao adicionar caixa: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }

    function removeFornecedor($id, $conn){
        $sql = "DELETE FROM fornecedores
                WHERE id_fornecedor = '$id'";
        if ($conn->query($sql) === TRUE) {
            $sql = "DELETE FROM produtos_fornecidos
                    WHERE id_fornecedor = '$id'";
            if ($conn->query($sql) === TRUE) {
                header("Location:fornecedores.php");
            }
            else{
                echo "Erro ao deletar fornecedor: " . $conn->error;
            }
        } else {
            echo "Erro ao deletar fornecedor: " . $conn->error;
        }
    }

    function editarFornecedor($id, $novo_nome, $novo_telefone, $novo_email, $novo_estado, $nova_cidade, $novo_endereco, $conn){
        $sql = "UPDATE fornecedores
        SET nome='$novo_nome', telefone='$novo_telefone', email='$novo_email', estado='$novo_estado', cidade='$nova_cidade', endereço='$novo_endereco'
        WHERE id_fornecedor='$id'";

        if ($conn->query($sql) === TRUE) {
            header("Location:fornecedores.php");
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

            if ($result and $result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $id_fornecedor = $row['id_fornecedor'];
                    echo "<tr>".
                    '<td style="text-align: center;"><a title="Adicionar relação entre um produto e esse fornecedor" href="produtos.php?id='.
                    $id_fornecedor.'&relacionar=relacionar%21"/>' . '<img src="assets/fornece.png" style="height: 43px;">'.
                    "</a></td>".
                    '<td style="text-align: center;"><h2>'.$row['nome']."</h2></td>".
                    '<td style="text-align: center;"><h2>'.$id_fornecedor."</h2></td>".
                    '<td style="text-align: center;"><h2>'.$row['telefone']."</h2></td>".
                    '<td style="text-align: center;"><h2>'.$row['email']."</h2></td>".
                    '<td style="text-align: center;"><a href="./editar-fornecedor.php?id='.$id_fornecedor.'&edt=editar%21"/>'.
                       '<img src="assets/Edit.png" style="height: 40px;">'.
                    "</a>".
                    '<a href="fornecedores.php?id='.$id_fornecedor.'&rmv=remover%21"/>'.
                       '<img src="assets/delete.png" style="height: 43px;">'.
                    "</a>".
                    "<tr>";
                }


            }
            else {
                echo "<tr>".
                     '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                     '<td style="text-align: center;"> <h1>Nenhum  </h1></td>'.
                     '<td style="text-align: center;">  <h1>fornecedor </h1></td>'.
                     '<td style="text-align: center;"> <h1>cadastrado</h1> </td>'.
                     '<td style="text-align: center;"> <h1>no sistema</h1>  </td>'.
                     '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                     "<td>";

            }
        }

        else{
            $sql = "SELECT id_fornecedor, nome, telefone, email, estado, cidade, endereço
            FROM fornecedores
            WHERE nome LIKE '%{$nome}%'";
            $result = $conn->query($sql);

            if ($result and $result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $id_fornecedor = $row['id_fornecedor'];
                    echo "<tr>".
                    '<td style="text-align: center;"><a title="Adicionar relação entre um produto e esse fornecedor" href="produtos.php?id='.
                    $id_fornecedor.'&relacionar=relacionar%21"/>' . '<img src="assets/fornece.png" style="height: 43px;">'.
                    "</a></td>".
                    '<td style="text-align: center;"><h2>'.$row['nome']."</h2></td>".
                    '<td style="text-align: center;"><h2>'.$id_fornecedor."</h2></td>".
                    '<td style="text-align: center;"><h2>'.$row['telefone']."</h2></td>".
                    '<td style="text-align: center;"><h2>'.$row['email']."</h2></td>".
                    '<td style="text-align: center;"><a href="./editar-fornecedor.php?id='.$id_fornecedor.'&edt=editar%21"/>'.
                       '<img src="assets/Edit.png" style="height: 40px;">'.
                    "</a>".
                    '<a href="fornecedores.php?id='.$id_fornecedor.'&rmv=remover%21"/>'.
                       '<img src="assets/delete.png" style="height: 43px;">'.
                    "</a>".
                    "<tr>";
                }

                return "Encontrado!";
            }
            else {
                echo "<tr>".
                     '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                     '<td style="text-align: center;"> <h1>Nenhum  </h1></td>'.
                     '<td style="text-align: center;"> <h1>fornecedor </h1></td>'.
                     '<td style="text-align: center;"> <h1>encontrado</h1> </td>'.
                     '<td style="text-align: center;"> <h1>no sistema</h1>  </td>'.
                     '<td style="text-align: center;"> <h1>-----</h1>  </td>'.
                     "<td>";

                      return "Não encontrado!";
            }
        }
    }

    function relacionar($id_produto, $id_fornecedor, $valor, $conn){
        $sql = "SELECT id_fornecedor
                FROM fornecedores
                WHERE id_fornecedor = $id_fornecedor";
        $result = $conn->query($sql);

        if ($result and $result->num_rows > 0) {
            $sql = "SELECT id_produto
                    FROM produtos
                    WHERE id_produto = $id_produto";
            $result = $conn->query($sql);

            if ($result and $result->num_rows > 0) {
                $sql = "INSERT INTO produtos_fornecidos (id_fornecedor, id_produto, valor)
                        VALUES ('$id_fornecedor','$id_produto', '$valor')";

                if ($conn->query($sql) === TRUE) {
                    header("Location:fornecedores.php");
                }
                else {
                    echo "Erro ao criar ligação: " . $conn->error;
                }
            }
        }
        else {
            echo "Fornecedor não encontrado!";
        }
    }
}
