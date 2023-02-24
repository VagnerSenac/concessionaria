<?php
echo "oii"
$conexao2 = mysqli_connect("localhost","root","","banco");
$id = $_POST['id'];
$sql2 = "DELETE FROM veiculos WHERE id = $id"; 
mysqli_query($conexao2,$sql2);
if($conexao2->query($sql2) == TRUE){
    echo "apagado com sucesso"; 
}else{
    echo "ERRO, registro não apagado";
}
mysqli_close($conexao2);

   

?>