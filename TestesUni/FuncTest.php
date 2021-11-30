<?php
require_once './src/mercadinho/Classes/Func.php';

class FuncTest extends  \PHPUnit\Framework\TestCase
{
    public function testRemoverFuncionario(){
        $obj = new Func();
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "mercadinho";
        $con=mysqli_connect($servername, $username, $password, $dbname);
        $this->assertEquals(true, $obj->removerFuncionario(2, $con));
    }

    public function testCadastrarFuncionario(){
        $obj = new Func();
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "mercadinho";
        $con=mysqli_connect($servername, $username, $password, $dbname);
        $nome = "Maria";
        $telefone = "34991224965";
        $email = "maria@gmail.com";
        $endereco = "Rua 7 de Setembro";
        $usuario = "maria";
        $senha = "maria";
        $admin = 0;
        $this->assertEquals(true, $obj->cadastrarFuncionario($nome, $endereco, $telefone, $email, $usuario, $senha, $admin, $con));
    }

    public function testEditarFuncionario(){
        $obj = new Func();
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "mercadinho";
        $con=mysqli_connect($servername, $username, $password, $dbname);
        $id_funcionario = 2;
        $nome = "Maria";
        $endereco = "Rua São Paulo";
        $telefone = "12999108412";
        $email = "maria@gmail.com";
        $usuario = "user";
        $senha = "user";
        $admin = 0;
        $this->assertEquals(true, $obj->editarFuncionario($id_funcionario, $nome, $endereco, $telefone, $email, $usuario, $senha, $admin, $con));
    }

}