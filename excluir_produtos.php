<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <link rel="stylesheet" href="estilo.css">
  <title>Cadastro de Veículos</title>
 </head>
 
<body class="bg-secondary p-2 text-dark bg-opacity-25">

<div class="row">
<div class="col">
<br>
<h1 class="my-5">Usuário Logado: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
</div>
<div class="col">
<br><br><br><br>
 <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
 </div>
</div>

<div class="container">
<h1> Exclusão DE VEÍCULOS</h1>

<form method="post">
<div class="mb-3">
<br>
<label for="exampleFormControlInput1" class="form-label">ID do veículo</label>
<input name="id" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Digite o ID do veículo que queira buscar">
<input type="submit"  name="botaobuscar" value="Buscar" class="btn btn-primary">
</div>

<?php

if(array_key_exists('botaobuscar', $_POST)){
    btbuscar();
}

function btbuscar(){
$id = $_POST['id'];
$conexao = mysqli_connect("localhost","root","","banco");
$sql_pesquisar = "select * from veiculos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql_pesquisar);

echo "<table class='table table-dark table-hover'>
 <tr>
 <th>ID</th>
 <th>Tipo</th>
 <th>Modelo</th>
 <th>Ano</th>
 <th>Marca</th>
 <th>Cor</th>
 <th>Acessórios</th>
 <th>Combustivel</th>
 <th>Foto</th>
 </tr>";

 while($linha = mysqli_fetch_assoc($resultado)){

    echo "<tr>";
    echo "<td>{$linha['id']}<td>";
    echo "<td>{$linha['tipo']}<td>";
    echo "<td>{$linha['modelo']}<td>";
    echo "<td>{$linha['ano']}<td>";
    echo "<td>{$linha['marca']}<td>";
    echo "<td>{$linha['cor']}<td>";
    echo "<td>{$linha['acessorios']}<td>";
    echo "<td>{$linha['combustivel']}<td>";
    echo "<td><img src='{$linha['foto']}' width='300' height='200'><td>";
    echo "</tr>";
}
 echo "</table>";
 echo "<br><br><br>";
 echo "<form method='post'>";
 echo "<input type='hidden' name='id' value='$id'>";
 echo "<input type='submit' class='btn btn-primary'name='botaoapagar'value='Apagar produto'>";
 mysqli_close($conexao);
}

if(array_key_exists('botaoapagar', $_POST)){
    btapagar();
}
function btapagar(){
    $id = $_POST['id'];
    $conexao = mysqli_connect("localhost","root","","banco");   
    $sql = "DELETE FROM veiculos WHERE id = $id";
    mysqli_query($conexao,$sql);
    if($conexao->query($sql) == TRUE){
        echo "apagado com sucesso"; 
    }else{
        echo "ERRO, registro não apagado";
    }
    mysqli_close($conexao); 
  
}

 ?>



</body>
</html>
