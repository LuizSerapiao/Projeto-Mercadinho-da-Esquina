<?php
class Func
{
    function __construct(){
    }

    function cadastrarFuncionario($nome, $endereco, $telefone, $email, $usuario,$senha, $admin, $conn){
        $sql = "INSERT INTO funcionarios (nome, endereco, telefone, email, usuario, senha, admin)
        VALUES ('$nome', '$endereco', '$telefone', '$email', '$usuario','$senha', '$admin')";

        if ($conn->query($sql) === TRUE) {
            //header("Location:funcionarios.php");
            return true;
        }
        else {
            echo "Erro ao adicionar caixa: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }

    function removerFuncionario($id, $conn) {
        $sql = "DELETE FROM funcionarios
                WHERE id_funcionario = '$id'";

        if ($conn->query($sql) === TRUE) {
            //header("Location:funcionarios.php");
            return true;

        } else {
            echo "Erro ao deletar funcionario: " . $conn->error;
            return false;
        }
    }

    function editarFuncionario($id, $nome, $endereco, $telefone, $email, $usuario,$senha, $admin, $conn){

        $sql = "UPDATE funcionarios
        SET nome='$nome', endereco='$endereco', telefone='$telefone', email='$email', usuario='$usuario', senha='$senha', admin='$admin'
        WHERE id_funcionario = '$id'";

        if ($conn->query($sql) === TRUE) {
            //header("Location:funcionarios.php");
            return true;
        }
        else {
            echo "Erro ao editar funcionario: " . $conn->error;
            return false;
        }
    }

    function listarUsuario($conn){
        $sql = "SELECT *
        FROM funcionarios";
        $result = $conn->query($sql);

        if ($result and $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["id_funcionario"];
                if ($row['admin'] === '1') {
                    $text = "Gerente";
                }
                else {
                    $text = "Atendente";
                }
                if ($id === '1') {
                    echo "<tr>".
                         '<td style="text-align: center;"><h2>'.$row["nome"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["email"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["usuario"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$text.'</h2></td>'.
                         '<td style="text-align: center;">'.
                            '<img src="assets/info.png" style="height: 38px; cursor: help;"'.
                            'title="O usuário padrão foi configurado na instalação do sistema, para solicitar&#013;'.
                            'qualquer mudança, entre em contato através do telefone (35) 98800-0085">'.
                         "</tr>";
                }
                else {
                    echo "<tr>".
                         '<td style="text-align: center;"><h2>'.$row["nome"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["email"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$row["usuario"].'</h2></td>'.
                         '<td style="text-align: center;"><h2>'.$text.'</h2></td>'.
                         '<td style="text-align: center;"><a href="./editar-funcionario.php?id='.$id.'&edt=editar%21"/>'.
                            '<img src="assets/Edit.png" style="height: 38px;">'.
                         "</a>".
                         '<a href="funcionarios.php?id='.$id.'&rmv=Remover%21"/>'.
                            '<img src="assets/delete.png" style="height: 43px;">'.
                         "</a></td>".
                         "</tr>";
                }
            }

        }
        else {
            echo "<tr>".
                 '<td style="text-align: center;"> <h1>-----</h1> </td>'.
                 '<td style="text-align: center;"> <h1>Nenhum</h1> </td>'.
                 '<td style="text-align: center;"> <h1>funcionario</h1> </td>'.
                 '<td style="text-align: center;"> <h1>cadastrado</h1> </td>'.
                 '<td style="text-align: center;"> <h1>-----</h1> </td>'.
                 "<td>";

        }
    }
}
?>
