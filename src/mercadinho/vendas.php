<html lang="pt-br">
<h1>Registro de vendas</h1>
<!--- Caixas de entrada e botões --->
<form action="gerente.php">
    <input type="submit" value="Voltar" />
</form>

 <?php

     include_once ("Classes/Venda.php");

     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "mercadinho";

     // Conexao com o servidor
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     $action = new Venda();
     $action->mostrarVenda($conn);

     if ( isset( $_POST['procurar'] )) {
         $id_venda = $_REQUEST['id_venda'];
         $action->procurarVenda($id_venda, $conn);
     }

     if(isset($_POST['excluir'])){
         $id_venda = $_REQUEST['id_venda'];
         $action->excluirVenda($id_venda, $conn);
     }
 ?>
 <br><b>Buscar detalhes sobre uma venda</b>
 <form action="vendas.php" method="post">
     <input type="text" name="id_venda" placeholder="Código da venda" required />
     <input type="submit" name="procurar" value="Procurar" />
     <input type="submit" name="excluir" value="Excluir" />
 </form>

</html>
