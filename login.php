<?php

include("config.php");

 $mysql = new BancodeDados();
 $mysql->conecta();
 $loginAluno = $_POST['codAluno'];
 $senhaAluno = $_POST['senhaAluno'];

 $sqlstring = ("SELECT * FROM estudante WHERE codAluno=$loginAluno AND senhaAluno='$senhaAluno'");

 $query = @mysqli_query($mysql->con, $sqlstring) or die ("Erro ao selecionar as informações");

 if (strlen($senhaAluno)<1){
     echo 'Senha inválida tente novamente';
 }
 else {
     echo "<script>location.href='index.php';</script>";
 }

//$stmt = $pdo->prepare('select from estudante')

?>



