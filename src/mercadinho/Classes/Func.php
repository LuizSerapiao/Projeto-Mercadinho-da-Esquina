<?php

class Func
{
    function __construct(){
    }

    function cadastrarFuncionario($usuario, $senha, $conn, $admin){
        if ($admin === 'sim') { $adm = 1; }
        else { $adm = 2; }
        $sql = "INSERT INTO funcionarios (usuario, senha, admin)
        VALUES ('$usuario','$senha', '$adm')";

        if ($conn->query($sql) === TRUE) {
            echo "Funcionário $usuario adicionado com sucesso!";
        }
        else {
            echo "Erro ao adicionar funcionário: " . $sql . "<br>" . $conn->error;
        }
    }

    function removerFuncionario($usuario, $conn)
    {
        $sql = "SELECT id_funcionario, usuario, senha
                FROM funcionarios
                WHERE usuario = '$usuario'";
        $result = $conn->query($sql);
        if ($result and $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["id_funcionario"] == 1) { echo "<b>Não é possível deletar o usuário padrão!</b>"; }
            else {
                $sql = "DELETE FROM funcionarios
                        WHERE usuario = '$usuario'";

                if ($conn->query($sql) === TRUE) {
                    echo "Caixa $usuario deletado com sucesso!";
                } else {
                    echo "Erro ao deletar funcionario: " . $conn->error;
                }
            }
        }
    }

    function editarFuncionario($usuario, $novoUsuario, $novaSenha, $conn){

        $sql = "UPDATE funcionarios
        SET usuario = '$novoUsuario', senha = '$novaSenha'
        WHERE usuario = '$usuario'";


        if ($conn->query($sql) === TRUE) {
            echo "Caixa $usuario editado com sucesso!";
        }
        else {
            echo "Erro ao editar funcionario: " . $conn->error;
        }
    }

    function listarUsuario($usuario, $conn){
        if($usuario == null){
            $sql = "SELECT id_funcionario, usuario, senha, admin
            FROM funcionarios";
            $result = $conn->query($sql);

            if ($result and $result->num_rows > 0) {
                // output data of each row
                echo "<B>Lista de funcionarios</B> <br>";
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id_funcionario"]. " - <b>Usuario:</b> " . $row["usuario"]. " - <b>Senha:</b> " . $row["senha"];
                    if ($row["admin"] === '1') { echo " - Admin!"; }
                    echo "<br>";
                }
            }
            else {
                echo "Nenhum funcionario cadastrado!";
            }
        }
        else{
            echo "<b>Resultado da busca:</b> <br>";
            $sql = "SELECT id_funcionario, usuario, senha
            FROM funcionarios
            WHERE usuario = '$usuario'";
            $result = $conn->query($sql);

            if ($result and $result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>id:</b> " . $row["id_funcionario"]. " - <b>Usuario:</b> " . $row["usuario"]. " - <b>Senha:</b> " . $row["senha"]. "<br>";
                }
            }
            else {
                echo "Nenhum funcionario encontrados!";
            }
        }

    }
}
