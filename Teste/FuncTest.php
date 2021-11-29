<?php
require_once './src/mercadinho/funcionarios.php';
require_once './src/mercadinho/Classes/Func.php';

class FuncTest extends  \PHPUnit\Framework\TestCase
{
    public function testRemoverFuncionario(){
        $obj = new Func();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mercadinho";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $this->assertEquals(false, $obj->removerFuncionario(32, $conn));
    }
}