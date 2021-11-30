<?php
require_once './src/mercadinho/Classes/Forn.php';

class FornTeste extends \PHPUnit\Framework\TestCase {

    public function testcadastrarFornecedor(){
        $obj = new Forn();
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "mercadinho";
        $con=mysqli_connect($servername, $username, $password, $dbname);
        $nome = "Nestlé";
        $telefone = "telefone";
        $email = "nestle@contato.com";
        $estado = "SP";
        $cidade = "São José do Rio Pardo";
        $endereco = "R. Henry Nestlé";
        $this->assertEquals(false, $obj->insereFornecedor($nome, $telefone, $email, $estado, $cidade, $endereco, $con));
    }

    public function testListarFonecedor(){
        $obj = new Forn();
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "mercadinho";
        $con=mysqli_connect($servername, $username, $password, $dbname);
        $nome = "Kiwi";
        $res = "Não encontrado!";
        $this->assertEquals($res, $obj->listarFornecedor($nome, $con));

    }

}