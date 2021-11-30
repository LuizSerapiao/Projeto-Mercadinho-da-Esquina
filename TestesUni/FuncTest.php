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
}