<html lang="pt-br">
<h1>Lista de pedidos</h1>
<!--- Caixas de entrada e botões --->
<form action="gerente.php">
    <input type="submit" value="Voltar" />
</form>

 <?php

     include_once ("Classes/Pedi.php");

     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "mercadinho";

     // Conexao com o servidor
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     $action = new Pedi();
     $action->listar_pedidos($conn);

     if ( isset( $_POST["completar"])) {
         $id = $_REQUEST['id'];
         $action->recebido($id, $conn);
     }

?>
<br>
<form action="pedidos.php" method="post">
    <input type="number" name="id" value="Código do pedido"/>
    <input type="submit" name="completar" value="Marcar como recebido!" />
</form>

<form action="fazer_pedido.php" method="post">
    <input type="submit" value="Fazer Pedido" />
</form>

</html>
